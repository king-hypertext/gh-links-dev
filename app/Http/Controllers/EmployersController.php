<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\EmployerProfile;
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
    public function create()
    {
    }
    public function register(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'username' => 'required|string|unique:employers,username',
                'email' => 'required|email|unique:employers,email',
                'phone_number' => 'required|string',
                // 'gender' => 'required|in:male,female',
                'password' => 'required|string|confirmed',
                'accept_terms' => 'required|accepted'
            ],
            [
                'accept_terms' => 'The terms of services must be accepted',
                'email' => 'The email is already linked with another account',
                'username' => "The username '{$request->username}' already exists",
            ]
        );
        // dd($request->all());
        $dashboard = redirect()->route('employer.dashboard')->with('success', 'Account created successfully')->getTargetUrl();
        $user = Employer::create(array_map('strtolower', $request->all()));
        Auth::guard('employer')->login($user);
        return $request->ajax() ?
            response(['success' => true, 'redirect_url' => $dashboard]) :
            response(['success' => false, 'message' => 'Failed to create account']);
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
        return redirect()->intended(route('home'))->with('info', 'You have been logged out successfully');
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
    public function email(Request $request){
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
        $companies = EmployerProfile::paginate(12);
        return view('pages.company.index', compact('companies', 'page_title'));
    }
    public function company_details($id)
    {
        $company = EmployerProfile::query()->where('employer_id', '=', $id)->first();
        abort_unless($company !== null, 404);
        $page_title = strtoupper($company->company_name);
        return view('pages.company.details', compact('company', 'page_title'));
    }
    public function showByCompanyName($company_name, EmployerProfile $company)
    {
        $company = $company->whereCompanyName($company_name)->first();
        abort_unless($company !== null, 404);
        $page_title = strtoupper($company->company_name);
        return view('pages.company.details', compact('company', 'page_title'));
    }
}
