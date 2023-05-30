<?php

function faixaEtaria($idade){

    if($idade <= 19){
        return "Jovem";
    }
    else if($idade >= 20 && $idade <= 50){
        return "Adulto";
    }
    else{
        return "Idoso";
    }
}

function situacaoAluno($nota, $faltas) {

    $subtrairpontosfalta = $faltas * 0.1;
    $notafinal = $nota - $subtrairpontosfalta;

    if ($notafinal < 6) {
        return "Reprovado";
    } else {
        return "Aprovado";
    }
}
?>