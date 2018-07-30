<?php

namespace App\Providers;

use App\Item;
use App\ItemCategory;
use App\OrderList;
use App\Policies\ItemCategoryPolicy;
use App\Policies\ItemPolicy;
use App\Policies\OrderListPolicy;
use App\Policies\SupplierPolicy;
use App\Policies\UserPolicy;
use App\Supplier;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Supplier::class => SupplierPolicy::class,
        ItemCategory::class => ItemCategoryPolicy::class,
        Item::class => ItemPolicy::class,
        OrderList::class => OrderListPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
