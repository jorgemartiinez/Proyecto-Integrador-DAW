@extends('layouts.master')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
               <div class="card-body">
                  <h5 class="card-title text-center">Iniciar Sesión</h5>
               <form method="POST" action="{{ route('login') }}">
                  @csrf

                  <div class="form-label-group row">
                     <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nombre usuario') }}</label>
                     <div class="col-md-6">
                        <input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                        @if ($errors->has('email'))
                           <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                     </div>
                  </div>

                  <div class="form-label-group row">
                     <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                     <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                           <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                           </span>
                        @endif
                     </div>
                  </div>

                  <div class="custom-control custom-checkbox mb-3">
                     <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                     <label class="custom-control-label" for="remember">
                        {{ __('Recordar contraseña') }}
                     </label>
                  </div>

                  <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase">
                     {{ __('Login') }}
                  </button>

                  @if (Route::has('password.request'))
                     <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                     </a>
                  @endif
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection
