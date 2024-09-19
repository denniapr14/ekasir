@extends('Dashboard.app')
@extends('flashdata')
@section('title', 'Edit Profile')
@section('pageTitle', 'Edit Profile')
@section('back', route('editProfile'))
@section('breadcrumb', 'Edit Profile')
{{--  @section('breadcrumb2', 'Tambah Produk')  --}}
@section('content')

    <div class="card">

        <div class="card-body">
            <form action="{{ route('editProfileAction') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="usernameUser" id="" class="form-control"
                        value="{{ $userData->usernameUser }}" placeholder="" readonly aria-describedby="helpId">

                </div>
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="nameUser" id="" value="{{ $userData->nameUser }}"
                        class="form-control" placeholder="" aria-describedby="helpId">

                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="emailUser" id="" value="{{ $userData->emailUser }}"
                        class="form-control" placeholder="" aria-describedby="helpId">

                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="addessUser" id="" class="form-control"
                        value="{{ $userData->addressUser }}" placeholder="" aria-describedby="helpId">

                </div>

                <div class="form-group">
                    <label for="">No. Phone</label>
                    <input type="tel" name="phoneUser" id="" class="form-control" placeholder=""
                        value="{{ $userData->phoneUser }}" aria-describedby="helpId">

                </div>
                <div class="form-group">
                    <label for="">Foto</label>
                    <input type="file" name="photoUser" id="" class="form-control"
                        value="{{ $userData->photoUser }}" placeholder="" aria-describedby="helpId">
                    @if (!empty($userData->photoUser))
                        <img src="{{ url('Uploads/photoUser/', [$userData->photoUser]) }}"
                            class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                            alt="">

                    @endif
                </div>
                <div class="form-group">
                    <label for="passwordUser">Password</label>
                    <div class="input-group">
                        <input type="password" name="passwordUser" id="passwordUser" class="form-control" required placeholder=""
                            aria-describedby="helpId">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="showPasswordToggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
        </div>
    </div>


    <script>
        document.getElementById("showPasswordToggle").addEventListener("click", function() {
            var passwordInput = document.getElementById("passwordUser");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                document.getElementById("showPasswordToggle").innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordInput.type = "password";
                document.getElementById("showPasswordToggle").innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    </script>

@endsection
