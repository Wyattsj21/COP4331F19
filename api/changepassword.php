<?php
  // *** user needs to already be logged in to change password ***
  // Receive a JSON with the userid and password of the user
  // validate the old password with the Database
  // change to new password
  // return a JSON with the Error code if there is any
  require_once "Database.php";
  $inData = getRequestInfo();
  $UserId="";
  $oldPassword="";
  $newPassword="";
  $confirm_pass="";

  // take input JSON
  function getRequestInfo()
  {
    return json_decode(file_get_contents('php://input'), true);
  }

  // check for post request
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $UserId = trim($inData["UserId"]);
    $oldPassword = trim($inData["OldPassword"]);
    $newPassword = trim($inData["NewPassword"]);
    $confirm_pass = trim($inData["confirm_pass"]);


    // validate Password. Password must be between 1-20 characters
    if (!(strlen($newPassword) >= 1 && strlen($newPassword) <= 20))
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
      if ($newPassword != $confirm_pass)
      {
        $data = array(
          "Error"=>"Password does not match!"
        );
        header('Content-Type: application/json');
        http_response_code(406);
        echo json_encode($data);
        goto end;
      }
    }

    if ($newPassword == $oldPassword)
    {
      $data = array(
        "Error"=>"New password cannot be the same as old password!"
      );
      header('Content-Type: application/json');
      http_response_code(406);
      echo json_encode($data);
      goto end;
    }


    // select all the columes in the database
    $sql = "SELECT * FROM Users WHERE UserID=?";
    if($stmt = $mysqli->prepare($sql))
    {
      // bind variables to the prepared statement
      // s for type string
      $stmt->bind_param("i", $UserIdParam);
      $UserIdParam = $UserId;

      // try to execute the prepared statement, print error if failed
      if($stmt->execute())
      {
        $stmt->store_result();

        // if UserId exists, row count must = 1, else print error
        if($stmt->num_rows() == 1)
        {
          // Bind database result to variables
          $stmt->bind_result($UserId, $Username, $db_Password);
          if($stmt->fetch())
          {
            // compare input Password with databas Password
            // print error if they don't match
            // use password_verify b/c $db_password is hashed
            if(password_verify($oldPassword, $db_Password))
            {
              goto changePassword;
            }
            else
            {
              $data = array(
                "Error"=>"Incorrect Old Password!"
              );
              header('Content-Type: application/json');
              http_response_code(404);
              echo json_encode($data);
              goto end;
            }
          }

        }
        else
        {
          $data = array(
            "Error"=>"Incorrect UserId!"
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
    $stmt->close();

    // hash the new password, then update the query
    changePassword:
    $sql = "UPDATE Users SET Password=? WHERE UserID=?";
    if($stmt = $mysqli->prepare($sql))
    {
      // bind variables to the prepared statement
      // s for type string, i for type integer
      $stmt->bind_param("si", $NewPasswordParam, $UserIdParam);

      // hash new password before updating
      $NewPasswordParam = Password_hash($newPassword, PASSWORD_DEFAULT);
      $UserIdParam = $UserId;

      // try to execute the prepared statement, print error if failed
      if($stmt->execute())
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
          "Error"=>"Update Error!"
        );
        header('Content-Type: application/json');
        http_response_code(418);
        echo json_encode($data);
      }
    }
    $stmt->close();
  }
  end:
?>
