@extends('layout')

@section('title', 'Login')

@section('content')
<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid" alt="Login Image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2>Other choices to login:</h2>

                    <!-- Social login buttons -->
                    <div class="d-flex flex-row align-items-center justify-content-center mb-4">
                        <button type="button" class="btn btn-floating btn-primary mx-2">
                            <i class="fab fa-facebook-f"></i>
                        </button>

                        <button type="button" class="btn btn-floating btn-primary mx-2">
                            <i class="fab fa-twitter"></i>
                        </button>

                        <button type="button" class="btn btn-floating btn-primary mx-2">
                            <i class="fab fa-linkedin-in"></i>
                        </button>
                    </div>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0">Or</p>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label-lg">Email address</label> <!-- Increased label size -->
                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">


                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label for="password" class="form-label-lg">Password</label> <!-- Larger label for password -->
                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                            name="password" required placeholder="Enter your password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-body">Forgot password?</a>
                        @endif
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('register') }}"
                                class="link-danger">Register</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    /* Background color */
    body {
        background-color: #222;
        color: #fff;
    }

    section.vh-100 {
        height: 100vh;
    }

    /* Form container */
    .card {
        background-color: #333;
        border: none;
        border-radius: 10px;
    }

    .form-control-lg {
        background-color: #fff;
        color: #fff;
        border: 1px solid #555;
    }

    .form-control:focus {
        background-color: #3652b0;
        border-color: #4c68d7;
        color: #fff;
    }

    /* Social login button styles */
    .btn-floating {
        border-radius: 50%;
        padding: 12px;
        width: 45px;
        height: 45px;
        font-size: 18px;
    }

    .btn-primary {
        background-color: #4c68d7;
        border: none;
    }

    .btn-primary:hover {
        background-color: #3652b0;
    }

    .divider {
      text-align: center;
      border-bottom: 1px solid #e9ecef; /* Solid border for the divider */
      margin: 1.5rem 0;
      position: relative;
  }
  
  .divider p {
      margin-bottom: 0;
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      background-color: #fff; /* Background color to make the text stand out */
      padding: 0 1rem; /* Padding around the text */
      font-weight: bold;
  }

    /* Button animations */
    .btn-lg {
        padding-left: 2.5rem;
        padding-right: 2.5rem;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        color: #fff;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Invalid feedback */
    .invalid-feedback {
        display: block;
        color: #e3342f;
        font-size: 0.875rem;
    }

    /* Custom Checkbox */
    .form-check-input {
        background-color: #333;
        border: 1px solid #444;
        border-radius: 0.25rem;
    }

    .form-check-input:checked {
        background-color: #4c68d7;
        border-color: #4c68d7;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .container-fluid.h-custom {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .form-control-lg {
            font-size: 1.15rem;
        }
    }

    /* Styles for larger labels */
    .form-label-lg {
        font-size: 1.25rem;
        /* Increase the label size */
        color: #222;
        /* Same color as the default form labels */
        display: block;
        /* Make sure it's displayed as a block element */
        margin-bottom: 0.5rem;
        /* Add spacing between the label and input */
    }

    /* Adjust form-control-lg for consistency */
    .form-control-lg {
        font-size: 1.25rem;
        /* Larger text size for input fields */
        padding: 1rem;
        /* Increase padding for better aesthetics */
        border-radius: 0.3rem;
        /* Keep the rounded edges */
    }
</style>