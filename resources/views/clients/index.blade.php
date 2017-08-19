@extends('layouts.app')

@section('content')
    <clients :clients="{{ $clients }}" :user="{{ Auth::user() }}"></clients>
@endsection
