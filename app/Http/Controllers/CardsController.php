<?php

namespace App\Http\Controllers;

use App\Card;
use App\CardGroup;
use Illuminate\Http\Request;
use Validator;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Cards  $cards
     * @return \Illuminate\Http\Response
     */
    public function show(Cards $cards)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cards  $cards
     * @return \Illuminate\Http\Response
     */
    public function edit(Cards $cards)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cards  $cards
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cards $cards)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cards  $cards
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cards $cards)
    {
        //
    }
}
