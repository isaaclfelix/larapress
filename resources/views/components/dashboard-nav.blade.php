<?php

?>
<ul id="dashboard-nav" class="col-12 col-md-3 col-lg-2 p-0 nav flex-column">
  <li class="nav-item">
    <a href="{{ route('dashboard') }}" class="pt-2 pb-2 text-light nav-link @if (Route::currentRouteName() === 'dashboard') active @endif">
      <div class="icon">
        <i class="fas fa-tachometer-alt"></i>
      </div>
      <div class="label">
        Dashboard
      </div>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('posts') }}" class="pt-2 pb-2 text-light nav-link @if (Route::currentRouteName() === 'posts') active @endif">
      <div class="icon">
        <i class="fas fa-pin"></i>
      </div>
      <div class="label">
        Posts
      </div>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('profile') }}" class="pt-2 pb-2 text-light nav-link @if (Route::currentRouteName() === 'profile') active @endif">
      <div class="icon">
        <i class="fas fa-user"></i>
      </div>
      <div class="label">
        Profile
      </div>
    </a>
  </li>
</ul>
