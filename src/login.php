<?php include "head.php"; 
include 'session_save.php';
//$session = new session_save();
?>

</head>

<body>  

   <?php include "menu.php"; ?>
   <div class='titulo'>Entrar</div>
   <div class='container-cadastro'>            
    <form action = '#' method = 'post' enctype='multipart/form-data'>               
        <div class='cadastro-login cadastro-input'>Nick/Login</div>                 
        <input type = 'text' name = 'login' required placeholder="user123" class='cadastro-input' value='<?php echo isset ($_POST['login'])?$_POST['login']:'';?>'>                                    
        <div class='cadastro-senha cadastro-input'>Senha</div>
        <input type = 'password' name = 'senha' required placeholder="*********" class='cadastro-input' value='<?php echo isset ($_POST['senha'])?$_POST['senha']:'';?>'>                
        <div class='cadastro-enviar cadastro-input'>
            <input type = 'submit' name = 'enviar' value='Entrar' class='btn-primary'>     
        </div>
    </form>
</div>

<?php                             
if (isset($_POST['enviar']))
{
    include "classes/conexao.php";
    include 'client.php'; 
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE login_usuario = '$login' and senha_usuario = '$senha' ";
    $resultado = $link->query ($sql);
    $linhas = $resultado->num_rows;

    if($linhas >0)
    {        

     $dados = $resultado->fetch_array(MYSQLI_ASSOC);
     session_start();
     $_SESSION['cod'] = $dados['cod_usuario'];
     $_SESSION['login'] = $dados['login_usuario'];
     header('Location: index.php');                                                                
    }

 else
 {                        
    echo "<script> alert('Login ou Senha invalido(s)')</script>";
 }
}
?>

</body>
</html>
