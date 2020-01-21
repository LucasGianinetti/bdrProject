<?php
require_once "connexion bbd.php";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
</head>
<body>
    
<form action="SignUp.php" method="post">
  <div class="container">
      <div class="row">
          <div class="col-sm-3">
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
                <hr class="mb-3">

                <label for="firstName" ><b>First Name</b></label>
                <input class="form-control" type="text" id="firstName" name="firstName" required>
              
                <label for="lastName" ><b>Last Name</b></label>
                <input class="form-control" id="lastName" type="text" name="lastName" required>
              
                <label for="birthdate" ><b>Birth date</b></label>
                <input class="form-control" type="date" id="birthDate" name="birthDate" required>
              
                <label for="pseudo" ><b>Pseudo</b></label>
                <input class="form-control" type="text" id="pseudo" name="pseudo" required>
              
                <label for="psw" ><b>Password</b></label>
                <input class="form-control" type="password" id="password" name="password" required>
              
                <hr class="mb-3">
                <input class="btn btn-primary"type="submit" id="register" name="create" value="Sign up">
              
                <a href="Login.php" class="btn btn-primary">Log in</a>
         </div>
      </div>
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script tpye="text/javascript">
        $(function(){
            $('#register').click(function(e){
                
                var valid = this.form.checkValidity();
                if(valid){
                    
                    var firstName = $('#firstName').val();
                    var lastName   = $('#lastName').val();
                    var birthDate = $('#birthDate').val();
                    var pseudo = $('#pseudo').val();
                    var password = $('#password').val();
                    
                    
                    e.preventDefault();
                    
                    $.ajax({
                        type: 'POST',
                        url: 'process.php',
                        data: {firstName:firstName,lastName:lastName,birthDate:birthDate, pseudo:pseudo,password:password},
                        success: function(data){
                                     Swal.fire(
                                      'Success!',
                                      data,
                                      'success'
                                    )
                                    
                        },
                        error: function(data){
                                     Swal.fire(
                                      'Error!',
                                      'There were errors while saving the data!',
                                      'error'
                                     )
                                    
                        }                       
                    });
                }
            });
            
        });
    </script>
</form>

</body>
</html>
