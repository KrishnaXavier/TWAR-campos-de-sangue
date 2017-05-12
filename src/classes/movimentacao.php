<script type="text/javascript">
flagPrimeiroClique = false;
primeiroCliqueIDPeca = 0;


function movimentar(div, idPosicao)
{
  console.log("#Posição: "+idPosicao);    
  moverPeca(idPosicao); 
}


function posicionarPecas(dadosPecas, jogador)
{  
  //PARA O JOGADOR 1
  if(jogador==1)
  {
    arrayPecasJogador1=dadosPecas;
    for(var k=1; k<=QUANTPECAS; k++)
    {          
      if(dadosPecas["peca"+k][0])
      {
        var divDestino = document.getElementById("campo_quadrado-"+dadosPecas["peca"+k][2]);
        var srcPersonagem = srcPersonagens(dadosPecas["peca"+k][1]);
        divDestino.style.backgroundImage = "url("+srcPersonagem+")";        
      }    

      else
        var pecaMorta; //FAZER FEED BACK VISUAL DAS PEÇAS MORTAS
    }
  }

  //PARA O JOGADOR 2
  if(jogador==2)
  {
    arrayPecasJogador2=dadosPecas;
    for(var k=1; k<=QUANTPECAS; k++)
    {    
      if(dadosPecas["peca"+k][0])
      {
        var divDestino = document.getElementById("campo_quadrado-"+dadosPecas["peca"+k][2]);
        var srcPersonagem = srcPersonagens(dadosPecas["peca"+k][1]);
        divDestino.style.backgroundImage = "url("+srcPersonagem+")";
      }    

      else
        var pecaMorta; //FAZER FEED BACK VISUAL DAS PEÇAS MORTAS
    }
  }  
}

function dadosEntradaSimulados() //jogador pode ser 1 ou 2
{
  var arrayPecas = [];  
  //Clases: rei, arqueiro, guerreiro, cavaleiro
  //pecax: var arrayDados = ['status= true(ativa/viva) ou false()', 'classe', 'posicao/id no tabuleiro', '%hp', '%stamina', 'id da peça no jogo']
  if(JOGADOR==1)
  {
    arrayPecas["peca1"] = ['true', 'rei', '1', '100', '100', '1'];
    arrayPecas["peca2"] = ['true', 'arqueiro', '2', '100', '100', '1'];
    arrayPecas["peca3"] = ['true', 'cavaleiro', '3', '100', '100', '1'];
    arrayPecas["peca4"] = ['true', 'cavaleiro', '4', '100', '100', '2'];
    arrayPecas["peca5"] = ['true', 'arqueiro', '5', '100', '100', '2'];
    arrayPecas["peca6"] = ['true', 'cavaleiro', '21', '100', '100', '3'];
    arrayPecas["peca7"] = ['true', 'guerreiro', '22', '100', '100', '1'];
    arrayPecas["peca8"] = ['true', 'arqueiro', '23', '100', '100', '3'];
    arrayPecas["peca9"] = ['true', 'arqueiro', '24', '100', '100', '4'];
    arrayPecas["peca10"] = ['true', 'guerreiro', '260', '100', '100', '2'];
    arrayPecas["jogador"] = JOGADOR;
  }

  else if(JOGADOR==2)
  {
    arrayPecas["peca1"] = ['true', 'rei', inverterCoordenadas(1), '100', '100', '1'];
    arrayPecas["peca2"] = ['true', 'arqueiro', inverterCoordenadas(2), '100', '100', '1'];
    arrayPecas["peca3"] = ['true', 'cavaleiro', inverterCoordenadas(3), '100', '100', '1'];
    arrayPecas["peca4"] = ['true', 'cavaleiro', inverterCoordenadas(4), '100', '100', '2'];
    arrayPecas["peca5"] = ['true', 'arqueiro', inverterCoordenadas(5), '100', '100', '2'];
    arrayPecas["peca6"] = ['true', 'cavaleiro', inverterCoordenadas(21), '100', '100', '3'];
    arrayPecas["peca7"] = ['true', 'guerreiro', inverterCoordenadas(22), '100', '100', '1'];
    arrayPecas["peca8"] = ['true', 'arqueiro', inverterCoordenadas(23), '100', '100', '3'];
    arrayPecas["peca9"] = ['true', 'arqueiro', inverterCoordenadas(24), '100', '100', '4'];
    arrayPecas["peca10"] = ['true', 'guerreiro', inverterCoordenadas(25), '100', '100', '2'];
    arrayPecas["jogador"] = JOGADOR;
  }

  else{alert("ERRO, movimentacao.php, dadosEntradaSimulados, jogador não definido");}

  return arrayPecas;
}

function srcPersonagens(classePersonagem)
{
  var srcComum = "imgs/personagens/";

  if(classePersonagem=="rei")
    return srcComum+"rei.png";

  else if(classePersonagem=="arqueiro")
    return srcComum+"arqueiro.png";

  else if(classePersonagem=="guerreiro")
    return srcComum+"guerreiro.png";

  else if(classePersonagem=="cavaleiro")
    return srcComum+"cavaleiro.png";

  else
  {
    alert("PERSONAGEM NÃO EXISTENTE2");
    return "ERRO";
  }
}

function verificarPecaPosicao(idPosicao)
{  
  if(JOGADOR==1)
  {
    for (i=1; i<=QUANTPECAS; i++)
    {
      if(arrayPecasJogador1["peca"+i][2]==idPosicao)
        return true;
    }
  }

  else if(JOGADOR==2)
  {
    for (i=1; i<=QUANTPECAS; i++)
    {
      if(arrayPecasJogador2["peca"+i][2]==idPosicao)
        return true;
    }
  }

  return false;
}

function moverPeca(idPosicao)
{
  if(verificarPecaPosicao(idPosicao) && !flagPrimeiroClique) // se peça existe e se é o primeiro clique para a movimentação
  {
    c("#Posições Possiveis: "+posicoesPossiveis(idPosicao).toString());
    c("#Posições Possiveis de ATK: "+posicoesPossiveisATK(posicoesPossiveis(idPosicao)).toString());    
    pPAnimacao(posicoesPossiveis(idPosicao));
    pPATKAnimacao(posicoesPossiveisATK(posicoesPossiveis(idPosicao)));

    flagPrimeiroClique=true; 
    primeiroCliqueIDPeca = idPosicao;
    console.log("@Primeiro clique para o movimento");

    g("subMenuJogador").innerHTML = "Classe: "+dadosPersonagem(idPosicao)[1]+"<br>HP: "+dadosPersonagem(idPosicao)[3]+"%"+"<br>Posição: "+dadosPersonagem(idPosicao)[2]+"<br>ID do Personagem: "+dadosPersonagem(idPosicao)[5];
    //arrayPecas["peca1"] = ['true', 'rei', '1', '100', '100', '1'];

    return true;
  }

  if(flagPrimeiroClique)
  {    
    console.log("@Segundo clique para o movimento");

    for(var i in posicoesPossiveis(primeiroCliqueIDPeca))
    {
     if(posicoesPossiveis(primeiroCliqueIDPeca)[i]==idPosicao)
     {
      c("###Dados para enviar para o servidor");
      c("@Dados da Movimentação: \n-ID Peça: "+idPecaPersonagem(primeiroCliqueIDPeca)+"\n-ID Movimentação-Origem: "+primeiroCliqueIDPeca+"\n-ID Movimentação-Destino: "+idPosicao+"\n-Status MOV/ATK: "+verIDPATK(primeiroCliqueIDPeca, idPosicao));
      
      limparBGAnimacao();
      c("Criar função para movimentar");
      flagPrimeiroClique=false; 
      return true;
     } 
    }
    
    c("@Movimentação Fail, segundo clique fora das posições possiveis, #Precisa zera as animações tb");
    limparBGAnimacao();
    flagPrimeiroClique=false; 
    return false;    
        
  }
}

function inverterCoordenadas(idPosicao)
{
  var idPosicaoInvertida = -1*(idPosicao-301);
  return idPosicaoInvertida;
}

function idPecaPersonagem(idPosicaoM1) //retorna o id da peça, id da posição anterior ao movimento, ou seja o posição do primeiro clique da movimentação
{
  if(JOGADOR==1)
    for(var i in arrayPecasJogador1)
    {
      if(arrayPecasJogador1[i][2]==idPosicaoM1) // id da peça no tabuleiro
        return arrayPecasJogador1[i][5]; // id da peça
    }

  if(JOGADOR==2)
    for(var i in arrayPecasJogador2)
    {
      if(arrayPecasJogador2[i][2]==idPosicaoM1) // id da peça no tabuleiro
        return arrayPecasJogador2[i][5]; // id da peça
    }
}

function dadosPersonagem (idPosicaoM1)
{
  if(JOGADOR==1)
    for(var i in arrayPecasJogador1)
    {
      if(arrayPecasJogador1[i][2]==idPosicaoM1) // id da peça no tabuleiro
        return arrayPecasJogador1[i]; // id da peça
    }

  if(JOGADOR==2)
    for(var i in arrayPecasJogador2)
    {
      if(arrayPecasJogador2[i][2]==idPosicaoM1) // id da peça no tabuleiro
        return arrayPecasJogador2[i]; // id da peça
    }
}

function verIDPATK(idPosicaoM1, idPosicaoM2) //id da posição anterior ao movimento, ou seja o posição do primeiro clique da movimentação
{
  for( var i in posicoesPossiveisATK(posicoesPossiveis(idPosicaoM1)))
  {
    if(posicoesPossiveisATK(posicoesPossiveis(idPosicaoM1))[i]==idPosicaoM2)
    {
      return "ATK";
    }

   c("verIDPATK: "+i+", valor: "+posicoesPossiveisATK(posicoesPossiveis(idPosicaoM1))[i]);
      
  }
  return "MOV";
}

// Funções de Redução
function g(id)//string, função para simplificação para pegar elemento atavez da id
{
  return document.getElementById(id);  
}

function c(txtConsole) //string
{
  console.log(txtConsole)
}

// Funções de Animação
function posicoesPossiveis(idPosicao)
{   
  var aVCR = [-21, -20, -19, 1, 21, 20, 19, -1]; //Valores relativos as Posições Possiveis, começando nas 10h30min no sentido horario
  var arrayPP = []; //Array das Posições Possiveis (PP)  
  var countPP = 0; //Contador das PP  
  
  for(var i=0; i<8; i++) // 8 é a quantidade de quadrados posiveis, com raio de 1 quadrado,em volta do quadrado clicado
  {
    if(idPosicao+aVCR[i]>=1 && idPosicao+aVCR[i]<=300)//Verifica se o valor da PP esta dentro dos limites do campo
    {
      if( !(idPosicao%20==0 && (i==2 || i==3 || i==4)) ) //Disconsidera posições a direita no extremo direito do campo
        if( !((idPosicao-1)%20==0 && (i==0 || i==6 || i==7)) ) //Disconsidera posições a esquerda no extremo esquerdo do campo
          arrayPP[countPP++]=idPosicao+aVCR[i];                                            
      }
  }

    if(JOGADOR==1)
    {
      for(var k=1; k<=QUANTPECAS; k++)
      {    
        var elementoPP = arrayPecasJogador1["peca"+k][2];        
        for(var i=0; i<8; i++)
        {
          if(arrayPP[i]==elementoPP)          
            arrayPP.splice(i, 1);
        }
      }
    }

    if(JOGADOR==2)
    {
      for(var k=1; k<=QUANTPECAS; k++)
      {    
        var elementoPP = arrayPecasJogador2["peca"+k][2];
        for(var i=0; i<8; i++)
        {
          if(arrayPP[i]==elementoPP)          
              arrayPP.splice(i, 1);                    
        }
      }
    }
    
    return arrayPP;
}

function pPAnimacao(arrayPP)
{
  for(i=0; i<arrayPP.length; i++)
  {      
    g("campo_quadrado-"+arrayPP[i]).style.backgroundColor = "#AAAAAA";    
    g("campo_quadrado-"+arrayPP[i]).style.opacity = "0.7";
  }
}

function pPATKAnimacao(arrayPP)
{
  for(i=0; i<arrayPP.length; i++)
  {      
    g("campo_quadrado-"+arrayPP[i]).style.backgroundColor = "#AA2020";    
    g("campo_quadrado-"+arrayPP[i]).style.opacity = "0.7";
  }
}

function posicoesPossiveisATK(arrayPP)
{
  var arrayPATK = []; //Array das Posições para ATK
  var countPATK = 0; //Contador das PATK

  if(JOGADOR==1)
  {
    for(var k=1; k<=QUANTPECAS; k++)
    {            
      var elementoPATK = arrayPecasJogador2["peca"+k][2]; 
      for(var i=0; i<8; i++)
      {
        if(arrayPP[i]==elementoPATK)
          arrayPATK[countPATK++]=elementoPATK;
      }
    }
  }

  else if(JOGADOR==2)
  {
    for(var k=1; k<=QUANTPECAS; k++)
    {            
      var elementoPATK = arrayPecasJogador1["peca"+k][2]; 
      for(var i=0; i<8; i++)
      {
        if(arrayPP[i]==elementoPATK)
          arrayPATK[countPATK++]=elementoPATK;
      }
    }
  }

    return arrayPATK;
}

function limparBGAnimacao()
{
  for(var i=1; i<=300; i++)
  {
    g("campo_quadrado-"+i).style.backgroundColor=null;
  }

  c("@limparBGAnimacao()");
}

function limparBGImage()
{

  for(var i=1; i<=300; i++)
    {
      g("campo_quadrado-"+i).style.backgroundImage=null;
    }

    c("@limparBGImage()");
}

  </script>