<?php

class model {

    protected $db;
    protected $dbdados;

    public function __construct() {
        global $config;
        try {
            $this->db = new PDO('mysql:dbname=' . $config['dbmaster'] . ';host=' . $config['host'], $config['dbuser'], $config['dbpass']);
            
        } catch (PDOException $e) {
            echo 'Falhou : ' . $e->getMessage();
        }
        try {
            $this->dbdados = new PDO('mysql:dbname=' . $config['dbname'] . ';host=' . $config['host'], $config['dbuser'], $config['dbpass']);
            // $sql = $this->dbdados->prepare("SET NAMES 'utf8';
            //                                 SET character_set_connection=utf8;
            //                                 SET character_set_client=utf8;
            //                                 SET character_set_results=utf8;");
            // $sql->execute();
        } catch (PDOException $e) {
            echo 'Falhou : ' . $e->getMessage();
        }
        try {
            $this->dbdados2 = new PDO('mysql:dbname=' . $config['dbname2'] . ';host=' . $config['host2'], $config['dbuser2'], $config['dbpass2']);
            // $sql = $this->dbdados->prepare("SET NAMES 'utf8';
            //                                 SET character_set_connection=utf8;
            //                                 SET character_set_client=utf8;
            //                                 SET character_set_results=utf8;");
            // $sql->execute();
        } catch (PDOException $e) {
            echo 'Falhou : ' . $e->getMessage();
        }
    }

}

?>