@extends('main-layout.layout2')

@section('title', 'Login')

@section('session')
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/home" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/mlijo.jpg" alt="">
                  <span class="d-none d-lg-block">MLIJO</span>
                </a>
              </div><!-- End Logo -->

              @if(session('messages'))
                <div style="text-align: center" class="alert alert-success">{{session('messages')}}</div>
                @endif

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Sign-in to Your Account</h5>
                    <p class="text-center small">Enter your username & password to sign-in</p>
                  </div>

                @error('email')
                    <div class="text-danger"><h6 style="text-align: center">{{ $message }}</h6></div>
                @enderror

                  <form action="{{route('session.store')}}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                    @csrf

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="email" class="form-control" id="yourEmail" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Sign-in</button>
                    </div>
                    <div class="col-12">
                      <p style="text-align: center" class="small mb-0">Don't have account? <a href="/register-show">Create an account</a></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->
@endsection
