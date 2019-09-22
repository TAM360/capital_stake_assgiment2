<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\UserServiceProvider;
use Dotenv\Regex\Result;

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
            return $userProvider->getDataByRole(auth()->user(), "");
        }

        return view('users');
    }

    public function shopProducts(Request $request) {
        if ($request->ajax()) {
            $userProvider = new UserServiceProvider(null);
            return $userProvider->getDataByRole(auth()->user(), "list_products");
        }

        return view('products');
    }

    public function shopOrders(Request $request) {
        if ($request->ajax()) {
            $userProvider = new UserServiceProvider(null);
            return $userProvider->getDataByRole(auth()->user(), "list_orders");
        }

        return view('orders');
    }

    public function orderDetails(Request $request) {
        activity()->log(auth()->user()->name." processed the order: ".$request->id);
        $userProvider = new UserServiceProvider(null);
        $result = $userProvider->getOrderDetails($request->id);
        return view('order_details', compact('result'));
    }
}
