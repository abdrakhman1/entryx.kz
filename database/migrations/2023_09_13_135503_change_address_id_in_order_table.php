<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            // $table->dropForeign('address_id');
            $table->dropForeign('orders_address_id_foreign');
            // $table->dropColumn('address_id');
            // $table->integer('address_id')->nullable()->change();
            // $table->foreignId('address_id')->nullable()->constrained()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
