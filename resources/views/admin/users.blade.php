
@extends('layouts.master')
@if(Auth::check() && Auth::user()->role === 'admin')
    @section('content')
    @include('layouts.flash-messages')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>All Users</h1>
            <hr>
            
            {{$dataTable->table()}}
            {{$dataTable->scripts()}}
        </div>
    </div>
    @endsection
@else
    @section('content')
    <h1>Page Restricted</h1>
    @endsection
    @endif
