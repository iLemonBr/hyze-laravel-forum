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

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/pages/{page}', 'PagesController@show')->name('pages');

Route::prefix('forums')->name('forums.')->namespace('Forums')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/{forum_slug}.{forum_id}/create-thread', 'ThreadController@create')
        //        ->middleware('auth:web')
        ->name('forum.create_thread');

    Route::get('/{forum_slug}.{forum_id}', 'ForumController@index')->name('forum');
    // Route::get('/category/{category_slug}', 'CategoryController@index')->name('category');
    Route::get('/thread/{thread_slug}.{thread_id}', 'ThreadController@show')->name('thread');
});

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('details', 'Profile\DetailsController@index')->name('details');

        // Security
        Route::get('security', 'Profile\SecurityController@index')->name('security');
        Route::put('security/update/email', 'Profile\SecurityController@updateEmail')->name('security.update.email')->middleware('throttle:6,1');
        Route::put('security/update/password', 'Profile\SecurityController@updatePassword')->name('security.update.password')->middleware('throttle:6,1');

        Route::get('security/update/password/confirm/{id}', 'Profile\SecurityController@updatePasswordConfirm')->name('security.update.password.confirm')->middleware('signed', 'throttle:6,1');
        Route::get('security/update/email/confirm/{id}', 'Profile\SecurityController@updateEmailConfirm')->name('security.update.email.confirm')->middleware('signed', 'throttle:6,1');
    });
});

Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('super.admin')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/tree', 'TreeController@index')->name('tree');
    Route::post('/tree/sort', 'TreeController@sort')->name('tree.sort');

    Route::get('/multimoderation', 'MultiModerationController@index')->name('multimoderation.index');

    Route::resource('categories', 'CategoryController')->only([
        'create', 'store', 'edit', 'update'
    ]);

    Route::resource('forums', 'ForumController')->only([
        'create', 'store', 'edit', 'update'
    ]);
});
