    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="upload-alert"></div>
                    <form action="/users/edit/{{ $user->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-4 d-flex flex-column justify-content-center align-items-centerr"
                                id="user-profile">
                                <img src="{{ asset($user->avatar) }}" alt="avatar" width="150" height="150"
                                    class="img-preview rounded-circle border border-secondary mb-3">
                                <label class="btn btn-primary" for="image">Upload Photo</label>
                                <input type="hidden" name="old_avatar" value="{{ $user->avatar }}">
                                <input type="file" name="avatar" class="form-control d-none" id="image"
                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                @error('avatar')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                value="{{ $user->name }}">
                            @error('name')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                id="username" value="{{ $user->username }}">
                            @error('username')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" name="bio" id="bio" rows="3">{{ $user->bio }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        @vite('/resources/js/image_preview.js')
    @endpush
