<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use App\Models\CandidateEducationDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Candidate $candidate, Request $request)
    {
        // $candidate = new Candidate();

        $search = false;
        if ($request->anyFilled(['position', 'location'])) {
            $location = $request->location;
            $position = $request->position;
            $search = true;
            $candidates = $candidate->query()->when($request->filled('position'), function ($q) use ($position) {
                return $q->orWhere('job_role', 'LIKE', '%{' . $position . '}%');
            })->when($request->filled('location'), function ($q) use ($location) {
                return
                    $q->orWhere('location', 'LIKE', "%{$location}%");
            })->with('user')->paginate(6);
        } else {
            $candidates = $candidate->with('user')->paginate(12);
        }
        $page_title = 'ALL CANDIDATES';
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

    public function logout()
    {
        if (!Auth::guard('candidate')) {
            return redirect()->route('login')->with('warning', 'You must be logged in');
        }

        session()->invalidate();
        session()->regenerateToken();
        Auth::guard('candidate')->logout();
        return redirect()->back()->with('info', 'You have been logged out successfully');
    }
    /**
     * Display the specified resource.
     */
    // public function show(Candidate $candidate/* , $username */)
    // {
    //     $page_title = strtoupper($candidate->username);
    //     return view('pages.candidate.details', compact('candidate', 'page_title'));
    // }

    public function showByUsername(string $username)
    {
        $user = User::where('username', $username)->first('id');
        abort_unless($user !== null, 404);
        $candidate = $user->candidate;
        abort_unless($candidate->isProfileCompleted(), 403, 'Profile is not activated');
        $page_title = strtoupper($username);
        return view('pages.candidate.details', compact('candidate', 'page_title'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        abort(403);
    }
    public function profile(Request $request)
    {
        $candidate = Candidate::find(auth('candidate')->id());
        $page_title = strtoupper($candidate->first_name);
        return view('candidate.profile', compact('candidate'));
    }
}
