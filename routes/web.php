<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Pest\Support\Arr as SupportArr;
use Whoops\Run;
use App\Models\job;

Route::get('/', function () {
 return view('home');
});

Route::get('/jobs', function ()  {
    $jobs = Job::with('employer')->paginate(4);

    return view('jobs', [
        "jobs" => $jobs
    ]);
});


Route::get('/jobs/{id}', function ($id)  {
    // Find the first job with the matching id
    $job = Job::find($id);
    
    if (!$job) {
        abort(404); // Return a 404 error if job is not found
    }
    
    return view('job', ['job' => $job]); // Assuming you have a 'job.blade.php' view
});

Route::get('/contact', function () {
    return view('contact');
});
