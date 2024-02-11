@extends('template')

@section('login','ログインページ')
@section('description','ログインすることができるページです')
@include('head')

@section('content')

{{ $slot }}

@endsection
