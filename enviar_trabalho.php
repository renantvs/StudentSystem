<?php

$idaluno= $_REQUEST['idaluno'];

$alerta= "";

if(isset ($_REQUEST['enviartrabalho'])){

    $pasta= 'trabalhos'. $idaluno;

    $alerta= "Pasta criada com sucesso!";

    if(is_dir($pasta)){
        $alerta= "A pasta já existe para o aluno";
    }else{
        mkdir($pasta, 0777);
    }

    //Tamanho do arquvo em bytes
    $up['tamanho']= 1024 * 1024 * 2;

    $up['extensoes']= array('jpg', 'png', 'gif', 'txt', 'pdf');

    $nomeexplode= explode('.',$_FILES['arquivo']['name']);
    $ext= strtolower(end($nomeexplode));

    //Faz a verificação do tamanho do arquivo
    if($_FILES['arquivo']['size'] > $up['tamanho']){
        
        echo "Tamanho do arquivo é maior que o permitido.";

    }else if(array_search ($ext, $up['extensoes']) === false ){

        echo "Por favor, envie um arquivo com extensão válida. Exemplo: 'jpg', 'png'";

    }else if(move_uploaded_file ($_FILES['arquivo']['tmp_name'], $pasta.'/'.$_FILES['arquivo']['name']) ){

        echo "Arquivo enviado com sucesso!";
    }
}

?>
<!DOCTYPE html>

<html lang = "pt-br">
    <head>
        <title>Formulário de envio de trabalho</title>
    </head>

    <body>

        <h2><?php echo $alerta; ?></h2>

        <form method="post" action= "enviar_trabalho.php?idaluno=<?php echo $idaluno; ?>" enctype="multipart/form-data">

            <input type= "hidden" name= "enviartrabalho" value= "true">

            <input type= "file" name= "arquivo">
            <br><br>

            <button type= "Submit">Enviar</button>
            
        </form>

    </body>

</html>

