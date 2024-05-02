<li class="list-group-item">
    <div class="user">
        <div class="row align-items-center">
            <div class="col-1">
                <img class="rounded-circle" width="40" height="40" src="{{ asset($user->avatar) }}" alt="avatar">
            </div>
            <div class="col">
                <span class="d-block text-white fw-bold">{{ $user->name }}</span>
                <a href="/{{ $user->username }}"
                    class="link-underline link-underline-opacity-0 text-secondary">{{ '@' . $user->username }}</a>
            </div>
        </div>
    </div>
</li>
