<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php
require_once ("conexion/conexion.php"); 
  $key = 'AIzaSyA4-cG74_Xz2bJTXssFTeqdIqW3TIDVJ_E';
  $origen = '16.908380,-92.094635';
  $destino = '16.908380,-92.094635';
  $summary = '';
  $modo = 'driving';
  $hashtag = '';
 ?>

<body id="page-top">

  <div id="wrapper">

     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-map-marked-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Lugares</div>
      </a>
      <hr class="sidebar-divider my-0">

    <form action="#" method="post" id="frmbuscar">
      <li class="nav-item active">
        <a class="nav-link">
          <i class="fas fa-fw fa-map-marker"></i>
          <span>Origen</span>
          <span>
            <select class="form-control form-control-sm" name="origen" id="origen">
            <?php                 
                $sql = "SELECT * FROM coordenadas ORDER BY lugar";
                $consulta = mysqli_query($link, $sql);
                while ( $fila = mysqli_fetch_array($consulta) ) {
                ?>                
                <option value="<?php echo $fila['coordenada']  ?>"><?php echo $fila['lugar']?></option>
                <?php } ?>
                </select>
          </span>          
        </a>          
      </li>
      <li class="nav-item active">
        <a class="nav-link">
          <i class="fas fa-fw fa-map-marker-alt"></i>
          <span>Destino</span>
          <span>
            <select class="form-control form-control-sm" name="destino" id="destino">
            <?php 
                $sql = "SELECT * FROM coordenadas ORDER BY lugar";
                $consulta = mysqli_query($link, $sql);
                while ( $fila = mysqli_fetch_array($consulta) ) {
                ?>                
                <option value="<?php echo $fila['coordenada']  ?>"><?php echo $fila['lugar']?></option>
                <?php } ?>
                </select>
          </span>          
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link">
          <i class="fas fa-fw fa-road"></i>
          <span>Modo</span>
          <span>
            <select class="form-control form-control-sm fa" name="modo" id="modo">
              <option class="fa" value="driving">&#xf1b9; Automóvil</option>
              <option class="fa" value="bicycling">&#xf206; Bicicleta</option>
              <option class="fa" value="walking">&#xf554; Caminata</option>
          </select>
          </span>          
        </a>
      </li>
      <hr class="sidebar-divider d-none d-md-block">
      <div class="text-center">
        <input class="text-center border-1 btn btn-outline-light" id="buscar" type="submit" value="Buscar">
      </div>
    </form>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>

    <?php 
        if( isset($_POST['origen']) && isset($_POST['destino']) && isset($_POST['modo']) ) {
          $origen = $_POST['origen'];
          $destino = $_POST['destino'];
          $modo = $_POST['modo'];
          $resp = file_get_contents("https://maps.googleapis.com/maps/api/directions/json?key=$key&origin=$origen&destination=$destino&mode=$modo");          
          $json = json_decode($resp);
          $summary = $json->{"routes"}[0]->{"summary"};
          $inicio = $json->{"routes"}[0]->{"legs"}[0]->{"start_address"};
          $fin = $json->{"routes"}[0]->{"legs"}[0]->{"end_address"};
          $distancia = $json->{"routes"}[0]->{"legs"}[0]->{"distance"}->{"text"};
          $tiempo = $json->{"routes"}[0]->{"legs"}[0]->{"duration"}->{"text"};
      ?>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"> 
          <h6 class="text-sm text-dark my-4 font-weight-bold"><?php echo $summary ?></h1>            
        </nav>
          <div class="container-fluid">
          <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Inicio
                      <i class="fas fa-map-marker fa-2x text-primary float-right"></i>
                      </div>
                      <br>
                      <div class="mb-0 text-justify text-xs font-weight-bold text-gray-800"><?php echo $inicio ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-ms font-weight-bold text-success text-uppercase mb-1">Fin
                        <i class="fas fa-map-marker-alt fa-2x text-success float-right"></i>
                      </div>
                      <br>
                      <div class="mb-0 text-justify text-xs font-weight-bold text-gray-800"><?php echo $fin ?></div>
                    </div>                      
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm font-weight-bold text-info text-uppercase mb-1">Distancia
                        <i class="fas fa-arrow-right fa-2x text-info float-right"></i>
                      </div>
                      <br>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="mb-0 text-justify text-sm font-weight-bold text-gray-800"><?php echo $distancia ?></div>
                        </div>
                      </div>
                    </div>                      
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tiempo de Recorrido
                        <i class="fas fa-clock fa-2x text-warning float-right"></i>
                      </div>
                      <br>
                      <div class="mb-0 text-justify text-sm font-weight-bold text-gray-800"><?php echo $tiempo ?></div>
                    </div>                      
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="container-fluid">
              <iframe class="embed-responsive-item" width="100%" height="550" frameborder="0" src="https://www.google.com/maps/embed/v1/directions?key=<?= $key ?>&origin=<?= $origen ?>&destination=<?= $destino ?>&mode=<?= $modo ?>" allowfullscreen></iframe>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 mb-4">
              <div class="card shadow mb-4">
                
              </div>
              <div class="row">
              <?php
                    $lugar = $_POST['destino'];
                    $sql2 = "SELECT * FROM coordenadas WHERE coordenada = '$lugar'";
                    $query = mysqli_query($link, $sql2);
                    $row = mysqli_fetch_array($query);
                    $hashtag = $row['hashtag'];
                    include "twitterQuery.php";
                    $respuesta = queryTwitter( $hashtag );
                    $json2 = json_decode($respuesta);
                    foreach ($json2->statuses as $key => $respuesta) {                    
                    $name = $json2->{'statuses'}[$key]->{'user'}->{'name'};
                    $screen_name = $json2->{'statuses'}[$key]->{'user'}->{'screen_name'};
                    $text = $json2->{'statuses'}[$key]->{'text'};                                                      
               ?>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-white shadow">
                    <div class="card-body">
                      <i class="fab fa-twitter fa-2x text-primary float-left"></i>
                      <?php echo "<p>"."&nbsp"."&nbsp".$name."</p>" ?>                                            
                      <?php echo "<a href='https://twitter.com/$screen_name' target='_blank'>"." @"."<span class='font-weight-bold'>".$screen_name."</span>"."</a>" ?>
                      <br>
                      <br>
                      <div><?php echo $text ?></div>
                    </div>
                    <?php 
                      if ( !empty( $url = @$json2->{'statuses'}[$key]->{'entities'}->{'urls'}[0]->{'url'}) ) { ?>
                        <a href="<?= $url ?>" target="_blank" class="text-center">
                          <button type="button" class="btn btn-outline-primary">
                            Ver Tweet
                          </button>
                        </a>
                        <br>
                     <?php      
                      }
                     ?>
                  </div>
                </div>
              <?php } ?>
                </div>
                </div>         
            <div class="col-lg-6 mb-4">
              
            </div>
          </div>

        </div>

      </div>

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>

    </div>

  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <?php
        }
        else {
          $origen = '16.908380,-92.094635';
          $destino = '16.908380,-92.094635';
          $modo = 'driving';
          $resp = file_get_contents("https://maps.googleapis.com/maps/api/directions/json?key=$key&origin=$origen&destination=$destino&mode=$modo");
          $json = json_decode($resp);
          $summary = $json->{"routes"}[0]->{"summary"};
          $inicio = $json->{"routes"}[0]->{"legs"}[0]->{"start_address"};
          $fin = $json->{"routes"}[0]->{"legs"}[0]->{"end_address"};
          $distancia = $json->{"routes"}[0]->{"legs"}[0]->{"distance"}->{"text"};
          $tiempo = $json->{"routes"}[0]->{"legs"}[0]->{"duration"}->{"text"};
          ?>
          <div id="content-wrapper" class="d-flex flex-column">        
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">          
          <h1 class="display-5 text-dark">Ocosingo, Chiapas</h1>
          <ul class="navbar-nav ml-auto">
        </nav>
      <div class="container-fluid">          
          <iframe class="embed-responsive-item" width="100%" height="550" frameborder="0" src="https://www.google.com/maps/embed/v1/directions?key=<?= $key ?>&origin=<?= $origen ?>&destination=<?= $destino ?>&mode=<?= $modo ?>" allowfullscreen></iframe>          
        </div>        
      <?php  
        }
      ?>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="js/sb-admin-2.min.js"></script>

  <script src="vendor/chart.js/Chart.min.js"></script>

  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>