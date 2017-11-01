<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use App\AdminNotification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $admin_notifications = DB::table('admin_notifications')
                ->where('is_seen', 0)
                ->orderBy('created_at', 'asc')
                ->limit(5)
                ->get();
        // $admin_notifications = AdminNotification::all();
        View::share('admin_notifications', $admin_notifications);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
