<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'title' => 'Наличные',
            'machine_title' => 'nal',
            'description' => 'Оплата наличными при получении'
        ]);

        PaymentMethod::create([
            'title' => 'Банковский перевод',
            'machine_title' => 'beznal',
            'description' => 'Оплата безналичным переводом'
        ]);

        PaymentMethod::create([
            'title' => 'Онлайн оплата',
            'machine_title' => 'cloudpayment',
            'description' => 'Оплата безналичным переводом',
        ]);
        
    }
}
