<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/InitCSS.css') }}">
</head>

<body class="body">
    <div class="contenedor">
        <div class="izquierda">
            <div style="height: 300px; width: 300px; margin-top: 20%; margin-left: 25%">
                <img src="https://ncsmadison.com/wp-content/uploads/2018/01/Security-Icon-2.png" 
                class="img-fluid rounded-start">
            </div>
            <div style="margin-top: 30px;">
                <h1 class="TitleGeneral">CyberSecure: Su asesor legal en cyberseguridad</h1>
            </div>
        </div>
        <div class="Derecha">
            @yield('content')
        </div>
    </div>
</body>

</html>
