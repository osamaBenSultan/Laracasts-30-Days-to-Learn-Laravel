<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {

    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('jobs.index', compact('jobs'));
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::post('/jobs', function () {
    // Validation
    request()->validate([
        'title' => 'required|min:3',
        'salary' => 'required',
    ]);

    // insert to the table
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});


Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});


Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

Route::patch('/jobs/{id}', function ($id) {

    // Validation
    request()->validate([
        'title' => 'required|min:3',
        'salary' => 'required',
    ]);

    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);



    return view('jobs.show', ['job' => $job]);
});

Route::delete('/jobs/{id}', function ($id) {
    $job = Job::findOrFail($id)->delete();

    return redirect('/jobs');
});


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/posts', function () {
    return view('posts.index');
});




