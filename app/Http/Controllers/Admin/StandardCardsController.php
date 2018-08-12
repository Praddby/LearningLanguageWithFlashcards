<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Cards;
use App\Http\Requests\CardsRequest;

class StandardCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::with('cards')->standardCards()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CardsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CardsRequest $request)
    {
        $category = DB::transaction(function () use ($request) {
            $category = Category::create($request->all());
            $category->setStandard()->save();
            foreach ($request['cards'] as $card) {
                if ( $card['name_original'] == '' || $card['name_translation'] == '') continue;
                $cards = new Cards([
                    'name_original'    => $card['name_original'],
                    'name_translation' => $card['name_translation'],
                ]);
                $cards->category()->associate($category)->save();

                if ( !isset($cards) ) {
                    throw new \Exception("Вы забыли добавить слова в карточку");
                }
            }

            return $category;
        });

        return $category->fresh('cards');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CardsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CardsRequest $request, $id)
    {
        Cards::find($id)->update([
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
        Cards::destroy( $id );
    }
}
