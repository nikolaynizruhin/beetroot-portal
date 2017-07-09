@extends('layouts.app')

@section('content')
    <clients :clients="{{ $clients }}"></clients>
@endsection
