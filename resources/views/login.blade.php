
@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-6 shadow rounded-lg">
                <h2 class="text-2xl font-semibold text-center mb-4">Login</h2>
                <livewire:login-form />
            </div>
        </div>
    </div>
@endsection