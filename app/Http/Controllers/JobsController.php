<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Job;
use App\Models\District;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\EmployerProfile;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function autocompleteJobList(Request $request)
    {
        $title = str_replace(['\\', '/', '.', '_', ',', '\''], ' ', $request->input('query'));
        $data = Job::query()->where('title', 'LIKE', "%{$title}%")->get('title');
        return response()->json($data);
    }
    public function index(Request $request)
    {
        $job = new Job();
        $search = false;
        if ($request->anyFilled(['job_title', 'location', 'job_type', 'min_salary'])) {
            $search = true;
            $location = $request->location;
            $type = $request->job_type;
            $salary = $request->min_salary;
            $jobs = $job->query()
                ->when($request->filled('job_title'), function ($q) use ($request) {
                    $title = str_replace(['\\', '/', '.', '_', ',', '\''], ' ', $request->job_title);
                    return $q->orWhere('title', 'LIKE', "%{$title}%");
                })
                ->when($request->filled('job_type'), function ($q) use ($type) {
                    return $q->orWhere('type', 'LIKE', "%{$type}%");
                })
                ->when($request->filled('min_salary'), function ($q) use ($salary) {
                    return $q->orWhere('max_salary', '>=', $salary);
                })->when($request->filled('location'), function ($q) use ($location) {
                    return  $q->orWhereHas('city', function ($q) use ($location) {
                        $q->orWhere('name', 'LIKE', "%{$location}%")
                            ->orWhere('capital', 'LIKE', "%{$location}%");
                    });
                })
                // ->dd();
                ->where('status', '=', 1)->paginate(6);
        } else {
            $jobs =  $job->newInstance()->where('status', '=', 1)->paginate(12);
        }
        // dd($jobs->last()->company);
        $page_title = 'ALL JOBS';
        $related_jobs = Job::where('status', '=', 1)->paginate(6);
        return view(
            'pages.jobs.index',
            compact('jobs', 'search', 'page_title',  'related_jobs')
        );
    }
    public function showByCompany($company)
    {
        $company = Employer::where('company_name', $company)->first();
        $page_title = 'OPEN VACANCIES (' . strtoupper($company->company_name) . ')';
        $jobs = Job::query()->where('status', '=', 1)->where('employer_id', $company->id)->paginate(6);
        $search = null;
        return view('pages.jobs.index', compact('company', 'jobs', 'search',  'page_title'));
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
        $job = Job::where('status', '=', 1)->find($id);
        $page_title = 'JOBS (' . strtoupper($job->title) . ')';
        return view('pages.jobs.details', compact('job', 'page_title'));
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
    // public function 
    public function getDistricts(Request $request)
    {
        $cityId = $request->input('city_id');
        $districts = District::where('city_id', $cityId)->get();
        return response()->json($districts);
    }
}
