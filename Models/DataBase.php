<?php
date_default_timezone_set('America/Sao_Paulo');

define('BD_SERVIDOR','localhost');
define('BD_USUARIO','root');
define('BD_SENHA','');
define('BD_BANCO','salas');
class DataBase {
    
    public $conn;

    public function __construct(){
        $this->conexao();
    }

    private function conexao(){
        $this->conn = new mysqli(BD_SERVIDOR, BD_USUARIO , BD_SENHA, BD_BANCO);
    }
}
?>
