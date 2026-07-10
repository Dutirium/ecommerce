<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Add replacement index for cart_id foreign key
        |--------------------------------------------------------------------------
        */

        Schema::table('cart_items', function (Blueprint $table) {
            $table->index(
                'cart_id',
                'cart_items_cart_id_index'
            );
        });


        /*
        |--------------------------------------------------------------------------
        | Replace old unique constraint
        |--------------------------------------------------------------------------
        */

        Schema::table('cart_items', function (Blueprint $table) {

            $table->dropUnique(
                'cart_items_cart_id_product_id_unique'
            );

            $table->unique(
                [
                    'cart_id',
                    'product_id',
                    'size',
                ],
                'cart_items_cart_product_size_unique'
            );
        });
    }


    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {

            $table->dropUnique(
                'cart_items_cart_product_size_unique'
            );

            $table->unique(
                [
                    'cart_id',
                    'product_id',
                ],
                'cart_items_cart_id_product_id_unique'
            );
        });


        Schema::table('cart_items', function (Blueprint $table) {

            $table->dropIndex(
                'cart_items_cart_id_index'
            );
        });
    }
};