@extends('layouts.app')
@section('styles')
    {{-- custom style or extend spesific css style --}}
@endsection

@section('title', 'Create New Post')

@section('content')
    @include('includes.navbar')
    <main>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-7 bg-body-tertiary p-3 rounded">
                    <form method="post" action="/posts/create">
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
