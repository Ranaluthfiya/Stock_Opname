@extends('layouts.main')

@section('container')
<link rel="stylesheet" type="text/css" href="css\custom.css">
    <div class="row justify-content-center">
        <div class="col-lg-5">


            <main class="form-signin w-100 m-auto">
                <form action="/register" method="post">
                    @csrf
                    @if (session()->has('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <h1 class="h3 mb-4 fw-normal text-center style-blod mt-4">Register</h1>

                    <div class="form-floating">
                        <input type="nama" class="form-control @error('username') is-invalid @enderror" name="username"
                            value="{{ old('username') }}" id="floatingInput" style="border-radius: 15px;"
                            placeholder="Password" autofocus required>
                        <label for="floatingInput">Username</label>
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="nama" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" id="floatingInput" style="border-radius: 15px;"
                            placeholder="name@example.com" autofocus required>
                        <label for="floatingInput">Nama</label>
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>

                    <div class="form-floating mt-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            id="floatingPassword" value="{{ old('password') }}" style="border-radius: 15px;"
                            placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
                    <label for="" class="mt-2">Sudah punya akun? <a href="/login" style="font-weight: bold;">
                            Login</a></label>

                </form>
            </main>
        </div>
    </div>
@endsection