<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Property;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\PropertyValue;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\PaymentLink;
use App\Models\PaymentMethod;
use App\Services\CloudpaymentsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Services\EmailService;

class ApiCatalogController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function catalog_dealer(Request $request)
    {

        $request->validate([
            'sortBy' => [
                'nullable',
                Rule::in(['price', 'created_at'])
            ],
            'direction' => [
                'nullable',
                Rule::in(['asc', 'desc'])
            ],
        ]);

        $sort_by = 'id';
        if ($request->sortBy) {
            $sort_by = $request->sortBy;
        }

        $sort_direction = 'desc';
        if ($request->direction) {
            $sort_direction = $request->direction;
        }

        $products = Product::orderBy($sort_by, $sort_direction)->paginate(20);
        foreach ($products as $product) {
            $product['image_path'] = url($product->get_main_image_path('medium'));
        }

        return $this->sendResponse($products);
    }

    public function catalog_category_dealer(Category $category, Request $request)
    {
        $request->validate([
            'sortBy' => [
                'nullable',
                Rule::in(['price', 'created_at'])
            ],
            'direction' => [
                'nullable',
                Rule::in(['asc', 'desc'])
            ],
        ]);

        $sort_by = 'id';
        if ($request->sortBy) {
            $sort_by = $request->sortBy;
        }

        $sort_direction = 'desc';
        if ($request->direction) {
            $sort_direction = $request->direction;
        }

        $products = Product::where('category_id', $category->id)
            ->orderBy($sort_by, $sort_direction)
            ->paginate(20);

        foreach ($products as $product) {
            $product['image_path'] = url($product->get_main_image_path('medium'));
        }

        return $this->sendResponse($products);
    }


    public function catalog(Request $request)
    {

        $request->validate([
            'sortBy' => [
                'nullable',
                Rule::in(['price', 'created_at'])
            ],
            'direction' => [
                'nullable',
                Rule::in(['asc', 'desc'])
            ],
        ]);

        $sort_by = 'id';
        if ($request->sortBy) {
            $sort_by = $request->sortBy;
        }

        $sort_direction = 'desc';
        if ($request->direction) {
            $sort_direction = $request->direction;
        }

        $products = Product::select(['id', 'category_id', 'title', 'slug', 'description'])
            ->orderBy($sort_by, $sort_direction)
            ->paginate(20);

        foreach ($products as $product) {
            $product['image_path'] = url($product->get_main_image_path('medium'));
        }
        return $this->sendResponse($products);
    }

    public function filter_data()
    {
        $filter_data = Property::filter_data();
        return $this->sendResponse($filter_data);
    }



    public function catalog_category(Category $category, Request $request)
    {
        $request->validate([
            'sortBy' => [
                'nullable',
                Rule::in(['price', 'created_at'])
            ],
            'direction' => [
                'nullable',
                Rule::in(['asc', 'desc'])
            ],
        ]);

        $sort_by = 'id';
        if ($request->sortBy) {
            $sort_by = $request->sortBy;
        }

        $sort_direction = 'desc';
        if ($request->direction) {
            $sort_direction = $request->direction;
        }

        $products = Product::where('category_id', $category->id)
            ->select(['id', 'category_id', 'title', 'slug', 'description'])
            ->orderBy($sort_by, $sort_direction)
            ->paginate(20);

        foreach ($products as $product) {
            $product['image_path'] = url($product->get_main_image_path('medium'));
        }
        return $this->sendResponse($products);
    }

    public function cart()
    {
        return $this->sendResponse(Cart::items_for_api());
    }

    public function add_to_cart(Product $product)
    {
        $cart = Cart::current();
        $cart->add_to_cart($product->id);
        return $this->sendResponse(Cart::items_for_api());
    }

    public function add_to_cart_variant($variant_id)
    {
        $cart = Cart::current();
        $cart->add_to_cart_variant($variant_id);
        return $this->sendResponse(Cart::items_for_api());
    }

    public function cart_increase_product($cart_item_id)
    {
        $cart = Cart::current();
        $count = CartItem::find($cart_item_id)->quantity;
        $cart->increase_item($cart_item_id);
        $count_new = CartItem::find($cart_item_id)->quantity;
        if ($count_new == $count) {
            $message = 'Больше нельзя добавлять в корзину данный товар';
        } else {
            $message = '';
        }

        return $this->sendResponse(Cart::items_for_api(), $message);
    }

    public function cart_reduce_product($cart_item_id)
    {
        $cart = Cart::current();
        $cart_item = CartItem::find($cart_item_id);
        if ($cart_item) {
            $cart->reduce_item($cart_item_id);
        }
        return $this->sendResponse(Cart::items_for_api());
    }

    public function cart_delete_product($cart_item_id)
    {
        $cart = Cart::current();
        $cart->delete_item($cart_item_id);
        return $this->sendResponse(Cart::items_for_api());
    }

    public function payments()
    {
        return $this->sendResponse(PaymentMethod::visible()->get());
    }

    public function make_cart_to_order(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'payment_method' => 'required',
            ]
        );

        if ($validate->fails()) {
            return $this->sendError($validate->errors());
        }

        $cart = Cart::current();
        if ($cart->items->count() == 0) {
            return $this->sendError('Пустая корзина');
        }

        $order = $cart->make_to_order('', $request->payment_method);

        if ($order->paymentMethod->machine_title == 'kaspi_qr') {
            $order->status = 2;
            $order->save();

            $order->payment_link = $order->payment_link_model->link;
        }

        if ($order->paymentMethod->machine_title == 'cloudpayment') {
            $order->status = 2;
            $order->save();

            $cloudpayment = new CloudpaymentsService();
            $response = $cloudpayment->create_order(
                $order->total_amount,
                $order->user->email,
                'Заказ №' . $order->id,
                $order->id,
                $order->user->id
            );

            PaymentLink::create([
                'link' => $response['Model']['Url'],
                'order_id' => $order->id,
            ]);

            $order->payment_link = $order->payment_link_model->link;
        }

        $this->emailService->sendOrderConfirmation($order);

        return $this->sendResponse([$order]);
    }

    public function orders()
    {
        $orders = Order::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->paginate(20);
        foreach ($orders as $order) {
            $order->paymentMethod;
            $order['human_status'] = $order->human_status();
            $order['payment_link'] = null;
            if ($order->paymentMethod->machine_title == 'kaspi_qr' && in_array($order->status , [0, 1, 2])) {
                $order['payment_link'] = "https://pay.kaspi.kz/pay/c8qjtcwo";
            }
            if ($order->paymentMethod->machine_title == 'cloudpayment' && in_array($order->status , [0, 1, 2])) {
                $order['payment_link'] = $order->payment_link_model->link ?? null;
            }

            if ($order->status == 3) {
                QrCode::size(270)
                    ->generate(
                        url('/storeman/order/uuid/' . $order->uuid),
                        base_path('public/images/orders/qr_order_' . $order->id . '.svg')
                    );

                $order['qr_link'] = url('/images/orders/qr_order_' . $order->id . '.svg');
            } else {
                $order['qr_link'] = null;
            }
        }
        return $this->sendResponse($orders);
    }

    public function orders_create()
    {
        $user = auth()->user();
        $cloudpayment = new CloudpaymentsService();
        // $response = $cloudpayment->test();
        $response = $cloudpayment->create_order(
            11,
            'client@test.local',
            'тестовый заказ',
            2,
            $user->id
        );


        $data = $response;
        return $this->sendResponse($data);
    }



    public function catalog_brand($brand_title)
    {
        if (!in_array(strtolower($brand_title), ['megi', 'ретвизан', 'str', 'phillips', 'ela'])) {
            abort(404);
        };

        if (in_array(strtolower($brand_title), ['megi', 'ретвизан', 'str'])) {
            $category = Category::where('title', 'Входные двери')->first();
        } elseif (in_array(strtolower($brand_title), ['phillips', 'ela'])) {
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

        $products = Product::select(['id', 'category_id', 'title', 'slug', 'description'])
            ->whereIn('id', $productIds)->paginate(20);

        foreach ($products as $product) {
            $product['image_path'] = url($product->get_main_image_path('medium'));
        }

        $filter_data = Property::filter_data();
        return $this->sendResponse($products);
    }

    public function catalog_brand_portal($brand_title)
    {
        if (!in_array(strtolower($brand_title), ['megi', 'ретвизан', 'str', 'phillips', 'ela'])) {
            abort(404);
        };

        if (in_array(strtolower($brand_title), ['megi', 'ретвизан', 'str'])) {
            $category = Category::where('title', 'Входные двери')->first();
        } elseif (in_array(strtolower($brand_title), ['phillips', 'ela'])) {
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

        $products = Product::whereIn('id', $productIds)->paginate(20);

        foreach ($products as $product) {
            $product['image_path'] = url($product->get_main_image_path('medium'));
        }

        $filter_data = Property::filter_data();
        return $this->sendResponse($products);
    }

    public function product_properties()
    {
        // $properties = Property::all();
        $properties = Property::with(['propertyValues' => function ($query) {
            $query->select('property_id', 'value')->distinct();
        }])->get(['id', 'title']);

        foreach ($properties as $property) {
            foreach ($property->propertyValues as $key => $val) {
                if ($val->value == null) {
                    $property->propertyValues->forget($key);
                }
            };
        }

        return $this->sendResponse($properties);
    }


    public function filter_products(Request $request)
    {
        $filters = $request->input('filters', []); // Получаем фильтры из тела запроса

        // $products = Product::whereHas('propertyValues', function ($query) use ($filters) {
        //     foreach ($filters as $filter) {
        //         // Предполагается, что каждый фильтр содержит 'property_id' и 'value'
        //         $query->where(function ($q) use ($filter) {
        //             $q->where('property_id', $filter['property_id'])
        //                 ->where('value', $filter['value']);
        //         });
        //     }
        // })->get();

        // // Фильтры могут быть переданы в формате:
        // // {"1":["2m", "2.5m"], "2":["Красный"]}
        // $filters = $request->input('filters', []);

        // $products = Product::whereHas('propertyValues', function ($query) use ($filters) {
        //     foreach ($filters as $propertyId => $values) {
        //         // Добавляем подзапрос для каждого свойства
        //         $query->orWhere(function ($query) use ($propertyId, $values) {
        //             $query->where('property_id', $propertyId)
        //                 ->whereIn('value', $values);
        //         });
        //     }
        // })->get();

        $products = Product::where(function ($query) use ($filters) {
            foreach ($filters as $propertyId => $values) {
                // Для каждого свойства создаем отдельный подзапрос
                $query->whereHas('propertyValues', function ($query) use ($propertyId, $values) {
                    $query->where('property_id', $propertyId)
                        ->whereIn('value', $values);
                });
            }
        })->get();

        foreach ($products as $product) {
            $product['image_path'] = url($product->get_main_image_path('medium'));
        }

        return $this->sendResponse($products);
    }
}
