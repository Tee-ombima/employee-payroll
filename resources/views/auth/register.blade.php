@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 to-blue-900 py-8 px-4 sm:py-12 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-6 sm:space-y-8 bg-gray-800 p-6 sm:p-10 rounded-xl sm:rounded-2xl shadow-xl border border-gray-700 backdrop-blur-sm bg-opacity-50">
        <!-- Corporate Logo/Header -->
        <div class="text-center">
            <svg class="mx-auto h-12 w-12 sm:h-16 sm:w-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h2 class="mt-4 text-2xl sm:text-3xl font-extrabold text-white">
                Employer Portal Access
            </h2>
            <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-blue-200">
                Enterprise-grade payroll management
            </p>
        </div>

        <!-- Access Request Form -->
        <div class="mt-6 sm:mt-8 space-y-4 sm:space-y-6 bg-gray-700 p-4 sm:p-6 rounded-lg">
            <div class="text-center">
                <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <h3 class="mt-3 sm:mt-4 text-base sm:text-lg font-medium text-white">
                    Controlled Access System
                </h3>
                <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-gray-300">
                    Employer accounts are manually verified to ensure system integrity and prevent abuse.
                </p>
            </div>

            <div class="mt-4 sm:mt-6 space-y-3 sm:space-y-4">
                <div class="flex items-center p-3 sm:p-4 bg-gray-600 rounded-lg overflow-x-auto">
    <svg class="flex-shrink-0 h-4 w-4 sm:h-5 sm:w-5 text-blue-400 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
    </svg>
    <div class="min-w-0">
        <h4 class="text-xs sm:text-sm font-medium text-white">Request Access</h4>
        <p class="text-xxs sm:text-xs text-gray-300 whitespace-nowrap">Email: ombimatitus7@gmail.com</p>
    </div>
</div>

                <div class="flex items-center p-3 sm:p-4 bg-gray-600 rounded-lg">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-blue-400 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <div>
                        <h4 class="text-xs sm:text-sm font-medium text-white">Call for Verification</h4>
                        <p class="text-xxs sm:text-xs text-gray-300">Phone: 0703 495 438</p>
                    </div>
                </div>
            </div>

            <div class="mt-4 sm:mt-6 text-center text-xs sm:text-sm text-gray-400">
                <p>Registered employers can <a href="{{ route('login') }}" class="font-medium text-blue-400 hover:text-blue-300">sign in here</a></p>
            </div>
        </div>

        <!-- Admin Access Only (hidden form) -->
        @if(config('app.allow_registration'))
        <form class="hidden" method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Your original form fields here -->
        </form>
        @endif
    </div>
</div>

<style>
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }
    .bg-opacity-50 {
        background-opacity: 0.5;
    }
</style>
@endsection