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
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.dropdown-trigger');
        var instances = M.Dropdown.init(elems, options);
    });

    // Or with jQuery

    $('.dropdown-trigger').dropdown();
</script>
</body>
</html>