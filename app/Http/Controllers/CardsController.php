<?php

namespace App\Http\Controllers;

use App\Card;
use App\CardGroup;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\AddingСard;

class CardsController extends Controller
{
    
    public function store(AddingСard $request)
    {
        $validated = $request->validated();

        $input = $request->all();

        $card_group = CardGroup::create([
            'name_category' => $input['name_category'],
        ]);

        foreach ($input['name_original'] as $key => $value) {
            if ( $value == '' || $input['name_translation'][$key] == '' ) continue;
            Card::create([
                'name_original'    => $value,
                'name_translation' => $input['name_translation'][$key],
                'card_group_id'    => $card_group->id
            ]);
        }
        return redirect()->back();
    }

   
    public function show()
    {
        return response( CardGroup::with('cards')->get() );
    }

    

    public function edit(Card $card, Request $request)
    {
        $world = $request->input('world');

        $card->edit( $world['id'], $world['name_original'], $world['name_translation']);
    }

    
    public function destroy(Card $card, Request $request)
    {
        $world = $request->input('world');
        
        $card->destroy($world['id']);

        return response( CardGroup::with('cards')->get() );
    }
}
