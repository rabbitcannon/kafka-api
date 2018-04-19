@extends('layouts.app')

@section('content')

    <div class="container --section">
        <div class="__header">
            <h2>Profile</h2>
        </div>

        <div class="__content">
            <div class="row">
                <div class="col-md-12">
                    <h6>
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </h6>
                    <hr />
                </div>
            </div>
            <div class="row">
                <div class="col-md-1 border-right">
                    Email
                </div>
                <div class="col-md-3">
                    {{ Auth::user()->email }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-1 border-right">
                    Phone/SMS
                </div>
                <div class="col-md-3">
                    {{ Auth::user()->profile->phone }}
                </div>
            </div>
        </div>
    </div>

@endsection