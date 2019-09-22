<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\DataTables;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\Customer;
use App\Product;
use App\User;
use App\Order;
use App\OrderItem;
use phpDocumentor\Reflection\Types\String_;

class UserServiceProvider extends ServiceProvider
{

    public function getUsersData() {
        $data = User::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getCustomerData() {
        $data = Customer::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getProductData() {
        $data = Product::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                return $btn;
            })
            ->editColumn('in_stock', function ($data) {
                return ($data->in_stock == 1) ? "Yes": "No";
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getOrderData() {
        $data = Order::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDataByRole(User $user, String $type) {
        if (Bouncer::is($user)->a('user-manager') == true) {
            return array($this->getUsersData(), $this->getCustomerData());
        } else if (Bouncer::is($user)->a('shop-manager') == true && $type == "list_products") {
            return $this->getProductData();
        } else if (Bouncer::is($user)->a('shop-manager') == true && $type == "list_orders") {
            return $this->getOrderData();
        }
    }
}
