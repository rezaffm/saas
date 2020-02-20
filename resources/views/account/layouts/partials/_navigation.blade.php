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
</ul>
