@extends('layouts.app')
@push('styles')
    {{-- custom style or extend spesific css style --}}
@endpush

@section('title', 'Profile')

@section('content')
    @include('includes.navbar')
    <main>
        <div class="container my-5">
            <div class="row justify-content-start">
                <div class="col-auto">
                    <img src="{{ asset($friend->avatar) }}" alt="avatar" class="rounded-circle me-2" width="200" height="200">
                </div>
                <div class="col align-self-center">
                    <h2>{{ $friend->name }}</h2>
                    <a href="/{{ $friend->username }}"
                        class="text-secondary link-underline link-underline-opacity-0">{{ '@' . $friend->username }}</a>
                    <i class="bi bi-dot text-secondary"></i>
                    <span class="text-secondary"><i class="bi bi-geo-alt-fill"></i> Joined Feb 2023</span>
                    <div class="mt-1 friendship-info">
                        <a href="" class="link-underline link-underline-opacity-0">
                            <span id="followers-target-count"
                                class="text-white fw-bold">{{ $friend->followers->count() }}</span>
                            <span class="text-secondary">Followers</span>
                        </a>

                        <i class="bi bi-dot text-secondary"></i>

                        <a href="" class="link-underline link-underline-opacity-0">
                            <span class="text-white fw-bold">{{ $friend->following->count() }}</span>
                            <span class="text-secondary">Following</span>
                        </a>
                    </div>
                </div>
                <div class="col-auto align-self-center">
                    <div class="row">
                        <div class="col-4">
                            @if ($friend->id === $user->id)
                                <button class="btn btn-outline-primary px-5" data-bs-toggle="modal"
                                    data-bs-target="#editModal">Edit</button>
                            @else
                                @switch($status)
                                    @case('friends')
                                    @case('following')
                                        <button class="btn btn-outline-secondary px-5" id="follow-btn"
                                            data-user-id="{{ $user->id }}"
                                            data-friend-id="{{ $friend->id }}">Following</button>
                                    @break

                                    @case('followers')
                                        <button class="btn btn-outline-primary px-5" id="followback-btn"
                                            data-user-id="{{ $user->id }}"
                                            data-friend-id="{{ $friend->id }}">FollowBack</button>
                                    @break

                                    @default
                                        <button class="btn btn-outline-primary px-5" id="follow-btn"
                                            data-user-id="{{ $user->id }}"
                                            data-friend-id="{{ $friend->id }}">Follow</button>
                                @endswitch
                            @endif


                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-5">
                    @isset($user->bio)
                        <p>{{ $user->bio }}</p>
                    @endisset
                </div>
            </div>
        </div>
    </main>
    @include('includes.edit-profile', ['user' => Auth::user()])

@endsection

@push('scripts')
    {{-- custom script or extend script link --}}
    @vite('resources/js/follow.js')
@endpush
