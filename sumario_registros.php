<!DOCTYPE html>
<html>
    <head>
        <title>AgriConnected - Listagem</title>
        <meta charset="utf-8">
        <link rel="icon" href="imgs/logo.png"/>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @media (max-width: 900px) {
                #errorh1{
                    font-family: Ubuntu;
                }
                
                #t1error{
                    font-size: 0.5em;
                }

                #btnp2{
                    background-color: transparent !important;
                    border: 2px solid white !important;
                    color: white !important;
                    font-family: Ubuntu !important;
                    padding: 5px !important;
                    font-size: 1.2em !important;
                    margin-left: 0.5% !important;
                    transition: 0.5s !important;
                    width: 40%;
                }

                .contentp2{
                    height: 250px !important;
                }
            }

        </style>

    </head>

    <body>
		<div class="content contentp2"  style="background-color: white;">
            <div class="image-background contentp2" style="height: 200px;">
                <div class="dark-filter contentp2" style="height: 200px;">
                    <center>
                        <h1 style="margin-top: 3%; transform: translateY(-10%); font-size: 2em !important;">Lista de registros que ja aconteceram</h1>
                        <a href="index.html"><button id="btnp2">Cadastrar um registro</button></a>
                        <a href="listar_registros.php"><button id="btnp2">Listagem dos registros</button></a>
                    </center>
                </div>
            </div>

            <div class="tabela">
                        <?php
                            error_reporting(0);
                            $estados = array("Acre","Alagoas","Amapá","Amazonas","Bahia","Ceará","Distrito Federal","Espírito Santo","Goiás","Maranhão","Mato Grosso","Mato Grosso do Sul","Minas Gerais","Pará","Paraíba","Paraná","Pernambuco","Piauí","Rio de Janeiro","Rio Grande do Norte","Rio Grande do Sul","Rondônia","Roraima","Santa Catarina","São Paulo","Sergipe","Tocantins");
                            try{
                                $conexao = new mysqli("localhost", "root", "", "db_agro");
                                if($conexao->connect_error){
                                    echo "<center>
                                        <h1 class=\"t1error\" style=\"margin-top: 5%; color: FireBrick; font-family: Ubuntu\">Infelizmente não conseguimos nos conectar, verifique sua conexão!</h1>
                                        <img src=\"imgs/robot.png\" style=\"height: 60% !important; width: 30% !important; margin-top: 5%;\"class=\"img-fluid\" alt=\"Erro\">
                                    </center>";
                                }
                                else{
                                    mysqli_set_charset($conexao,"utf8");
                                    $query = "select estado from tbl_registros";
                                    $resultado = $conexao->query($query);
                                    if($resultado->num_rows == 0){
                                        echo "<center>
                                               <h1 class=\"t1error\" style=\"margin-top: 10%; color: Teal; font-family: Ubuntu\">Pesquisamos muito longe, mas ainda nao há registros!</h1>
                                               <img src=\"imgs/robot.png\" style=\"height: 60% !important; width: 30% !important; margin-top: 5%;\"class=\"img-fluid\" alt=\"Erro\">
                                           </center>";
                                   }
                                   else{
                                       $contador = 0;
                                       echo "<table class=\"table table-striped table-bordered table-hover\">
                                       <thead class=\"thead-dark\">
                                           <tr>
                                           <th scope=\"col\">Estado</th>
                                           <th scope=\"col\">Total de Eventos</th>
                                           </tr>
                                       </thead>
                                       <tbody>";
                                       while($contador < 27) {
                                           $resultado = $conexao->query("select estado, count(estado) from tbl_registros where estado = '".$estados[$contador]."'");
                                           foreach($resultado as $pegar_nome){
                                                if(!$pegar_nome['estado']==null||!$pegar_nome['estado']==""){
                                                    echo "<tr>
                                                        <td>".$pegar_nome['estado']."</td>
                                                        <td>".$pegar_nome['count(estado)']."</td>
                                                    </tr>";
                                                }    
                                            }
                                            $contador++;
                                           }
                                       }
                                   }
                                }
                            catch(Exception $e){
                                echo "<center>
                                        <h1 style=\"margin-top: 10%; color: Teal; font-family: Ubuntu\">Infelizmente não conseguimos nos conectar, verifique sua conexão!</h1>
                                        <img src=\"imgs/robot.png\" style=\"height: 60% !important; width: 30% !important; margin-top: 5%;\"class=\"img-fluid\" alt=\"Erro\">
                                    </center>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
	</body>
</html>