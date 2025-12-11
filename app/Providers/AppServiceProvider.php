<?php
namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Kota;
use App\Policies\KotaPolicy;

class AuthServiceProvider extends ServiceProvider
{
 /**
 * The policy mappings for the application.
 *
 * @var array
 */
 protected $policies = [
 'App\Model' => 'App\Policies\ModelPolicy',
 Kota::class => KotaPolicy::class,
 ];
 
 /**
 * Register any authentication / authorization services.
 *
 * @return void
 */
 public function boot()
 {
 $this->registerPolicies();
 Gate::define('baca', function ($user, $kota) {
 return $user->id == $kota->user_id;
 });
 
 Gate::define('update-post', function ($user, $post) {
 return $user->id == $post->user_id;
 });
 }
}
