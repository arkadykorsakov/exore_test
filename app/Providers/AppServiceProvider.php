<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		Gate::define('store-employee', [UserPolicy::class, 'store']);
		Gate::define('show-employee', [UserPolicy::class, 'showEmployee']);
		Gate::define('store-post', [PostPolicy::class, 'store']);
		Gate::define('update-post', [PostPolicy::class, 'update']);
		Gate::define('delete-post', [PostPolicy::class, 'delete']);
	}
}
