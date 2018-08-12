<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardsRequest;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Cards;
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
        return Auth::user()->categories()->with('cards')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CardsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CardsRequest $request)
    {
        DB::transaction(function () use ($request) {
            $category = Category::create($request->all());
            $category->user()->associate(Auth::user())->save();
            
            foreach ($request['cards'] as $card) {
                if ( $card['name_original'] == '' || $card['name_translation'] == '') continue;

                $cards = new Cards([
                    'name_original'    => $card['name_original'],
                    'name_translation' => $card['name_translation'],
                ]);

                $cards->category()->associate($category)
                          ->user()->associate(Auth::user())->save();
            }

            if ( !isset($cards) ) {
                throw new \Exception("Вы забыли добавить слова в карточку");
            }
        });

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
        DB::transaction(function () use ($request, $id) {
            $category = Category::find($id);
            foreach ($request['cards'] as $card) {
                if ( $card['name_original'] == '' || $card['name_translation'] == '' ) continue;
                if ( isset($card['id']) ) {
                    Cards::find($card['id'])->update([
                        'name_original'    => $card['name_original'],
                        'name_translation' => $card['name_translation']
                    ]);
                } else {
                    $cards = new Cards([
                        'name_original'    => $card['name_original'],
                        'name_translation' => $card['name_translation'],
                    ]);
                    $cards->category()->associate($category)
                              ->user()->associate(Auth::user())->save();
                }
            }
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cards::destroy($id);
    }
}
