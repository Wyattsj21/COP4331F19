<!doctype html>
<html>
 
 <head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    
     <!--Metadata required for Bootstrap-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script>
        var userid = getCookie("uid");
        if (userid != "")
        {
            window.location = "http://poosproject.com/contact_page.php"
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
    <title>POOS Small Project</title>
    <style>
      body{
          background: url("background3.jpg") no-repeat center center fixed;
          background-repeat: no-repeat;
          background-size: cover;
        }
      .block-left { float: left; }
    .block-right { float: right; }
    </style>
    <!--<div class="wrapper">
        <div class="block-left"><button class="btn" value="Home" onclick="home()">Home</button></div>
        <div class="block-right"><button class="btn" value="Login" onclick="login()">Login</button></div>
    </div>-->
</head>    

<body>
    
    <div style="background:transparent !important" class="jumbotron">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card text-dark bg-light shadow">
                        <div class="card-body">
                            <h1 class="card-title text-dark text-center">For The Glory of Your Country</h1>
                            <form>
                                <div class="form-group row">
                                    <label for="First Name" class="col-3 col-form-label">First Name:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="First Name" placeholder="First Name" id = "first" onkeydown = "if (event.keyCode == 13) document.getElementById('signupbtn').click()" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Last Name" class="col-3 col-form-label">Last Name:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="Last Name" placeholder="Last Name" id = "last" onkeydown = "if (event.keyCode == 13) document.getElementById('signupbtn').click()" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Email" class="col-3 col-form-label">Email:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="Email" placeholder="Email" id = "email" onkeydown = "if (event.keyCode == 13) document.getElementById('signupbtn').click()" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Phone" class="col-3 col-form-label">Phone Number:</label>
                                    <div class="col">
                                        <input type="number" class = "form-control" name="Phone" placeholder="Number Only (e.g. 1234567890)" id="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(this.maxlength, this.maxLength);" maxlength = "10" onkeydown = "if (event.keyCode == 13) document.getElementById('signupbtn').click()"required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Username" class="col-3 col-form-label">Username:</label>
                                    <div class="col">
                                        <input type="username" class="form-control" name="Username" placeholder="Username" id = "user" onkeydown = "if (event.keyCode == 13) document.getElementById('signupbtn').click()" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Password" class="col-3 col-form-label">Password:</label>
                                    <div class="col">
                                        <input type="password" class="form-control" name="Password" placeholder="Password" id = "pass" onkeydown = "if (event.keyCode == 13) document.getElementById('signupbtn').click()" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Password" class="col-3 col-form-label">Confirm Password:</label>
                                    <div class="col">
                                        <input type="password" class = "form-control" name="Confirm_pass" placeholder="Confirm Password" id = "cpass"  onkeydown = "if (event.keyCode == 13) document.getElementById('signupbtn').click()"required>
                                    </div>
                                </div>
                                <p class="text-primary" id="demo"></p>
                                <button type="button" class="btn btn-outline-primary btn-block" id="signupbtn" value="Sign Up" onclick="send()" >Enlist</button>
                            </form>
                            <button class="btn btn-outline-danger btn-block mt-2" onclick="home()">Chicken Out</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--<center>
        <br><br><br><br>
        <h1> Sign Up </h1>
        
        First Name: <input type="text" name="First Name" placeholder="First Name" id = "first" required><br><br>
        Last Name: <input type="text" name="Last Name" placeholder="Last Name" id = "last" required><br><br>
        Email: <input type="text" name="Email" placeholder="Email" id = "email" required><br><br>
        Phone Number: <input type="number" name="Phone" placeholder="Number Only (e.g. 1234567890)" id="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(this.maxlength, this.maxLength);" maxlength = "10"required><br><br>
        Username: <input type="username" name="Username" placeholder="Username" id = "user" required><br><br>
        Password: <input type="password" name="Password" placeholder="Password" id = "pass" required><br><br>
        Confrim Password: <input type="password" name="Confirm_pass" placeholder="Confirm Password" id = "cpass" required><br><br>
        <button class="btn" onclick="send()"> Sign Up</button>
    </center>-->
        
        <script>
        
        function send(){
            
            var pack = {
                "First Name": document.getElementById("first").value,
                "Last Name": document.getElementById("last").value,
                Email: document.getElementById("email").value,
                Phone: document.getElementById("phone").value,
                Username: document.getElementById("user").value,
                Password: document.getElementById("pass").value,
                Confirm_pass: document.getElementById("cpass").value
            };
            
            var Sender = JSON.stringify(pack);
            console.log(pack);
            console.log(Sender);
            
            
            
            $.ajax({
                type: "POST",
                data: Sender,
                contentType: "application/json",
                url: "/signup-api.php",
                crossDomain : true,
                success:function(data){console.log(data);
                    document.getElementById("demo").innerHTML = "Successfully Signed Up! You can now login.";
                    window.location.replace("/login.php");
                },
                 error: function(data){
                        document.getElementById("demo").innerHTML = data.responseJSON.Error;
                        console.log(data[responseJSON]);
                         
                         }
                })
              
           
        }
        
        function home()
        {
            window.location = "http://poosproject.com";
        }
        
        function login()
        {
            window.location.replace("/login.php");
        }
        </script>
        <p id="demo"></p>

     <!-- Boostrap dependencies: JQuery, popper, and bootstrap javascript-->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

 </body>
 <script src="//fast.wistia.net/labs/fresh-url/v1.js" async></script>
</html>