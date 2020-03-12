<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
        html{
            height: 100%;
        }
        
        html * {
            height: 100%;
        }

        body {
            background-image: URL({{URL::to('/Images/Backgrounds/login-background.jpg')}});
            background-attachment: scroll;
            background-repeat: repeat;
            background-size: cover;
        }

        .card {
            height: auto;
            width: 100%;
        }
        
        .center-div {
            background-color: #ffffff6b;
        }

        label{
            font-size: large;
            font-weight: 600;
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col"></div>
            <div class="col d-flex align-items-center center-div">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('postLogin')}}">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Nombre De Usuario</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="contrasenia">Contraseña de usuario</label>
                                <input type="password" name="contrasenia" id="contrasenia" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Ingresar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>