@extends('errors::layout')
@section('title', __('Unauthorized'))
@section('message')
    <div class="wrapper-403">
        <div class="wrapper">
            <div class="box-403">
                <h1 class="text-9xl shadow-emerald-500">403</h1>
                <p class="text-3xl mb-2">{{ __('Sorry, its not allowed to go beyond this point!') }}</p>
                <p class="">
                    <x-primary-link href="{{ route('dashboard') }}" class="text-2xl">{{ __('Please, go back this way.') }}</x-primary-link>
                </p>
            </div>
        </div>
    </div>
@endsection