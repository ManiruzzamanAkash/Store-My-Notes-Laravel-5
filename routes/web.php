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

Auth::routes();

Route::get('/', 'PageController@getIndex')->name('index');
Route::get('/contact', 'PageController@contactPage')->name('contact');
Route::get('/privacy', 'PageController@privacyPage')->name('privacy');
Route::get('/terms', 'PageController@termsPage')->name('terms');
Route::get('/report', 'PageController@reportPage')->name('report');
// Route::get('/all-notes', 'HomeController@getAllPublicNotes')->name('all_notes');
// Route::get('/manage-all-notes', 'HomeController@manageAllNotes')->name('manage_all_notes');
// Route::get('/add-note', 'HomeController@addNote')->name('add_note');


// Route::resource('note', 'NoteController');
Route::post('note', 'NoteController@store')->name('note.store');
Route::get('/add-note', 'NoteController@create')->name('add_note');
Route::get('/all-notes', 'NoteController@index')->name('all_notes');
Route::get('/manage-all-notes', 'NoteController@manageAllNotes')->name('manage_all_notes');
Route::post('/manage-all-notes', 'NoteController@changeNoteStatus')->name('note.changeNoteStatus');

Route::get('notes/{slug}',['as' => 'note.single', 'uses' => 'NoteController@show'])
->where('slug', '[\w\d\-\_]+');

Route::get('notes/{note_slug}/edit', 'NoteController@edit')->name('note.edit');
Route::put('notes/{id}', 'NoteController@update')->name('note.update');
Route::delete('notes/{id}', 'NoteController@destroy')->name('note.delete');
Route::post('notes/{id}', 'NoteController@changeLikeStatus')->name('note.changeLike');
Route::post('notes/dislike/{id}', 'NoteController@changeDisLikeStatus')->name('note.changeDisLike');
Route::get('note/', 'NoteController@searchNote')->name('note.search');


Route::post('comments/{note_slug}', 'CommentController@store')->name('comments.store');


Route::post('/requests', 'UserController@sendBanRemoveRequest')->name('user.request.removeBan');
Route::post('/requests', 'NoteController@sendReportNoteRequest')->name('note.request.report');


Route::get('/users/{username}', 'UserController@singleUser')->name('user.single')->where('username', '[\w\d\-\_]+');

Route::get('/users/{username}/edit', 'UserController@edit')->name('user.edit');
Route::put('/users/{id}', 'UserController@update')->name('user.update');
Route::post('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');



Route::group(['prefix' => 'admin'], function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');


	//Password resets routes

	Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
	Route::post('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');


	//Admin Pages

	Route::get('/', "AdminController@index")->name('admin.dashboard');


	//Notes pages
	Route::get('/manage-notes', "AdminController@manageNotesPage")->name('admin.manage_notes');


	//User pages
	Route::get('/manage-users', "AdminController@manageUsers")->name('admin.manage_users');
	Route::post('/manage-users/{id}', 'AdminController@changeActiveStatus')->name('admin.user.changeActiveStatus');
	Route::get('/search','AdminController@getUserAsJson')->name('admin.searchUser');


	//Notification Page
	Route::get('/notifications', 'AdminNotificationController@index')->name('admin.notifications');
	Route::get('/notifications/{id}', 'AdminNotificationController@show')->name('admin.notification.single');


	//category routes
	Route::get('/manage-categories', "AdminCategoryController@index")->name('admin.manage_categories');
	Route::post('/manage-categories', "AdminCategoryController@store")->name('admin.category.store');
	Route::get('/manage-categories/{id}', 'AdminCategoryController@edit')->name('admin.category.edit');
	Route::put('/manage-categories/{id}', 'AdminCategoryController@update')->name('admin.category.update');
	Route::delete('/manage-categories/{id}', 'AdminCategoryController@destroy')->name('admin.category.delete');


	//Tag routes
	Route::get('/manage-tags', "AdminTagsController@index")->name('admin.manage_tags');
	Route::post('/manage-tags', "AdminTagsController@store")->name('admin.tag.store');
	Route::get('/manage-tags/{id}', 'AdminTagsController@edit')->name('admin.tag.edit');
	Route::put('/manage-tags/{id}', 'AdminTagsController@update')->name('admin.tag.update');
	Route::delete('/manage-tags/{id}', 'AdminTagsController@destroy')->name('admin.tag.delete');


	//Settings page
	Route::get('/settings', 'AdminController@settingsPage')->name('admin.settings');
	Route::put('/settings', 'AdminController@settingsUpdate')->name('admin.settings.update');

});
