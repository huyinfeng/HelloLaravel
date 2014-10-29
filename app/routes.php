<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Model Bindings */
Route::model('picture', 'Picture');
Route::model('comment', 'Comment');

/* User routes */
Route::get('/picture/{picture}/show', ['as' => 'picture.show', 'uses' => 'PictureController@showPicture']);
Route::post('/picture/{picture}/comment', ['as' => 'comment.new', 'uses' => 'CommentController@newComment']);

/* Admin routes */
Route::group(['prefix' => 'admin', 'before' => 'auth'], function () {
    /*get routes*/
    Route::get('dash-board', function () {
        $layout = View::make('master');
        $layout->title = 'DashBoard';
        $layout->main = View::make('dash')->with('content', 'Hi, Welcome to Dashboard!');
        return $layout;

    });
    Route::get('/picture/list', ['as' => 'picture.list', 'uses' => 'PictureController@listPicture']);
    Route::get('/picture/new', ['as' => 'picture.new', 'uses' => 'PictureController@newPicture']);
    Route::get('/picture/{picture}/edit', ['as' => 'picture.edit', 'uses' => 'PictureController@editPicture']);
    Route::get('/picture/{picture}/delete', ['as' => 'picture.delete', 'uses' => 'PictureController@deletePicture']);
    Route::get('/comment/list', ['as' => 'comment.list', 'uses' => 'CommentController@listComment']);
    Route::get('/comment/{comment}/show', ['as' => 'comment.show', 'uses' => 'CommentController@showComment']);
    Route::get('/comment/{comment}/delete', ['as' => 'comment.delete', 'uses' => 'CommentController@deleteComment']);

    /*picture routes*/
    Route::post('/picture/save', ['as' => 'picture.save', 'uses' => 'PictureController@savePicture']);
    Route::post('/picture/{picture}/update', ['as' => 'picture.update', 'uses' => 'PictureController@updatePicture']);
    Route::post('/comment/{comment}/update', ['as' => 'comment.update', 'uses' => 'CommentController@updateComment']);

});

/* Home routes */
Route::controller('/', 'BlogController');

/* View Composer */
View::composer('sidebar', function ($view) {
    $view->recentPictures = Picture::orderBy('id', 'desc')->take(5)->get();
});

