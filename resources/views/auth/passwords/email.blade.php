@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 to-blue-900 py-8 px-4 sm:py-12 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-6 sm:space-y-8 bg-gray-800 p-6 sm:p-10 rounded-xl sm:rounded-2xl shadow-xl border border-gray-700 backdrop-blur-sm bg-opacity-50">
        <!-- Logo/Company Name -->
        <div class="text-center">
            <svg class="mx-auto h-12 w-12 sm:h-16 sm:w-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
            </svg>
            <h2 class="mt-4 text-2xl sm:text-3xl font-extrabold text-white">
                Access Recovery
            </h2>
            <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-blue-200">
                Request secure credential reset
            </p>
        </div>

        @if (session('status'))
            <div class="rounded-md bg-blue-900 bg-opacity-50 p-3 sm:p-4 text-xs sm:text-sm text-blue-200 border border-blue-700">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="mt-6 sm:mt-8 space-y-4 sm:space-y-6">
            @csrf

            <div class="space-y-3 sm:space-y-4">
    <div>
        <label for="email" class="block text-xs sm:text-sm font-medium text-gray-300">Corporate Email</label>
        <input id="email" type="email" 
               class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-3 bg-gray-700 border border-gray-600 rounded-md sm:rounded-lg shadow-sm placeholder-gray-400 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 text-xs sm:text-sm @error('email') @enderror"
               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
        @error('email')
            <p class="mt-1 text-xs sm:text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>
</div>

            <div>
                <button type="submit" class="responsive-button w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg group relative flex justify-center items-center transform hover:-translate-y-0.5">
                    <span class="absolute left-4 inset-y-0 flex items-center">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-blue-300 group-hover:text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </span>
                    <span class="pl-6 sm:pl-7">Send Recovery Instructions</span>
                </button>
            </div>
        </form>

        <div class="text-center pt-3 sm:pt-4 border-t border-gray-700">
            <a href="{{ route('login') }}" class="text-xs sm:text-sm font-medium text-blue-400 hover:text-blue-300">
                ← Return to authentication portal
            </a>
        </div>
    </div>
</div>

<style>
    /* Smooth transitions */
    .transition-all {
        transition-property: all;
    }
    .duration-200 {
        transition-duration: 200ms;
    }
    .ease-in-out {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
    .responsive-input {
        @apply mt-1 block w-full px-3 py-2 sm:px-4 sm:py-3 bg-gray-700 border border-gray-600 rounded-md sm:rounded-lg shadow-sm placeholder-gray-400 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 text-xs sm:text-sm;
    }
    .responsive-button {
        @apply px-4 py-2 sm:px-5 sm:py-3 text-sm sm:text-base font-medium rounded-lg transition-all duration-200;
    }
</style>
@endsection