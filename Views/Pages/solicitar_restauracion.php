<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Resources/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Resources/dist/css/adminlte.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="login-card">
            <div class="login-aside flex justify-content-center align-items-center">
                <div>
                    <div class="icon-wrapper mt-3">
                        <!-- <img src="assets/layout/images/themes/logo-removebg.png" alt="Home Icon" id="logo"> -->
                    </div>
                </div>
            </div>
            <div class="login-aside-container">
                <div class="login-container d-none" id="login-container">
                    <form id="quickForm" method="POST" action="../../Services/enviar_codigo.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Usuario</label>
                                <input type="text" name="usuario" class="form-control" id="exampleInputUsername1" placeholder="Usuario" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-3">Enviar Código</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <style>
                .d-none {
            display: none;
        }

        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f6f9;
        }

        .wrapper {
            z-index: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .login-card {
            z-index: 1;
            width: 800px;
            height: 500px;
            display: flex;
            position: relative;
        }

        @keyframes unfoldAside {
            from {
                transform: scaleY(0);
            }

            to {
                transform: scaleY(1);
            }
        }

        .login-aside {
            z-index: 2;
            background-color: #000;
            width: 35%;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.25) 10px 14px 28px, rgba(0, 0, 0, 0.22) 8px 10px 10px;
            animation: unfoldAside 1s ease-out forwards;
            position: relative;
        }

        @keyframes unfoldAsideContainer {
            from {
                transform: scaleX(0);
            }

            to {
                transform: scaleX(1);
                width: 65%;
            }
        }

        .login-aside-container {
            display: flex;
            align-items: center;
            width: 0%;
            transform-origin: left;
            animation: unfoldAsideContainer 0.5s ease-out forwards;
            animation-delay: 1.2s;
            position: relative;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 4;
            transition: width 2s, opacity 1s ease-out;
            width: 100%;
            height: 95%;
            background: white;
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.25) 10px 14px 28px, rgba(0, 0, 0, 0.22) 8px 10px 10px;
            opacity: 0;
        }

        .login-container.show {
            opacity: 1;
        }

        .login-content {
            padding-top: 14%;
            padding-bottom: 14%;
            padding-right: 20%;
            padding-left: 20%;
        }

        .icon-wrapper {
            width: 250px;
            border-radius: 10px;
        }

        #logo {
            width: 100%;
            border-radius: 10px;
        }

        .sinopsis {
            padding: 20px;
            color: #ecf0f1;
            font-size: smaller;
        }

        .btn-block {
            width: 100%;
            display: block;
        }
    </style>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                document.getElementById('login-container').classList.remove('d-none');
                setTimeout(() => {
                    document.getElementById('login-container').classList.add('show');
                }, 50);
            }, 1800);
        });
    </script>
</body>
</html>
