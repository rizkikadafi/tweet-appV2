@extends('layouts.app')
@push('styles')
    {{-- custom style or extend spesific css style --}}
@endpush

@section('title', 'Threads')

@section('content')
    @include('includes.navbar')
    <main>
        <div class="container">
            <div class="parent py-3">
                @if ($post->parent)
                    @foreach ($post->getNestedParentsAttribute() as $parentPost)
                        @include('includes.reply-card', ['post' => $parentPost])
                        <div class="row justify-content-center my-0">
                            <div class="col-7 border-start border-2 m-0 py-3 ms-5 ps-3"></div>
                        </div>
                    @endforeach
                @endif
                @include('includes.reply-card', $post)
            </div>
            <div class="row justify-content-center">
                <div class="col-7">
                    <h5 class="fw-bold">Comments</h5>
                </div>
            </div>
            @each('includes.post-card', $children, 'post')
        </div>
    </main>

@endsection
{{-- @include('includes.post_card') --}}

@push('scripts')
    {{-- custom script or extend script link --}}
    {{-- @vite('/resources/js/test.js') --}}
@endpush
