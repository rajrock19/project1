<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Dear {{ $user->name }},</p>
<p>Please click <a href="{{ $verificationLink }}">here</a> to verify your email.</p>
<p>Thanks</p>

</body>
</html>