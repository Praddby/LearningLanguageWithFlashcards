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
        $data = $request->validated();
        
        $cardGroup = CardGroup::create($data);

        foreach ($data['name_original'] as $key => $value) {
            if ( $value == '' || $data['name_translation'][$key] == '' ) continue;
            $card = new Card([
                'name_original'    => $value,
                'name_translation' => $data['name_translation'][$key],
            ]);

            $card->cardGroup()->associate($cardGroup);

            $card->save();

        }
        return redirect()->back();
    }

   
    public function show()
    {
        return response( CardGroup::with('cards')->get() );
    }

    

    public function edit(Request $request)
    {
        Card::where('id', $request['card']['id'])
            ->update([
                'name_original'     => $request['card']['name_original'],
                'name_translation'  => $request['card']['name_translation']
            ]);
    }

    
    public function destroy(Request $request)
    {

        $result = Card::destroy( $request['card']['id'] );

        return response( $result );
    }
}
