@extends('account.layouts.default')

@section('account.content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('account.subscription.card.store') }}" method="POST" id="card-form">
                @csrf
                <p>Your card will be used for future payments.</p>
                <!-- Stripe -->
                <input id="card-holder-name" type="hidden" value="{{ auth()->user()->name }}">
                <div class="form-group">
                    <div class="col-md-9">
                        <div id="card-element"></div>
                    </div>
                </div>
                <button class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">Update
                </button>
            </form>
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
                let form = $('#card-form')
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
