<?php

use App\MembershipTotal;

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

Route::get('', 'WelcomeController')->name('welcome');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('password-change/{message}', function ($message) {
        return view('password-change', ['message' => $message]);
    })->name('password-change.form');
    Route::post('password-change/{user}', 'Admin\UserController@passwordChange')->name('password-change');
});

Route::group(['prefix' => 'admin',  'middleware' => 'check.admin'], function () {
    Route::resource('attendance', 'AttendanceController');
    Route::post('users/reset-password/{user}', 'Admin\UserController@resetPassword')->name('users.reset-password');
    Route::get('users/{user}/attendance', 'Admin\UserController@attendance')->name('users.attendance');
    Route::post('users/unlock/{id}', 'Admin\UserController@unlock')->name('users.unlock');
    Route::delete('users/lock/{user}', 'Admin\UserController@lock')->name('users.lock');
    Route::resource('users', 'Admin\UserController');
    Route::get('migration', 'Admin\CategoryController@showMigrationForm')->name('migration.form');
    Route::put('migrate', 'Admin\CategoryController@migrate')->name('migration');
    Route::resource('category', 'Admin\CategoryController');
    Route::put('article/reorder', 'Admin\ArticleController@reorder')->name('article.reorder');
    Route::resource('article', 'Admin\ArticleController');
    Route::put('documents/reorder', 'Admin\DocumentController@reorder')->name('documents.reorder');
    Route::resource('documents', 'Admin\DocumentController');
    Route::get('membership', 'Admin\MembershipController@index')->name('membership.index');
    Route::put('membership/update-total', 'Admin\MembershipController@updateTotal')->name('membership.update-total');
    Route::put('membership/update-all', 'Admin\MembershipController@updateAll')->name('membership.update-all');
    Route::get('notifications/{message?}', 'Admin\NotificationsController')->name('notifications');
    Route::post('notifications/send', 'Admin\NotificationSendController')->name('notifications.send');
});

Route::group(['prefix' => 'trainer',  'middleware' => 'check.trainer'], function () {
    Route::put('events/{event}/update-details', 'Admin\EventController@updateDetails')->name('events.update-details');
    Route::resource('events', 'Admin\EventController');
    Route::get('attendance/{message?}', 'AttendanceController@create')->name('trainer.attendance.create');
    Route::post('attendance', 'AttendanceController@store')->name('trainer.attendance.store');
});

Route::group(['middleware' => 'check.player'], function () {
    Route::get('attendance', 'AttendancePlayerController')->name('attendance.player');

    Route::get('membership', function () {
        $membership = Auth::user()->membership;
        return view('membership', ['membership' => $membership]);
    })->name('membership');
    Route::post('participate/{participate}/{event}', 'ParticipateController')->name('participate');
    Route::get('profile', 'PlayerProfileController')->name('player.profile');
    Route::post('profile/switch-notifications', 'SwitchNotificationController')->name('notification.switch');
});

Route::get('events/{type}', 'EventController')->name('events');

Route::get('matches/{category}', 'MatchController')->name('matches');

Route::get('documents', 'DocumentController')->name('documents');

Route::get('gallery/{albumId?}', 'GalleryController')->name('gallery');
Route::post('gallery/{albumId?}', 'GalleryController')->name('gallery.post');

Route::get('trainers/{id?}', 'TrainersController')->name('trainers');

Route::get('about', function () {
    return view('about');
})->name('about');

Route::get('contact/{message?}', function ($message = null) {
    return view('contact', ['message' => $message]);
})->name('contact');

Route::post('contact/send', 'ContactMailController')->name('contact.send');

Route::get('articles', 'ArticleListController')->name('article.list');
Route::get('article/{article}', 'ArticleController')->name('article.single');
