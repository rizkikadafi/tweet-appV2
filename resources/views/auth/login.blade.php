@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container text-center">
        <div class="row min-vh-100 align-items-center">
            <div class="col style=" border: 1px solid white">

                <div class="row mb-3">
                    <div class="col">
                        <img class="mb-3" src="{{ asset('/images/tweet-logo.png') }}" alt="app logo" width="120">
                        <h4>Welcome Back!</h4>
                    </div>
                </div>

                @if (session()->has('loginError'))
                    <div class="row mb-3">
                        <div class="col-5 mx-auto px-0">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-5 mx-auto px-0">
                        <form method="post" action="/login">
                            @csrf
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
                                    class="btn btn-primary rounded-1 fw-medium">Login</button>
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
                        <p class="my-0">Belum punya akun? <a href="/register">Signup</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
