<?php

use Illuminate\Database\Seeder;
use App\CardGroup;
use App\UserCards;

class UserCardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $card_group = CardGroup::create([
            'name_category' => 'Поход к врачу',
            'user_id'       => 2,
        ]);

        for ($i=0; $i < 7; $i++) { 
            UserCards::insert([
                'name_original'    => str_random(10),
                'name_translation' => str_random(10),
                'card_group_id'    => $card_group->id,
                'user_id'          => 2,
            ]);
        }


        $card_group = CardGroup::create([
            'name_category' => 'Поход к магазин',
            'user_id'       => 2,
        ]);

        for ($i=0; $i < 8; $i++) { 
            UserCards::insert([
                'name_original'    => str_random(10),
                'name_translation' => str_random(10),
                'card_group_id'    => $card_group->id,
                'user_id'          => 2,
            ]);
        }
    }
}
