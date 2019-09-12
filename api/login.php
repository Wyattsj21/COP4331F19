<?php
  // Receive a JSON with the usernname and password of the user
  // validate the information with the Database
  // return a JSON with the UserId and the Error code if there is any
  require_once "Database.php";
  $inData = getRequestInfo();
  $Username="";
  $Password="";
  $UserId="";

  // take input JSON
  function getRequestInfo()
  {
    return json_decode(file_get_contents('php://input'), true);
  }
  // check for post request
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $Username = trim($inData["Username"]);
    $Password = trim($inData["Password"]);

    // select all the columes in the database
    $sql = "SELECT * FROM user WHERE Username=?";

    if($stmt = $mysqli->prepare($sql))
    {
      // bind variables to the prepared statement
      // s for type string
      $stmt->bind_param("s", $UsernameParam);

      $UsernameParam = $Username;

      // try to execute the prepared statement, print error if failed
      if($stmt->execute())
      {
        $stmt->store_result();

        // if Username exists, row count must = 1, else print error
        if($stmt->num_rows() == 1)
        {
          // Bind database result to variables
          $stmt->bind_result($UserId, $Username, $db_Password);
          if($stmt->fetch())
          {
            // compare input Password with databas Password
            // print error if they don't match
            // use password_verify b/c $db_password is hashed
            if(password_verify($Password, $db_Password))
            {
              $data = array(
                "UserId"=>"$UserId",
                "Error"=>""
              );
              header('Content-Type: application/json');
              http_response_code(200);
              echo json_encode($data);
            }
            else
            {
              $data = array(
                "Error"=>"Incorrect Password!"
              );
              header('Content-Type: application/json');
              http_response_code(404);
              echo json_encode($data);
            }
          }

        }
        else
        {
          $data = array(
            "Error"=>"Incorrect Username!"
          );
          header('Content-Type: application/json');
          http_response_code(404);
          echo json_encode($data);
        }
      }
    }
    else
    {
      $data = array(
        "Error"=>"Statement Error!"
      );
      header('Content-Type: application/json');
      http_response_code(418);
      echo json_encode($data);
    }
  }
?>
