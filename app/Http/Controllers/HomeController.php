<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Client;
use App\Property;
use App\Job;
use App\Engineer;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getDashboardInfo()
    {
        $totalClients = Client::where('user_id', Auth::user()->id)->count();
        $totalProperties = Property::where('user_id', Auth::user()->id)->count();
        $totalEngineers = Engineer::where('user_id', Auth::user()->id)->count();
        $completeJob = Job::where('user_id', Auth::user()->id)
            ->whereNotNull('customer_complete_date')->count();
        $inCompleteJob = Job::where('user_id', Auth::user()->id)
            ->whereNull('customer_complete_date')->count();

        $trialDays = null;
        $user = Auth::user();
        if ($user->is_trial == 1) {
            $created = new Carbon($user->created_at);
            $now = Carbon::now();
            $trialDays = 14 - ($created->diff($now)->days);
        }

        return [
            'totalClients' => $totalClients,
            'totalProperties' => $totalProperties,
            'totalEngineers' => $totalEngineers,
            'completeJob' => $completeJob,
            'inCompleteJob' => $inCompleteJob,
            'trialDays' => $trialDays,
        ];
    }
}
