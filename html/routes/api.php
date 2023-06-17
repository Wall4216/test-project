<?php

use App\Http\Controllers\NightClubController;
use Illuminate\Support\Facades\Route;

Route::get('/nightclub', [NightClubController::class, 'index']);
