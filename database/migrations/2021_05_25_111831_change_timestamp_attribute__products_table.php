<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeTimestampAttributeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attribute__products', function (Blueprint $table) {
            DB::statement("ALTER TABLE `attribute__products` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute__products', function (Blueprint $table) {
            DB::statement("ALTER TABLE `attribute__products` CHANGE `created_at` `created_at` TIMESTAMP NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL");
        });
    }
}
