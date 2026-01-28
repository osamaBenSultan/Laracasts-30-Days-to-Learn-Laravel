<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {

    $jobs = Job::with('employer')->get();
    return view('jobs', compact('jobs'));
});


Route::get('/jobs/{id}', function ($id) {
    $job = Job::all();

    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/posts', function () {
    return view('posts');
});




