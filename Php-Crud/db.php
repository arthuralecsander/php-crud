<?php

class db {

    public function conectar() {
        $mysqli = new mysqli('localhost', 'root', '', 'dbturim') or die(mysqli_error($mysqli));
        return $mysqli;
    } //Funcao de conectar ao banco

    public function gravar($pai, $paiId) {
        $connect = $this->conectar();
        $paiNome = $pai['nome'];
        $paiId += 1;

        $sqlPai = "INSERT INTO tb_pai(idpai,nome) VALUES ('$paiId','$paiNome')";
        mysqli_query($connect, $sqlPai);

        if (isset($pai['filhos']) && !empty($pai['filhos'])) {
            foreach ($pai['filhos'] as $filhoId => $filho) {
                $filhoNome = $filho['nome'];
                $sqlFilho = "INSERT INTO tb_filho(nome,fk_idpai) VALUES ('$filhoNome','$paiId')";
                mysqli_query($connect, $sqlFilho);
            }
        }
    } //funcao de gravar os dados recebidos pelo metodo POST

    public function ler() {
        $mysqli = $this->conectar();
        $sqlPai = "SELECT * FROM tb_pai";
        $myArray = array();

        if ($result = $mysqli->query($sqlPai)) {

            while ($pai = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $pai;
                $paiId = intval($pai['idpai']);
                
                if ($resultFilho = $mysqli->query("SELECT * FROM tb_filho WHERE fk_idpai = '$paiId'")) {

                    while ($filho = $resultFilho->fetch_array(MYSQLI_ASSOC)) {
                        $myArray[] = $filho;
                    }
                }
            }
            echo json_encode($myArray);
        }
    } //leitura pelo o metodo GET

}
