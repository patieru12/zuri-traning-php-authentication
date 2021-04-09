<?php

if(!function_exists("login")){
	function login(string $username, string $password, string $db_file="./db/my_db.txt"){
		//now check if all required parameter are ready
		if(!trim($username)){
			return "No username";
		}
		if(!trim($password)){
			return "No password";
		}

		if(!trim($db_file)){
			return "No database file provided";
		}

		if(!file_exists($db_file)){
			return "Invalid database file provided";
		}

		//Now make sure to read the database
		$my_database = file($db_file);
		// var_dump($my_database);
		if(count($my_database) > 0){
			// var_dump($my_database);
			foreach($my_database AS $row){
				if(preg_match("/(,)/", $row)){
					// $rowData = implode(",", $row);
					$rowData = explode(",", $row);

					// var_dump($rowData[0], $username == $row[2], hash("sha256", $password) === trim($row[3]) );
					if($username == $rowData[2] && hash("sha256", $password) === trim($rowData[3])){
						return $rowData;
					}
				}
			}
			return "No Match Found. Please double check you username";
		} else {
			return  "No match found. Please try other credentials";
		}

	}
}

if(!function_exists("register")){
	function register(string $name, string $username, string $password, string $db_file="./db/my_db.txt"){
		if(!trim($name)){
			return "No Name";
		}
		if(!trim($username)){
			return "No username";
		}
		if(!trim($password)){
			return "No password";
		}

		if(!trim($db_file)){
			return "No database file provided";
		}

		if(!file_exists($db_file)){
			return "Invalid database file provided";
		}

		//Now red the database file and print everything for later use
		$my_database = file($db_file);

		//Now get the update String
		$new_user_data = ['name' => $name, "username" => $username, "password" => $password];
		$string = update_db($my_database, $new_user_data);
		if(trim($string)){
			//Now make sure to write the new data string found in the database
			try{
				file_put_contents($db_file, $string);
				return  true;
			} catch(\Exception $e){
				return $e->getMessage();
			}
			
		} else{
			return "Undefined error occured. Please try again later";
		}

		return $string;
	}
}

if(!function_exists("search_username")){
	function search_username(string $username, string $db_file="./db/my_db.txt"){
		//now check if all required parameter are ready
		if(!trim($username)){
			return "No username";
		}

		if(!trim($db_file)){
			return "No database file provided";
		}

		if(!file_exists($db_file)){
			return "Invalid database file provided";
		}

		//Now make sure to read the database
		$my_database = file($db_file);
		// var_dump($my_database);
		if(count($my_database) > 0){
			// var_dump($my_database);
			foreach($my_database AS $row){
				if(preg_match("/(,)/", $row)){
					// $rowData = implode(",", $row);
					$rowData = explode(",", $row);

					// var_dump($rowData[0], $username == $row[2], hash("sha256", $password) === trim($row[3]) );
					if($username == $rowData[2]){
						return $rowData;
					}
				}
			}
			return "No Match Found. Please double check you username";
		} else {
			return  "No match found. Please try other credentials";
		}

	}
}

if(!function_exists("reset_mypwd")){
	function reset_mypwd(string $username, string $password, string $db_file="./db/my_db.txt"){
		if(!trim($username)){
			return "No username";
		}
		if(!trim($password)){
			return "No password";
		}

		if(!trim($db_file)){
			return "No database file provided";
		}

		if(!file_exists($db_file)){
			return "Invalid database file provided";
		}

		$user_data = search_username($username);

		if(!is_array($user_data)){
			return "Invalid username";
		}
		// var_dump($user_data);
		//Get the new string to be used for update
		$new_user_data = ["username" => $username, "password" => $password];
		$my_database = file($db_file);
		$string = update_db($my_database, $new_user_data, $user_data[0]);

		if(trim($string)){
			//Now make sure to write the new data string found in the database
			try{
				file_put_contents($db_file, $string);
				return  true;
			} catch(\Exception $e){
				return $e->getMessage();
			}
			
		} else{
			return "Undefined error occured. Please try again later";
		}
	}
}

if(!function_exists("update_db")){
	function update_db(&$old_data, &$new_data, int $index=null):string{
		$data_string = "";
		$data_count = 1;
		if(is_array($old_data)){
			foreach($old_data AS $key=>$data){
				$data_count++;
				if(!is_null($index) && $data[0] == $index){
					//Here Update the database for later use
					$extracted_data = explode(",", $data);

					//Now modify the password and put it back into data
					$extracted_data[3] = hash("sha256", $new_data['password']);
					$data = implode(",", $extracted_data);
				}
				//Now keep the information as it was before
				$data_string .= trim($data)."
";
			}
		}
		if(is_array($new_data)){
			if(!preg_match("/(,{$new_data['username']},)/", $data_string)){
				$data_string .= ($data_count++).",".$new_data['name'].",".$new_data['username'].",".hash("sha256",$new_data['password'])."
			
";
			}
		}

		return $data_string;
	}

}




//check if the file it created
$db_file = "./db/my_db.txt";

if(!file_exists($db_file)){
	//Now create the file with emoty data
	$content = "";
	file_put_contents($db_file, $content);
}