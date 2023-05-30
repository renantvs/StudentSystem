<style type= "text/css">

.erro{
    font-weight: bold;
    color: red;
}

</style>

<?php

    require_once('conexao.php');
    
    $nome= $_REQUEST['nome'];
    $sobrenome= $_REQUEST['sobrenome'];
    $idade= $_REQUEST['idade'];
    $cidade= $_REQUEST['cidade'];
    $falta= $_REQUEST['falta'];
    $nota= $_REQUEST['nota'];
    $sexo= $_REQUEST['sexo'];

    if(empty ($nome)){

        $nome= NULL;
        echo "<p class='erro'>Nome é obrigatório!</p>";
    }

    if(empty ($sobrenome)){

        $sobrenome= NULL;
        echo "<p class='erro'>Sobrenome é obrigatório!</p>";
    }
    
    if (empty($idade) || !is_numeric($idade)) {
        $idade = NULL;

        echo "<p class='erro'>Idade é obrigatória e deve ser um número!</p>";
    } 

    if(empty($cidade)){

        $cidade= NULL;
        echo "<p class='erro'>Cidade é obrigatório!</p>";
    }
    
    if(empty($falta)){

        $falta= NULL;
        echo "<p class='erro'>Falta é obrigatório!</p>";
    }
    
    if(empty($nota)){

        $nota= NULL;
        echo "<p class='erro'>Nota é obrigatório!</p>";
    }

    if(empty($sexo)){

        $sexo= NULL;
        echo "<p class='erro'>Sexo é obrigatório!</p>";
    }

    if($sexo!='m' && $sexo!= 'f' && !empty($sexo)){

        $sexo= NULL;
        echo "<p class='erro'>Sexo escolhido é inválido!</p>";
    }

    if( $nome && $sobrenome && $idade && $cidade && $falta && $sexo ){

        $sqlinserir = "INSERT INTO alunos (strAlunoNome, strAlunoSobrenome, intAlunoIdade, enAlunoSexo, strAlunoCidade, intAlunoFalta, floAlunoNota) 
        VALUES (:nome, :sobrenome, :idade, :sexo, :cidade, :falta, :nota)";

        $stmt = $conn->prepare($sqlinserir);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sobrenome', $sobrenome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':falta', $falta);
        $stmt->bindParam(':nota', $nota);

        if ($stmt->execute()) {
            echo "New record created successfully!<br><br>";
            echo '<a href="index.php">Listar Alunos</a>';
        } else {
            echo "Error: " . $sqlinserir . "<br>" . $conn->errorCode();
        }
        
    }

?>