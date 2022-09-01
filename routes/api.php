<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PollController;
use App\Http\Controllers\Api\ReportCommentController;
use App\Http\Controllers\Api\PollAnswerController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostLikeController;
use App\Http\Controllers\Api\PostCommentController;
use App\Http\Controllers\Api\LiveController;
use App\Http\Controllers\Api\MeetingController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\MediaController;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::prefix("v2")->group(function(){
  Route::post('/auth/login', [AuthController::class, 'login']);
  Route::post('/auth/register', [AuthController::class, 'register']);
  Route::post('/auth/forgotPassword', [AuthController::class, 'forgotPassword']);
  Route::post('/auth/resetPassword', [AuthController::class, 'resetPassword']);
  Route::post('/auth/social', [AuthController::class, 'social']);
  // Route::get('/verify-email', [AuthController::class, 'liveMigration']);
  // Route::get('/auth/testPush', [AuthController::class, 'testPush']);

  Route::group(['middleware' => ['jwt.verify']], function() {
      Route::prefix("live")->group(function(){
        Route::get('/', [LiveController::class, 'index']);
        Route::get('/{id}', [LiveController::class, 'show']);
        Route::post('/go-live', [LiveController::class, 'store']);
        Route::delete('/{id}', [LiveController::class, 'destroy']);
        Route::put('/{id}', [LiveController::class, 'update']);
        Route::post('/create_agora', [LiveController::class, 'create_agora']);
      });
      Route::prefix("meeting")->group(function(){
        Route::get('/', [MeetingController::class, 'index']);
        Route::get('/{id}', [MeetingController::class, 'show']);
        Route::post('/go-meeting', [MeetingController::class, 'store']);
        Route::delete('/{id}', [MeetingController::class, 'destroy']);
        Route::put('/{id}', [MeetingController::class, 'update']);
      });
      Route::prefix("groups")->group(function(){
        Route::get('/list', [GroupController::class, 'index']);
        Route::post('/create', [GroupController::class, 'store']);
        Route::get('/list/{id}', [GroupController::class, 'get_single']);
        Route::put('/update/{id}', [GroupController::class, 'update']);
        Route::delete('/delete/{id}', [GroupController::class, 'destroy']);
        Route::post('/user_add', [GroupController::class, 'add_user_to_group']);
        Route::get('/users/{id}', [GroupController::class, 'get_all_users']);
        Route::post('/trending', [GroupController::class, 'index']);
        // Route::get('/invitation', [GroupController::class, 'index']);
        Route::post('/search', [GroupController::class, 'index']);
        // Route::post('/test', [GroupController::class, 'test']);
      });
      Route::prefix("reports")->group(function(){
        Route::get('/list', [ReportController::class, 'index']);
        Route::post('/create', [ReportController::class, 'store']);
        Route::post('/filter', [ReportController::class, 'filter']);
        Route::post('/search', [ReportController::class, 'index']);
        Route::get('/list/{id}', [ReportController::class, 'single_report']);
        Route::delete('/list/{id}', [ReportController::class, 'destroy']);
        Route::put('/list/{id}', [ReportController::class, 'update']);
        Route::get('/list-comments/{id}', [ReportCommentController::class, 'single_report_comment']);
        Route::post('/comment', [ReportCommentController::class, 'store']);
      });
      Route::prefix("posts")->group(function(){
        Route::get('/list', [PostController::class, 'index']);
        Route::get('/list/{id}', [PostController::class, 'single_post']);
        Route::post('/create', [PostController::class, 'store']);
        Route::post('/filter', [PostController::class, 'filter']);
        Route::post('/search', [PostController::class, 'index']);
        Route::post('/comment', [PostCommentController::class, 'store']);
        Route::get('/list-comments/{id}', [PostCommentController::class, 'single_post_comment']);
        Route::post('/like', [PostLikeController::class, 'store']);
        Route::get('/list-like/{id}', [PostLikeController::class, 'single_post_like']);
        Route::get('/list-dislike/{id}', [PostLikeController::class, 'single_post_dislike']);
        Route::post('/trending', [PostController::class, 'index']);
      });
      Route::prefix("polls")->group(function(){
        Route::get('/list', [PollController::class, 'index']);
        Route::post('/create', [PollController::class, 'store']);
        Route::post('/search', [PollController::class, 'index']);
        Route::post('/trending', [PollController::class, 'index']);
        Route::post('/vote', [PollAnswerController::class, 'store']);
        Route::get('/list/{id}', [PollController::class, 'single_poll']);
      });
      Route::prefix("users")->group(function(){
        Route::get('/my-profile', [UserController::class, 'me']);
        Route::put('/edit-profile', [UserController::class, 'updateMe']);
      });
      // Route::prefix("contacts")->group(function(){
      //   Route::post('/', [ReportController::class, 'update']);
      // });
      // Route::prefix("admin")->group(function(){
      //   Route::post('/add-project', [ReportController::class, 'update']);
      // });

      // Route::resources([
      //     'users' => UserController::class,
      //     'polls' => PollController::class,
      //     'poll_answers' => PollAnswerController::class,
      //     'groups' => GroupController::class,
      //     'reports' => ReportController::class,
      //     'posts' => PostController::class,
      //     'post_likes' => PostLikeController::class,
      //     'post_comments' => PostCommentController::class,
      //     'lives' => LiveController::class,
      //     'contacts' => ContactController::class,
      //     'medias' => MediaController::class,
      // ]);
      
      // Route::get('/group/search', [GroupController::class, 'search']);

      // Route::get('/me', [UserController::class, 'me']);
      // Route::put('/me', [UserController::class, 'updateMe']);

      Route::delete('auth', [AuthController::class, 'logout']);
  });
});
