@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container p-3">
            <div class="row justify-content-center">
                <div class="col-md-12 bg-black text-white rounded overflow-hidden">
                    <div class="p-3">
                        @if ($profile == null)
                            <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data"
                                class="p-3">
                                @csrf
                                <div class="text-center mb-3">
                                    <input type="file" name="profile_picture" id="profileImage" class="d-none"
                                        onchange="previewImage()" accept="image/*">
                                    <label id="profileImageLabel" for="profileImage"
                                        class="btn btn-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto fs-1"
                                        style="width: 350px; height: 350px;">
                                        Select Image
                                    </label>
                                    <img id="imagePreview" src="#" alt="Image Preview"
                                        class="d-none rounded-circle mx-auto mt-3" style="width: 350px; height: 350px;">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="first_name" class="text-white">
                                        Voornaam
                                    </label>
                                    <input type="text" name="first_name" class="form-control bg-secondary text-white" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="last_name" class="text-white">
                                        Achternaam
                                    </label>
                                    <input type="text" name="last_name" class="form-control bg-secondary text-white" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="bio" class="text-white">
                                        Over mij
                                    </label>
                                    <textarea rows="4" name="bio" class="form-control bg-secondary text-white"></textarea>
                                </div>
                                <button type="submit"
                                    class="btn btn-danger w-25 align-items-center d-flex justify-content-center mx-auto">
                                    opslaan
                                </button>
                            </form>
                        @else
                            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data"
                                class="p-3">
                                @csrf
                                <div class="text-center mb-3">
                                    <img id="imagePreview" src="data:image/png;base64,{{ $profile->profile_picture }}"
                                        alt="Image Preview" class="d-flex rounded-circle mx-auto mt-3"
                                        style="width: 350px; height: 350px;">
                                    <input type="file" name="profile_picture" id="profileImage" class="d-none"
                                        onchange="previewImageUpdate()">
                                    <label id="profileImageLabel" for="profileImage"
                                        class="btn btn-danger mt-3 w-25 align-items-center d-flex justify-content-center mx-auto">
                                        Select Image
                                    </label>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="first_name" class="text-white">
                                        Voornaam
                                    </label>
                                    <input type="text" name="first_name"
                                        value="{{ old('first_name', $profile->first_name ?? '') }}"
                                        class="form-control bg-secondary text-white" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="last_name" class="text-white">
                                        Achternaam
                                    </label>
                                    <input type="text" name="last_name"
                                        value="{{ old('last_name', $profile->last_name ?? '') }}"
                                        class="form-control bg-secondary text-white" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="bio" class="text-white">
                                        Over mij
                                    </label>
                                    <textarea rows="4" name="bio" class="form-control bg-secondary text-white">{{ old('bio', $profile->bio ?? '') }}</textarea>
                                </div>
                                <button type="submit"
                                    class="btn btn-danger w-25 align-items-center d-flex justify-content-center mx-auto">
                                    Profiel Opslaan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewImage() {
            var input = document.getElementById('profileImage');
            var profileImageLabel = document.getElementById('profileImageLabel');
            var preview = document.getElementById('imagePreview');
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                profileImageLabel.classList.add('d-none');
                profileImageLabel.classList.remove('d-flex');
            }
            if (input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewImageUpdate() {
            var input = document.getElementById('profileImage');
            var profileImageLabel = document.getElementById('profileImageLabel');
            var preview = document.getElementById('imagePreview');
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            if (input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
