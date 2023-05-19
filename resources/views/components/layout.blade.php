<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - Controle de Séries</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="d-flex flex-column min-vh-100 corpo">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('series.index') }}">Séries</a>
            @auth
                <a href="{{ route('logout') }}" class="fonte">Sair</a>
            @endauth
            @guest
                <a href="{{ route('login') }}">Entrar</a>
            @endguest
        </div>
    </nav>
    <div class="flex-grow-1 container">
        <h1 class="text-center">{{ $title }}</h1>

        @isset($mensagemSucesso)
            <div class="alert alert-dark" role="alert">
                {{ $mensagemSucesso }}
            </div>
        @endisset
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{ $slot }}
    </div>

    <footer class="bg-black text-white py-4 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Informações de contato</h4>
                    <p>Endereço: Av. Cel Manoel Nunes</p>
                    <p>Email: ericdourado1@hotmail.com</p>
                    <p>Telefone: (27) 996948351</p>
                </div>
                <div class="col-md-6">
                    <h4>Links úteis</h4>
                    <ul class="list-unstyled">
                        <li><a href="https://www.linkedin.com/in/eric-dourado-de-santana-dos-santos-ab3826211/"
                                class="fonte">Linkedin</a></li>
                        <li><a href="https://github.com/ericdourado" class="fonte">GitHub</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>


<style scoped>
    .fonte {
        color: #ffffff;
        text-decoration: none
    }

    .min-vh-100 {
        min-height: 100vh;
    }
    .corpo{
        background-color: #f4f4f4;
    }
</style>
