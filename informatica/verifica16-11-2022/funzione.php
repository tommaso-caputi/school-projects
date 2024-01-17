<?php

    function funz($num1, $num2, $op){
        switch ($op){
            case ">":
                if($num1>$num2){
                    return "Il numero num1 é maggiore del numero num2";
                }else{
                    return "Il numero num1 non è maggiore del numero num2";
                }
            case "<":
                if($num1<$num2){
                    return "Il numero num1 è minore del numero num2";
                }else{
                    return "Il numero num1 non è minore del numero num2";
                }
            default:
                if($num1==$num2){
                    return "I numeri num1 e num2 sono uguali";
                }else{
                    return "I numeri num1 e num2 non sono uguali";
                }
                break;
        }
    }
    
    echo funz(10, 5, ">");
?>