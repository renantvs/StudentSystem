<?php

require_once ('conexao.php');

$idaluno = $_REQUEST['idaluno'];   

//Atualiza os dados dos alunos
$resultadoatualizacao='';

if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])){

    $form_alunonome= $_REQUEST ['nome'];
    $form_alunoidade= $_REQUEST ['idade'];
    $form_alunosexo= $_REQUEST ['sexo'];
    $form_alunocidade= $_REQUEST ['cidade'];
    $form_alunofalta= $_REQUEST ['falta'];
    $form_alunonota= $_REQUEST ['nota'];
    $form_alunoid= $_REQUEST ['id'];

    $sqlatualizar= "UPDATE alunos SET strAlunoNome= :nome, intAlunoIdade= :idade, enAlunoSexo= :sexo, strAlunoCidade= :cidade, 
    intAlunoFalta= :falta, floAlunoNota= :nota WHERE intAlunoId= :id";
    $stmt = $conn->prepare($sqlatualizar);

    $stmt->bindParam(':nome', $form_alunonome);
    $stmt->bindParam(':idade', $form_alunoidade);
    $stmt->bindParam(':sexo', $form_alunosexo);
    $stmt->bindParam(':cidade', $form_alunocidade);
    $stmt->bindParam(':falta', $form_alunofalta);
    $stmt->bindParam(':nota', $form_alunonota);
    $stmt->bindParam(':id', $form_alunoid);

    if ($stmt->execute()) {
        $resultadoatualizacao = "Registro atualizado com sucesso!";

        if(isset($_REQUEST['arquivofaltasenotas'])){ //Verifica se o checkbox foi selecionado

            $pasta= 'arquivos'.$_REQUEST['id']; //Pasta de arquivos do aluno

            if(!is_dir($pasta)){ //Cria uma pasta para o aluno caso não exista
                mkdir($pasta, 0777);
            }

            $arquivo= fopen($pasta.'/faltasenotas.txt','w');

            fwrite($arquivo, "Faltas do aluno: ".$form_alunofalta. " /  Nota do aluno:". $form_alunonota);
            
        }
    } else {
        $error = $stmt -> errorInfo(); 
        $resultadoatualizacao = "Erro ao atualizar registro: " . $sqlinserir . "<br>" . $conn->errorCode();
    }

}

$consulta= "SELECT * FROM alunos WHERE intAlunoId= $idaluno";

$resultado= $conn->query ($consulta);

$aluno= $resultado->fetch(PDO::FETCH_ASSOC); 

echo $aluno ['strAlunoNome'];

?>

<!DOCTYPE html>

<html lang = "pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Formulário de Edição</title>
    </head>

    <body>
        <div>
            <a href="index.php"> Listar Alunos </a>
        </div>

        <p> <?php echo $resultadoatualizacao; ?></p>

        <form method="post" action= "">

            <input type= "hidden" value= "<?php echo $idaluno; ?>" name="id">

            <p>Digite o nome do aluno</p>
            <input type= "text" value= "<?php echo $aluno['strAlunoNome'];?>" name= "nome">

            <br>

            <p>Digite a idade do aluno</p>
            <input type= "number" value= "<?php echo $aluno['intAlunoIdade'];?>" name= "idade">

            <br>

            <p>Sexo do Aluno</p>
            <select name= "sexo">
                <option value= "">Selecione o sexo</option>
                <option <?php if( $aluno['enAlunoSexo']== 'm' ){echo 'selected';}?> value= "m">Masculino</option>
                <option <?php if( $aluno['enAlunoSexo']== 'f' ){echo 'selected';}?> value= "f">Feminino</option>
            </select>

            <br>

            <p>Digite a cidade do aluno</p>
            <input type= "text" value= "<?php echo $aluno['strAlunoCidade'];?>" name= "cidade">

            <p>Digite as faltas do aluno</p>
            <input type= "number" value= "<?php echo $aluno['intAlunoFalta'];?>" name= "falta">

            <p>Digite a nota do aluno</p>
            <input type= "text" value= "<?php echo $aluno['floAlunoNota'];?>" name= "nota">

            <br> 
            <br>

            <input type= "checkbox" id= "arquivofaltasenotas" name= "arquivofaltasenotas" value= "1">
            <label for="arquivofaltasenotas"> Criar / atualizar arquivos faltas e notas</label>

            <br> 
            <br>

            <button type= "Submit">Salvar</button>
          
        </form>   

    </body>

</html>
