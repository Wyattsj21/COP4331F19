<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>


var userid = parseInt(getCookie("uid"));
if (userid == "")
{
    window.location = "http://poosproject.com/login.php"
}
    
function contacts(){
    console.log(userid);
        
                 var pack = {
                    UserID: userid,
                    Input: ""
                        };
    
                    var Sender = JSON.stringify(pack);
                    
        $.ajax({
                        type: "POST",
                        data: Sender,
                        contentType: "application/json",
                        url: "/read_contact.php",
                        crossDomain : true,
                        success:function(data){console.log(data);
                            var json = data.responseJSON;
                            document.cookie ="userid = this.id";
                           
                            }
                            
                            
                            
                });
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
     <script>
     //    contacts();
     </script>
     
  <title>POOS Small Project</title>
    <style>
      body{
          background: url("background3.jpg") no-repeat center center fixed;
          /*background-attachment: fixed;*/
          background-repeat: no-repeat;
          background-size: cover;
      }
      
      div {
            resize: none;
            overflow: auto;
        }
      
      tbody, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        background: white;
        
            }
            th, td {
                padding: 15px;
            }
        /* Button used to open the contact form - fixed at the bottom of the page */
    .open-button {
        display:none;
      background-color: #555;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      opacity: 0.8;
      position: fixed;
      bottom: 23px;
      right: 28px;
      width: 280px;
    }
    
    /* The popup form - hidden by default */
    .form-popup {
      display: none;
      position: fixed;
      bottom: 0px;
      top: 30px;
      right: 210px;
      left: 210px;
      border: none;
      z-index: 9;
    }
    
    /* Add styles to the form container */
    .form-container {
      max-width: 300px;
      padding: 10px;
      background-color: #D3D3D3;
      
    }
    
    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=number] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
    }
    
    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }
    
    /* Set a style for the button */
    .form-container .btn {
      background-color: #4CAF50;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
      margin-bottom:10px;
      opacity: 0.8;
    }
    
    /* Add a red background color to the cancel button */
    .form-container .cancel {
      background-color: red;
    }
    
    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
      opacity: 1;
    }
    .block-left { float: left; }
    .block-right { float: right; }
      </style>
      <div class="wrapper">
    
    <div class="block-left"><button class="btn btn-primary btn-block" value="Change User Password" onclick="changepassword()">Change User Password</button></div>
    <div class="block-right"><button class="btn btn-danger btn-block" value="Logout" onclick="logout()">Logout</button></div>
    </div>

     </head>
     
     <body onload = "search()">

        <center>
            
            
            
            <br><br><br><br>
            
            <h1><font color ="gradient"><strong> Welcome to the Contact Manager </strong></font></h1>



                  <div style="background:transparent !important" class="jumbotron">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-9">
                    <div class="card text-dark bg-light shadow">
                        <div class="card-body">
                            <form>
                                <div class="form-group row">
                                    <label for="Search Contact" class="col-3 col-form-label">Search Contact:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="input" id="input" oninput="search()" placeholder="Type Here">
                                    </div>
                                </div>
                                <input type="button" class= "btn btn-outline-primary btn-block" value="Search" onclick="search()">
                            </form>
                            <button class="btn btn-outline-primary btn-block" value="Add Contact" onClick="addForm()" /><i class="fa fa-plus"></i>Add A New Contact</button>
                            <br>
                            <tbody>
                            <table id = "myTable">
                            </table>
                            </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

            
        <div class="form-popup" id="editForm">
          <form class="form-container">
          <center>
            <h1>Edit Contact</h1>
            <b>Leave field blank if you don't want to edit the contact</b><br><br>
            <font color ="red"><p class="text-primary" id="editerror"></p></font>
            <label for="firstname"><b>First Name</b></label>
            <input type="text" placeholder="Enter New First Name" name="firstname" id="newfirst" onkeydown = "if (event.keyCode == 13) document.getElementById('editbtn').click()">
            
             <label for="lastname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter New Last Name" name="lastname" id="newlast"onkeydown = "if (event.keyCode == 13) document.getElementById('editbtn').click()">
            
             <label for="phone"><b>Phone Number</b></label><br>
            <input type="number" placeholder="Enter New Phone Number" name="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(this.maxlength, this.maxLength);" maxlength = "10" id="newphone" onkeydown = "if (event.keyCode == 13) document.getElementById('editbtn').click()">
            <br>
             <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter New Email" name="email" id="newemail" onkeydown = "if (event.keyCode == 13) document.getElementById('editbtn').click()" >
        

        
            <input type="button" onclick="editContact()"class="btn" value="Submit" id="editbtn">
            <input type="button" class="btn cancel" onclick="closeForm()" value = "Close">
            </center>
          </form>
        </div>
        
        
        <div class="form-popup" id="deleteForm">
          <form class="form-container">
          <center>
            <h1>Are you really SURE that you want to DELETE this contact?</h1>
            <font color ="red"><p class="text-primary" id="deleteerror"></p></font>
            <input type="button" onclick="deleteContact()"class="btn" value="Heck yeah">
            <input type="button" class="btn cancel" onclick="closeDelete()" value = "My bad, clicked by mistake">
            </center>
          </form>
        </div>
        
        <div class="form-popup" id="addForm">
          <form class="form-container">
          <center>
            <h1>Add Contact</h1>
            <font color ="red"><p class="text-primary" id="adderror"></p></font>
            <label for="firstname"><b>First Name</b></label>
            <input type="text" placeholder="Enter New First Name" name="firstname" id="addfirst" onkeydown = "if (event.keyCode == 13) document.getElementById('addbtn').click()" required>
            
             <label for="lastname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter New Last Name" name="lastname" id="addlast" onkeydown = "if (event.keyCode == 13) document.getElementById('addbtn').click()" required>
            
             <label for="phone"><b>Phone Number</b></label><br>
            <input type="number" placeholder="Enter New Phone Number" name="phone" id="addphone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(this.maxlength, this.maxLength);" maxlength = "10" onkeydown = "if (event.keyCode == 13) document.getElementById('addbtn').click()"required>
            <br>
             <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter New Email" name="email" id="addemail" onkeydown = "if (event.keyCode == 13) document.getElementById('addbtn').click()"required>
        

        
            <input type="button" onclick="addContact()"class="btn" value="Submit" id="addbtn">
            <input type="button" class="btn cancel" onclick="closeAdd()" value = "Close">
            </center>
          </form>
        </div>
        
            <input type = "hidden" id="ContactID" value="">
            <script>
                function changepassword()
                {
                    window.location = "http://poosproject.com/changepassword.php";
                }
                function logout(){
                    deleteCookie("uid");
                    window.location = "http://poosproject.com/login.php";
                }
               
                function search()
                {
                    
                   var pack = {
                    UserID: userid,
                    Input: document.getElementById("input").value
                        };
    
                    var Sender = JSON.stringify(pack);
                    
                    $.ajax({
                        type: "POST",
                        data: Sender,
                        contentType: "application/json",
                        url: "/read_contact.php",
                        crossDomain : true,
                        success:function(data){console.log(data);
                            var json = data.responseJSON;
                            let a = (data.contacts).length - 1;
                            var table = document.getElementById("myTable");
                            table.innerHTML="";
                            
                            while(a>=0){
                            console.log(data.contacts[a]);
                            var hold = (data.contacts[a]);
                            var row = table.insertRow(0);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            var cell4 = row.insertCell(3);
                            var cell5 = row.insertCell(4);
                            var cell6 = row.insertCell(5);
                            cell1.innerHTML = hold.FirstName;
                            cell2.innerHTML = hold.LastName;
                            cell3.innerHTML = hold.PhoneNumber;
                            cell4.innerHTML = hold.Email;
                            cell5.innerHTML = '<button class="btn btn-outline-primary btn-block" value="Edit" onClick="update(\'' + hold.ContactID + '\')" /><i class="fa fa-pencil"></i></button>';
                            cell6.innerHTML = '<button class="btn btn-outline-warning btn-block" onClick="deletes(\'' + hold.ContactID + '\')" /><i class="fa fa-trash"></i></button>';
                            a--;
                            }
                            tableHead();
                        },
                        error:function(data){console.log(data);
                            var table = document.getElementById("myTable");
                            table.innerHTML="";
                            tableHead();
                        }
                    });
                }
                
                function tableHead()
                {
                    var table = document.getElementById("myTable");
                    var header = table.createTHead();
                    var row = header.insertRow(0);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "<b>First Name</b>";
                    cell = row.insertCell(1);
                    cell.innerHTML = "<b>Last Name</b>";
                    cell = row.insertCell(2);
                    cell.innerHTML = "<b>Phone</b>";
                    cell = row.insertCell(3);
                    cell.innerHTML = "<b>Email</b>";
                    cell = row.insertCell(4);
                    cell.innerHTML = "<b>Edit</b>";
                    cell = row.insertCell(5);
                    cell.innerHTML = "<b>Delete</b>";
                }
                
                function update(contactId)
                {
                    document.getElementById("ContactID").value = contactId;
                    openForm();
                }
                
                function deletes(contactId)
                {
                    document.getElementById("ContactID").value = contactId;
                    deleteForm();
                }
                

                function openForm()
                {
                    document.getElementById("editForm").style.display = "block";
                }

                function closeForm() 
                {
                    document.getElementById("editForm").style.display = "none";
                }
                
                function deleteForm()
                {
                    document.getElementById("deleteForm").style.display = "block";
                }
                
                function closeDelete()
                {
                    document.getElementById("deleteForm").style.display = "none";
                }
                
                function addForm()
                {
                    document.getElementById("addForm").style.display = "block";
                }
                
                function closeAdd()
                {
                    document.getElementById("addForm").style.display = "none";
                }
                
                function editContact()
                {
                    var pack = {
                    UserID: userid,
                    ContactID: document.getElementById("ContactID").value,
                    "First Name": document.getElementById("newfirst").value,
                    "Last Name": document.getElementById("newlast").value,
                    Phone: document.getElementById("newphone").value,
                    Email: document.getElementById("newemail").value
                        };
    
                    var Sender = JSON.stringify(pack);
                    
                    $.ajax({
                        type: "POST",
                        data: Sender,
                        contentType: "application/json",
                        url: "/edit_contact.php",
                        crossDomain : true,
                        success:function(data){console.log(data);
                            document.getElementById("editerror").innerHTML = "Successfully Edited Contact";
                            setTimeout(function(){
                                window.location.reload();
                                },1000);
                        },
                        error:function(data){console.log(data);
                            document.getElementById("editerror").innerHTML = data.responseJSON.Error;
                        
                        }
                    });
                }
                
                function deleteContact()
                {
                    var pack = {
                    UserID: userid,
                    ContactID: document.getElementById("ContactID").value
                        };
    
                    var Sender = JSON.stringify(pack);
                    
                    $.ajax({
                        type: "POST",
                        data: Sender,
                        contentType: "application/json",
                        url: "/delete_contact.php",
                        crossDomain : true,
                        success:function(data){console.log(data);
                            document.getElementById("deleteerror").innerHTML = "Successfully Deleted Contact";
                            setTimeout(function(){
                                window.location.reload();
                                },1000);
                            
                        },
                        error:function(data){console.log(data);
                            document.getElementById("deleteerror").innerHTML = data.responseJSON.Error;
                        
                        }
                    });
                }
                
                function addContact()
                {
                    var pack = {
                        UserID: userid,
                        "First Name": document.getElementById("addfirst").value,
                        "Last Name": document.getElementById("addlast").value,
                        Email: document.getElementById("addemail").value,
                        Phone: document.getElementById("addphone").value
                    };
                    
                    var Sender = JSON.stringify(pack);

                    $.ajax({
                        type: "POST",
                        data: Sender,
                        contentType: "application/json",
                        url: "/create_contact.php",
                        crossDomain : true,
                        success:function(data){console.log(data);
                            document.getElementById("adderror").innerHTML = "Successfully Added Contact";
                            setTimeout(function(){
                                window.location.reload();
                                },1000);
                        },
                         error: function(data){
                            document.getElementById("adderror").innerHTML = data.responseJSON.Error;     
                                 }
                        });
                }
                
                function deleteCookie( name ) {
                     document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                }
            </script>
            
            
            <!--<center><div class ="open-button"><a href="http://getamped2.cyberstep.com/" target="_blank"><img src="shooting.gif"></a></div></center>-->
        </center>


     </body>

</html>
