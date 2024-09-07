<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Lieber {{ $user->name }},</p>
    <p>Bitte klicken Sie <a href="{{ $verificationLink }}">hier</a>, um Ihre E-Mail-Adresse zu bestätigen.</p>
    <p>Vielen Dank</p>
    
</body>
</html>