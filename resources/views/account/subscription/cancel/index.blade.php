@extends('account.layouts.default')

@section('account.content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('account.subscription.cancel.store') }}" method="POST">
                @csrf
                <p>Confirm your subscription cancellation.</p>
                <button class="btn btn-primary" type="Submit">Cancel</button>
            </form>
        </div>
    </div>
@endsection
