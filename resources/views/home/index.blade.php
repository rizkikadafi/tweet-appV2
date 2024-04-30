@extends('layouts.app')
@section('styles')
    {{-- custom style or extend spesific css style --}}
@endsection

@section('title', 'Home')

@section('content')
    @include('includes.navbar')
    <main>
        <div class="container">
            <div class="row mt-3 justify-content-center">
                <div class="col-7">
                    <a href="/posts/create" type="button" class="btn btn-primary">New Post</a>
                </div>
            </div>

            {{-- @include('includes.post_card') --}}
            @each('includes.post_card', $posts, 'post')

        </div>
    </main>
@endsection

@push('scripts')
    {{-- custom script or extend script link --}}
@endpush
