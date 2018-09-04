<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    public function up()
    {
        $categories = [
            [
                'name'        => '蔬菜',
                'description' => '蔬菜',
            ],
            [
                'name'        => '水果',
                'description' => '水果',
            ],
            [
                'name'        => '肉类',
                'description' => '肉类',
            ],
            [
                'name'        => '干货',
                'description' => '干货',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    public function down()
    {
        DB::table('categories')->truncate();
    }
}
