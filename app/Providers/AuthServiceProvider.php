<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;
use App\Policies\GuestPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => GuestPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->postGates();
        //
    }


    /**
     *
     */
    function postGates(){
        // you have to pass $user and 2nd parmes of your model.
        Gate::define('post-view', function ($user, $post) {
            return Auth::id() === $post->user_id;
        });

        Gate::define('post-delete',function($user ,$post){
            Auth::id() == $post->user_id;
        });


    }




}
