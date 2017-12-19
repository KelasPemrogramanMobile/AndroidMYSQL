<?php

/**
 * File to handle all API requests
 * Accepts GET and POST
 * 
 * Each request will be identified by TAG
 * Response will be JSON data

  /**
 * check for POST request 
 */
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];

    // include db handler
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();

    // response Array
    $response = array("tag" => $tag, "error" => FALSE);

    // check for tag type
    if ($tag == 'login') {
        // Request type is check Login
        $email = $_POST['email'];
        $password = $_POST['password'];

        // check for user
        $user = $db->getUserByEmailAndPassword($email, $password);
        if ($user != false) {
            // user found
            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["namanya"] = $user["name"];
            $response["email"] = $user["email"];
            $response["created_at"] = $user["created_at"];
            $response["updated_at"] = $user["updated_at"];
            echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
            $response["error"] = TRUE;
            $response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
		
        }
    } else if ($tag == 'register') {
        // Request type is Register new user
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // check if user is already existed
        if ($db->isUserExisted($email)) {
            // user is already existed - error response
            $response["error"] = TRUE;
            $response["error_msg"] = "Email Sudah Terpakai";
            echo json_encode($response);
        } else {
            // store user
            $user = $db->storeUser($name, $email, $password);
            if ($user) {
                // user stored successfully
                $response["error"] = FALSE;
				$response["success"] = "Berhasil Registrasi";
                echo json_encode($response);
            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Error occured in Registartion";
                echo json_encode($response);
            }
        }
    }else if ($tag == 'inputDataMHS') {
        // Request type is Register new user
        $npm 	= $_POST['npm'];
        $nama 	= $_POST['nama'];
        $alamat = $_POST['alamat'];

            // store user
        $user = $db->inputDataMahasiswa($npm, $nama, $alamat);
        if ($user) {
			// user stored successfully
			$response["error"] = FALSE;
			$response["success"] = "Berhasil Menginput Data Mahasiswa";
			echo json_encode($response);
        } else {
         // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Gagal";
            echo json_encode($response);
         }
    }else if ($tag == 'selectDataMHS') {
        // Request type is Register new user
        $npm 	= $_POST['npm'];

            // store user
        $user = $db->selectDataMHS($npm);
        if ($user) {
			// user stored successfully
			$response["error"] = FALSE;
			$response["npm"] = $user["npm"];
			$response["alamat"] = $user["alamat"];
			$response["nama"] = $user["nama"];
			$response["success"] = "Berhasil Mengambil data";
			echo json_encode($response);
        } else {
         // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Gagal";
            echo json_encode($response);
         }
    }else if ($tag == 'updateDataMHS') {
        // Request type is Register new user
        $npm 	= $_POST['npm'];
		$nama 	= $_POST['nama'];
		$alamat 	= $_POST['alamat'];

        $user = $db->updateDataMHS($npm,$nama,$alamat);
        if ($user) {
			// user stored successfully
			$response["error"] = FALSE;
			$response["success"] = "Berhasil Update Data";
			echo json_encode($response);
        } else {
         // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Gagal";
            echo json_encode($response);
         }
    }else if ($tag == 'deleteDataMHS') {
        // Request type is Register new user
        $npm 	= $_POST['npm'];

        $user = $db->deleteDataMHS($npm);
        if ($user) {
			// user stored successfully
			$response["error"] = FALSE;
			$response["success"] = "Data Berhasil Di Hapus";
			echo json_encode($response);
        } else {
         // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Gagal";
            echo json_encode($response);
         }
    }
	else if ($tag == 'readData') {
		
        $user = $db->readData();
    
	} else {
        // user failed to store
        $response["error"] = TRUE;
        $response["error_msg"] = "Unknow 'tag' value. It should be either 'login' or 'register'";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>
