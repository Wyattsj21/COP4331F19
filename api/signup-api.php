<?php
  // Receive a JSON with the usernname, password and other user info
  // validate the information with the Database to see if the accounnt is available
  // return a JSON with the Error code if there is any
  require_once "Database.php";
  $inData = getRequestInfo();
  $Username ="";
  $Password ="";
  $confirm_pass ="";
  $firstName="";
  $lastName ="";
  $email ="";
  $UserId="";

  // take input JSON
  function getRequestInfo()
  {
    return json_decode(file_get_contents('php://input'), true);
  }

  // check for post request
  if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $Username = trim($inData["Username"]);
    $Password = trim($inData["Password"]);
    $confirm_pass = trim($inData["Confirm_pass"]);
    $lastName = trim($inData["Last Name"]);
    $firstName = trim($inData["First Name"]);
    $email = trim($inData["Email"]);

    // get info from database to check for dublicate Username
    $sql = "SELECT * FROM Users WHERE Username=?";

    if ($stmt = $mysqli->prepare($sql))
    {
      // bind variables to the prepared statement
      // s for type string
      $stmt->bind_param("s", $UsernameParam);
      $UsernameParam = $Username;

      // try to execute the prepared statement, print error if failed
      if($stmt->execute())
      {
        $stmt->store_result();

        // if Username exists, row count must = 1
        if($stmt->num_rows() == 1)
        {
          $data = array(
            "Error"=>"Username already taken"
          );
          header('Content-Type: application/json');
          http_response_code(406);
          echo json_encode($data);
          goto end;
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
        goto end;
      }
    }
    // close statement
    $stmt->close();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $data = array(
        "Error"=>"Invalid email address"
      );
      header('Content-Type: application/json');
      http_response_code(406);
      echo json_encode($data);
      goto end;
    }

    // Username available. Begininng signup process
    // validate Password. Password must be between 1-20 characters
    if (!(strlen($Password) >= 1 && strlen($Password) <= 20))
    {
      $data = array(
        "Error"=>"Password must be between 1 to 20 characters long!"
      );
      header('Content-Type: application/json');
      http_response_code(406);
      echo json_encode($data);
      goto end;
    }
    else
    {
      if ($Password != $confirm_pass)
      {
        $data = array(
          "Error"=>"Password does not match!"
        );
        header('Content-Type: application/json');
        http_response_code(406);
        echo json_encode($data);
        goto end;
      }


      // Insert data into table
      $sql = "INSERT INTO Users (Username, Password) VALUES (?,?)";

      // Prepare statement & check for errors
      if ($stmt = $mysqli->prepare($sql))
      {
        // bind variables to parameters to insert
        // Type s for string
        $stmt->bind_param("ss", $UsernameParam, $PasswordParam);

        // Give values to parameters
        $UsernameParam = $Username;
        $PasswordParam = Password_hash($Password, PASSWORD_DEFAULT);

        // try to execute the prepared statement, print error if faile
        if ($stmt->execute())
        {
          $UserId = $mysqli->insert_id;
          goto insertContacts;
        }
        else
        {
          $data = array(
            "Error"=>"Failed to insert into user table"
          );
          header('Content-Type: application/json');
          http_response_code(418);
          echo json_encode($data);
          goto end;
        }
      }


      insertContacts:
      $stmt->close();
      // insert data into table
      $sql = "INSERT INTO Contacts (UserID, LastName, FirstName, Email) VALUES (?,?,?,?)";

      // Prepare statement & check for errors
      if ($stmt = $mysqli->prepare($sql))
      {
        // bind variables to parameters to insert
        // Type s for string and i for integer
        $stmt->bind_param("isss", $idParam, $lastParam, $firstParam, $emailParam);

        // Give values to parameters
        $idParam = $UserId;
        $lastParam = $lastName;
        $firstParam = $firstName;
        $emailParam = $email;

        // try to execute the prepared statement, print error if faile
        if ($stmt->execute())
        {
          $data = array(
            "Error"=>""
          );
          header('Content-Type: application/json');
          http_response_code(200);
          echo json_encode($data);
        }
        else
        {
          $data = array(
            "Error"=>"Failed to insert into contacts table"
          );
          header('Content-Type: application/json');
          http_response_code(418);
          echo json_encode($data);
          goto end;
        }
      }
      else
      {
        $data = array(
          "Error"=>"Failed to access contacts table $stmt->error & $mysqli->error"
        );
        header('Content-Type: application/json');
        http_response_code(418);
        echo json_encode($data);
        goto end;
      }
      $stmt->close();
    }
  end:
  }
?>
