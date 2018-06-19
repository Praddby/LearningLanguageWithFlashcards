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

    public function index()
    {
        return view('admin.index');
    }

    public function showUsers(Request $request)
    {
        return response( User::with('role')->orderBy('role_id','DESC')->orderBy('name')->paginate(5) );
    }
}
