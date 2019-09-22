<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\DataTables;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\Customer;
use App\User;

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

    public function getDataByRole(User $user) {
        if (Bouncer::is($user)->a('user-manager') == true) {
            return array($this->getUsersData(), $this->getCustomerData());
        } else if (Bouncer::is($user)->a('shop-manager') == true) {

        } else if (Bouncer::is($user)->an('admin') == true) {

        } else {

        }
    }
}
