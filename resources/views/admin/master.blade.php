<!DOCTYPE html>
<html>
<head>
    <title>
        STMIK BINA INSANI
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @stack('css')

</head>
<body>
<nav class="green lighten-1" role="navigation">
    <div class="nav-wrapper container"><a class="h6" href="/barang">PENILAIAN</a>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>

<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://materializecss.com/bin/materialize.js"></script>
@stack('script')
</body>
</html>