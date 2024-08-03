<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $candidate = new CandidateProfile();
        $search = false;
        if ($request->anyFilled(['position', 'location'])) {
            $location = $request->location;
            $position = $request->position;
            $search = true;
            $candidates = $candidate->query()->when($request->filled('position'), function ($q) use ($position) {
                return $q->orWhere('job_role', 'LIKE', '%{' . $position . '}%');
            })->when($request->filled('location'), function ($q) use ($location) {
                return
                    // $q->orWhereHas('city', function ($q) use ($location) {
                    $q->orWhere('location', 'LIKE', "%{$location}%");
                // ->orWhere('capital', 'LIKE', "%{$location}%");
                // });
            })->paginate(6, ['candidate_id', 'profile_picture', 'id', 'full_name', 'job_role', 'gender', 'location', 'experience']);
        } else {
            $candidates = $candidate->select(['candidate_id', 'profile_picture', 'id', 'full_name', 'job_role', 'gender', 'location', 'experience'])->paginate(12);
        }
        $page_title = 'ALL CANDIDATES';
        // dd($candidates);
        return view('pages.candidate.index', compact('page_title', 'candidates', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $request->validate(
            [
                // 'first_name' => 'required|string',
                // 'last_name' => 'required|string',
                'username' => 'required|string|unique:candidates,username',
                'phone_number' => 'required|string',
                'email' => 'required|email|unique:candidates,email',
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
        $dashboard = redirect()->route('home')->with('success', 'Account created successfully')->getTargetUrl();
        $user = Candidate::create(array_map('strtolower', $request->all()));
        Auth::guard('candidate')->login($user);
        return $request->ajax() ?
            response(['success' => true, 'redirect_url' => $dashboard]) :
            response(['success' => false, 'message' => 'Failed to create account']);
    }

    public function logout(Request $request)
    {
        if (!Auth::guard('candidate')->check()) {
            return redirect()->route('login')->with('warning', 'You must be logged in');
        }
       
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::guard('candidate')->logout();
        return redirect()->back()->with('info', 'You have been logged out successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate/* , $username */)
    {
        $page_title = strtoupper($candidate->username);
        return view('pages.candidate.details', compact('candidate', 'page_title'));
    }

    public function showByUsername($username, Candidate $candidate)
    {
        $candidate = $candidate->whereUsername($username)->first();
        abort_unless($candidate !== null, 404);
        $page_title = strtoupper($candidate->username);
        return view('pages.candidate.details', compact('candidate', 'page_title'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
    public function profile(Request $request)
    {
        $candidate = Candidate::find(auth('candidate')->id());
        return view('candidate.profile', compact('candidate'));
    }
}
