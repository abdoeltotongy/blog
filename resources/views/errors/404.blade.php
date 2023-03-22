@extends('layouts.main')
@section('title')
    404 Error Page
@endsection

@section('content')
    <div class="dark:bg-gray-900 max-h-screen">
        <div class="container">
            <div class="row">
                <img src=" {{ asset('images/404-error-template-3.webp') }}"
                    style="width: 100% ; height: 100vh; border-radius: 70%">
            </div>
        </div>
    </div>
@endsection
