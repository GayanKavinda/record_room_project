<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Define your API routes here
Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
