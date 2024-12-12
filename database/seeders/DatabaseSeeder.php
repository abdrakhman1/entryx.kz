<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\City;
use App\Models\PostType;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::create([
            'email' => 'admin@entryx.loc',
            'password' => Hash::make('t5ggt816645u65'),
            'name' => 'Суперадмин',
            'role_id' => 1,
        ]);

        \App\Models\User::create([
            'email' => 'customer@entryx.loc',
            'password' => Hash::make('t678gvfd5u65'),
            'name' => 'Тестовый покупатель',
            'role_id' => 3,
        ]);

        \App\Models\DocumentType::create(
            [
                'name' => 'Изображение товара',
                'machine_title' => 'product_image',
            ]
        );

        \App\Models\DocumentType::create(
            [
                'name' => 'Ссылка на видео товара',
                'machine_title' => 'product_video_link',
            ]
        );

        \App\Models\Role::create([
            'name' => 'Суперадмин',
            'machine_title' => 'sa',
        ]);

        \App\Models\Role::create([
            'name' => 'Менеджер',
            'machine_title' => 'manager',
        ]);

        \App\Models\Role::create([
            'name' => 'Покупатель',
            'machine_title' => 'customer',
        ]);

        \App\Models\Role::create([
            'name' => 'Заведующий складом',
            'machine_title' => 'storeman',
        ]);

        \App\Models\Setting::create([
            'other' => ''
        ]);




        City::create(
            [
                'title' => 'Астана',
                'latitude' => 51.1468,
                'longitude' => 71.4304,
            ], 
        );
        City::create(
            [
                'title' => 'Кокшетау',
                'latitude' => 53.2851,
                'longitude' => 69.3755,
            ]
        );
        City::create(
            [
                'title' => 'Павлодар',
                'latitude' => 52.2855,
                'longitude' => 76.9407,
            ]
        );
        City::create(
            [
                'title' => 'Шымкент',
                'latitude' => 42.3155,
                'longitude' => 69.5869,
            ]
        );

        PostType::create([
            'title' => 'Страница',
            'machine_title' => 'page',
            'slug' => 'page',
        ]);
        PostType::create([
            'title' => 'Новость',
            'machine_title' => 'news',
            'slug' => 'news',
        ]);
        PostType::create([
            'title' => 'Статья',
            'machine_title' => 'article',
            'slug' => 'article',
        ]);


        $category = Category::create([
            'title' => 'Двери',
            'parent_id' => null,
        ]);

        Product::create([
            'category_id' => $category->id,
            'title' => 'Test door AC-130',
            'description' => fake()->text(20),
            'price' => '10',
            'quantity' => 60,
        ]);
        

    }
}
