@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container text-center">
        <div class="row min-vh-100 align-items-center">
            <div class="col style=" border: 1px solid white">

                <div class="row mb-3">
                    <div class="col">
                        <img class="mb-3" src="{{ Vite::asset('resources/images/tweet-logo.png') }}" alt="app logo"
                            width="120">
                        <h4>Welcome to TweetApp</h4>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-5 mx-auto px-0">

                        <form method="post" action="/register">
                            @csrf
                            <div class="mb-3 mx-0">
                                <label for="name" class="form-label d-block text-start">Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Enter your name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="mb-3 mx-0">
                                <label for="email" class="form-label d-block text-start">Email address</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="name@example.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="mb-3 mx-0">
                                <label for="password" class="form-label d-block text-start">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Enter your Password" required>
                                @error('password')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-grid mx-auto gap-2">
                                <button type="submit" name="submit"
                                    class="btn btn-primary rounded-1 fw-medium">Register</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col px-0">
                        <div class="d-grid col-5 mx-auto gap-2">
                            <a href="" type="button" class="btn btn-secondary rounded-1 fw-medium"><i
                                    class="bi bi-google"></i> Continue with Google</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <p>Already have an account? <a href="/login">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
