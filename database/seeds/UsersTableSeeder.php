<?php

use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bouncer = Bouncer::class;

        // generate 3 different users.
        $admin = factory(App\User::class)->create();
        $userManager = factory(App\User::class)->create();
        $shopManager = factory(App\User::class)->create();

        // create 3 different roles.
        $bouncer::allow('admin')->everything();
        $bouncer::allow('user-manager')->toManage(App\User::class);
        $bouncer::allow('shop-manager')->toManage(App\Product::class);
        $bouncer::allow('shop-manager')->toManage(App\Order::class);
        
        // Assign roles to users.
        $admin->assign('admin');
        $shopManager->assign('shop-manager');
        $userManager->assign('user-manager');
    }
}