<div class="row justify-content-center post">
    <div class="col-7 p-3">
        <div class="card">
            <div class="card-header py-3">
                <div class="user-info">
                    <img class="rounded-circle me-1" src="{{ asset($post->user->avatar) }}" alt="avatar" width="20"
                        height="20">
                    <a href="/{{ $post->user->username }}" class="link-underline link-underline-opacity-0">
                        <span class="text-secondary">{{ '@' . $post->user->username }}</span>
                    </a>

                    <i class="bi bi-dot text-secondary"></i>
                    <span class="text-secondary">2 days ago</span>
                </div>
            </div>

            <a href="/{{ $post->user->username }}/posts/{{ $post->id }}"
                class="link-underline link-underline-opacity-0 link-light">
                <div class="card-body" style="cursor:pointer;">
                    <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                    <p class="card-text">
                        {{ $post->content }}
                    </p>
                </div>
            </a>

            <div class="card-footer">
                <div class="row align-items-center">
                    <div class="col-4">
                        {{-- liked --}}
                        {{-- <i class="bi bi-heart-fill text-danger me-1 unlike-btn"></i> --}}

                        {{-- unliked --}}
                        <i class="bi bi-heart me-1 like-btn"></i>
                        <span class="text-white like-count me-4" id="like-count">3</span>
                        <a href="/posts/reply/{{ $post->id }}"
                            class="text-white link-underline link-underline-opacity-0 me-1">
                            <i class="bi bi-chat-left-dots"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
