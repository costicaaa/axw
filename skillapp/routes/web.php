<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route("dashboard");
});

Auth::routes();




Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'AdminController@index')->name('dashboard');

    // users routes
    Route::resource('users', 'UsersController');
    Route::resource('skills', 'SkillsController');

    Route::get('api/skills/grouped_by_categories', 'SkillsController@getSkillsGroupedByCategories')->name('skills.api.groupedByCategories');

    Route::get('api/skills/by_user/{user_id}', 'SkillsController@getAssignedSkillsForUser')->name('skills.api.getAssignedSkillsForUser');
    Route::post('api/skills/search_user_by_skill_set', 'SkillsController@searchBySkillSet')->name('skills.api.searchBySkillSet');

    Route::get('api/skills/{skill_id}/{user_id}', 'SkillsController@getSkillInfo')->name('skills.api.getSkillInfo');



    Route::post('api/users/{user_id}/assign-skill-value', 'UsersController@assignSkillValue')->name('skills.api.assignSkillValue');


//    Route::get('/users', 'UsersController@index')->name('users');


});