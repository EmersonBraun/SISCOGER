<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> 
</head>
    <body>
        <div class="content row">
            <h3>Olá, {{ special_ucwords($user->nome) }}!</h3>
            <div class="col-md-12">
                <p>Você está recebendo este e-mail porque foi realizado seu cadastro no SISCOGER.</p>
                <p>Para o primeiro acesso o login e senha são seu RG (apenas os números).</p>

                <p><a href="{{route('login')}}" class="btn btn-primary" target="_blanck">Acessar SISCOGER</a></p>
                <p>Caso tenha problemas com o botão, copie e cole esse endereço no navegador: {{route('login')}}</p>
            </div>
            <p></p>
            <p>Não responda esse e-mail, Envio automático, <b>SISCOGER<b></p>
        </div>
    </body>
</html>