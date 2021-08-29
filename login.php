<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="/Tesis/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Tesis/assets/sweetalert2/sweetalert2.min.css">

    <!-- Estilo de primer columna -->
    <style>
        body{
            background: #ff6b31;
            background: linear-gradient(to right, #22c1c3, #fdbb2d);
        }
        .bg{
            background-image: url(/Tesis/assets/images/wallhaven-5wper9.jpg);
            background-position: center center;
        }
    </style>
</head>
<body>
    <!-- Inicio de sesión con imagen -->
    <div class="container w-75 bg-primary mt-5 rounded shadow">
        <div class="row align-items-stretch">
            <!-- Logo de la Huarachera de Coyoacan -->
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6">
            </div>
            <!-- Logotyope and welcome text -->
            <div class="col bg-white p-5 rounded-end rounded-start">
                <div class="text-center">
                    <img src="/Tesis/assets/images/logo-removebg-preview2.png" width="128" alt="">
                </div>

                <h2 class="fw-bold text-center pt-10 mb-8">La Huarachera de Coyoacán</h2>
                
                <h3 class="fw-light text-center">Inicio de sesión</h3>
                <!-- Login -->
                <form id="formLogin" class="form" action="" method="post">
                    <div class="mb-4">
                        <label for="usuario" class="form-label">Usuario:</label>
                        <br>
                        <input type="text" name="usuario" id="usuario" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña:</label>
                        <br>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="d-grid">
                        <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Conectar">
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="/Tesis/assets/jquery/jquery-3.3.1.min.js"></script>
<script src="/Tesis/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/Tesis/assets/popper/popper.min.js"></script>
<script src="/Tesis/assets/sweetalert2/sweetalert2.all.min.js"></script>
<script src="/Tesis/codigo.js"></script>
</body>
</html>