<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/home', 'HomeController@userdata');

    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('project_managements', 'Admin\ProjectManagementsController');
    Route::post('project_managements_mass_destroy', ['uses' => 'Admin\ProjectManagementsController@massDestroy', 'as' => 'project_managements.mass_destroy']);
    Route::post('project_managements_restore/{id}', ['uses' => 'Admin\ProjectManagementsController@restore', 'as' => 'project_managements.restore']);
    Route::delete('project_managements_perma_del/{id}', ['uses' => 'Admin\ProjectManagementsController@perma_del', 'as' => 'project_managements.perma_del']);
    Route::resource('notices', 'NoticesController');
    Route::post('notices_mass_destroy', ['uses' => 'NoticesController@massDestroy', 'as' => 'notices.mass_destroy']);
    Route::post('notices_restore/{id}', ['uses' => 'NoticesController@restore', 'as' => 'notices.restore']);
    Route::delete('notices_perma_del/{id}', ['uses' => 'NoticesController@perma_del', 'as' => 'notices.perma_del']);
    Route::resource('attandances', 'Admin\AttandancesController');
    Route::post('attandances_mass_destroy', ['uses' => 'Admin\AttandancesController@massDestroy', 'as' => 'attandances.mass_destroy']);
    Route::post('attandances_restore/{id}', ['uses' => 'Admin\AttandancesController@restore', 'as' => 'attandances.restore']);
    Route::delete('attandances_perma_del/{id}', ['uses' => 'Admin\AttandancesController@perma_del', 'as' => 'attandances.perma_del']);
    Route::resource('departments', 'Admin\DepartmentsController');
    Route::post('departments_mass_destroy', ['uses' => 'Admin\DepartmentsController@massDestroy', 'as' => 'departments.mass_destroy']);
    Route::post('departments_restore/{id}', ['uses' => 'Admin\DepartmentsController@restore', 'as' => 'departments.restore']);
    Route::delete('departments_perma_del/{id}', ['uses' => 'Admin\DepartmentsController@perma_del', 'as' => 'departments.perma_del']);
    Route::resource('saleries', 'Admin\SaleriesController');
    Route::post('saleries_mass_destroy', ['uses' => 'Admin\SaleriesController@massDestroy', 'as' => 'saleries.mass_destroy']);
    Route::post('saleries_restore/{id}', ['uses' => 'Admin\SaleriesController@restore', 'as' => 'saleries.restore']);
    Route::delete('saleries_perma_del/{id}', ['uses' => 'Admin\SaleriesController@perma_del', 'as' => 'saleries.perma_del']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');


});
