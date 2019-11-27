<?php
class PgConnection {

    private $conexion;
    private $resource;
    private $sql;
    public static $queries;
    private static $_singleton;

    public static function getInstance(){
        if (is_null (self::$_singleton)) {
            self::$_singleton = new PgConnection();
        }
        return self::$_singleton;
    }
    private function __construct(){
        try{
        $config=new config();
        $this->conexion=pg_connect("host=".$config->getHost()." port=".$config->getPort()." password=".$config->getPass()." user=".$config->getUser()." dbname=".$config->getDataBase());
        self::$queries = 0;
        $this->resource = null;
        }catch(exception $err){
            echo $err->getMessage();exit();
        }
    }
    public function execute(){
        if(!($this->resource = pg_exec($this->conexion, $this->sql))){
            return null;
        }
        self::$queries++;
        return $this->resource;
    }
    public function executeQuery(){
        if(!($this->resource = pg_exec($this->conexion, $this->sql))){
            return false;
        }
        return true;
    }
    public function getError(){
        return pg_errormessage($this->conexion);
    }
    public function iniciaTransaccion(){
        if(!(pg_exec($this->conexion, 'START TRANSACTION'))){return false;}
        return true;
    }
    public function commit(){
        if(!(pg_exec($this->conexion, 'COMMIT'))){return false;}
        return true;
    }
    public function rollback(){
        if(!(pg_exec($this->conexion, 'ROLLBACK'))){return false;}
        return true;
    }
    public function generaIdAntesDeInsert($table){//para casos de procesos entre varias tablas
        $sequence=$table."_id".substr($table, 2, 40)."_seq";
        $sqlnextval = "SELECT nextval('$sequence')";
        pg_query($this->conexion,$sqlnextval);
        $select = "SELECT currval('$sequence')";
        $load = pg_query($this->conexion,$select);
        $id = pg_fetch_array($load,null,PGSQL_NUM);
        return $id[0];
    }
    public function alter(){
        if(!($this->resource = pg_exec($this->conexion, $this->sql))){
                return false;
        }
        return true;
    }
    public function loadObjectList(){
        if (!($cur = $this->execute())){
                return null;
        }
        $array = array();
        while ($row = pg_fetch_assoc ($cur)){
            $array[] = $row;
        }
        return $array;
    }

    public function setQuery($sql){
        if(empty($sql)){
                return false;
        }
        $this->sql = $sql;
        return true;
    }

    public function freeResults(){
        pg_free_result($this->resource);
        return true;
    }

    public function loadObject(){
        if ($cur = $this->execute()){
            if($object=pg_fetch_object($cur)){
                pg_free_result($cur);
                return $object;
            }
            else {
                return null;
            }
        }
        else {
            return false;
        }
    }

    function __destruct(){
        pg_free_result($this->resource);
        pg_close($this->conexion);
    }
}
?>