<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notification;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $notification = Notification::updateOrCreate(
                ['level' => $request['lvl'], 'user_id' => Auth::user()->id],
                ['last_repeat' => Carbon::now()]
            );

            $notification->user()->associate(Auth::user())->save();
        });
    }
}
