<?php
header('Content-Type: application/json');
require_once "Database.php";
	$inData = getRequestInfo();
	$userID = "";
    $ContactID = "";

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$userID = trim($inData["UserID"]);
		$ContactID = trim($inData["ContactID"]);


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

		$sql = "DELETE FROM Contacts WHERE UserID = ? AND ContactID = ?";
		if ($stmt = $mysqli->prepare($sql))
		{
		    $stmt->bind_param("ii", $idParam, $contactParam);
       		$idParam = $userID;
       		$contactParam = $ContactID;
			if($stmt->execute())
			{
				$data = array("Error"=>"");
				http_response_code(200);
				echo json_encode($data);
				exit();
			}
			else
			{
				$data = array("Error"=>"Could not delete!");
        		http_response_code(400);
        		echo json_encode($data);
        		exit();
			}
		}
	}
?>
