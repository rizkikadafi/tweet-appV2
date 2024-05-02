@extends('layouts.app')
@push('styles')
    {{-- custom style or extend spesific css style --}}
@endpush

@section('title', 'Home')

@section('content')
    @include('includes.navbar')
    <main>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-7 p-3 rounded">

                    <div class="card">
                        <div class="card-header py-3">
                            <div class="user-info">
                                <img class="rounded-circle me-1" src="{{ asset($post->user->avatar) }}" alt="avatar" width="20"
                                    height="20">
                                <span class="text-white fw-bold">{{ $post->user->name }}</span>
                                <i class="bi bi-dot text-secondary"></i>
                                <a href="{{ $post->user->username }}" class="link-underline link-underline-opacity-0">
                                    <span class="text-secondary">{{ '@' . $post->user->username }}</span>
                                </a>


                                <i class="bi bi-dot text-secondary"></i>
                                <span class="text-secondary">2 days ago</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                        </div>
                    </div>

                    <p class="card-text border-start border-2 m-0 py-3 ms-3 ps-3">Commenting to <span
                            class="text-primary">{{ '@' . $post->user->username }}</span></p>

                    <form method="post" action="/posts/reply/{{ $post->id }}">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="title"
                                class="form-control form-control-lg @error('title') is-invalid @enderror" id="title"
                                placeholder="Enter Title..." value="{{ old('email') }}" required>
                            @error('title')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                                placeholder="Write your post here..." id="content" style="height: 200px" required></textarea>
                            @error('content')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
    {{-- custom script or extend script link --}}
    {{-- @vite('/resources/js/test.js') --}}
@endpush
