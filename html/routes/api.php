<?php

use App\Http\Controllers\NightClubController;
use Illuminate\Support\Facades\Route;
Route::post('/set-people-count', [NightClubController::class, 'setPeopleCount']);
Route::get('/nightclub', [NightClubController::class, 'index']);
