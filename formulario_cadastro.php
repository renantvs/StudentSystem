<!DOCTYPE html>

<html lang = "pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Formulário de Cadastro</title>
    </head>

    <body>
         <div>
            <a href="index.php"> Listar Alunos </a>
        </div>

        <form method="post" action= "recebe_dados_form.php">

            <p>Digite o nome do aluno</p>
            <input type= "text" name= "nome">

            <br>

            <p>Digite o sobrenome do aluno</p>
            <input type= "text" name= "sobrenome">

            <br>

            <p>Digite a idade do aluno</p>
            <input type= "number" name= "idade">

            <br>

            <p>Sexo do Aluno</p>
            <select name= "sexo">
                <option value= "">Selecione o sexo</option>
                <option value= "f">Feminino</option>
                <option value= "m">Masculino</option>
            </select>

            <br>

            <p>Digite a cidade do aluno</p>
            <input type= "text" name= "cidade">

            <br>

            <p>Digite as faltas do aluno</p>
            <input type= "number" name= "falta">

            <br>

            <p>Digite a nota do aluno</p>
            <input type= "number" name= "nota">

            <br><br>

            <button type= "Submit">Cadastrar</button>
            
        </form>

    </body>

</html>