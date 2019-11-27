<?php
    class config {
        private $host;
        private $user;
        private $pass;
        private $db;
        private $dns;
        private $port;
        public function  __construct() {
            #CONNECTION TO MYSQL
            // $this->host='localhost';
            // $this->user='root';
            // $this->pass='123456';
            // $this->db='master_clientes';
            // $this->port='3306';
            // $this->dns='mysql:dbname='.($this->db).';port='.($this->port).';host='.($this->host);

            #CONNECTION TO MSSQL
            $this->host = "SERVER400";
            $this->user = "sa";
            $this->pass = "Andinars08";
            $this->db = "RSFACCAR";
            $this->port = 1443;
            $this->dns="sqlsrv:Server=".$this->host.";Database=".$this->db;

        }
        public function setHost ( $host ) {
            $this->host=$host;
        }
        public function getHost () {
            return $this->host;
        }

        public function setUser ( $user ) {
            $this->user=$user;
        }
        public function getUser ( ) {
            return $this->user;
        }

        public function setPass ( $pass ) {
            $this->pass=$pass;
        }
        public function getPass () {
            return $this->pass;
        }

        public function setDataBase ( $db ) {
            $this->db=$db;
        }
        public function getDataBase ( ) {
            return $this->db;
        }

        public function setDns ( $dns ) {
            $this->dns=$dns;
        }
        public function getDns ( ) {
            return $this->dns;
        }

        public function setPort ( $port ) {
            $this->port=$port;
        }
        public function getPort ( ) {
            return $this->port;
        }
    }
?>
