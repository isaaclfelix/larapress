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
        <i class="fas fa-pencil-alt"></i>
      </div>
      <div class="label">
        Posts
      </div>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('media') }}" class="pt-2 pb-2 text-light nav-link @if (Route::currentRouteName() === 'media') active @endif">
      <div class="icon">
        <i class="far fa-images"></i>
      </div>
      <div class="label">
        Media
      </div>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('pages') }}" class="pt-2 pb-2 text-light nav-link @if (Route::currentRouteName() === 'pages') active @endif">
      <div class="icon">
        <i class="fas fa-pen-fancy"></i>
      </div>
      <div class="label">
        Pages
      </div>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('settings') }}" class="pt-2 pb-2 text-light nav-link @if (Route::currentRouteName() === 'settings') active @endif">
      <div class="icon">
        <i class="fas fa-cogs"></i>
      </div>
      <div class="label">
        Settings
      </div>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('users') }}" class="pt-2 pb-2 text-light nav-link @if (Route::currentRouteName() === 'users') active @endif">
      <div class="icon">
        <i class="fas fa-user"></i>
      </div>
      <div class="label">
        Users
      </div>
    </a>
  </li>
</ul>
