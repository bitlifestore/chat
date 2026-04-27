<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showAuth'])->name('home');

Route::get('/login', [AuthController::class, 'showAuth'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth','lastseen'])->group(function(){
    Route::get('/dashboard',[ChatController::class,'index']);
    Route::get('/messages/{id}',[ChatController::class,'messages']);
    Route::post('/send',[ChatController::class,'send']);
    Route::post('/send-image',[ChatController::class,'sendImage']);
    Route::post('/send-audio',[ChatController::class,'sendAudio']);
    Route::delete('/delete-message/{id}',[ChatController::class,'deleteMessage']);
    Route::delete('/clear-chat/{id}',[ChatController::class,'clearChat']);
    Route::post('/typing', function(Request $req){
        try {
            if(!auth()->check()){
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            // For now, just return success without broadcasting
            // Broadcasting is handled by the polling system
            return response()->json(['status' => 'typing']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });
    
    // Profile routes
    Route::post('/upload-profile-image', [AuthController::class, 'uploadProfileImage']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    Route::get('/get-profile', [AuthController::class, 'getProfile']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');
