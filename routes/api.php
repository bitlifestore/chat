<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\CallController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Auth (Public)
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/profile', [AuthController::class, 'updateProfile']);
    Route::post('/auth/change-password', [AuthController::class, 'changePassword']);
    Route::patch('/auth/status', [AuthController::class, 'updateStatus']);

    // Conversations
    Route::get('/conversations', [ConversationController::class, 'index']);
    Route::post('/conversations/private', [ConversationController::class, 'startPrivateChat']);
    Route::post('/conversations/group', [ConversationController::class, 'createGroup']);
    Route::post('/conversations/{id}/members', [ConversationController::class, 'addMembers']);
    Route::delete('/conversations/{id}/members/{userId}', [ConversationController::class, 'removeMember']);
    Route::patch('/conversations/{id}/settings', [ConversationController::class, 'updateSettings']);
    Route::delete('/conversations/{id}/leave', [ConversationController::class, 'leaveGroup']);

    // Messages
    Route::get('/conversations/{id}/messages', [MessageController::class, 'index']);
    Route::post('/conversations/{id}/messages', [MessageController::class, 'store']);
    Route::post('/conversations/{id}/messages/mark-read', [MessageController::class, 'markRead']);
    Route::post('/conversations/{id}/messages/typing', [MessageController::class, 'typingIndicator']);
    Route::put('/messages/{id}', [MessageController::class, 'update']);
    Route::delete('/messages/{id}/everyone', [MessageController::class, 'destroyForEveryone']);
    Route::delete('/messages/{id}/me', [MessageController::class, 'destroyForMe']);
    Route::post('/messages/{id}/react', [MessageController::class, 'react']);
    Route::delete('/messages/{id}/react', [MessageController::class, 'removeReaction']);
    Route::post('/messages/{id}/forward', [MessageController::class, 'forward']);
    Route::patch('/messages/{id}/star', [MessageController::class, 'toggleStar']);
    Route::get('/messages/search', [MessageController::class, 'search']);
    Route::get('/messages/starred', [MessageController::class, 'starred']);

    // Calls
    Route::get('/calls/history', [CallController::class, 'history']);
    Route::post('/calls/initiate', [CallController::class, 'initiate']);
    Route::get('/calls/{id}', [CallController::class, 'show']);
    Route::post('/calls/{id}/answer', [CallController::class, 'answer']);
    Route::post('/calls/{id}/decline', [CallController::class, 'decline']);
    Route::post('/calls/{id}/end', [CallController::class, 'end']);
    Route::post('/calls/{id}/ice-candidate', [CallController::class, 'sendIceCandidate']);

    // Status/Stories
    Route::get('/statuses', [StatusController::class, 'index']);
    Route::post('/statuses', [StatusController::class, 'store']);
    Route::post('/statuses/{id}/view', [StatusController::class, 'markViewed']);
    # Route::delete('/statuses/{id}', [StatusController::class, 'destroy']); // User might want this

    // Contacts
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::post('/contacts', [ContactController::class, 'store']);
    Route::get('/contacts/blocked', [ContactController::class, 'blocked']);
    Route::post('/contacts/{id}/block', [ContactController::class, 'block']);
    Route::post('/contacts/{id}/unblock', [ContactController::class, 'unblock']);
    Route::patch('/contacts/{id}/favourite', [ContactController::class, 'toggleFavourite']);
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);

    // Users
    Route::get('/users/search', [UserController::class, 'search']);
    Route::get('/users/{id}/profile', [UserController::class, 'profile']);
    Route::post('/users/push-token', [UserController::class, 'savePushToken']);

    // ── Products API ──────────────────────────────────────
    Route::apiResource('products', ProductController::class);
});
