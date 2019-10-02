<html>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>

let params = new URLSearchParams(document.location.search.substring(1));
var userid = params.get("uid");
    if (userid != null){}
    else
    {
        window.location = "http://poosproject.com/login.php";
    }

</script>

 <head>
  <title>POOS Small Project</title>
  <style>
      body{
          background-image: url("back.png");
          background-repeat: no-repeat;
          background-size: cover;

      }
  </style>

  <div align = "right">
      <button onclick="exit()"> Log out</button>
  </div>
  <div align = "left">
      <button onclick="home()"> Home</button>
  </div>
 </head>

 <body>
    <center>
        <br><br><br><br>
        <h1> Add New Contact </h1>
        First Name: <input type="text" name="First Name" placeholder="First Name" id = "first" required><br><br>
        Last Name: <input type="text" name="Last Name" placeholder="Last Name" id = "last" required><br><br>
        Email: <input type="text" name="Email" placeholder="Email" id = "email" required><br><br>
        Phone Number: <input type="number" name="Phone" placeholder="Number Only (e.g. 1234567890)" id="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(this.maxlength, this.maxLength);" maxlength = "10"required><br><br>
        <button onclick="send()"> Add Contact</button>
        
        <script>
        
        function send(){
            
            var pack = {
                UserID: userid,
                "First Name": document.getElementById("first").value,
                "Last Name": document.getElementById("last").value,
                Email: document.getElementById("email").value,
                Phone: document.getElementById("phone").value
            };
            
            var Sender = JSON.stringify(pack);
            console.log(pack);
            console.log(Sender);
            
            
            
            $.ajax({
                type: "POST",
                data: Sender,
                contentType: "application/json",
                url: "/create_contact.php",
                crossDomain : true,
                success:function(data){console.log(data);
                    document.getElementById("demo").innerHTML = "Successfully added contact";
                    // window.location.replace("/login.php");
                },
                 error: function(data){
                        document.getElementById("demo").innerHTML = data.responseJSON.Error;
                        console.log(data[responseJSON]);
                         
                         }
                })
        }
        function home()
        {
            window.location = "http://poosproject.com/contact_page.php?uid=" +userid;
        }
        function exit()
        {
            window.location = "http://poosproject.com/"
        }
        </script>
        <p id="demo"></p>
    </center>

 </body>
 
</html>
