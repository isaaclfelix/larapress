@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div id="dashboard-content" class="col-12 offset-lg-2 col-md-10 bg-light py-2">
            @yield('panel')
        </div>
    </div>
</div>
@include('components/dashboard-nav')
@endsection
