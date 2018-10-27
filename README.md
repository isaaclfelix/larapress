# inmov.io

Real Estate CRM, a laravel webapp.

# Requirements
PHP 7.1 installed and accesible through terminal
Composer installed globally

# To install Composer globally on your Mac
Source: https://getcomposer.org/download/

1. Open a new terminal and run the following commands:

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

2. After the installation, run:

```
mv composer.phar /usr/local/bin/composer
```

3. Test if working, run:

```
composer
```

You should see the composer ASCII logo:

```
   ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/
```

# To install the project

1. Clone the repository anywhere you like
2. Open a terminal in the project directory or cd to the project directory
3. Run:

```php
composer install && npm install && php artisan serve
```

4. In another terminal, also located in the project directory, run:

```php
npm run watch
```

5. http://localhost:3000 will open in a browser window


# To add a new panel to the dashboard (for example, /properties)

Lets say we want to add a new panel to inmov.io's dashboard called Properties. We would have to follow this steps:

1. Add a new route to routes/web.php like so:

```php
Route::get('/properties', 'DashboardController@properties')->name('properties');
```

2. Edit app/Http/Controllers/DashboardController, add a function like the ones before that matches the name of the new route:

```php
/**
 * Show the user's properties tab in the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */
public function properties()
{
    return view('dashboard/properties');
}
```

3. Add a new view for it on resources/views/dashboard/properties.blade.php (you can copy on that's already there and modify)

```php
@extends('layouts.dashboard')
@section('panel')
  <h1>Properties</h1>
  Panel content
@endsection
```

4. Add a link for the panel on the dashboard menu template on resources/views/component/dashboard-nav.blade.php

```php
<li class="nav-item">
    <a href="{{ route('properties') }}" class="pt-2 pb-2 text-light nav-link @if (Route::currentRouteName() === 'properties') active @endif">
      <div class="icon">
        <i class="fas fa-home"></i>
      </div>
      <div class="label">
        Properties
      </div>
    </a>
</li>
```

Thats it! After that you can start putting your UI controls on properties.blade.php!