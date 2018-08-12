<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Cards;

class CardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
	        $category = Category::create([
	            'name_category' => 'Путишествие',
	            'is_standard' => true,
	        ]);

	        for ($i=0; $i < 11; $i++) { 
	            Cards::insert([
	                'name_original' => str_random(10),
	                'name_translation' => str_random(10),
	                'category_id' => $category->id,
	            ]);
	        }
	    });

	    DB::transaction(function () {
	        $category = Category::create([
	            'name_category' => 'Ресторан',
	            'is_standard' => true,
	        ]);

	        for ($i=0; $i < 8; $i++) { 
	            Cards::insert([
	                'name_original' => str_random(10),
	                'name_translation' => str_random(10),
	                'category_id' => $category->id,
	            ]);
	        }
	    });

	    DB::transaction(function () {
	        $category = Category::create([
	            'name_category' => 'Поход к врачу',
	            'user_id' => 2,
	        ]);

	        for ($i=0; $i < 7; $i++) { 
	            Cards::insert([
	                'name_original' => str_random(10),
	                'name_translation' => str_random(10),
	                'category_id' => $category->id,
	                'user_id' => 2,
	            ]);
	        }
	    });

	    DB::transaction(function () {
	        $category = Category::create([
	            'name_category' => 'Поход к магазин',
	            'user_id' => 2,
	        ]);

	        for ($i=0; $i < 8; $i++) { 
	            Cards::insert([
	                'name_original' => str_random(10),
	                'name_translation' => str_random(10),
	                'category_id' => $category->id,
	                'user_id' => 2,
	            ]);
	        }
	    });
    }
}
