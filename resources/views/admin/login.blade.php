<html>

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
        body {
            background: #fff;
        }
        .input-field input[type=date]:focus + label,
        .input-field input[type=text]:focus + label,
        .input-field input[type=email]:focus + label,
        .input-field input[type=password]:focus + label {
            color: #e91e63;
        }
        .input-field input[type=date]:focus,
        .input-field input[type=text]:focus,
        .input-field input[type=email]:focus,
        .input-field input[type=password]:focus {
            border-bottom: 2px solid #e91e63;
            box-shadow: none;
        }
    </style>
</head>

<body>
<div class="section"></div>
<main>
    <center>
        <img class="responsive-img" style="width: 250px;" src="{{url('img/logo.jpg')}}" />
        <div class="container">
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                <form class="col s12" id="login_form">
                    {!! csrf_field() !!}
                    <div class='row'>
                        <div class='col s12'>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='email' name='email' id='email' />
                            <label for='email'>Enter your email</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='password' name='password' id='password' />
                            <label for='password'>Enter your password</label>
                        </div>

                    </div>

                    <br />
                    <center>
                        <div class='row'>
                            <a type='submit' id='btn_login' name='btn_login' class='col s12 btn btn-large waves-effect green'>Login</a>
                        </div>
                    </center>
                </form>
            </div>
        </div>

    </center>

    <div class="section"></div>
    <div class="section"></div>
</main>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://materializecss.com/bin/materialize.js"></script>
</body>
<script>
    $('#btn_login').click(function () {

        var form_data = $('#login_form').serialize();
        $.ajax({
           url:"{{url('admin/login')}}",
            type:"POST",
            data:form_data,

            success:function (res) {
                if(res.success == false){
                    var toastHTML = '<span>'+res.data+'</span>';
                    M.toast({html: toastHTML});
                }else{
                    var toastHTML = '<span>'+res.data+'</span>';
                    M.toast({html: toastHTML});
                    location.replace("{{url('admin')}}")
                }
                console.log(res)
            }
        });
    })
</script>
</html>
