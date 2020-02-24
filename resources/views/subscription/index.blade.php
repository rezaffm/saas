@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-default">
                <div class="card-header">
                    Subscription
                </div>
                <div class="card-body">
                    <form action="{{ route('subscription.store') }}" method="POST" class="form-horizontal" id="payment-form">
                        @csrf

                        <div class="form-group{{ $errors->has('plan') ? ' has-error' : '' }}">
                            <label for="plan" class="col-md-4 control-label">Plan</label>

                            <div class="col-md-6">
                                <select name="plan" id="plan" class="form-control">
                                    @foreach($plans as $plan)
                                        <option value="{{ $plan->gateway_id }}" {{ request('plan') === $plan->slug || old('plan') === $plan->gateway_id ? 'selected="selected"' : ''  }}>{{ $plan->name }} (€{{ $plan->price }})</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('plan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('plan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('coupon') ? ' has-error' : '' }}">
                            <label for="coupon" class="col-md-4 control-label">Coupon code</label>

                            <div class="col-md-6">
                                <input type="text" name="coupon" id="coupon" class="form-control" value="{{ old('coupon') }}">

                                @if ($errors->has('coupon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('coupon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Stripe -->
                        <input id="card-holder-name" type="hidden" value="{{ auth()->user()->name }}">
                        <div class="form-group">
                            <div class="col-md-9">
                                <div id="card-element"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                              <!--Stripe-->
                              <button class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">
                                Pay
                            </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function() {
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                // Display "error.message" to the user...
                console.log(error)
            } else {
                // The card has been verified successfully...
                //console.log(setupIntent.payment_method)
                let form = $('#payment-form')
                $('#card-button').prop('disabled', true)
                $('<input>').attr({
                    type: 'hidden',
                    name: 'payment_method',
                    value: setupIntent.payment_method
                }).appendTo(form)
                form.submit();
            }
        });
    });
</script>
@endsection
