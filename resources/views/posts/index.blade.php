@extends('layouts.app')
@section('styles')
    {{-- custom style or extend spesific css style --}}
@endsection

@section('title', 'Your Posts')

@section('content')
    @include('includes.navbar')
    <main>
        <div class="container">
            <div class="row mt-3 justify-content-center">
                <div class="col-7">
                    <h3 class="fw-bold">Your Post</h5>
                </div>
            </div>
            @each('includes.post_card', $posts, 'post')
        </div>
    </main>

@endsection

@push('scripts')
    {{-- custom script or extend script link --}}
    @vite('/resources/js/search_user.js')
@endpush
