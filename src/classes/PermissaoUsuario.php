<?php            
    session_start();

    function permissaoUsuario()
    {
        if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"]))
        {
            return false;            
        }
        
        else
        {            
            return true;        
        }
            
    }
    
    
                