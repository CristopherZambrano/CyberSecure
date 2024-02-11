@extends('Assets.InitAsset')
@section('title', 'Registro - CyberSecure')
@section('content')
<h1 class="TitleGeneral">Bienvenido a CyberSecure</h1>
<form method="POST" action="{{route('VenderElAlma')}}">
    @csrf
    <div class="SecondContainer">
        <div class="rowContainer">
            <div class="fourtContainer">
                <div>
                    <label class="NormalText">Nombre:</label>
                </div>
                <div>
                    <input type="text" id="name" placeholder="Ingrese su nombre" name="name" class="inputText">
                </div>
            </div>
            <div class="fiveContainer">
                <div>
                    <label class="NormalText">Apellido:</label>
                </div>
                <div>
                    <input type="text" id="lastName" placeholder="Ingrese su apellido" name="lastName" class="inputText">
                </div>
            </div>
        </div>
        <div class="rowContainer">
            <div class="fourtContainer">
                <div>
                    <label class="NormalText">Email:</label>
                </div>
                <div>
                    <input type="email" id="email" placeholder="Ingrese su correo electronico" name="email" class="inputText">
                </div>
            </div>
            <div class="fiveContainer">
                <div>
                    <label class="NormalText">Telefono:</label>
                </div>
                <div>
                    <input type="number" id="phone" placeholder="Ingrese su numero de telefono" name="phone" class="inputText">
                </div>
            </div>
        </div>
        <div class="rowContainer">
            <div class="fourtContainer">
                <div>
                    <label class="NormalText">Direccion:</label>
                </div>
                <div>
                    <input type="text" id="address" placeholder="Ingrese la direccion de su empresa" name="address" class="inputText">
                </div>
            </div>
            <div class="fiveContainer">
                <div>
                    <label class="NormalText">Empresa:</label>
                </div>
                <div>
                    <input type="text" id="enterprise" placeholder="Ingrese el nombre de su empresa" name="enterprise" class="inputText">
                </div>
            </div>
        </div>
        <div class="rowContainer">
            <div class="fourtContainer">
                <div>
                    <label class="NormalText">Usuario:</label>
                </div>
                <div>
                    <input type="text" id="user" placeholder="Ingrese su alias o usuario" name="user" class="inputText">
                </div>
            </div>
            <div class="fiveContainer">
                <div>
                    <label class="NormalText">Password:</label>
                </div>
                <div>
                    <input type="password" id="password" placeholder="Ingrese su contraseña" name="password" class="inputText">
                </div>
            </div>
        </div>
        <div class="thirdContainer" style="align-content: center" >
            <button type="submit" class="buttonprimary">Registrate</button>
        </div>
        <div class="thirdContainer" style="text-align: center">
            <label class="NormalText" >¿Tienes una cuenta?</label>
            <label class="NormalText" style="color: red">
                <a href="/" style="color: red">Ingresa al sistema</a></label>
        </div>
    </div>
</form>
@endsection