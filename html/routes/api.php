<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NightClubController;

Route::get('/nightclub', [NightClubController::class, 'index']);
Route::get('/f/{participant_count}', [NightClubController::class, 'startParty']);

