<?php
	header('Content-Type: application/json');
	require_once "Database.php";
	$inData = getRequestInfo();
	$userID = "";
	$firstName = "";
	$lastName = "";
	$email = "";
	$phone = "";

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}
	function intcmp($a,$b)
    {
    return ($a-$b) ? ($a-$b)/abs($a-$b) : 0;
    }

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$userID = trim($inData["UserID"]);
        $ContactID = trim($inData["ContactID"]);
        $NfirstName = trim($inData["First Name"]);
        $NlastName = trim($inData["Last Name"]);
        $Nemail = trim($inData["Email"]);
        $NphoneNumber = trim($inData["Phone"]);
    
        if (strlen($NfirstName) < 1 && strlen($NlastName) < 1 && strlen($NphoneNumber) < 1 && strlen($Nemail) < 1)
        {
            $data = array("Error"=>"Nothing was entered");
			http_response_code(406);
			echo json_encode($data);
			exit();
        }
		if (strlen($NfirstName) > 30)
		{
			$data = array("Error"=>"First name length limit(30) exceeded.");
			http_response_code(406);
			echo json_encode($data);
			exit();
		}

		if (strlen($NlastName) > 30)
		{
			$data = array("Error"=>"Last name length limit(30) exceeded..");
			http_response_code(406);
			echo json_encode($data);
			exit();
		}

		if (strlen($Nemail) > 0 && !filter_var($Nemail, FILTER_VALIDATE_EMAIL))
		{
			$data = array(
				"Error"=>"Invalid email address");
			http_response_code(406);
			echo json_encode($data);
			exit();
		}
		
// 		$sql = "UPDATE Contacts SET UserID = ?, LastName = ?, FirstName = ?, //Phone = ?, Email = ? WHERE UserID = ? AND LastName = ? AND FirstName = ? //AND Phone = ? AND Email = ?";
// 		if ($stmt = $mysqli->prepare($sql))
//     {
//     	$stmt->bind_param("issisissis", $NidParam, $NlastParam, $NfirstParam, //$NphoneParam, $NemailParam,$OidParam, $OlastParam, $OfirstParam, //$OphoneParam, $OemailParam);
//       $NidParam = $NuserID;
//       $NlastParam = $NlastName;
//       $NfirstParam = $NfirstName;
//       $NphoneParam = $NphoneNumber;
//       $NemailParam = $Nemail;
//      	$OidParam = $OuserID;
//     	$OlastParam = $OlastName;
//   	  $OfirstParam = $OfirstName;
//      	$OphoneParam = $OphoneNumber;
//      	$OemailParam = $Oemail;
     	
//      	if(!($stmt->execute()))
//      	{
//      		$data = array("Error"=>"Bad Request.");
//       	    http_response_code(400);
//       	    echo json_encode($data);
//       	    exit();
//       }
//     }

//         $stmt->close();

$sql = "SELECT * FROM Contacts WHERE UserID = ? AND ContactID = ?";
		if ($stmt = $mysqli->prepare($sql))
		{
		    $stmt->bind_param("ii", $idParam, $contactParam);
       		$idParam = $userID;
       		$contactParam = $ContactID;
			if($stmt->execute())
			{
				$stmt->store_result();
				if($stmt->num_rows() != 1)
				{
					$data = array("Error"=>"This Contact does not exist");
					http_response_code(400);
					echo json_encode($data);
					exit();
				}
				else
				{
				    $stmt->bind_result($ContactID,$userID, $dbLast, $dbFirst, $dbPhone, $dbEmail);
				    $stmt->fetch();
				    if (strlen($NlastName) < 1)
				    {
				        $NlastName = $dbLast;
				    }
				    if (strlen($NfirstName) < 1)
				    {
				        $NfirstName = $dbFirst;
				    }
				    if (strlen($NphoneNumber) < 1)
				    {
				        $NphoneNumber = $dbPhone;
				    }
				    if (strlen($Nemail) < 1)
				    {
				        $Nemail = $dbEmail;
				    }
				    
				    if (strcmp($NlastName, $dbLast) == 0 && strcmp($NfirstName, $dbFirst) == 0 && intcmp($NphoneNumber, $dbPhone) == 0 && strcmp($Nemail, $dbEmail) == 0)
				    {
				        $data = array("Error"=>"Nothing was changed.");
        		        http_response_code(400);
        		        echo json_encode($data);
        		        exit();
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

		$stmt->close();

		$sql = "UPDATE Contacts SET LastName = ?, FirstName = ?, Phone = ?, Email = ? WHERE UserID = ? AND ContactID = ?";
		if ($stmt = $mysqli->prepare($sql))
		{
		    $stmt->bind_param("ssisii", $lastParam, $firstParam, $phoneParam, $emailParam, $idParam, $contactParam);
       		$idParam = $userID;
       		$contactParam = $ContactID;
       		$lastParam = $NlastName;
    		$firstParam = $NfirstName;
       		$phoneParam = $NphoneNumber;
        	$emailParam = $Nemail;
			if($stmt->execute())
			{
				$data = array("Error"=>"");
              	http_response_code(200);
              	echo json_encode($data);
			}
			else
			{
				$data = array("Error"=>"Failed to Update.");
        		http_response_code(500);
        		echo json_encode($data);
        		exit();
			}
		}

//     insert:
// 		$sql = "INSERT INTO Contacts (UserID, LastName, FirstName, Phone, Email) VALUES (?,?,?,?,?)";
// 		if ($stmt = $mysqli->prepare($sql))
//     {
//       $stmt->bind_param("issis", $idParam, $lastParam, $firstParam, $phoneParam, $emailParam);
//       $idParam = $NuserID;
//       $lastParam = $NlastName;
//     	$firstParam = $NfirstName;
//       $phoneParam = $NphoneNumber;
//       $emailParam = $Nemail;
//       if ($stmt->execute())
//       {
//       	$data = array("Error"=>"");
//       	http_response_code(200);
//       	echo json_encode($data);
//       }
//       else
//       {
//       	$data = array("Error"=>"Failed to insert into contacts table.");
//       	http_response_code(500);
//       	echo json_encode($data);
//       }
//   	}
	}
?>