<?php include "head.php"; ?>

<script type="text/javascript">                        
arrayBiomasDefinidosSimulados = ["jogador1", "deserto", "floresta", "glacial", "montanha", "pantano", "neutro", "deserto", "floresta", "glacial", "montanha", "jogador2",];
statusConexao=false;
flagCriarCampo=false;

window.onload=function()
{
    conexaoSoquete();
}


function comecarJogo(dadosEntrada, jogador)
{                
                    
    if(!flagCriarCampo)
    {
        document.getElementById('step1').remove();
        criarCampos();  //função criarCampos iniciada, ela deve ser iniciada apenas um vez    
        setBiomas(arrayBiomasDefinidosSimulados); //função setBiomas iniciada, isso é uma simulação de dados de entrada, essa função deve ser chamado pelo servidor
        flagCriarCampo=true;

    }
    
    posicionarPecas(dadosEntrada, jogador);

}

function criarCampos()
{
    steps = document.getElementById('steps');
    divCampo = document.createElement('div');
    divCampo.setAttribute('class', 'campo'); 
    divCampo.setAttribute('id', 'campo'); 

    divCampoExterno = document.createElement('div');
    divCampoExterno.setAttribute('class', 'campo_externo'); 
    divCampoExterno.setAttribute('id', 'campo_externo'); 

    divCampoMenuJogador = document.createElement('div');
    divCampoMenuJogador.setAttribute('class', 'containerMenuJogador'); 
    divCampoMenuJogador.setAttribute('id', 'menuJogador');
    divCampoMenuJogador.innerHTML = 'Menu do Jogo';                 

    divSubCampoMenuJogador = document.createElement('div');
    divSubCampoMenuJogador.setAttribute('class', 'containerSubMenuJogador'); 
    divSubCampoMenuJogador.setAttribute('id', 'subMenuJogador');


    var idContAc1=0;                
    var idOut=0;
    for(var k=1; k<=12; k++)
    {                    
        divCampoBiomas = document.createElement('div');
        divCampoBiomas.setAttribute('class', 'campo_biomas'); 
        divCampoBiomas.setAttribute('id', 'campo_biomas'+k);

        for(var i=1; i<=25; i++)
        {                                                                        
            idOut=(parseInt((i-1)/5)*15+i)+(idContAc1*5);
            divCampoBiomaQuadrado = document.createElement('div');
            divCampoBiomaQuadrado.setAttribute('class', 'campo_quadrado'); 
            divCampoBiomaQuadrado.setAttribute('id', 'campo_quadrado-'+idOut); // Cod converção IDs
            divCampoBiomaQuadrado.setAttribute('onclick', 'movimentar(this, '+idOut+')'); // Cod converção IDs
            divCampoBiomas.appendChild(divCampoBiomaQuadrado);                        
        }
        divCampoExterno.appendChild(divCampoBiomas);          
        idContAc1++;

        if(idContAc1==24)
            idContAc1=40;                    

        if(idContAc1==4)                    
            idContAc1=20;

    }

    divCampo.appendChild(divCampoExterno);
    divCampoMenuJogador.appendChild(divSubCampoMenuJogador);
    steps.appendChild(divCampo);
    steps.appendChild(divCampoMenuJogador);

}            

function setBiomas(biomas)
{   
    srcBiomasJS = srcBiomasJS();

    for(var i=1; document.getElementById("campo_biomas"+i)!=null; i++)
    {                                                                                                              
        document.getElementById("campo_biomas"+i).style.backgroundImage="url('"+srcBiomasJS[biomas[i-1]]+"')";                                                    
    }
}

function msmConsole(mensagem)
{
    console.log("@MENSAGEM: "+mensagem);
}

function srcBiomasJS()
{
    srcP = "imgs/biomas/";
    var arrayBiomas = [];

    arrayBiomas["deserto"] = srcP+"deserto.png";
    arrayBiomas["floresta"] = srcP+"floresta.png";
    arrayBiomas["glacial"] = srcP+"glacial.png";
    arrayBiomas["montanha"] = srcP+"montanha.png";
    arrayBiomas["pantano"] = srcP+"pantano.png";
    arrayBiomas["neutro"] = srcP+"neutro.png";
    arrayBiomas["jogador1"] = srcP+"castelo-jagador-1.png";
    arrayBiomas["jogador2"] = srcP+"castelo-jagador-2.png";

    return arrayBiomas;
}


//#################################### Funções do Web Soquete
function conexaoSoquete()
{
    ws = new WebSocket("ws://localhost:2100/server_oo.php");

    ws.onopen = function()
    {
        console.log("@WB: conectou");
        statusConexao = true;
    }

    ws.onmessage = function (ev)
    {
        
        var dados = JSON.parse(ev.data);
        console.log("@WB dados: "+dados);

        if(dados == 'jogador1')
        {
            JOGADOR=dados;
            console.log("@WB: recebido jogador: "+JOGADOR);
            return;
        }

        if(dados == 'jogador2')
        {
            JOGADOR=dados;
            console.log("@WB: recebido jogador: "+JOGADOR);
            return;
        }

        

            dadosEntrada=dados;
            jogador=dadosEntrada['jogador'];
            console.log("@WB: ELSE, dadosEntrada, jogador: "+jogador);

            comecarJogo(dadosEntrada, jogador);            
        

    }

    ws.onclose = function (ev)
    {
        alert("WS fechou");
        statusConexao = false;
    }

    ws.onerror = function (ev)
    {
        alert("Erro no WS: "+ev.data);
    }
} 

function enviarDadosWS(dados)
{
    if(statusConexao)
    {
        wb.send(dados);    
    }
}
//#################################### Funções do Web Soquete


</script>
<?php 
include "classes/config-jogador.php";
include "classes/movimentacao.php";            
;?>                        

</head>

<body>  

    <?php include "menu.php";?>		    

    <div class='titulo'>Jogar</div>

    <div class='steps' id='steps'>
        <div class='step1' id='step1'>
            <div class='step1Inf'>Procurando Oponente Digno...</div>
            <img src='imgs/loading.gif' class='step1Img'></img>
            <button onclick='comecarJogo()' class='step1Simulacao'>Oponente escolhido(simulação)</button>
        </div>                            
    </div>    

</body>
</html>
