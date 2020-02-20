@extends('account.layouts.default')

@section('account.content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('account.password.store') }}" method="POST">
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

                <div class="form-group">
                    <label for="password">New password</label>
                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password_confirmation">New password again</label>
                    <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <button class="btn btn-primary" type="submit">Change password</button>
            </form>
        </div>
    </div>
@endsection
