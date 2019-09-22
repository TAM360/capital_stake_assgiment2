<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\UserServiceProvider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function userManager(Request $request) {

        if ($request->ajax()) {
            $userProvider = new UserServiceProvider(null);
            return $userProvider->getDataByRole(auth()->user());
        }

        return view('users');
    }
}
