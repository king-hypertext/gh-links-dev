<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        abort(403);
    }

    // log the user out of the system
    public function logout()
    {
        if (!Auth::guard('employer')->check()) {
            return redirect()->route('login')->with('warning', 'You must be logged in');;
        }
        session()->regenerate();
        session()->invalidate();
        session()->flush();
        Auth::guard('employer')->logout();
        return redirect(route('home'))->with('info', 'You have been logged out successfully');
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
    public function show(Employer $employer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employer $employer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employer $employer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employer $employer)
    {
        //
    }
    public function email(Request $request)
    {
        $request->user('employer')->sendEmailVerificationNotification();

        return redirect()->back()->with('success', 'Verification link sent!');
        // $verificationUrl = URL::signedRoute('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]);
    }
    public function dashboard()
    {
        $user = Employer::find(auth('employer')->id());

        // dd($employer);
        return view('employer.dashboard', compact('user'));
    }
    public function company(Request $request)
    {
        $page_title = 'ALL COMPANIES';
        $companies = Employer::paginate(12);
        return view('pages.company.index', compact('companies', 'page_title'));
    }
    public function company_details($id)
    {
        $company = Employer::find( $id);
        abort_unless($company !== null, 404);
        $page_title = strtoupper($company->company_name);
        return view('pages.company.details', compact('company', 'page_title'));
    }
    public function showByCompanyName($company_name, Employer $company)
    {
        $company = $company->whereCompanyName($company_name)->first();
        abort_unless($company !== null, 404);
        $page_title = strtoupper($company->company_name);
        return view('pages.company.details', compact('company', 'page_title'));
    }
}
