<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\EmployerProfile;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('q');
        return $search;
    }
    public function home(Request $request)
    {
        $companies = EmployerProfile::select(['company_name', 'id', 'employer_id', 'company_location'])->paginate(10);
        // dd($companies);
        $page_title = 'HOME';
        $jobs = Job::paginate(10);
        return view('pages.home', compact('companies', 'page_title', 'jobs'));
    }
}
