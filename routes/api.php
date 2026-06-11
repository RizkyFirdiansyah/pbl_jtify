<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\SiteContentController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:5,1')->group(function () {
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/register', [AuthController::class, 'register']);
});

Route::get('/informations', [InformationController::class, 'index']);
Route::get('/informations/categories', [InformationController::class, 'categories']);
Route::get('/informations/{information}', [InformationController::class, 'show']);

Route::get('/feedbacks/public', [FeedbackController::class, 'publicIndex']);

Route::get('/site-content', [SiteContentController::class, 'index']);
Route::get('/site-content/pages', [SiteContentController::class, 'pages']);
Route::get('/site-content/pages/{slug}', [SiteContentController::class, 'showPage']);
Route::get('/site-content/settings', [SiteContentController::class, 'settings']);
Route::get('/site-content/settings/{key}', [SiteContentController::class, 'showSetting']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user(),
        ]);
    });

    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    Route::get('/bookmarks', [BookmarkController::class, 'index']);
    Route::post('/bookmarks/toggle', [BookmarkController::class, 'toggle']);
    Route::get('/bookmarks/check', [BookmarkController::class, 'check']);
    Route::patch('/bookmarks/reminder', [BookmarkController::class, 'updateReminder']);

    // Likes (heart icon) - quick toggle, no consent
    Route::get('/likes', [LikeController::class, 'index']);
    Route::post('/likes/toggle', [LikeController::class, 'toggle']);
    Route::get('/likes/check', [LikeController::class, 'check']);

    // Interests (registration) - requires consent checkbox
    Route::get('/interests', [InterestController::class, 'index']);
    Route::post('/interests/toggle', [InterestController::class, 'toggle']);
    Route::get('/interests/check', [InterestController::class, 'check']);
    Route::get('/interests/information/{information}', [InterestController::class, 'getByInformation']);

    Route::get('/feedbacks', [FeedbackController::class, 'index']);
    Route::post('/feedbacks', [FeedbackController::class, 'store']);
    Route::get('/feedbacks/{id}', [FeedbackController::class, 'show']);
    Route::match(['put', 'patch'], '/feedbacks/{id}', [FeedbackController::class, 'update']);
    Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy']);

    Route::get('/profile', [UserProfileController::class, 'show']);
    Route::get('/profile/edit', [UserProfileController::class, 'edit']);
    Route::put('/profile', [UserProfileController::class, 'update']);
    Route::put('/profile/password', [UserProfileController::class, 'updatePassword']);
    Route::delete('/profile/cv', [UserProfileController::class, 'deleteCv']);
    Route::get('/profile/cv/download', [UserProfileController::class, 'downloadCv']);
    Route::get('/profile/feedbacks', [UserProfileController::class, 'feedbacks']);
});
