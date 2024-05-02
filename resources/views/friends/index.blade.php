@extends('layouts.app')
@push('styles')
    {{-- custom style or extend spesific css style --}}
@endpush

@section('title', 'Friends')

@section('content')
    @include('includes.navbar')
    <main>
        <div class="container">
            <div class="py-5 row justify-content-center">
                <div class="col-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="user p-2 mb-3">
                                <div class="row align-items-center">
                                    <div class="col-1">
                                        <img class="rounded-circle" width="40" height="40" src="{{ asset($user->avatar) }}"
                                            alt="avatar">
                                    </div>
                                    <div class="col">
                                        <span class="d-block text-white fw-bold">{{ $user->name }}</span>
                                        <a href="" class="link-underline link-underline-opacity-0 text-secondary">
                                            {{ '@' . $user->username }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <nav class="mb-3 nav nav-pills flex-column flex-sm-row border border-secondary rounded p-2">
                                <button id="friends-tab"
                                    class="flex-sm-fill text-sm-center nav-link active">Friends</button>
                                <button id="followers-tab" class="flex-sm-fill text-sm-center nav-link">Followers</button>
                                <button id="following-tab" class="flex-sm-fill text-sm-center nav-link">Following</button>
                            </nav>
                            <ul id="friends-list" class="list-group list-group-flush">
                                @each('includes.profile-item', $friends, 'user')
                            </ul>
                            <ul id="followers-list" class="d-none list-group list-group-flush">
                                @each('includes.profile-item', $followers, 'user')
                            </ul>
                            <ul id="following-list" class="d-none list-group list-group-flush">
                                @each('includes.profile-item', $following, 'user')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
    {{-- custom script or extend script link --}}
    @vite('/resources/js/friendship.js')
@endpush
