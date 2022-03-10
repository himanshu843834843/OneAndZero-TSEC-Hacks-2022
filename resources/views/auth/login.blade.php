@extends('layouts.app')

@section('content')
<div class="gradient-custom">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="mt-2 mb-5  card bg-dark text-white" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                {{-- <div class="mb-md-5 mt-md-4"> --}}
                <div class="mb-5">
                  <h2 class="fw-normal mb-2 text-uppercase">Login</h2>
                  <p class="text-white-50 mb-5">Please enter your login and password!</p>

                  <div class="form-outline form-white mb-4">
                    <input type="email" id="typeEmailX" class="form-control form-control-lg" placeholder="Email" />
                    {{-- <label class="form-label" for="typeEmailX">Email</label> --}}
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="password" id="typePasswordX" class="form-control form-control-lg" placeholder="Password"/>
                    {{-- <label class="form-label" for="typePasswordX">Password</label> --}}
                  </div>

                  <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                  <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                </div>

                <div>
                  <p class="mb-2">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

