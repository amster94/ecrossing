<?php

/*
* EcrossingPDO - PHP PDO query creation .
* PHP Version 7
* @package Service

/**
* EcrossingPDO - PHP PDO query creation .
* @package Service
* @author Amey Sarode (Amster) <ameysarode00@gmail.com>
*/

//=========================== INCLUDES ALL DEFINES VARIABLES ===========================//
require_once 'appvars.php';
class EcrossingPDO
{
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;
 
    private $dbh;
    private $error;
    private $stmt;

    // Initialize the PDO database configuration 
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }
    //-----------------------RETURN THE QUERY ---------------------------------//
    public function query($query){
    	$this->stmt = $this->dbh->prepare($query);
	}
	
	
    //------------------BIND PARAMETER WITH VALUE ----------------------------//
    public function bindParam($param, $value, $type = null){
    	if (is_null($type)) {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        	}
    	}
    	$this->stmt->bindParam($param, $value, $type);
	}
    //--------------------------- FETCH TABLE COLUMN NAME --------------------//
    public function columnCount(){
            // $this->execute();
            return $this->stmt->columnCount();
    }
    //--------------------------- FETCH TABLE COLUMN META --------------------//
    public function getColumnMeta($value){
            // $this->execute();
            return $this->stmt->getColumnMeta($value);
    }
    //--------------------------- EXECUTE QUERY -----------------------------//
    public function execute(){
    		return $this->stmt->execute();
	}
	//-------------------------- RETURN ALL RESULT ---------------------------//
	public function resultset(){
    		$this->execute();
    		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	//----------- RETURN SINGLE RESULT ROW -----------------------------------//
	public function single(){
    		$this->execute();
    		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
	//--------------------- RETURN ROW COUNT ---------------------------//
	public function rowCount(){
    		return $this->stmt->rowCount();
	}
	//---------------- RETURN LAST TRANSACTION ID ------------------------//
	public function lastInsertId(){
    		return $this->dbh->lastInsertId();
	}
	//------------------ BEGIN TRANSACTION -----------------------------//
	public function beginTransaction(){
    		return $this->dbh->beginTransaction();
	}
	//---------------- COMMIT TRANSACTION ------------------------------//
	public function endTransaction(){
    		return $this->dbh->commit();
	}
	//------------------- CANCEL TRANSACTION -------------------------//
	public function cancelTransaction(){
    		return $this->dbh->rollBack();
	}
	//--------------- DEBUG DUMPED PARAMETERS -----------------------//
	public function debugDumpParams(){
    		return $this->stmt->debugDumpParams();
	}


    // function selectQuery($sql){
    //     $this->stmt = $this->dbh->prepare($sql);
    //     $this->stmt->execute();
    //     return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // FUNCTION FOR GETTING DATA FROM DB $condition_arr1 is SQL CONDITION AND $condition_arr2 IS OUR CUSTOM CONDITION
    public function selectQuery($sql,$condition_arr1=null, $condition_arr2=null){
        $this->stmt = $this->dbh->prepare($sql);
        $condition_size= 0;
        if(is_array($condition_arr1) && sizeof($condition_arr1) > 0) {
        $condition_size=sizeof($condition_arr1);
        }
        for ($i=0; $i <$condition_size; $i++) { 
            // $this->stmt->bindParam($condition_arr1[$i], $condition_arr2[$i]);
            $this->stmt->bindParam($condition_arr1[$i], $condition_arr2[$i]);
        }
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // FUNCTION FOR INSERTING DATA FROM DB $condition_arr1 is SQL CONDITION AND $condition_arr2 IS OUR CUSTOM CONDITION
    public function insertQuery($sql,$condition_arr1=null, $condition_arr2=null){
        $this->stmt = $this->dbh->prepare($sql);
        $condition_size= 0;
        if(is_array($condition_arr1) && sizeof($condition_arr1) > 0) {
        $condition_size=sizeof($condition_arr1);
        }

        for ($i=0; $i <$condition_size; $i++) { 
            // $this->stmt->bindParam($condition_arr1[$i], $condition_arr2[$i]);
            $this->stmt->bindParam($condition_arr1[$i], $condition_arr2[$i]);
        }

        $this->stmt->execute();
        return $this->stmt->rowCount();

        // return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // FUNCTION FOR UPDATING DATA FROM DB $condition_arr1 is SQL CONDITION AND $condition_arr2 IS OUR CUSTOM CONDITION
    public function updateQuery($sql,$condition_arr1=null, $condition_arr2=null){
        $this->stmt = $this->dbh->prepare($sql);
        $condition_size= 0;
        if(is_array($condition_arr1) && sizeof($condition_arr1) > 0) {
        $condition_size=sizeof($condition_arr1);
        }

        for ($i=0; $i <$condition_size; $i++) { 
            // $this->stmt->bindParam($condition_arr1[$i], $condition_arr2[$i]);
            $this->stmt->bindParam($condition_arr1[$i], $condition_arr2[$i]);
        }

        $this->stmt->execute();
        return $this->stmt->rowCount();

        // return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // FUNCTION FOR DELETE DATA FROM DB $condition_arr1 is SQL CONDITION AND $condition_arr2 IS OUR CUSTOM CONDITION
    public function deleteQuery($sql,$condition_arr1=null, $condition_arr2=null){
        $this->stmt = $this->dbh->prepare($sql);
        $condition_size= 0;
        if(is_array($condition_arr1) && sizeof($condition_arr1) > 0) {
        $condition_size=sizeof($condition_arr1);
        }

        for ($i=0; $i <$condition_size; $i++) { 
            // $this->stmt->bindParam($condition_arr1[$i], $condition_arr2[$i]);
            $this->stmt->bindParam($condition_arr1[$i], $condition_arr2[$i]);
        }

        $this->stmt->execute();
        return $this->stmt->rowCount();

        // return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
