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
        //
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quantity')->default('1');
            $table->decimal('amount');

            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('item');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('cart', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropColumn('item_id');

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });


        Schema::dropIfExists('return_item');
    }
};
