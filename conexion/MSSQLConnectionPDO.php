<?php

class MSSQLConnectionPDO {

    public static $instance = NULL;
    public static $connecion = NULL;

    private function __construct(){        
    }

    private function __clone(){        
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection( $user = "", $password = "", $new_config = NULL ) {
        $cn = NULL;
        try {
            if (self::$connecion == NULL) {
                $cf = new config();             
                
                // if( $host!='' ){ $cf->setHost($host); }
                // if( $db!='' ){ $cf->setDataBase($db); }
                if( $user!='' ){ $cf->setUser($user); }
                if( $password!='' ){ $cf->setPass($password); }
                if( $new_config!=NULL ){ $cf = $new_config; }
                
                // self::$connecion = new PDO($cf->getDns(), $cf->getUser(), $cf->getPass(), array( PDO::ATTR_PERSISTENT => true));
                // self::$connecion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // self::$connecion = new PDO($cf->getDns(), $cf->getUser(), $cf->getPass());
                self::$connecion = new PDO($cf->getDns(), $cf->getUser(), $cf->getPass());
                self::$connecion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // echo "hola";
                // $tsql = "SELECT TOP 10 VE_CCODIGO,VE_CNOMBRE FROM FT0016VEND";
                // $getReviews = $connecion->prepare($tsql);
                // $getReviews->execute();
                // $reviews = $getReviews->fetchAll(PDO::FETCH_NUM); 

                // foreach($reviews as $row)  {  
                //     $codigo = $row[0];  
                //     $nombre = $row[1]; 
                //     //DisplayReview( $productID, $name, $date, $rating, $comments );  
                //     echo $codigo."---".$nombre."<br>\n";
                // } 

            }            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            exit();
        }
        //var_dump($cn);
        return self::$connecion;
    }

}

?>
