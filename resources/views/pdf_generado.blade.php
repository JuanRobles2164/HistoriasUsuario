<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>DOCUMENTOOOOOOO XDD</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>USUARIOS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                
                    <td>
                        {{$usuario->e_mail}}
                    </td>
                    <td>
                        {{$usuario->nombres}}
                    </td>
                    <td>
                        {{$usuario->apellidos}}
                    </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>