<?php
	header('Content-Type: application/json');
	require_once "Database.php";
	$inData = getRequestInfo();
	$userID = "";
	$firstName = "";
	$lastName = "";
	$email = "";
	$phoneNumber = "";

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$userID = trim($inData["UserID"]);
		$firstName = trim($inData["First Name"]);
		$lastName = trim($inData["Last Name"]);
		$email = trim($inData["Email"]);
		$phoneNumber = trim($inData["Phone"]);
		if (strlen($NfirstName) < 1 || strlen($NlastName) < 1 || strlen($NphoneNumber) < 1 || strlen($Nemail) < 1)
        {
            $data = array("Error"=>"At least 1 field is empty");
			http_response_code(406);
			echo json_encode($data);
			exit();
        }
		if (strlen($firstName) > 30)
		{
			$data = array("Error"=>"First name length limit(30) exceeded.");
			http_response_code(406);
			echo json_encode($data);
			exit();
		}

		if (strlen($lastName) > 30)
		{
			$data = array("Error"=>"Last name length limit(30) exceeded..");
			http_response_code(406);
			echo json_encode($data);
			exit();
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$data = array(
				"Error"=>"Invalid email address");
			http_response_code(406);
			echo json_encode($data);
			exit();
		}
		
		$sql = "SELECT * FROM Contacts WHERE UserID = ? AND LastName = ? AND FirstName = ? AND Phone = ? AND Email = ?";
		if ($stmt = $mysqli->prepare($sql))
    	{
      		$stmt->bind_param("issis", $idParam, $lastParam, $firstParam, $phoneParam, $emailParam);
       		$idParam = $userID;
       		$lastParam = $lastName;
    		$firstParam = $firstName;
       		$phoneParam = $phoneNumber;
        	$emailParam = $email;
      		if($stmt->execute())
      		{
        		$stmt->store_result();
        		if($stmt->num_rows() > 0)
        		{
          			$data = array("Error"=>"Contact already exists");
          			http_response_code(406);
          			echo json_encode($data);
          			goto end;
        		}
      		}
      		else
      		{
        		$data = array("Error"=>"Bad Request.");
        		http_response_code(400);
        		echo json_encode($data);
        		goto end;
        	}
        }

        $stmt->close();

		$sql = "INSERT INTO Contacts (UserID, LastName, FirstName, Phone, Email) VALUES (?,?,?,?,?)";
		if ($stmt = $mysqli->prepare($sql))
      	{
       		$stmt->bind_param("issis", $idParam, $lastParam, $firstParam, $phoneParam, $emailParam);
       		$idParam = $userID;
       		$lastParam = $lastName;
    		  $firstParam = $firstName;
       		$phoneParam = $phoneNumber;
        	$emailParam = $email;
        	if ($stmt->execute())
        	{
          		$data = array("Error"=>"");
          		http_response_code(200);
          		echo json_encode($data);
        	}
        	else
        	{
          		$data = array("Error"=>"Failed to insert into contacts table.");
          		http_response_code(500);
          		echo json_encode($data);
        	}
     	}
     	end:
	}
?>