@extends('layouts.app')

@section('content')

    <div class="container --section">
        <div class="__header">
            <h2>Profile</h2>
        </div>

        <div class="__content">
            <div class="row">
                <div class="col">
                    <h6>
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </h6>
                    <hr />
                </div>
            </div>
            <div class="row">
                <div class="col-2 border-right">
                    Email
                </div>
                <div class="col">
                    {{ Auth::user()->email }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 border-right">
                    Phone/SMS
                </div>
                <div class="col">
                    @if(!empty(Auth::user()->profile->phone))
                        {{ Auth::user()->profile->phone }}
                    @else
                        Not provided, update your profile.
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection