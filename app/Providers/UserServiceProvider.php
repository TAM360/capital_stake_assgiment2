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
use Illuminate\Support\Facades\DB;

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
        $data = DB::table('orders')->join('customers', 'orders.customer_id', 'customers.id')->get();
        return Datatables::of($data)->addIndexColumn()->make(true);
    }

    public function getOrderDetails($id) {
        $data = DB::table('order_items')
            ->join('products', 'order_items.product_id', 'products.id')
            ->where('order_items.order_id', '<>', $id)
            ->get();
        return Datatables::of($data)->addIndexColumn()->make(true);
    }

    public function getDataByRole(User $user, String $type) {
        if (Bouncer::is($user)->a('user-manager') || Bouncer::is($user)->a('admin')) {
            return array($this->getUsersData(), $this->getCustomerData());
        } else if (Bouncer::is($user)->a('shop-manager') == true && $type == "list_products") {
            return $this->getProductData();
        } else if (Bouncer::is($user)->a('shop-manager') == true && $type == "list_orders") {
            return $this->getOrderData();
        }
    }
}
