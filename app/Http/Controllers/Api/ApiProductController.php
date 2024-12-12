<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function show(Product $product)
    {

        $properties = [];
        foreach($product->get_properties() as $property){
            $properties[] = [
                $property->property->title => $property->value
            ];
        }

        $images = [];
        foreach($product->documents as $document){
            if($document->documentType->machine_title == 'product_image'){
                $images[] = [
                    'type' => 'image',
                    'url_full' => url($document->getImagePublicPath()),
                    'url_thumbnail' => url($document->getImagePublicPath('thumbnail'))
                ];
            }
            if($document->documentType->machine_title == 'product_video_link'){
                $images[] = [
                    'type' => 'video',
                    'video_thumbnail' => url($document->getYoutubeThumbnailPath()),
                    'url' => $document->link
                ];
            }
        }

        $variants = [];
        foreach ($product->variants as $variant){
            $variants[] = [
                'title' => $variant->title,
                'price' => $variant->price,
                'quantity' => $variant->quantity,
            ];
        }

        unset($product->price);
        unset($product->documents);
        unset($product->variants);

        return $this->sendResponse([
            'product' => $product,
            'properties' => $properties,
            'images' => $images,
            'variants' => $variants,
            'main_image_path' => asset($product->get_main_image_path()),
        ]);
    }

    public function show_dealer(Product $product)
    {
        $properties = [];
        foreach($product->get_properties() as $property){
            $properties[] = [
                $property->property->title => $property->value
            ];
        }

        $images = [];
        foreach($product->documents as $document){
            if($document->documentType->machine_title == 'product_image'){
                $images[] = [
                    'type' => 'image',
                    'url_full' => url($document->getImagePublicPath()),
                    'url_thumbnail' => url($document->getImagePublicPath('thumbnail'))
                ];
            }
            if($document->documentType->machine_title == 'product_video_link'){
                $images[] = [
                    'type' => 'video',
                    'video_thumbnail' => url($document->getYoutubeThumbnailPath()),
                    'url' => $document->link
                ];
            }
        }

        unset($product->documents);
        unset($product->variants);

        return $this->sendResponse([
            'product' => $product,
            'properties' => $properties,
            'images' => $images,
            'variants' => $product->variants,
            'main_image_path' => asset($product->get_main_image_path()),
        ]);
    }

    public function search(Request $request)
    {
        $searchable_string = $request->searchable_string;
        $products = Product::select(['id', 'category_id', 'title'])
            ->where('title', 'like', '%' . $searchable_string . '%')
            ->take(10)
            ->get();

        if ($products->count() === 0) {
            return $this->sendResponse([], 'Товар не найден');
        }

        foreach($products as $product){
            $product['image_path'] = url($product->get_main_image_path('thumbnail'));
        }

        return $this->sendResponse($products);
    }
}
