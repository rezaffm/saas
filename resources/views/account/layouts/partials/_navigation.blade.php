<ul class="nav flex-column nav-pills">
  <li class="nav-item">
    <a class="nav-link {{ return_if(on_page('account'), 'active') }}" href="{{ route('account.index') }}">Account overview</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ return_if(on_page('account/profile'), 'active') }}" href="{{ route('account.profile.index') }}">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ return_if(on_page('account/password'), 'active') }}" href="{{ route('account.password.index') }}">Change password</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ return_if(on_page('account/deactivate'), 'active') }}" href="{{ route('account.deactivate.index') }}">Deactivate account</a>
  </li>
</ul>

@subscribed
    @notpiggybacksubscription
        <hr>
        <ul class="nav nav-pills nav-stacked">
            @subscriptionnotcancelled
                <li class="nav-item">
                    <a class="nav-link {{ return_if(on_page('account/subscription/swap'), 'active') }}" href="{{ route('account.subscription.swap.index') }}">Change plan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ return_if(on_page('account/subscription/cancel'), 'active') }}" href="{{ route('account.subscription.cancel.index') }}">Cancel subscription</a>
                </li>
            @endsubscriptionnotcancelled
            @subscriptioncancelled
                <li class="nav-item">
                    <a class="nav-link {{ return_if(on_page('account/subscription/resume'), 'active') }}" href="{{ route('account.subscription.resume.index') }}">Resume subscription</a>
                </li>
            @endsubscriptioncancelled
            <li class="nav-item">
                <a class="nav-link {{ return_if(on_page('account/subscription/card'), 'active') }}" href="{{ route('account.subscription.card.index') }}">Update card</a>
            </li>
            @teamsubscription
                <li class="nav-item">
                    <a class="nav-link {{ return_if(on_page('account/subscription/team'), 'active') }}" href="{{ route('account.subscription.team.index') }}">Manage team</a>
                </li>
            @endteamsubscription
        </ul>
    @endnotpiggybacksubscription
@endsubscribed
