@extends('layouts.dashboard')
@section('aside')
    <livewire:mostrar-aside></livewire:mostrar-aside>
@endsection
@section('contenido')
    @if (session()->has('mensaje'))
        <div class=" mt-2 uppercase border border-green-600 bg-green-100 text-green-600 p-2 font-bold my-3 text-sm">
            {{ session('mensaje') }}
        </div>
    @endif
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-gray-100 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-gray-100 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-gray-100 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
