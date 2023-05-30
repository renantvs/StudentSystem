<?php

require_once ('conexao.php');
include_once ('funcoes.php');

$resultadoexclusao= "";
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])){

    $form_alunoid= $_REQUEST['id'];

    if(is_dir('trabalhos'. $form_alunoid)){
        rmdir('trabalhos'. $form_alunoid);
    }

    $sqlexcluir= "DELETE FROM alunos WHERE intAlunoId= :id";

    $stmt = $conn->prepare($sqlexcluir);
    $stmt->bindParam(':id', $form_alunoid, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $resultadoatualizacao = "Registro atualizado com sucesso!";
    } else {
        $error = $stmt -> errorInfo(); 
        $resultadoexclusao = "Erro ao atualizar registro: " . $error;
    }
}


$consulta= "SELECT * FROM alunos ORDER BY intAlunoId DESC";

$resultado= $conn->query ("$consulta");

?>

<!DOCTYPE html>

<html lang= "pt-br">
    <head>

        <title>Listar Alunos</title>

        <style> 
        table, th, td {
            border:1px solid black;
        }     

        table{
            margin-top: 15px;
        }
        </style>

    </head>

    <body>
        <div>
            <a href="formulario_cadastro.php">Cadastrar Alunos</a>
        </div>

        <p> <?php $resultadoexclusao;?> </p> 

        <table style= "width:100%">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Faixa etária</th>
                <th>Cidade</th>
                <th>Faltas</th>
                <th>Nota</th>
                <th>Situação</th>
                <th>Download</th>
                <th>Ações</th>
            </tr>

            <?php

            $totalnotaalunos= 0;
            $totalfaltaalunos= 0;
            $aux= 0;
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {

                $nomealuno = $row['strAlunoNome'];
                $nomealuno = $nomealuno.' '.$row['strAlunoSobrenome'];

                $totalnotaalunos += $row['floAlunoNota'];
                $totalfaltaalunos += $row['intAlunoFalta'];
                $substrairpontosfalta = $row['intAlunoFalta'] * 0.1;

                $linha= $aux % 2;
            ?>
            <tr <?php if($linha == 0){ ?>style= "background: #cceeff;"<?php } ?>>
                <td><?php echo $row ['intAlunoId']; ?></td>
                <td><?php echo $nomealuno; ?></td>
                <td><?php echo $row ['intAlunoIdade']; ?></td>
                <td><?php echo faixaEtaria($row ['intAlunoIdade']); ?></td>
                <td><?php echo $row ['strAlunoCidade']; ?></td>

                <td style= "text-align:center";> <?php echo $row ['intAlunoFalta']; ?></td>
                <td style= "text-align:center";> <?php echo ($row ['floAlunoNota'] - $substrairpontosfalta); ?></td>
                <td><?php echo situacaoAluno($row['floAlunoNota'], $row['intAlunoFalta']); ?></td>

                <td> 
                    <?php 
                    if(file_exists('arquivos'.$row['intAlunoId'].'/faltasenotas.txt')){
                    ?>
                    <a href="arquivos<?php echo $row['intAlunoId'] ?>/faltasenotas.txt" download="faltasenotas">Baixar</a>
                    <?php 
                    //var_dump($row['intAlunoId']);
                    }
                    ?>
                </td>

                <td style= "text-align:center;">
                    
                    <form method= "post" action= "">

                        <input type= "hidden" name="id" value= "<?php echo $row['intAlunoId']; ?>"> 

                        <a href= "formulario_edicao.php?idaluno=<?php echo $row['intAlunoId']; ?>">Editar</a>

                        <a href= "enviar_trabalho.php?idaluno=<?php echo $row['intAlunoId']; ?>">Enviar Trabalho</a>

                        <button type= "submit" style= "margin-left: 10px;">Excluir</button>

                    </form>

                </td>
            </tr>
            <?php
            $aux++;
            }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style= "text-align: center; "><?php echo $totalfaltaalunos;?></td>
                <td style= "text-align: center;"><?php echo $totalnotaalunos; ?></td>
            </tr>
        </table>
    </body>
</html>