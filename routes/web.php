<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LiveController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\Auth\ForgotPassword;
use App\Http\Controllers\Auth\LoginController;

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
    if(auth()->user()) {
        return redirect("/dashboard");
    }else {
        return view('auth/login');
    }
});
//password recovery system
Route::get('reset-passoword', [ForgotPassword::class, 'reset_form'])->name('password.reset.form');
Route::post('reset-passoword/send-link', [ForgotPassword::class, 'send_link'])->name('password.reset.sendLink');
Route::post('reset-passoword', [ForgotPassword::class, 'reset_password'])->name('password.reset.post');


Route::group(['middleware' => ['auth', 'adminRole']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name("dashboard");
    Route::prefix("admins")->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name("admin.index");
        Route::post('/', [AdminController::class, 'store'])->name("admin.store");
        Route::get('/view/{id}', [AdminController::class, 'details'])->name("admin.view");
        Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name("admin.delete");
        Route::post('/delete-rows', [AdminController::class, 'destroyRows'])->name("admin.delete.row");
        Route::post('/update', [AdminController::class, 'update'])->name("admin.update");
        Route::get('/create', [AdminController::class, 'create'])->name("admin.create");
    });

    Route::prefix("user")->group(function(){
        Route::get('/', [UserController::class, 'index'])->name("user.index");
        Route::post('/', [UserController::class, 'store'])->name("user.store");
        Route::get('/view/{id}', [UserController::class, 'details'])->name("user.view");
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name("user.delete");
        Route::post('/delete-rows', [UserController::class, 'destroyRows'])->name("user.delete.row");
        Route::post('/update', [UserController::class, 'update'])->name("user.update");
        Route::get('/create', [UserController::class, 'create'])->name("user.create");
    });

    Route::prefix("poll")->group(function(){
        Route::get('/', [PollController::class, 'index'])->name("poll.index");
        Route::post('/', [PollController::class, 'store'])->name("poll.store");
        Route::get('/view/{id}', [PollController::class, 'details'])->name("poll.view");
        Route::get('/delete/{id}', [PollController::class, 'destroy'])->name("poll.delete");
        Route::post('/delete-rows', [PollController::class, 'destroyRows'])->name("poll.delete.row");
        Route::post('/update', [PollController::class, 'update'])->name("poll.update");
        Route::get('/create', [PollController::class, 'create'])->name("poll.create");
        Route::any('/filterrecords', [PollController::class, 'filterrecords'])->name("poll.filterrecords");
    });


    Route::prefix("vote")->group(function(){
        Route::get('/{pool_id}', [VoteController::class, 'index'])->name("vote.index");
        Route::post('/{pool_id}', [VoteController::class, 'store'])->name("vote.store");
        Route::get('/{pool_id}/view/{id}', [VoteController::class, 'details'])->name("vote.view");
        Route::get('/{pool_id}/delete/{id}', [VoteController::class, 'destroy'])->name("vote.delete");
        Route::post('/{pool_id}/delete-rows', [VoteController::class, 'destroyRows'])->name("vote.delete.row");
        Route::post('/{pool_id}/update', [VoteController::class, 'update'])->name("vote.update");
        Route::get('/create', [VoteController::class, 'create'])->name("vote.create");
    });


    Route::prefix("post")->group(function(){
        Route::get('/', [PostController::class, 'index'])->name("post.index");
        Route::post('/', [PostController::class, 'store'])->name("post.store");
        Route::get('//view/{id}', [PostController::class, 'details'])->name("post.view");
        Route::get('//commentEdit/{id}', [PostController::class, 'commentDetails'])->name("post.viewDesc");
        Route::get('//viewComments/{id}', [PostController::class, 'alldetails'])->name("post.viewComments");
        Route::get('/delete/{id}', [PostController::class, 'destroy'])->name("post.delete");
        Route::post('/delete-rows', [PostController::class, 'destroyRows'])->name("post.delete.row");
        Route::post('/update', [PostController::class, 'update'])->name("post.update");
        Route::get('/create', [PostController::class, 'create'])->name("post.create");
        Route::get('/postDetails/{id}', [PostController::class, 'postDetails'])->name("post.viewComments");
        Route::post('/postDetails/{id}', [PostController::class, 'postDetailsSave'])->name("post.savePostComments");
        Route::post('/updateComment', [PostController::class, 'updateComment'])->name("post.updateComment");
        Route::get('/deleteComment/{id}', [PostController::class, 'destroyComment'])->name("post.deleteComment");
    });


    Route::prefix("comment")->group(function(){
        Route::get('/{post_id}', [CommentController::class, 'index'])->name("comment.index");
        Route::post('/{post_id}', [CommentController::class, 'store'])->name("comment.store");
        Route::get('/{post_id}/view/{id}', [CommentController::class, 'details'])->name("comment.view");
        Route::get('/{post_id}/delete/{id}', [CommentController::class, 'destroy'])->name("comment.delete");
        Route::post('/{post_id}/delete-rows', [CommentController::class, 'destroyRows'])->name("comment.delete.row");
        Route::post('/{post_id}/update', [CommentController::class, 'update'])->name("comment.update");
        Route::get('/create', [CommentController::class, 'create'])->name("comment.create");
    });

    Route::prefix("like")->group(function(){
        Route::get('/{post_id}', [LikeController::class, 'index'])->name("like.index");
        Route::post('/{post_id}', [LikeController::class, 'store'])->name("like.store");
        Route::get('/{post_id}/view/{id}', [LikeController::class, 'details'])->name("like.view");
        Route::get('/{post_id}/delete/{id}', [LikeController::class, 'destroy'])->name("like.delete");
        Route::post('/{post_id}/delete-rows', [LikeController::class, 'destroyRows'])->name("like.delete.row");
        Route::post('/{post_id}/update', [LikeController::class, 'update'])->name("like.update");
    });

    Route::prefix("report")->group(function(){
        Route::get('/', [ReportController::class, 'index'])->name("report.index");
        Route::post('/',  [ReportController::class, 'store'])->name("report.store");
        Route::get('/view/{id}',  [ReportController::class, 'details'])->name("report.view");
        Route::get('/delete/{id}',  [ReportController::class, 'destroy'])->name("report.delete");
        Route::post('/delete-rows',  [ReportController::class, 'destroyRows'])->name("report.delete.row");
        Route::post('/update',  [ReportController::class, 'update'])->name("report.update");

        Route::get('//commentEdit/{id}', [ReportController::class, 'reportcommentDetails'])->name("report.viewDesc");
                Route::get('//viewComments/{id}', [ReportController::class, 'alldetails'])->name("report.viewComments");
        Route::get('/reportDetails/{id}', [ReportController::class, 'reportDetails'])->name("report.viewComments");
        Route::post('/reportDetails/{id}', [ReportController::class, 'reportDetailsSave'])->name("report.saveReportComments");
        Route::post('/updateComment', [ReportController::class, 'updateComment'])->name("report.updateComment");
        Route::get('/deleteComment/{id}', [ReportController::class, 'destroyComment'])->name("report.deleteComment");
    });

    Route::prefix("group")->group(function(){
        Route::get('/', [GroupController::class, 'index'])->name("group.index");
        Route::post('/', [GroupController::class, 'store'])->name("group.store");
        Route::get('/view/{id}', [GroupController::class, 'details'])->name("group.view");
        Route::get('/delete/{id}', [GroupController::class, 'destroy'])->name("group.delete");
        Route::post('/delete-rows', [GroupController::class, 'destroyRows'])->name("group.delete.row");
        Route::post('/update', [GroupController::class, 'update'])->name("group.update");
    });

    Route::prefix("live")->group(function(){
        Route::get('/', [LiveController::class, 'index'])->name("live.index");
        Route::post('/', [LiveController::class, 'store'])->name("live.store");
        Route::get('/view/{id}', [LiveController::class, 'details'])->name("live.view");
        Route::get('/delete/{id}', [LiveController::class, 'destroy'])->name("live.delete");
        Route::post('/delete-rows', [LiveController::class, 'destroyRows'])->name("live.delete.row");
        Route::post('/update', [LiveController::class, 'update'])->name("live.update");
        // Route::post('/notification', [LiveController::class, 'notification'])->name("live.notification");
    });

    Route::prefix("meeting")->group(function(){
        Route::get('/', [MeetingController::class, 'index'])->name("meeting.index");
        Route::post('/', [MeetingController::class, 'store'])->name("meeting.store");
        Route::get('/view/{id}', [MeetingController::class, 'details'])->name("meeting.view");
        Route::get('/delete/{id}', [MeetingController::class, 'destroy'])->name("meeting.delete");
        Route::post('/delete-rows', [MeetingController::class, 'destroyRows'])->name("meeting.delete.row");
        Route::post('/update', [MeetingController::class, 'update'])->name("meeting.update");
    });


});
require __DIR__.'/auth.php';
