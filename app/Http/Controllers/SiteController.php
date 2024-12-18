<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use App\Models\Category;
use App\Models\Document;
use App\Models\Order;
use App\Models\PaymentCallback;
use App\Models\Post;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\SyncService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SiteController extends Controller
{
    public function home()
    {
        
                // ID нужных замков
        $lockIds = [65, 64, 63, 73, 72, 71, 70, 61, 38, 37, 36, 35]; // Замените на реальные ID

        $locks = Product::where('category_id', 2)
            ->where('visible', 1)
            ->whereIn('id', $lockIds)
            ->get()
            ->map(function($lock) {
                $lock->image = $lock->get_main_image_path();
                return $lock;
            });


        return view('site.templates.pages.index', compact('locks'));
    }

    public function show_post($slug)
    {
        $post = Post::where('slug', $slug)->where('visible', true)->firstOrFail();
        return view('site.posts.show', compact('post'));
    }

    public function about()
    {
        return view('site.templates.pages.about');
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

        $all_category = true;
        return view('site.templates.pages.catalog', compact('products', 'filter_data', 'all_category'));
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
        return view('site.templates.pages.catalog', compact('products', 'filter_data'));
    }

    public function catalog_brand($brand_title)
    {
        if(!in_array( strtolower($brand_title), ['megi', 'ретвизан', 'str', 'phillips', 'ela', 'tenon'])){
            abort(404);
        };

        if (in_array(strtolower($brand_title), ['megi', 'ретвизан', 'str'])){
            $category = Category::where('title', 'Входные двери')->first();
        } elseif (in_array(strtolower($brand_title), ['phillips', 'ela', 'tenon'])) {
            $category = Category::where('title', 'Умные электронные замки')->first();
        }

        $property = Property::where('category_id', $category->id)
            ->where('title', 'Бренд')
            ->first();

        $property_values = PropertyValue::where('property_id', $property->id)
            ->where('value', $brand_title)
            ->get();

        $productIds = [];
        foreach ($property_values as $value) {
            $productIds[] = $value->product->id;
        }

        $products = Product::whereIn('id', $productIds)->paginate(30);

        $filter_data = Property::filter_data();
        return view('site.templates.pages.catalog', compact('products', 'filter_data'));
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
        return view('site.templates.pages.catalog', compact('products', 'filter_data'));












        $prop_values_query->where('value1', 3)->where('property_id', 4);
        // dd($prop_values_query->toSql());
        $prop_values = $prop_values_query->get();
        dd($prop_values);



        $products = [];
        $products_id = [];
        foreach ($prop_values as $prop_value) {
            $products[] = $prop_value->product;
            $products_id[] = $prop_value->product->id;
        }
        // dd($products_id);
        $products = Product::whereIn('id', $products_id)->paginate(10);
        // dd($products);

        $filter_data = Property::filter_data();
        return view('site.templates.pages.catalog', compact('products', 'filter_data'));






        $prop_values = PropertyValue::where('value', $property_value)->where('property_id', $property_id)->get();
        // dd($prop_values);
        $products = [];
        foreach ($prop_values as $prop_value) {
            $products[] = $prop_value->product;
        }

        $filter_data = Property::filter_data();
        return view('site.templates.pages.catalog', compact('products', 'filter_data'));

    }

    public function product_show(Product $product)
    {
        if (!$product->visible){
            return redirect(route('site.catalog'));
        }
        return view('site.templates.pages.product', compact('product'));
    }

    public function product_search($text)
    {
        usleep(200000);
        $products = Product::select(['id', 'category_id', 'title'])->where('title', 'like', "%$text%")->take(10)->get();
        foreach($products as $product){
            $product['image_path'] = $product->get_main_image_path('thumbnail');
        }
        return $products;
    }


    public function contacts()
    {
        return view('site.templates.pages.contacts');
    }

    public function dealers()
    {
        return view('site.templates.pages.dealers');
    }

    public function branch_offices()
    {
        $branch_offices = BranchOffice::visible()->inRandomOrder()->get();
        return view('site.templates.pages.points_sale', compact('branch_offices'));
    }

    public function branch_offices_search(Request $request)
    {
        usleep(100);
        $result = BranchOffice::where('address', 'like', '%' . $request->query_str . '%')->get();
        return response()->json([
            'query_str' => $request->query_str,
            'result' => $result,
        ]);
    }

    public function about_payment()
    {
        return  view('site.templates.pages.about.payment');
    }

    public function about_requisites()
    {
        return  view('site.templates.pages.about.requisites');
    }

    public function about_privacy()
    {
        return  view('site.templates.pages.about.privacy');
    }

    public function about_public_contract()
    {
        return  view('site.templates.pages.about.public_contract');
    }

    public function cloudpayments_callback(Request $request)
    {
        $uri = urldecode(str_replace('/cloudpayments_callback?', '', $request->getRequestUri()));
        $s = hash_hmac('sha256', $uri, config('app.cloudpayments_secret'), true);
        $hash = base64_encode($s);

        Log::info('post hash: ' . $hash. ", header: " . $request->header('X-Content-HMAC'));

        if ($request->header('X-Content-HMAC') == $hash){
            // hash verified

            PaymentCallback::create([
                'HMAC' => $request->header('X-Content-HMAC'),
                'order_id' => $request->InvoiceId,
                'transaction_id' => $request->TransactionId,
                'card_last_four' => $request->CardLastFour,
                'status' => $request->Status,
                'ip' => $request->IpAddress,
                'data' => $request->Data,
                'raw_body' => $request->getRequestUri(),
            ]);

            $incoming_data = json_decode($request->get('Data'));
            $order = Order::find($incoming_data->cloudPayments->orderData->id);
            $order->payment_status = $request->TransactionId;
            $order->status = 3;
            $order->save();

            Log::info('Order payed: ' . json_encode($order));

            SyncService::post(
                'orders/upload',
                [
                    "order_id" => $order->article,
                    "set_status" => "done",
                    "payment" => "online",
                    "payment_data" => [
                        "datetime" => now()->format('Y-m-d H:i'),
                        "transaction" => $request->TransactionId
                    ]
                ]
            );

            return [
                'code' => 0
            ];

        } else {

            PaymentCallback::create([
                'HMAC' => $request->header('X-Content-HMAC'),
                'order_id' => $request->InvoiceId,
                'transaction_id' => $request->TransactionId,
                'card_last_four' => $request->CardLastFour,
                'status' => $request->Status . ' NOT CONFIRMED',
                'ip' => $request->IpAddress,
                'data' => $request->Data,
                'raw_body' => $request->getRequestUri(),
            ]);

            return [
                'error' => 1
            ];
        }
    }

    public function hmack_test(Request $request)
    {
        $uri = urldecode(str_replace('/hmack_test?', '', $request->getRequestUri()));
        $s = hash_hmac('sha256', $uri, config('app.cloudpayments_secret'), true);
        $hash = base64_encode($s);

        $uri = urldecode(str_replace('/hmack_test?', '', $request->getRequestUri()));

        return [
            'data' => [
                'hash' => "$hash",
                'uri' => $uri,
                'qawe' => json_encode($request->getContent())
            ]
        ];
    }

    public function flushcashed()
    {
        $list = ['thumbnail', 'medium', 'large', 'full'];
        foreach($list as $size_name){
            $rel_path = '/images/' . $size_name . '/';
            if (is_dir(public_path($rel_path))) {
                self::delTree( public_path($rel_path) );
            }
        }

        return redirect('/')->with('success', 'Image cache was cleared');
    }

    public static function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));

        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);

    }


    public function index()
    {
        // Получаем замки (предполагая, что category_id = 2 для замков)
        $locks = Product::where('category_id', 2)
                       ->where('visible', 1)  // Только видимые товары
                       ->take(8)
                       ->get();

        // Для каждого замка получаем основное изображение
        $locks = $locks->map(function($lock) {
            $lock->image = $lock->get_main_image_path(); // Используем ваш существующий метод
            return $lock;
        });

        return view('site.templates.pages.index', [
            'locks' => $locks,
            // другие переменные, если они есть
        ]);
    }


}
