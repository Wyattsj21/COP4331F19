<html>
    
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
var userid = getCookie("uid");
        if (userid == "")
        {
            window.location = "http://poosproject.com/login.php"
        }
        function getCookie(cname) {
          var name = cname + "=";
          var decodedCookie = decodeURIComponent(document.cookie);
          var ca = decodedCookie.split(';');
          for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
              c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
            }
          }
          return "";
        }
</script>

 <head>
     <!--Metadata required for Bootstrap-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  
    <title>POOS Small Project</title>
    
    <style>
        body{
            background: url("background3.jpg") no-repeat center center fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        tbody, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        background: white;
        }
        
        th, td {
            padding: 15px;
        }
        
        .block-left { float: left; }
        .block-right { float: right; }
    </style>
    
    <!--<div class="wrapper">
        <div class="block-right">
            <button class="btn" onClick = "exit()"> Log Out</button>
        </div>
        <div class="block-left">
            <button class="btn" onClick = "contacts()"> Contacts</button>
        </div>
    </div>-->
</head>

<body>
    <div style="background:transparent !important" class="jumbotron">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card text-dark bg-light shadow">
                        <div class="card-body">
                            <h1 class="card-title text-dark text-center">Change Password</h1>
                            <form>
                                <div class="form-group row">
                                    <label for="Password" class="col-3 col-form-label">Old Password:</label>
                                    <div class="col">
                                        <input type="password" class="form-control" name="Password" placeholder="Password" id = "oldpass" onkeydown = "if (event.keyCode == 13) document.getElementById('changebtn').click()" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Password" class="col-3 col-form-label">New Password:</label>
                                    <div class="col">
                                        <input type="password" class="form-control" name="Password" placeholder="Password" id = "newpass" onkeydown = "if (event.keyCode == 13) document.getElementById('changebtn').click()" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Password" class="col-3 col-form-label">Confirm Password:</label>
                                    <div class="col">
                                        <input type="password" class="form-control" name="Password" placeholder="Password" id = "confirmpass" onkeydown = "if (event.keyCode == 13) document.getElementById('changebtn').click()" required>
                                    </div>
                                </div>
                                <p class="text-primary" id="demo"></p>
                                <button type="button" class="btn btn-outline-primary btn-block" value="Change" onclick="send()" id="changebtn">Change</button>
                            </form>
                            <button class="btn btn-outline-danger btn-block mt-2" onclick="contacts()">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        <!--<center>
            <br><br><br><br>
            
            <h1> Change Password </h1>
            Old Password: <input type="password" name="Password" placeholder="Password" id = "oldpass" required><br><br>
            New Password: <input type="password" name="Password" placeholder="Password" id = "newpass" required><br><br>
            Confirm Password: <input type="password" name="Password" placeholder="Password" id = "confirmpass" required><br><br>
            
            <button onClick="send()"> Submit</button>
        </center>--> 
        
        <script>
        function send(){
            
            var pack = {
                UserId:userid,
                OldPassword: document.getElementById("oldpass").value,
                NewPassword: document.getElementById("newpass").value,
                Confirm_pass: document.getElementById("confirmpass").value
            };
            
            var Sender = JSON.stringify(pack);
            console.log(pack);
            console.log(Sender);
            
            
            
            $.ajax({
                type: "POST",
                data: Sender,
                contentType: "application/json",
                url: "/changepassword-api.php",
                crossDomain : true,
                success:function(data){console.log(data);
                    document.getElementById("demo").innerHTML = "Successfully Changed Password.";
                    window.location = "http://poosproject.com/contact_page.php";
                },
                 error: function(data){
                        document.getElementById("demo").innerHTML = data.responseJSON.Error;
                        console.log(data[responseJSON]);
                         
                         }
                })
              
           
        }
        function exit(){
                deleteCookie("uid");
                window.location = "http://poosproject.com/login.php";
                
                }
        function deleteCookie( name ) {
                     document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                }
        function contacts(){
                window.location = "http://poosproject.com/contact_page.php";
                
                }
        function deleteCookie( name ) {
                     document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                }
        </script>

     </body>
</html>