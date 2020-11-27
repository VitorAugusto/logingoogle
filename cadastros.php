<!DOCTYPE html>
<html lang="en">
<?php
//IMPORTANDO ORM 
include ('configurarbanco.php');
?>

<head>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Demo Login Google</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
     <a class="navbar-brand" href="index.php">Demo Login Google - by Vitor Augusto</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Login
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="cadastros.php">Cadastros</a>
            <span class="sr-only">(current)</span>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Usuários cadastrados :</h1>
        <?php
          class User extends TORM\Model {};
          $users = User::all(); //Get todos os usuários

          foreach ($users as $user) {
            echo "ID:". $user->id;
            echo "<p> </p>"; 
            echo '<img src="'.$user->fotoperfil.'" class="img-responsive img-circle img-thumbnail" />';
            echo '<h3><b>Nome :</b> '.$user->name.'</h3>';
            echo '<h3><b>Email :</b> '.$user->email.'</h3>';  
            echo "<hr>"; 
        }  

        ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
