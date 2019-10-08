<!DOCTYPE html>
<html>
 <head>
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
    </style>
 </head>

 <script>
    function send(){
        var pack = {
            Username: document.getElementById("Username").value,
            Password: document.getElementById("Password").value
            };
            
        var Sender = JSON.stringify(pack);
        
            
            
        $.ajax({
            type: "POST",
            data: Sender,
            contentType: "application/json",
            url: "/login-api.php",
            crossDomain : true,
            success:function(data){console.log(data);
                var id = (data.UserId);
                document.getElementById("demo").innerHTML = "Login Success";
                setCookie("uid",id,1);
                window.location = "http://poosproject.com/contact_page.php";
            },
            error: function(data){
                document.getElementById("demo").innerHTML = data.responseJSON.Error;
                console.log(data);
                }
        });
    }
    

    function setCookie(cname, cvalue, exdays) {
         var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=http://poosproject.com/";
}
        
    function home()
    {
        window.location = "http://poosproject.com";
    }
 </script>

 <body>
    <div style="background:transparent !important" class="jumbotron">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card text-dark bg-light shadow">
                        <div class="card-body">
                            <h1 class="card-title text-dark text-center">Go To War</h1>
                            <form>
                                <div class="form-group row">
                                    <label for="Username" class="col-3 col-form-label">Username:</label>
                                    <div class="col">
                                        <input type="username" class="form-control" id = "Username" name="Username" placeholder="Username" onkeydown = "if (event.keyCode == 13) document.getElementById('loginbtn').click()" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Password" class="col-3 col-form-label">Password:</label>
                                    <div class="col">
                                        <input type="password" class="form-control" id = "Password" name="Password" placeholder="Password" onkeydown = "if (event.keyCode == 13) document.getElementById('loginbtn').click()" required>
                                    </div>
                                </div>
                                <p class="text-primary" id="demo"></p>
                                <button type="button" class="btn btn-outline-primary btn-block" id="loginbtn" value="Login" onclick="send()">Deploy</button>
                            </form>
                            <button class="btn btn-outline-danger btn-block mt-2" onclick="home()">Chicken Out</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<center>
        <h1> <font color="red">Login Page</font> </h1>
        
        <font color="black">Username:</font> <input type="username" id = "Username" name="Username" placeholder="Username" required><br><br>
        <font color="black">Password:</font> <input type="password" id = "Password" name="Password" placeholder="Password" required><br><br>
        
        <button class="btn" value="Login" onClick="send()">Login</button>
        
        <script>
            function forgot()
            {
                window.location = "http://poosproject.com/forgot_password.php";
            }
        </script>
        <!--<button onclick="forgot()"> Forgot Password?</button>-->
    <!--</center>-->
    <!-- Boostrap dependencies: JQuery, popper, and bootstrap javascript-->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
</body>
<script src="//fast.wistia.net/labs/fresh-url/v1.js" async></script>
</html>
