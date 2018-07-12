<?php

use Illuminate\Database\Seeder;
use App\CardGroup;
use App\StandardCards;


class StandardCardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $card_group = CardGroup::create([
            'name_category' => 'Путишествие',
            'is_standard'   => true,
        ]);

        for ($i=0; $i < 11; $i++) { 
            StandardCards::insert([
                'name_original'    => str_random(10),
                'name_translation' => str_random(10),
                'card_group_id'    => $card_group->id,
            ]);
        }


        $card_group = CardGroup::create([
            'name_category' => 'Ресторан',
            'is_standard'   => true,
        ]);

        for ($i=0; $i < 8; $i++) { 
            StandardCards::insert([
                'name_original'    => str_random(10),
                'name_translation' => str_random(10),
                'card_group_id'    => $card_group->id,
            ]);
        }
    }
}
