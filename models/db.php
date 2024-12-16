<?php
    class Db 
    {

        protected $DBN      = 'dbmenus'; /*bd* */
        protected $dbUser   = 'root';
        protected $dbPass   = '';
        protected $PDOCON   = NULL;
        public $conection;

        public function __construct()
        {
            try 
            {
                $DSN            = 'mysql:host=localhost;dbname=' . $this->DBN;
                $DBH            = new PDO( $DSN, $this->dbUser, $this->dbPass );
                $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conection   = $DBH;
            } 
            catch ( PDOException $ex )
            {
                $msg=$ex->getMessage();
                return FALSE;           
            }
        }
    }