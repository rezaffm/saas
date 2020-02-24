@extends('account.layouts.default')

@section('account.content')
    <div class="card">
       <div class="card-body">
            <form action="{{ route('account.deactivate.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="password_current">Current password</label>
                    <input type="password" name="password_current" class="form-control {{ $errors->has('password_current') ? 'is-invalid' : '' }}" id="password_current">
                    @if ($errors->has('password_current'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_current') }}</strong>
                        </span>
                    @endif
                </div>

                @subscriptionnotcancelled
                    <p>This will also cancel your active subscription.</p>
                @endsubscriptionnotcancelled

                <button class="btn btn-primary" type="submit">Deactivate account</button>
            </form>
        </div>
    </div>
@endsection
