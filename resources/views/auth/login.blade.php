<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/auth/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/toastr/css/toastr.min.css') }}">
    <title>Login</title>
</head>
<body>
    <form class="login" id="loginForm">
        @csrf
        <h2>Login</h2>
    
        <input type="text" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
        <div class="error" id="emailError"></div>
    
        <input type="password" placeholder="Password" name="password" id="password">
        <div class="error" id="passwordError"></div>
    
        <button class="button" type="submit" id="submit">Log In</button>
    
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

// $('#loginForm').on('submit', function (e) {
//     e.preventDefault();

//     let email = $('#email').val();
//     let password = $('#password').val();
//     let csrfToken = $('input[name=_token]').val();

//     if(email == ''){
//         toastr.error('Email Field is Required');
//         return false;
//     }
//     if(password == ''){
//         toastr.error('Password Field is Required');
//         return false;
//     }

//     $.ajax({
//         url: "{{ route('authenticate') }}",
//         type: "POST",
//         data: {
//             email: email,
//             password: password,
//             _token: csrfToken
//         },
//         success: function (response) {
//             console.log(response);
//             if (response.token) {
//                 let token = response.token;
//                 window.location.href = "{{ route('dashboard.view') }}?token=" + token;
//             }else{
//                 toastr.error();
//             }
//         },
//         error: function (xhr) {
//             let errors = xhr.responseJSON.errors;

//             toastr.error(errors.message);
            

//             if (xhr.status === 401) {
//                 toastr.error('Invalid credentials or account not verified.');
//             }
//         }
//     });
// });

$('#loginForm').on('submit', function (e) {
    e.preventDefault();

    let email = $('#email').val();
    let password = $('#password').val();
    let csrfToken = $('input[name=_token]').val();

    if (email === '') {
        toastr.error('Email Field is Required');
        return false;
    }
    if (password === '') {
        toastr.error('Password Field is Required');
        return false;
    }

    $.ajax({
        url: "{{ route('authenticate') }}",
        type: "POST",
        data: {
            email: email,
            password: password,
            _token: csrfToken
        },
        success: function (response) {
            console.log(response);
            if (response.token) {
                let token = response.token;
                window.location.href = "{{ route('dashboard.view') }}?token=" + token;
            } else {
                toastr.error(response.message || 'An unexpected error occurred.');
            }
        },
        error: function (xhr) {
            // Check if the response is JSON and has an 'error' field
            if (xhr.responseJSON && xhr.responseJSON.error) {
                toastr.error(xhr.responseJSON.message || 'An error occurred.');
            } else {
                // Fallback for other types of errors
                toastr.error('An unexpected error occurred.');
            }

            if (xhr.status === 401) {
                toastr.error('Invalid credentials or account not verified.');
            }
        }
    });
});

    </script>
</body>
</html>
