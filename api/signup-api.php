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
  $phone ="";
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
    $phone = trim($inData["Phone"]);
    $email = trim($inData["Email"]);

    // check for empty field
    if (strlen($Username)<1 || strlen($Password)<1 || strlen($confirm_pass)<1
      || strlen($lastName)<1 || strlen($firstName)<1 || strlen($email)<1)
      {
        $data = array(
          "Error"=>"At least one of the fields is empty"
        );
        header('Content-Type: application/json');
        http_response_code(406);
        echo json_encode($data);
        goto end;
      }
      
    // Check for username length
    if(strlen($Username)>30)
    {
      $data = array(
        "Error"=>"Username length limit(30) exceeded!"
      );
      header('Content-Type: application/json');
      http_response_code(406);
      echo json_encode($data);
      goto end;
    }

    // Check for lastname length
    if(strlen($lastName)>30)
    {
      $data = array(
        "Error"=>"Last Name length limit(30) exceeded!"
      );
      header('Content-Type: application/json');
      http_response_code(406);
      echo json_encode($data);
      goto end;
    }

    // Check for Firstname length
    if(strlen($firstName)>30)
    {
      $data = array(
        "Error"=>"Username length limit(30) exceeded!"
      );
      header('Content-Type: application/json');
      http_response_code(406);
      echo json_encode($data);
      goto end;
    }


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
    // close statement to start a new one for email
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
      $stmt->close();

      insertContacts:
      // insert data into table
      $sql = "INSERT INTO Contacts (UserID, LastName, FirstName, Phone, Email) VALUES (?,?,?,?,?)";

      // Prepare statement & check for errors
      if ($stmt = $mysqli->prepare($sql))
      {
        // bind variables to parameters to insert
        // Type s for string and i for integer
        $stmt->bind_param("issis", $idParam, $lastParam, $firstParam, $phoneParam, $emailParam);

        // Give values to parameters
        $idParam = $UserId;
        $lastParam = $lastName;
        $firstParam = $firstName;
        $phoneParam = $phone;
        $emailParam = $email;

        // try to execute the prepared statement, print error if faile
        if ($stmt->execute())
        {
          // Redirect to login page
          $data = array(
            "Error"=>""
          );
          header('Content-Type: application/json');
          http_response_code(200);
          echo json_encode($data);
          goto end;
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
          "Error"=>"Failed to prepare contacts query"
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
