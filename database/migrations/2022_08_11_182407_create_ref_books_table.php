<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('alias')->nullable()->unique();
            $table->text('description')->nullable();
            $table->json('options')->nullable();
            $table->foreignId('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('ref_books');
            $table->boolean('visible')->default(true);
            $table->integer('order')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_books');
    }
}
