<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BranchOffice;
use App\Models\User;
use App\Models\Role;
use App\Services\SyncService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class AdminDealerController extends Controller
{

    // public function index()
    // {
    //     $dealerRoleId = Role::where('machine_title', 'dealer')->value('id');
    //     $dealers = User::where('role_id', '=', $dealerRoleId)->paginate(20);
    //     return view('admin.dealers.index', compact('dealers'));
    // }

    public function index()

    {
        $role_id = Role::where('machine_title', 'dealer')->first();
        $dealers = User::where('role_id', '=', $role_id->id)->orderBy('id', 'desc')->paginate(20);
        return view('admin.dealers.index', compact('dealers'));
    }



    public function create()
    {
        return view('admin.dealers.create', ['roles' => Role::all()]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'company_name' => 'nullable',
            'bin' => 'required|digits:12|unique:users,bin',
            'password' => 'required|min:2',
            'repassword' => 'required|same:password',
        ]);

        $data = $request->all();
        $data['role_id'] = Role::where('machine_title', 'dealer')->first()->id;

        User::create($data);

        $responce = SyncService::post(
            'users/new',
            [
                "name" => $request->name,
                "email" => $request->email,
                "bin" => $request->bin,
                "company_name" => $request->company_name,
                "address" => "",
                "phones" => $request->phone
            ]
        );

        Log::info('1c users/new ' . $request->bin . ': ' . $responce['body']);

        return redirect()->route('admin.dealers.index')
            ->with('success', 'Dealer created successfully.');
    }

    public function show(User $dealer)
    {
        $branchoffices = $dealer->branchoffices()->paginate(20);
        return view('admin.dealers.show', compact('dealer', 'branchoffices'));
    }

    public function edit(User $dealer)
    {
        return view('admin.dealers.edit', compact('dealer'));
    }

    public function update(Request $request, User $dealer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'company_name' => 'nullable',
            'bin' => 'required|digits:12|unique:users,bin',
        ]);

        $dealer->update($request->all());

        $user_new_data =
            [
                "company_name" => $request->company_name,
                "phones" => $request->phone
            ];

        $responce_user_update = SyncService::patch(
            'users/' . $dealer->bin,
            $user_new_data
        );

        Log::info('1c users/update ' . $request->bin . ': ' . $responce_user_update['body']);

        return redirect()->route('admin.dealers.show', [$dealer])
            ->with('success', 'Dealer updated successfully.');
    }

    public function destroy(User $dealer)
    {
        DB::transaction(function () use ($dealer) {
            if ($dealer->cart != null){
                foreach($dealer->cart as $cart){
                    foreach($cart->items as $cartItem){
                        $cartItem->delete();
                    }
                    $orders = Order::where('cart_id', $cart->id)->get();
                    foreach($orders as $order){
                        $order->delete();
                    }
                    $cart->delete();
                }
            }
        });

        $dealer->branchoffices()->delete();

        if ($dealer->id != 1) {
            $dealer->delete();
        }

        return redirect()->route('admin.dealers.index')
            ->with('success', 'User deleted successfully.');
    }


    //здесь начинается crud для точек продаж (branch office)

    public function branchOfficeCreate(User $dealer)
    {
        return view('admin.branchoffices.create', ['dealer' => $dealer]);
    }


    public function branchofficestore(Request $request, User $dealer)
    {
        $request->validate([
            'title' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $data = $request->all();
        $data['user_id'] = $dealer->id;
        Branchoffice::create($data);

        return redirect()->route('admin.dealers.show', [$dealer->id])
            ->with('success', 'Branchoffice created successfully.');
    }

    public function branchofficeshow(User $dealer)
    {
        $branchoffices = $dealer->branchoffices()->orderBy('id', 'desc')->paginate(20);
        return view('admin.dealers.show', compact('dealer', 'branchoffices'));
    }

    public function branchofficeedit(User $dealer, BranchOffice $branchoffice)
    {
        return view('admin.branchoffices.edit', compact('dealer', 'branchoffice'));
    }

    public function branchofficeupdate(Request $request, User $dealer, BranchOffice $branchoffice)
    {
        $request->validate([
            'title' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $branchoffice->update($request->all());

        $branchoffice->fill($request->except(['is_visible']));
        $branchoffice->is_visible = $request->has('is_visible');
        $branchoffice->save();

        return redirect()->route('admin.dealers.show', compact('dealer'))
            ->with('success', 'Dealer updated successfully.');
    }

    public function branchofficedestroy(User $dealer, BranchOffice $branchoffice)
    {
        $branchoffice->delete();

        return redirect()->route('admin.dealers.show', compact('dealer'))
            ->with('success', 'User deleted successfully.');
    }
}
