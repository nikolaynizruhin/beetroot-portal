@extends('layouts.app')

@section('content')
    <users :users="{{ $users }}"></users>
@endsection
