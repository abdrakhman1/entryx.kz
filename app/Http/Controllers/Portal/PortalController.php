<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Services\SyncService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PortalController extends Controller
{
    public function login(){
        return 123;
        return view();
    }

    public function index()
    {
        $last_3_products = Product::orderBy('id', 'desc')->where('visible', 1)->take(3)->get();
        return view('site.templates.portal.index', [
            'last_3_products' => $last_3_products
        ]);
    }

    public function catalog(Request $request)
    {
        $request->validate([
            'sortBy' => [
                'nullable',
                Rule::in(['price','created_at'])
            ],
            'direction' => [
                'nullable',
                Rule::in(['asc','desc'])
            ],
        ]);

        $sort_by = 'id';
        if ($request->sortBy){
            $sort_by = $request->sortBy;
        }

        $sort_direction = 'desc';
        if ($request->direction){
            $sort_direction = $request->direction;
        }

        $products = Product::orderBy($sort_by, $sort_direction)->visible()->paginate(20);
        $filter_data = Property::filter_data();
        return view('site.templates.portal.catalog', compact('products', 'filter_data'));
    }

    public function catalog_category(Category $category, Request $request)
    {
        $request->validate([
            'sortBy' => [
                'nullable',
                Rule::in(['price','created_at'])
            ],
            'direction' => [
                'nullable',
                Rule::in(['asc','desc'])
            ],
        ]);

        $sort_by = 'id';
        if ($request->sortBy){
            $sort_by = $request->sortBy;
        }

        $sort_direction = 'desc';
        if ($request->direction){
            $sort_direction = $request->direction;
        }

        $products = Product::where('category_id', $category->id)
            ->orderBy($sort_by, $sort_direction)
            ->visible()
            ->paginate(20);

        $filter_data = Property::filter_data($category->id);
        return view('site.templates.portal.catalog', compact('products', 'filter_data'));
    }

    public function product(Product $product){
        if (!$product->visible){
            return redirect(route('portal.catalog.index'));
        }
        return view('site.templates.portal.product', compact('product'));
    }

    public function add_to_cart(Product $product)
    {
        $cart = Cart::current();
        $cart->add_to_cart($product->id);
        return back();
    }

    public function add_to_cart_variant($variant_id)
    {
        $cart = Cart::current();
        $cart->add_to_cart_variant($variant_id);
        return back();
    }

    public function posts(){
        $posts = Post::orderBy('id', 'desc')->paginate(6);
        return view('site.templates.portal.posts', compact('posts'));
    }

    public function posts_show(Post $post){
        return view('site.templates.portal.posts_show', compact('post'));
    }

    public function contacts(){
        return view('site.templates.portal.contacts');
    }

    public function about(){
        return view('site.templates.portal.about');
    }

    public function profile(){
        return view('site.templates.portal.profile');
    }

    public function orders(){
        $orders = Order::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->paginate(20);
        return view('site.templates.portal.orders', compact('orders'));
    }

    public function order(Order $order)
    {
        if (Auth::user()->id != $order->user_id){
            return abort(404);;
        }
        return view('site.templates.portal.order_index', compact('order'));
    }

    public function order_qr(Order $order)
    {
        if ($order->status != 3){
            return abort(404);
        }
        return view('site.templates.portal.order_qr', compact('order'));
    }

    public function order_kaspi_qr(Order $order)
    {
        if (Auth::user()->id != $order->user_id){
            return abort(404);;
        }
        return view('site.templates.portal.order_kaspi_qr', compact('order'));
    }

    public function order_cancel(Order $order)
    {
        if (Auth::user()->id != $order->user_id){
            return abort(404);;
        }
        $order->status = -1;
        $order->save();

        $data = [
            "order_id" => $order->article,
            "set_status" => "cancel",
        ];

        Log::info('1c orders/upload data:  ' . json_encode($data));

        $responce = SyncService::post(
            'orders/upload',
            $data
        );

        Log::info('1c orders/upload cancel: ' . $responce['body']);

        return back()->with('success','Заказ отменён');
    }

    public function download_requisits()
    {
        $file= public_path(). "/requisites.pdf";
        $headers = array(
              'Content-Type: application/pdf',
            );
        return response()->download($file, 'Entryx_Requisits.pdf', $headers);
    }

    public function online_payment(Order $order)
    {
        // dd($order);
        if (Auth::user()->id != $order->user_id){
            return abort(404);;
        }
        if ($order->paymentMethod->machine_title != 'cloudpayment' ){
            abort(404);
        }
        if ($order->payment_status){
            return back()->with('success', 'Данный заказ уже оплачен');
        }

        return view('site.templates.portal.online_payment', compact('order'));
    }

    public function catalog_filtred(Request $request)
    {
        // dd($request->all());

        if (!$request->prop){
            $products = Product::paginate(30);
            $filter_data = Property::filter_data();
            return view('site.templates.pages.catalog', compact('products', 'filter_data'));
        }

        $filter_properties = $request->prop;
        // dd($filter_properties);

        $prop_values_query = PropertyValue::query();

        $prop_values_array = [];

        foreach ($filter_properties as $property_id => $values) {
            foreach ($values as $property_value_id => $property_value) {
                // dd($property_id, $property_value);
                $prop_values_array[$property_id][] =
                    PropertyValue::where('value', $property_value)
                        ->where('property_id', $property_id)
                        ->get();
                $prop_values_query->where('value', $property_value)->where('property_id', $property_id);
            }

            // $prop_values_query->where('value', $value)->where('property_id', $property_id);
        }
        // dd($prop_values_array);
        foreach ($prop_values_array as $prop_id => $prop_list){
            foreach ($prop_list as $id => $prop_items){
                // dd($id, $prop_items);
                foreach ($prop_items as $index => $value_prop) {
                    $products[] = $value_prop->product;
                    // dd($value->product);
                }
            }
            // dd($prop_list);
        }
        $products = collect($products)->unique()->all();
        // dd($products);

        // $filter_data = Property::filter_data();
        // return view('site.templates.pages.catalog', compact('products', 'filter_data'));


        $productIds = array_map(function ($product) {
            return $product->id;
        }, $products);

        // dd($productIds);
        $products = Product::whereIn('id', $productIds)->paginate(30);
        // dd($products);
        $filter_data = Property::filter_data();
        return view('site.templates.portal.catalog', compact('products', 'filter_data'));

    }

    function catalog_brand($brand_title)
    {
        if(!in_array( strtolower($brand_title), ['megi', 'ретвизан', 'str', 'phillips', 'ela'])){
            abort(404);
        };

        if (in_array(strtolower($brand_title), ['megi', 'ретвизан', 'str'])){
            $category = Category::where('title', 'Входные двери')->first();
        } elseif (in_array(strtolower($brand_title), ['phillips', 'ela'])) {
            $category = Category::where('title', 'Умные электронные замки')->first();
        }

        $property = Property::where('category_id', $category->id)
            ->where('title', 'Бренд')
            ->first();

        $brand_title;
        $property_values = PropertyValue::where('property_id', $property->id)
            ->where('value', $brand_title)
            ->get();

        $productIds = [];
        foreach ($property_values as $value) {
            $productIds[] = $value->product->id;
        }

        $products = Product::whereIn('id', $productIds)->paginate(30);

        $filter_data = Property::filter_data();
        return view('site.templates.portal.catalog', compact('products', 'filter_data'));
    }

    public function policy(){
        return view('site.templates.portal.policy');
    }

    public function support(){
        return view('site.templates.portal.support');
    }

    public function support_create(){
        return view('site.templates.portal.support_create');
    }

    public function support_show(){
        return view('site.templates.portal.support_show');
    }
}
