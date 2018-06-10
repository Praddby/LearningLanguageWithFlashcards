<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminController extends Controller
{

	public function __construct()
	{
		$this->middleware('admin');
	}

    public function showUsers(Request $request)
    {
    	$data = User::orderBy('id','DESC')->paginate(5);
        return view('admin.users',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
}
