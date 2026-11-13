@extends('layouts.app')

@section('title', 'Sign in')

@section('content')
<form method="POST" action="{{ route('login') }}" class="mx-auto mt-6 w-full max-w-sm space-y-4 rounded-lg bg-white p-4 shadow sm:mt-10 sm:p-6">
    @csrf

    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full rounded border border-slate-300 p-2.5 text-base">
    @error('email')
    <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

    <input type="password" name="password" placeholder="Password" class="w-full rounded border border-slate-300 p-2.5 text-base">
    @error('password')
    <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

    <button class="w-full rounded bg-orange-600 p-2.5 font-medium text-white hover:bg-orange-700">Sign in</button>
</form>
@endsection