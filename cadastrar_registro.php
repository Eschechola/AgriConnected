<?php
    error_reporting(0);
    $cidade = $_POST['cidade'];
    $estado = "";
    $data = $_POST['data'];
    
    try{
        $estado = $_POST['estado'];
    }
    catch(Exception $e){
        $estado = "Indefinido";
    }

    $conectar = mysqli_connect("localhost", "root", "", "db_agro");
    mysqli_set_charset($conectar,"utf8");
    $query = "insert into tbl_registros values ('default', '".$cidade."','".$estado."','".$data."');";
    if(!$conectar) {
        echo
        "<script>
            alert('Ocorreu algum erro na conexão! Tente novamente.');
            location.href = 'index.html';
        </script>";
    }
    else{
        $conectar->query($query);
        echo
        "<script>
            alert('Cadastrado com sucesso!');
            location.href = 'index.html';
        </script>";
    }
    $conectar.die();
?>