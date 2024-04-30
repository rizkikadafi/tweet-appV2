@extends('layouts.app')
@section('styles')
    {{-- custom style or extend spesific css style --}}
@endsection

@section('title', 'Threads')

@section('content')
    @include('includes.navbar')
    <main>
        <div class="container">
            <div class="parent py-3">
                @if ($post->parent)
                    @foreach ($post->getNestedParentsAttribute() as $post)
                        @include('includes.reply_card', $post)
                        <div class="row justify-content-center my-0">
                            <div class="col-7 border-start border-2 m-0 py-3 ms-5 ps-3"></div>
                        </div>
                    @endforeach
                    {{-- @each('includes.reply_card', $post->getNestedParentsAttribute(), 'post') --}}
                @endif
                @include('includes.reply_card', $post)
            </div>
            <div class="row justify-content-center">
                <div class="col-7">
                    <h5 class="fw-bold">Comments</h5>
                </div>
            </div>
            @each('includes.post_card', $children, 'post')
        </div>
    </main>

@endsection
{{-- @include('includes.post_card') --}}

@push('scripts')
    {{-- custom script or extend script link --}}
    {{-- @vite('/resources/js/test.js') --}}
@endpush
