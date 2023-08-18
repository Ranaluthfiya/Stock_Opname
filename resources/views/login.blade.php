@extends('layouts.main')

@section('container')
  <link rel="stylesheet" type="text/css" href="css\custom.css">
    <div class="row justify-content-center">
        <div class="col-lg-5">


            <main class="form-signin w-100 m-auto">
                <form action="/login" method="post">
                    @csrf
                    <h1 class="h3 mb-3 mt-4 fw-normal text-center style-blod">Login</h1>
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="form-floating">
                        <input type="username" class="form-control" name="username" id="floatingInput"
                            placeholder="username" style="border-radius: 15px;" required autofocus>
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mt-3">
                        <input type="password" class="form-control" name="password" id="floatingPassword"
                            placeholder="Password" style="border-radius: 15px;" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign In</button>
                    <label for="" class="mt-2">Belum punya akun? <a href="/register" style="font-weight: bold;">
                            Register</a></label>
                </form>
            </main>
        </div>
    </div>

@endsection