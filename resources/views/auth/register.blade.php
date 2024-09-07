<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/auth/login.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/toastr/css/toastr.min.css') }}">
    <title>User Register</title>
    <style>
        .error{
  font-weight: 600;
  color:red;
}
    </style>
</head>
<body>
    <form class="login" action="{{ route('user.store') }}" method="POST">
        @csrf
        <h2>User Registration Form</h2>

        <input type="text" placeholder="Name" name="name" id="name" value="{{ old('name') }}">
        @if($errors->has('name'))
            <div class="error">{{ $errors->first('name') }}</div>
        @endif
        <input type="text" placeholder="Username (Email)" name="email" id="email" value="{{ old('email') }}">
        @if($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
        @endif
        <input type="password" placeholder="Password" name="password" id="password">
        @if($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
        @endif

        <input type="password" placeholder="Confirm Password" name="password_confirmation" id="confirm_password">
        @if($errors->has('password_confirmation'))
            <div class="error">{{ $errors->first('password_confirmation') }}</div>
        @endif
    
        <select name="language" id="language" class="language-select">
            <option value="" selected disabled>--Select Language--</option>
            <option value="en" {{ old('language') == 'en' ? 'selected' : '' }}>EN</option>
            <option value="de" {{ old('language') == 'de' ? 'selected' : '' }}>DE</option>
        </select>
        @if($errors->has('language'))
            <div class="error">{{ $errors->first('language') }}</div>
        @endif

        <input type="text" placeholder="Mobile Number" name="mobile" id="mobile" value="{{ old('mobile') }}">
        @if($errors->has('mobile'))
            <div class="error">{{ $errors->first('mobile') }}</div>
        @endif

        <button class="button" type="submit" value="Log In" id="submit">Submit</button>

        <div class="links">
            <div>Already have an account?</div>
            <a href="{{ url('/') }}">Login</a>
        </div>
    </form>
    
       
    
      <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/js/feather.min.js') }}"></script>
      <script src="{{ asset('assets/js/moment.min.js') }}"></script>
      <script src="{{ asset('assets/js/script.js') }}"></script>
      <script src="{{ asset('assets/toastr/js/toastr.min.js') }}" type="text/javascript"></script>
<script>
                 @if(session()->has('error'))
                     toastr.error("", "{{ session()->get('error')}}", {
                                    positionClass: "toast-top-right",timeOut: 5000,
                                    closeButton: !0,debug: !1,newestOnTop: !0,
                                    progressBar: !0,preventDuplicates: !0,onclick: null,
                                    showDuration: "300",hideDuration: "1000",
                                    extendedTimeOut: "1000",showEasing: "swing",
                                    hideEasing: "linear",showMethod: "fadeIn",
                                    hideMethod: "fadeOut",tapToDismiss: !1
                                })
                    @endif
                    @if(session()->has('success'))
                       toastr.success("", "{{ session()->get('success')}}", {
                                    timeOut: 5000,closeButton: !0,
                                    debug: !1,newestOnTop: !0,
                                    progressBar: !0,positionClass: "toast-top-right",
                                    preventDuplicates: !0,onclick: null,
                                    showDuration: "300",hideDuration: "1000",
                                    extendedTimeOut: "1000",showEasing: "swing",
                                    hideEasing: "linear",showMethod: "fadeIn",
                                    hideMethod: "fadeOut",tapToDismiss: !1
                                })
                    @endif

    </script>

</body>

</html>