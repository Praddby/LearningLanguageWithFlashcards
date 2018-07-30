<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
     * @param  \Illuminate\Http\StandardCardsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StandardCardsRequest $request)
    {
        $cardGroup = DB::transaction(function () use ($request) {
            $cardGroup = CardGroup::create($request->all());
            $cardGroup->setStandard();
            foreach ($request['cards'] as $card) {
                if ( $card['name_original'] == '' || $card['name_translation'] == '') continue;
                $standardCards = new StandardCards([
                    'name_original'    => $card['name_original'],
                    'name_translation' => $card['name_translation'],
                ]);
                $standardCards->cardGroup()->associate($cardGroup);
                $standardCards->save();

                if ( !isset($standardCards) ) {
                    throw new \Exception("Вы забыли добавить слова в карточку");
                }
            }

            return $cardGroup;
        });

        return $cardGroup->fresh('standardCards');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StandardCardsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StandardCardsRequest $request, $id)
    {
        StandardCards::find($id)->update([
            'name_original'    => $request->card['name_original'],
            'name_translation' => $request->card['name_translation']
        ]);
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
