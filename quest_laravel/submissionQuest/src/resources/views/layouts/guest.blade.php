
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

<? /*
@extends('template')

@section('login','ログインページ')
@section('description','ログインすることができるページです')
@include('head')

@section('content')

    <div class="auth-page">
        <div class="container page">
            <div class="row">
            <div class="col-md-6 offset-md-3 col-xs-12">
                <h1 class="text-xs-center">Sign in</h1>
                <p class="text-xs-center">
                    <a href="/register">Need an account?</a>
                </p>

                <ul class="error-messages">
                    <li>That email is already taken</li>
                </ul>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <fieldset class="form-group">
                        <label for="email" :value="__('Email')"></label>
                        <input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="password" :value="__('Password')"></label>
                        <input id="password" class="form-control form-control-lg" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                    </fieldset>
                    <button class="btn btn-lg btn-primary pull-xs-right">{{ __('Log in') }}</button>
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
*/?>
