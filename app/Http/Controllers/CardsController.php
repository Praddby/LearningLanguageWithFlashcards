<?php

namespace App\Http\Controllers;

use App\Card;
use App\CardGroup;
use Illuminate\Http\Request;
use Validator;

class CardsController extends Controller
{
    
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name_category' => 'required|string',
        ]);
        
        if ($validated->fails()) {
            return redirect('/home')
                    ->withErrors($validator)
                    ->withInput();
        }

        $cardgroup = CardGroup::create([
            'name_category' => $request->input('name_category'),
        ]);

        foreach ($request->input('name_original') as $key => $value) {
            if ( $value == '' || $request->input('name_translation')[$key] == '' ) continue;
            Card::create([
                'name_original'    => $value,
                'name_translation' => $request->input('name_translation')[$key],
                'cardgroup_id'     => $cardgroup->id,
            ]);
        }
        return redirect()->back();
    }

   
    public function show()
    {
        return response( CardGroup::with('cards')->get() );
    }

    
    
    public function edit(Cards $cards)
    {
        //
    }

    
    public function destroy(Cards $cards)
    {
        //
    }
}
