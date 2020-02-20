<?php

namespace App\Http\Controllers\Subscription;

use App\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanTeamController extends Controller
{
    public function index()
    {
        $plans = Plan::active()->forTeams()->get();

        return view('subscription.plans.teams.index', compact('plans'));
    }
}
