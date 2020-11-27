<?php
//IMPORTANDO ORM 
include ('configurarbanco.php');
/*
echo "<p> </p>";

class User extends TORM\Model {};

$users = User::where(["email" => 'mariaribeiro1503@gmail.com']);


if($users->count() > 0){
	echo "já existe";
}else{
	echo "não existe";
}
*/
class User extends TORM\Model {};

usuarioJaExiste('mariaribeiro1503@gmail.com');

function usuarioJaExiste($email){
  $users = User::where(["email" => $email]);


  if($users->count() > 0){
    echo "já existe";
  }else{
    echo "não existe";
  }
}


?>