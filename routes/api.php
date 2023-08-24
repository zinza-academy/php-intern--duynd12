<?php

use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\DashboardController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\TagController;
use App\Http\Controllers\api\TopicController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('/refresh', 'refresh');
});
Route::middleware(['companyApi'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::put('users/update/{id}', 'updateInfoUser');
    });
});
Route::group(['middleware' => ['auth:api']], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('topUsers', 'topUsers');
        Route::get('getAllUserByName', 'getAllUserByName');
        Route::get('user', 'getMe');
        Route::post('updateUser', 'updateUser');
        Route::get('users', 'getAllUsers');
        Route::post('users', 'store');
        Route::get('users/{id}', 'getUserById');
        Route::post('logout', 'logout');
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index');
    });

    Route::middleware(['checkAdminApi'])->group(function () {
        Route::controller(TopicController::class)->group(function () {
            Route::post('/topics', 'store');
            Route::put('/topics/{id}', 'update');
            Route::delete('/topics',  'deleteTopics');
            Route::delete('/topics/{id}', 'destroy');
        });

        Route::controller(TagController::class)->group(function () {
            Route::post('tags', 'store');
            Route::put('/tags/{id}', 'update');
            Route::delete('/tags/{id}', 'destroy');
            Route::delete('/tags', 'deleteTags');
        });

        Route::controller(CompanyController::class)->group(function () {
            Route::post('companies', 'store');
            Route::put('company/{id}', 'update');
            Route::delete('companies/{id}', 'destroy');
        });

        Route::controller(PostController::class)->group(function () {
            Route::post('posts', 'store');
            Route::put('/posts/changeStatusPin/{id}', 'changeStatusPin');
        });

        Route::controller(UserController::class)->group(function () {
            Route::delete('users/{id}', 'destroy');
            Route::delete('/manyUsers', 'deleteUsers');
        });
    });

    Route::middleware(['userCreatedPost'])->group(function () {
        Route::controller(PostController::class)->group(function () {
            Route::delete('/posts/{id}', 'destroy');
            Route::put('/posts/{id}', 'update');
            Route::put('/posts/{id}', 'update');
        });
    });

    Route::controller(TopicController::class)->group(function () {
        Route::get('topics', 'index');
        Route::get('getAllTopics', 'getAllTopics');
        Route::get('/topicNames', 'getTopicName');
        Route::get('/topics/{id}', 'getTopicById');
        Route::get('/topics/detail/{id}', 'show');
    });

    Route::controller(PostController::class)->group(function () {
        Route::get('limitRecordPost', 'limitRecordPost');
        Route::get('/posts', 'index');
        Route::get('posts/{id}', 'getPostById');
        Route::get('/posts/detail/{id}', 'show');
        Route::get('/searchPost', 'searchPost');
    });

    Route::controller(TagController::class)->group(function () {
        Route::get('tags', 'index');
        Route::get('/tagNames', 'getTagName');
        Route::get('/tags/{id}', 'show');
    });

    Route::controller(CompanyController::class)->group(function () {
        Route::get('companies', 'index');
        Route::get('companies/{id}', 'show');
        Route::get('company/companyName', 'getNameCompany');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::post('comments', 'store');
        Route::post('comment/like/{comment_id}', 'changeLikeComment');
        Route::post('/post/comment/resolve/{comment_id}', 'changeStatusResolve');
    });
});
