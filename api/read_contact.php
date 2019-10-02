<?php
	header('Content-Type: application/json');
	require_once "Database.php";
	$inData = getRequestInfo();
	$userID = "";
	$firstName = "";
	$lastName = "";
	$email = "";
	$phoneNumber = "";
	$contacts_arr = array();
	$contacts_arr["contacts"] = array();
	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$userID = trim($inData["UserID"]);
		$firstName = "%".strtolower(trim($inData["Input"]))."%";
		//$lastName = trim($inData["LastName"]);

		if (empty($userID))
		{
			$data = array("Error"=>"No user ID.");
			http_response_code(400);
			echo json_encode($data);
			exit();
		}

		$sql = "SELECT * FROM Contacts WHERE UserID = ? AND LOWER(Contacts.FirstName) LIKE ? ORDER BY Contacts.FirstName ASC";
		if ($stmt = $mysqli->prepare($sql))
    	{
      		$stmt->bind_param("is", $idParam, $firstParam);
       		$idParam = $userID;
       		//$lastParam = $firstName;
    		$firstParam = $firstName;
      		if($stmt->execute())
      		{
        		$stmt->store_result();
        		if($stmt->num_rows() > 0)
        		{
        			$stmt->bind_result($ContactID,$userID, $dbLast, $dbFirst, $dbPhone, $dbEmail);
          			while($stmt->fetch())
          			{
						$data = array(
          				"UserID"=>"$userID",
          				"LastName"=>"$dbLast",
          				"FirstName"=>"$dbFirst",
          				"Email"=>"$dbEmail",
          				"PhoneNumber"=>"$dbPhone",
          				"ContactID"=>"$ContactID",
          				"Error"=>"");

          				array_push($contacts_arr["contacts"], $data);
          			}
          			goto last;
        		}
      		}
      		else
      		{
        		$data = array("Error"=>"Bad Request.");
        		http_response_code(400);
        		echo json_encode($data);
        		exit();
        	}
        }
        last:
        $stmt->close();
        $sql = "SELECT * FROM Contacts WHERE UserID = ? AND LOWER(Contacts.LastName) LIKE ? AND LOWER(Contacts.FirstName) NOT LIKE ? ORDER BY Contacts.FirstName ASC";
		if ($stmt = $mysqli->prepare($sql))
    	{
      		$stmt->bind_param("iss", $idParam, $lastParam, $firstParam);
       		$idParam = $userID;
       		$lastParam = $firstName;
    		$firstParam = $firstName;
      		if($stmt->execute())
      		{
        		$stmt->store_result();
        		if($stmt->num_rows() > 0)
        		{
        			$stmt->bind_result($ContactID,$userID, $dbLast, $dbFirst, $dbPhone, $dbEmail);
          			while($stmt->fetch())
          			{
						$data = array(
          				"UserID"=>"$userID",
          				"LastName"=>"$dbLast",
          				"FirstName"=>"$dbFirst",
          				"Email"=>"$dbEmail",
          				"PhoneNumber"=>"$dbPhone",
          				"ContactID"=>"$ContactID",
          				"Error"=>"");

          				array_push($contacts_arr["contacts"], $data);
          			}
          			goto mail;
        		}
      		}
      		else
      		{
        		$data = array("Error"=>"Bad Request.");
        		http_response_code(400);
        		echo json_encode($data);
        		exit();
        	}
        }
        
        mail:
        $stmt->close();
        $sql = "SELECT * FROM Contacts WHERE UserID = ? AND LOWER(Contacts.Email) LIKE ? AND LOWER(Contacts.LastName) NOT LIKE ? AND LOWER(Contacts.FirstName) NOT LIKE ? ORDER BY Contacts.FirstName ASC";
		if ($stmt = $mysqli->prepare($sql))
    	{
      		$stmt->bind_param("isss", $idParam, $emailParam, $lastParam, $firstParam);
       		$idParam = $userID;
    		$emailParam = $firstName;
    		$lastParam = $firstName;
    		$firstParam = $firstName;
      		if($stmt->execute())
      		{
        		$stmt->store_result();
        		if($stmt->num_rows() > 0)
        		{
        			$stmt->bind_result($ContactID,$userID, $dbLast, $dbFirst, $dbPhone, $dbEmail);
          			while($stmt->fetch())
          			{
						$data = array(
          				"UserID"=>"$userID",
          				"LastName"=>"$dbLast",
          				"FirstName"=>"$dbFirst",
          				"Email"=>"$dbEmail",
          				"PhoneNumber"=>"$dbPhone",
          				"ContactID"=>"$ContactID",
          				"Error"=>"");

          				array_push($contacts_arr["contacts"], $data);
          			}
          			http_response_code(200);
          			echo json_encode($contacts_arr);
        		}
        		else
        		{
        		    if (count(array_filter($contacts_arr)) == 0)
        		    {
        		        $data = array("Error"=>"No Results");
        		        http_response_code(406);
        		        echo json_encode($data);
        		    }
        		    else
        		    {
        		        http_response_code(200);
        		        echo json_encode($contacts_arr);
        		    }
        		}
      		}
      		else
      		{
        		$data = array("Error"=>"Bad Request.");
        		http_response_code(400);
        		echo json_encode($data);
        		exit();
        	}
        }
	}
?>