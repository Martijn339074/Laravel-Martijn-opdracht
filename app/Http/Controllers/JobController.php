<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->paginate(4);
        return view('jobs.index', [
            "jobs" => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255|min:3',
            'salary' => 'required',
            // Temporarily removed employer_id from validation
        ]);



        // Temporarily hard-coding the employer_id
        // TODO: Remove this hard-coding and implement proper employer selection
        $validatedData['employer_id'] = 1; // Assuming 1 is a valid employer_id in your database

        $job = Job::create($validatedData);
        
        Mail::to($job->employer->user)->queue(
            new JobPosted($job)
        );


        return redirect('/jobs')->with('success', 'Job created successfully!');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function edit(Job $job)
    {

        return view('jobs.edit', ['job' => $job]);
    }


    public function update(Request $request, Job $job)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255|min:3',
            'salary' => 'required',
        ]);

        $job->update($validatedData);

        return redirect('/jobs/' . $job->id)->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/jobs')->with('success', 'Job deleted successfully!');
    }
}