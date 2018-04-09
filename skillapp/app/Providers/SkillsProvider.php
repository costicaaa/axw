<?php

namespace App\Providers;

use App\Models\Skill;
use App\Models\SkillCategories;
use Illuminate\Support\ServiceProvider;

class SkillsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // todo:: remove this from all views

        $pretty_values_array = [ //todo:: move this to config
            1 => 'theoretical knowledge',
            2 => 'junior',
            3 => 'confirmed',
            4 => 'senior',
            5 => 'expert'
        ];
        \View::share('texts_array', $pretty_values_array);
        \View::share('skills', Skill::with('category')->get());
        \View::share('categories', SkillCategories::all());
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
