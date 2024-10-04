@extends('layouts.app')

@section('content')
{{-- <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ asset('assets/images/stisla-fill.svg') }}" alt="logo" width="100"
class="shadow-light rounded-circle">
</div>

<div class="card card-primary">
    <div class="card-header">
        <h4>Login</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group">
                <label for="email">Correo Eléctronico</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus tabindex="1">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">Contraseña</label>
                    <div class="float-right">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-small">
                            ¿Olvidaste tu contraseña?
                        </a>
                        @endif
                    </div>
                </div>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror" name="password"
                    required autocomplete="current-password" tabindex="2">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                        name="remember" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember-me">Recordad Usuario</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
<div class="simple-footer">
    Municipalidad de Santiago de Surco &copy;
</div>
</div>
</div>
</div>
</section> --}}
<div class="login-page">
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-lg-3 col-md-8 col-12 d-none d-lg-block">
                <div class="box mb-0 b-0 bg-transparent">
                    <div class="box-body login-slider p-0">
                        <div id="carousel-example-generic-captions" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic-captions" data-slide-to="0" class="active">
                                </li>
                                <li data-target="#carousel-example-generic-captions" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic-captions" data-slide-to="2"></li>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img src="{{ asset('assets/images/slide-1.jpg') }}" class="img-fluid"
                                        alt="slide-1">
                                    <div class="carousel-caption">
                                        <h3>First here</h3>
                                        <p>this is the subcontent you can use this</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/images/slide-1.jpg') }}" class="img-fluid"
                                        alt="slide-2">
                                    <div class="carousel-caption">
                                        <h3>Second here</h3>
                                        <p>this is the subcontent you can use this</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/images/slide-1.jpg') }}" class="img-fluid"
                                        alt="slide-3">
                                    <div class="carousel-caption">
                                        <h3>Third here</h3>
                                        <p>this is the subcontent you can use this</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-12">
                <div class="login-box">
                    <div class="login-box-body">
                        <h3 class="text-center">Get started with Us</h3>
                        <p class="login-box-msg">Sign in to start your session</p>

                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group has-feedback">
                                <input type="email" name="email" class="form-control rounded  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="ion ion-email form-control-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" name="password" class="form-control rounded @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="ion ion-locked form-control-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <!-- <div class="col-6">
                                    <div class="checkbox">
                                        <input type="checkbox" id="basic_checkbox_1">
                                        <label for="basic_checkbox_1">Remember Me</label>
                                    </div>
                                </div> -->
                                <!-- /.col -->
                                <div class="col-12 text-center mb-5">
                                    <button type="submit" class="btn btn-info btn-block margin-top-10">SIGN IN</button>
                                </div>
                                <!-- /.col -->
                                                                 <!-- /.col -->
                                <div class="col-12 mt-5">
                                    <div class="fog-pwd text-center ">
                                        <a href="javascript:void(0)" class="text-white"><i class="ion ion-locked"></i>
                                            ¿Olvidadte tu contraseña??</a><br>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="social-auth-links text-center">
                            <p>- OR -</p>
                            <a href="#" class="btn btn-outline btn-light btn-social-icon"><i
                                    class="fa fa-facebook"></i></a>
                            <a href="#" class="btn btn-outline btn-light btn-social-icon"><i
                                    class="fa fa-google-plus"></i></a>
                            <a href="#" class="btn btn-outline btn-light btn-social-icon"><i
                                    class="fa fa-twitter"></i></a>
                            <a href="#" class="btn btn-outline btn-light btn-social-icon"><i
                                    class="fa fa-instagram"></i></a>
                        </div>
                        <!-- /.social-auth-links -->

                        <div class="margin-top-30 text-center">
                            <p>Don't have an account? <a href="register.html" class="text-warning ml-5">Sign Up</a></p>
                        </div>

                    </div>
                    <!-- /.login-box-body -->
                </div>
                <!-- /.login-box -->

            </div>
        </div>
    </div>
</div>
@endsection