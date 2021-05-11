<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Восстановление пароля</title>
</head>

<body>
    <p>Ссылка действует один час : <a href="{{ route('link', ['hash' => $hash]) }}">Перейдите по ссылке</a> </p>

</body>

</html>
