<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;

Route::prefix('v1')->group(function () {
    Route::get('recipes', [RecipeController::class, 'index'])->name('recipes.index');
    Route::get('recipes/{id}', [RecipeController::class, 'show'])->name('recipes.show');
    Route::post('recipes/{id}/like', [RecipeController::class, 'like'])->name('recipes.like');

    Route::post('register', [UserController::class, 'register'])->name('user.register');
    Route::post('login', [UserController::class, 'login'])->name('user.login');
    Route::post('logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::resource('recipes', RecipeController::class)
        ->except(['index', 'show'])
        ->names([
            'store' => 'recipes.store',
            'update' => 'recipes.update',
            'destroy' => 'recipes.destroy',
        ]);

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('user.profile');
});
