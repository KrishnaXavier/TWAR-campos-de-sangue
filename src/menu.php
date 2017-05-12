<?php 
  include "classes/PermissaoUsuario.php"; 
  include "classes/conexao.php";
?>
<!DOCTYPE html>		
	<head>        		    
	    <link rel="stylesheet" href="classes/bootstrap-3.3.6-dist/css/bootstrap.css">
	</head>

<body>

	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">TWar</a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="index.php">Home</a></li>
      <li><a href="jogar.php">Jogar</a></li>      
    </ul>
    
    <?php 
      if(permissaoUsuario())
      {
        $login = $_SESSION["login"];
        $senha = $_SESSION["senha"];
        $sql = "SELECT * FROM usuario WHERE login_usuario = '$login' and senha_usuario = '$senha' ";
        $resultado = pg_query ($conexao, $sql);
        $registro = pg_fetch_array($resultado);

        echo "
          <ul class='nav navbar-nav navbar-right'>
            <li> <img src=imgs/users/".$registro['foto_usuario']." height='50px'/> </li>
            <li> <a href='perfil.php'>".$registro['login_usuario']."</a></li>
            <li><a href='classes/LoginOut.php'><span class='glyphicon glyphicon-user'></span> Sair</a></li>            
          </ul>
        ";
      }
      else
      {
        echo"
          <ul class='nav navbar-nav navbar-right'>
            <li><a href='cadastro.php'><span class='glyphicon glyphicon-user'></span> Cadastro</a></li>
            <li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Entrar</a></li>
        </ul>
        ";
      }
    ?>    
  </div>
</nav>

</body>		

</html>