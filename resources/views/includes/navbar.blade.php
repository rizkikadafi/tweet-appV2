<nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <img class="me-2" src="{{ asset('/images/tweet-logo.png') }}" width="50" alt="tweet logo">
        <a class="navbar-brand" href="/">TweetApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                        href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('friends/*') ? 'active' : '' }}" aria-current="page"
                        href="/friends/{{ Auth::user()->username }}">Friends</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('posts') || request()->is('posts/*') ? 'active' : '' }}"
                        aria-current="page" href="/{{ Auth::user()->username }}/posts">Post</a>
                </li>
            </ul>
            <ul class="navbar-nav w-100 justify-content-center">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                        data-bs-toggle="modal" data-bs-target="#searchUserModal">
                </form>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ asset(Auth::user()->avatar) }}" alt="" width="32" height="32"
                            class="rounded-circle me-2">
                        <strong>{{ Auth::user()->name }}</strong>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/{{ Auth::user()->username }}">Profile</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="searchUserModal" tabindex="-1" aria-labelledby="searchUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <input class="form-control" id="search-user" placeholder="Type to search user...">
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush" id="search-results">

                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @vite('resources/js/search_user.js')
@endpush
