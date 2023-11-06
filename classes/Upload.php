
<?php 

class Upload{


    private $_db;
    public function __construct(){
        $this->_db = DB::getInstance();
    }
}