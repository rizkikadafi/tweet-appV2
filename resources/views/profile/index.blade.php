@extends('layouts.app')
@section('styles')
    {{-- custom style or extend spesific css style --}}
@endsection

@section('title', 'Profile')

@section('content')
    @include('includes.navbar')
    <main>
        <div class="container my-5">
            <div class="row justify-content-start">
                <div class="col-auto">
                    @if ($user->avatar !== null)
                        <img src="{{ Vite::image('tweet-logo.png') }}" alt="avatar" class="rounded-circle me-2" width="200"
                            height="200">
                    @else
                        <img src="{{ Vite::image('avatar.jpeg') }}" alt="avatar" class="rounded-circle me-2" width="200"
                            height="200">
                    @endif
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
                                    data-bs-target="#exampleModal">Edit</button>
                            @else
                                {{-- @switch($status)
                                    @case('pending')
                                        @switch($action_status)
                                            @case('first')
                                                <button class="btn btn-outline-secondary px-5" id="following-btn"
                                                    data-user-id="{{ $user->id }}"
                                                    data-friend-id="{{ $friend->id }}">Following</button>
                                            @break

                                            @case('second')
                                                <button class="btn btn-outline-primary px-5" id="followback-btn"
                                                    data-user-id="{{ $user->id }}"
                                                    data-friend-id="{{ $friend->id }}">FollowBack</button>
                                            @break
                                        @endswitch
                                    @break

                                    @case('accepted')
                                        <button class="btn btn-outline-secondary px-5" id="following-btn"
                                            data-user-id="{{ $user->id }}"
                                            data-friend-id="{{ $friend->id }}">Following</button>
                                    @break

                                    @default
                                        <button class="btn btn-outline-primary px-5" id="follow-btn"
                                            data-user-id="{{ $user->id }}"
                                            data-friend-id="{{ $friend->id }}">Follow</button>
                                @endswitch --}}
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
                        <p>{{ description }}</p>
                    @endisset
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="upload-alert"></div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="row justify-content-center">
                            <div class="col-5" id="user-profile">
                                <input type="file" name="profile-img" class="form-control" id="imageInput"
                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload" hidden>

                                <div class="content">
                                    <div id="image-link">
                                        <img src=" alt="" width=" 150" height="150"
                                            class="rounded-circle border border-secondary">
                                        <div class="content-details">
                                            <h5 class="content-title">Upload Photo</h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Name</label>
                            <input type="text" name="fullname" class="form-control" id="fullname" value="">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" value="">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- custom script or extend script link --}}
    @vite('resources/js/follow.js')
@endpush
