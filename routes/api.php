<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;



Route::get('/change/status/admin', [ApiController::class, 'changeAdminStatus']);
Route::post('/change/status/course', [ApiController::class, 'changeCourseStatus']);
Route::get('/search/category', [ApiController::class, 'getSearchCategory']);
Route::get('/search/course', [ApiController::class, 'getSearchCourse']);
