<?php

namespace App\Http\Controllers;

use App\Models\EmployerProfile;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.jobs.index', [
            'page_title' => 'ALL JOBS',
            'jobs' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employer.post-job.index', ['page_title' => 'Create']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job, $id)
    {
        // dd($id);
        return view('pages.jobs.details');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
    public function company_details(Request $request)
    {
        $id = $request->company;
        $company = EmployerProfile::query()->where('employer_id', $id)->first();
        return view('pages.company.details', compact('company'));
    }
    public function company(Request $request)
    {
        return view('pages.company.index');
    }
}
