
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Views/Resources/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Views/Resources/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="Views/Resources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="Views/Resources/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="Views/Resources/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<div class="wrapper">
    <div class="login-card">
      <div class="login-aside flex justify-content-center align-items-center">
        <div >
          <div class="icon-wrapper mt-3">
            <!-- <img src="assets/layout/images/themes/logo-removebg.png" alt="Home Icon" id="logo"> -->
          </div>
          <!-- <div class="sinopsis text-center">
            <p>
              Grupo Rac es tu socio confiable para la compra y venta de automóviles. Nos especializamos en ofrecer una experiencia segura y transparente, con un enfoque personalizado para ayudarte a encontrar el auto perfecto, ya sea un coche económico, un sedán familiar o un vehículo de lujo.
            </p>
            
          
          </div> -->
        </div>
      </div>
      <div class="login-aside-container">
        <div class="login-container">
          <!-- <div id="login-content" class="login-content d-none">
            <div class="text-center mb-5">
              <div class="text-900 text-3xl font-medium mb-3">¡Bienvenido!</div>
              <span class="text-600 font-medium">Inicia sesión para continuar</span>
            </div>
            <div class="login-form">
              <div class="flex flex-column mb-4">
                <label for="name">Usuario</label>
                <input type="text" pInputText id="name" placeholder="Usuario" [(ngModel)]="usuario" required autofocus [ngClass]="{'ng-invalid ng-dirty' : submitted && !usuario}"/>
              </div>
              <div class="flex flex-column mb-4" style="width: 100%;">
                <label for="name">Contraseña</label>
                <input type="password" pInputText id="name" placeholder="Contraseña" [(ngModel)]="contrasena" required autofocus [ngClass]="{'ng-invalid ng-dirty' : submitted && !contrasena}"/>
              </div>
              
              <div _ngcontent-ng-c1839742986="" class="flex align-items-center justify-content-between mb-3 gap-5">
                <div class="field-checkbox-1">
                  <p-checkbox name="group1" value="New York" [(ngModel)]="rememberMe" id="rememberMe"></p-checkbox>
                  <label for="rememberMe " class="p-1">Recuérdame</label>
                </div>
                <a _ngcontent-ng-c1839742986="" routerLink="/reestablecer" class="font-medium no-underline ml-2 text-right cursor-pointer" style="color: #920808;">
                  ¿Olvidó su contraseña?
                </a>
              </div>
              <div class="flex flex-column mb-3" style="color: red;">
                <small class="ng-dirty ng-invalid" *ngIf="submitted && !usuario">Usuario es requerido.</small>
                <small class="ng-dirty ng-invalid" *ngIf="submitted && !contrasena">Contraseña es requerida.</small>  
                <small class="ng-dirty ng-invalid" *ngIf="submitted && errorMessage">{{errorMessage}}</small>  
              </div>
               <div>
                <button pButton (click)="onLogin()" label="Iniciar Sesión" class="p-element w-full p-3 text-xl p-button p-component"></button>
              </div>
            </div>
          </div> -->
          <form id="quickForm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Usuario</label>
                    <input type="input" name="email" class="form-control" id="exampleInputEmail1" placeholder="Usuario">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">Recordar <a href="#">Restablecer contraseña</a>.</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                  <button type="submit" class="btn btn-primary" href="../Template.php">Iniciar Seccion</button>

            </form>

        </div>
      </div>
    </div>
  </div>
  

    <style>

      .d-none{
        display: none;
      }

      .wrapper{
        z-index: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
      }
  
      .login-card{
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
        box-shadow:rgba(0, 0, 0, 0.25) 10px 14px 28px,rgba(0, 0, 0, 0.22) 8px 10px 10px;
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
      .login-aside-container{
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
      transition: width 2s;
      width: 100%;
      height: 95%;
      background: white;
      border-top-right-radius: 15px;
      border-bottom-right-radius: 15px;
      box-shadow:rgba(0, 0, 0, 0.25) 10px 14px 28px,rgba(0, 0, 0, 0.22) 8px 10px 10px;
      }

      .login-content{
        /* border-style: dotted;
        border-color: #920808;
        border-radius: 20px; */
        padding-top: 14%;
        padding-bottom: 14%;
        padding-right: 20%;
        padding-left: 20%;

      }

    .icon-wrapper {
      width: 250px;
      border-radius: 10px;
    }
    
    #logo{
      width: 100%;
      border-radius: 10px;
    }
    .sinopsis{
      padding: 20px;
      color: #ecf0f1;
      font-size: smaller;
    }
    
    </style>