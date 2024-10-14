<?php

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->paginate(4);
    return view('jobs.index', [
        "jobs" => $jobs
    ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});


Route::post('/jobs', function () {
    $validatedData = request()->validate([
        'title' => 'required|max:255|min:3',
        'salary' => 'required',
        // Temporarily removed employer_id from validation
    ]);

    // Temporarily hard-coding the employer_id
    // TODO: Remove this hard-coding and implement proper employer selection
    $validatedData['employer_id'] = 1; // Assuming 1 is a valid employer_id in your database

    Job::create($validatedData);
    return redirect('/jobs')->with('success', 'Job created successfully!');
});

//Show 
Route::get('/jobs/{id}', function ($id) {
    $job = Job::findOrFail($id);
    return view('jobs.show', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    $job = Job::findOrFail($id);

    $validatedData = request()->validate([
        'title' => 'required|max:255|min:3',
        'salary' => 'required',
    ]);

    $job->update($validatedData);

    return redirect("/jobs/{id}")->with('success', 'Job updated successfully!');
});

//Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::findOrFail($id);
    return view('jobs.edit', ['job' => $job]);
});

//Destroy
Route::delete('/jobs/{id}', function ($id) {
    $job = Job::findOrFail($id);
    $job->delete();
    return redirect('/jobs')->with('success', 'Job deleted successfully!');
});

// Store
Route::get('/contact', function () {
    return view('contact');
});