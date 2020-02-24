<?php

namespace App\Http\Controllers\Account\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionCardController extends Controller
{
    public function index()
    {
        $intent = auth()->user()->createSetupIntent();

        return view('account.subscription.card.index', compact('intent'));
    }


    public function store(Request $request)
    {
        $request->user()->updateDefaultPaymentMethod($request->payment_method);

        return redirect()->route('account.index')->withSuccess('Your card has been updated.');
    }
}

