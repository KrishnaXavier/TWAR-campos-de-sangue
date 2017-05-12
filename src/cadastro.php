<?php include "head.php"; ?>
        <script type="text/javascript">
            window.onload=function()
            {
            	
            }
        </script>
        
     </head>

     <body>  

	    <?php include "menu.php"; ?>
	    <div class='titulo'>Cadastro</div>
	    <div class='container-cadastro'>	    	
		    <form action = '#' method = 'post' enctype='multipart/form-data'>			    
			    <div class='cadastro-login cadastro-input'>Nick/Login</div>			    	
			    <input type = 'text' name = 'login' required placeholder="user123" class='cadastro-input' value='<?php echo isset ($_POST['login'])?$_POST['login']:'';?>'>
			    

			    <div class='cadastro-email cadastro-input'>E-Mail</div>			    
			    <input type = 'email' name = 'email' required placeholder="user123@gmail.com" class='cadastro-input' value='<?php echo isset ($_POST['email'])?$_POST['email']:'';?>'>
			    

			    <div class='cadastro-senha cadastro-input'>Senha</div>
			    <input type = 'password' name = 'senha' required placeholder="*********" class='cadastro-input' value='<?php echo isset ($_POST['senha'])?$_POST['senha']:'';?>'>
			    

			    <div class='cadastro-foto-perfil cadastro-input'>Foto de Perfil</div>
			    <input type = 'file' name='imagem' class='file'>
			    

			    <div class='cadastro-enviar cadastro-input'>
			    	<input type = 'submit' name = 'enviar' value='Cadastra-se' class='btn-primary'>		
			    </div>

			</form>
		</div>

			<?php 
				include "classes/config-upload.php";				

				if (isset($_POST['enviar']))
				{
					include "classes/conexao.php";
					$email = $_POST['email'];
					$login = $_POST['login'];
					$senha = $_POST['senha'];
					
					//Foto de Perfil
					$nome_arquivo=$_FILES['imagem']['name'];					
					$arquivo_temporario=$_FILES['imagem']['tmp_name'];                        					
        			$extensao_imagem= strtolower(substr($nome_arquivo, -4));

        			if($arquivo_temporario)
        			{
        				if($_FILES['imagem']['size']>=$tamanho_limite_bytes)					            
            			die("Erro: tamanho maximo da imagem foi utrapassado, tamanho maximo: ".$tamanho_limite_bytes);        			                        
        			
        				if (!in_array($extensao_imagem, $extensoes_validas))
            				die("Extensão de arquivo inválida para upload");        			

						$foto_perfil = md5(time()).$extensao_imagem;                        					
						move_uploaded_file($arquivo_temporario, $diretorio_imagem.$foto_perfil);
        			}

        			if(!$arquivo_temporario)
        			{
        				$foto_perfil="profile.png";
        			}
        			
					//Verificação se já existe Nick/Login ou Email
					$sql = "SELECT * FROM usuario WHERE email_usuario='$email' ";
					$resultado = pg_query($conexao, $sql);         			
         			$registro = pg_fetch_array($resultado);         			         			
         			if($registro['email_usuario'])
         			{
         				echo "<script> alert('Email em uso') </script>";
         			}
         				

					$sql = "SELECT * FROM usuario WHERE login_usuario='$login'";
					$resultado = pg_query($conexao, $sql);         			
         			$registro = pg_fetch_array($resultado);         			         			
         			if($registro['login_usuario'])
         			{
         				echo "<script> alert('Nick/Login já existe') </script>";
         			}         				
         				


		     		else
		     		{
		     			$sql = "INSERT INTO usuario(login_usuario, senha_usuario, email_usuario, foto_usuario) VALUES ('$login', '$senha', '$email', '$foto_perfil')";
						$resultado = pg_query ($conexao, $sql);
        				if($resultado)
        				{
							echo "<br>Cadastro Pronto";
        					header('Location: login.php');
        				}
        					
        				else
        					echo "<br>Erro no Cadastro";            				
					}
		     	}		     				
			?>
		





	</body>

</html>