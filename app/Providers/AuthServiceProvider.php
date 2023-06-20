<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Absence' => 'App\Policies\AbsencePolicy',
        'App\Models\Employement' => 'App\Policies\EmployementPolicy',
        'App\Models\Event' => 'App\Policies\EventPolicy',
        'App\Models\Personne' => 'App\Policies\PersonnePolicy',
        'App\Models\Poste' => 'App\Policies\PostePolicy',
        'App\Models\Reason' => 'App\Policies\RaisonPolicy',
        'App\Models\Service' => 'App\Policies\ServicePolicy',
        'App\Models\Source' => 'App\Policies\SourcePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
     public function boot()
    {
     $this->registerPolicies();
    //     Gate::define('subs-only','App\Policies\subs@subs_only');


    //     //
     }
}
