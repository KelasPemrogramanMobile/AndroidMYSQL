<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $password) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $result = mysql_query("INSERT INTO users(unique_id, name, email, encrypted_password, salt, created_at)
		VALUES('$uuid', '$name', '$email', '$encrypted_password', '$salt', NOW())");
        // check for successful store
        if ($result) {
            // get user details 
            $uid = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM users WHERE uid = $uid");
            // return user details
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }
	
	public function inputDataMahasiswa($npm,$nama,$alamat){
		$result = mysql_query("insert into tbl_mhasiswa(npm,nama,alamat) VALUES ('$npm','$nama','$alamat')");
		
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	public function readData(){
        $r = mysql_query("SELECT * FROM tbl_mhasiswa");
        $result = array();

        while($row = mysql_fetch_array($r)){
            array_push($result,array(
                'npm'=>$row['npm'],
				'nama'=>$row['nama'],
				'alamat'=>$row['alamat'],
            ));
        }

        if($result){
			echo json_encode(array('error'=>FALSE,'result'=>$result));
		}else{
			echo json_encode(array('error'=>TRUE,'message'=>'Tidak Ada Data Saat Ini'));
		}
    }
	
	public function selectDataMHS($npm){
		$result = mysql_query("select * from tbl_mhasiswa where npm='$npm'");
		
		$no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
          
            //if ($result) {
                return $result;
            //}
        } else {
            return false;
        }
	}
	
	public function updateDataMHS($npm,$nama,$alamat){
		$result = mysql_query("update tbl_mhasiswa set nama='$nama', alamat='$alamat' where npm='$npm'");
		
        if ($result) {
            return $result;
        } else {
            return false;
        }
	}
	
	public function deleteDataMHS($npm){
		$result = mysql_query("DELETE FROM `tbl_mhasiswa` WHERE npm = '$npm'");
		
        if ($result) {
            return $result;
        } else {
            return false;
        }
	}


    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {
        $result = mysql_query("SELECT * FROM users WHERE email = '$email'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $result;
            }
        } else {
            // user not found
            return false;
        }
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysql_query("SELECT email from users WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed 
            return true;
        } else {
            // user not existed
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

}

?>
