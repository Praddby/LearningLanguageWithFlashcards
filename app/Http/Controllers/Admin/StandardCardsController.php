<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CardGroup;
use App\StandardCards;
use App\Http\Requests\StandardCardsRequest;

class StandardCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CardGroup::with('standardCards')->standardCards()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StandardCardsRequest $request)
    {
        $cardGroup = CardGroup::create($request->all());
        $cardGroup->setStandard();
        $cardGroup->save();
        
        foreach ($request['cards'] as $card) {
            if ( $card['name_original'] == '' || $card['name_translation'] == '') continue;
            $standardCards = new StandardCards([
                'name_original'    => $card['name_original'],
                'name_translation' => $card['name_translation'],
            ]);

            $standardCards->cardGroup()->associate($cardGroup);

            $standardCards->save();
        }

        return $cardGroup->fresh('standardCards');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StandardCardsRequest $request, $id)
    {
        $card = StandardCards::find($id);
        $card->name_original    = $request->card['name_original'];
        $card->name_translation = $request->card['name_translation'];
        $card->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StandardCards::destroy( $id );
    }
}
