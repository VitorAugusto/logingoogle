<!DOCTYPE html>
<?php

//IMPORTANDO ORM 
include ('configurarbanco.php');

//Include Configuration File
include('config.php');

$login_button = '';


if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();
  //CRIO UM USUÁRIO ORM
  class User extends TORM\Model {};


  //SETO OS ATRIBUTOS
  User::validates("id", array("numericality"=>true));
  User::validates("name", array("presence"=>true));
  User::validates("email", array("presence"=>true));
  User::validates("fotoperfil", array("presence"=>true));

  $user = new User(); //INVOCO O USUÁRIO
  $user->id = rand();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  $user->name = $_SESSION['user_first_name'].' '.$_SESSION['user_last_name']; //NOME DO USUÁRIO

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  $user->email = $_SESSION['user_email_address']; //E-MAIL DO USUÁRIO

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }

  $user->fotoperfil = $_SESSION['user_image']; //FOTO DE PERFIL USUÁRIO
  
  //SALVANDO USUÁRIO
  checkUsuarioJaExiste($user->email, $user);

}
}

function checkUsuarioJaExiste($email, $user){
  $users = User::where(["email" => $email]);


  if($users->count() > 0){
    echo "<div style='text-align: center; background-color: #4285f4; color: white;'>";
    echo "Conta encontrada - Usuário já cadastrado";
    echo "</div>";
  }else{
    echo "<div style='text-align: center; background-color: #34a853; color: white;'>";
    echo "Conta criada com sucesso !";
    echo "</div>";
    $user->save();
  }
}



if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="logogoogle1.png" /></a>';
}

?>

<html lang="en">

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
      <a class="navbar-brand" href="#">Demo Login Google - by Vitor Augusto</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Login
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastros.php">Cadastros</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Demo Login Google</h1>
        <p class="lead">Demonstração Login Google via API</p>
        <p>
          <?php
          ?>
        </p>
        <?php
   if($login_button == '')
   {
    echo '<div class="panel-heading">Usuário Logado :</div><div class="panel-body">';
    echo "<p> </p>";
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Nome :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="logout.php">Sair</h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
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
