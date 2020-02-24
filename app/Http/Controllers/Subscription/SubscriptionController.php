<?php

namespace App\Http\Controllers\Subscription;

use App\Models\Plan;
use App\Http\Requests\Subscription\SubscriptionStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Plan::active()->get();

        $intent = auth()->user()->createSetupIntent();

        return view('subscription.index', compact('plans', 'intent'));
    }

    public function store(SubscriptionStoreRequest $request)
    {
        //$request->user()->newSubscription('main', $request->plan)->create($request->payment_method);

        $subscription = $request->user()->newSubscription('main', $request->plan);


        if ($request->has('coupon')) {
            $subscription->withCoupon($request->coupon);
        }


        $subscription->create($request->payment_method);

        return redirect('/')->withSuccess('Thanks for becoming a subscriber.');
    }
}
