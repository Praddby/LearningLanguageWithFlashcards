<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCardsRequest;
use App\CardGroup;
use App\UserCards;
use App\User;

class UserCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user()->cardGroups()->with('userCards')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserCardsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCardsRequest $request)
    {
        $cardGroup = CardGroup::create($request->all());
        $cardGroup->user()->associate(Auth::user());
        $cardGroup->save();
        
        foreach ($data['cards'] as $card) {
            if ( $card['name_original'] == '' || $card['name_translation'] == '') continue;
            $userCards = new UserCards([
                'name_original'    => $card['name_original'],
                'name_translation' => $card['name_translation'],
            ]);

            $userCards->cardGroup()->associate($cardGroup);
            $userCards->user()->associate(Auth::user());

            $userCards->save();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
