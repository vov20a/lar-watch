<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeTimestampProductRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_related', function (Blueprint $table) {
            DB::statement("ALTER TABLE `product_related` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_related', function (Blueprint $table) {
            DB::statement("ALTER TABLE `product_related` CHANGE `created_at` `created_at` TIMESTAMP NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL");
        });
    }
}
