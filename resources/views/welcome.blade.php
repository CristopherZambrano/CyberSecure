@extends('Assets.InitAsset')
@section('title', 'CyberSecure')
@section('content')
    <h1 class="TitleGeneral">Bienvenido a CyberSecure</h1>
    <form method="GET" action="{{route('StartAdventure')}}">

        @csrf

        <div class="SecondContainer">
            <div class="thirdContainer">
                <div>
                    <label class="NormalText">Usuario:</label>
                </div>
                <div>
                    <input type="text" id="user" placeholder="Ingrese su usuario o correo" name="user" class="inputText">
                </div>
            </div>
            <div class="thirdContainer">
                <div>
                    <label class="NormalText" >Password:</label>
                </div>
                <div>
                    <input class="inputText" type="password" id="password" placeholder="Ingrese su contraseña" name="password">
                </div>
            </div>
            <div class="thirdContainer" style="align-content: center" >
                <button type="submit" class="buttonprimary">Ingresar</button>
            </div>
            <div class="thirdContainer" style="text-align: center">
                <label class="NormalText" >¿No tienes una cuenta?</label>
                <label class="NormalText" style="color: red">
                    <a href="registro" style="color: red">Registrate</a></label>
            </div>
        </div>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first('error') }}
        </div>
    @endif
@endsection