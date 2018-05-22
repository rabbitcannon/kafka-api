@extends('layouts.app')

@section('content')

    <profile-view></profile-view>

    <input type="hidden" id="user" value="{{ Auth::id() }}">

@endsection