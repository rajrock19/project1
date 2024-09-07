<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/auth/login.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/toastr/css/toastr.min.css') }}">
    <title>Login</title>
</head>
<body>
    <form class="login" action="{{ route('authenticate') }}" method="POST">
        @csrf
        <h2>Login</h2>
    
        <input type="text" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
        @if($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
        @endif
    
        <input type="password" placeholder="Password" name="password" id="password">
        @if($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
        @endif
    
        <button class="button" type="submit" value="Log In" id="submit">Log In</button>
    
        <div class="links">
            <a href="{{ url('/user/register') }}">Register</a>
        </div>
    </form>
    
    
      <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
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