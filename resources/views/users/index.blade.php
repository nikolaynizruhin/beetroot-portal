@extends('layouts.app')

@section('content')
    <users :users="{{ $users }}" :user="{{ Auth::user() }}"></users>
@endsection
