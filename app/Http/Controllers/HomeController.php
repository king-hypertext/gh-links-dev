<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\EmployerProfile;
use App\Models\CandidateProfile;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('q');
        // return $search;
        // $data = DB::select("SELECT * FROM candidate_profile  WHERE full_name LIKE ? OR WHERE job_role LIKE ? UNION ALL SELECT * FROM employer_profiles WHERE company_name LIKE ?",[]);
        $cs = false;
        $js = false;
        $es = false;
        $c = CandidateProfile::query()->orwhere("full_name", "LIKE", "%$search%")->orWhere("job_role", "LIKE", "%$search%")->get(['id', 'full_name']);
        if ($c->isNotEmpty()) {
            $cs = true;
        }
        $e = EmployerProfile::query()->orwhere("company_name", "LIKE", "%$search%")->get(['id', 'company_name']);
        if ($e->isNotEmpty()) {
            $es = true;
        }
        $j = Job::query()->orWhere("title", "LIKE", "%$search%")->get(['id','title']);
        if ($j->isNotEmpty()) {
            $js = true;
        }
        $data = $c->merge($e)->merge($j);
        // return $data;    
        $page_title = "SEARCH RESULTS";
        return view('pages.search', compact('cs', 'js', 'es', 'c', 'j', 'e', 'page_title', 'data'));
    }
    public function home(Request $request)
    {
        $page_title = 'HOME';
        $companies = Employer::select(['company_name', 'id', 'company_location'])->paginate(10);
        $jobs = Job::where('status', '=', 1)->paginate(10);
        return view('pages.home', compact('companies', 'page_title', 'jobs'));
    }
}
