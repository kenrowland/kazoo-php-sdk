<html>
   <head>
      <?php
          require('HostileWorkEnvironment.php');

          if ($_POST){
              $last_name    = $_POST['lname'];
              $first_name   = $_POST['fname'];
              $cage         = $_POST['cage'];
              $email        = $_POST['email'];
              $restrictions = $_POST['restrictions']; 

              var_dump($_POST); 


              $employee = new HostileWorkEnvironment;
              $employee->hire($first_name, $last_name, $email, $cage, $restrictions);
              
          }
      ?>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
   </head>
   <body style="background-color:#505050">
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Hostile Work Environment</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="hire.php">Hire</a></li>
            <li><a href="fire.php">Fire</a></li>
           </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>   
   <div class="container" >
      <div class="row">
         <div class="col-lg-2" ></div>
         <div class="col-lg-8 col-offset-6 centered" style="background-color:white">
            <h2 class=".h2">New Hire Form</h2>
            <form class="form-horizontal" role="form"  action="hire.php" method="post">
               <div class="form-group">
                  <label for="first" class="col-sm-2 control-label">First name:</label>
                  <div class="col-sm-8">
                      <input type="first" class="form-control" name="fname" placeholder="Enter First Name">
                  </div>
               </div>
               <div class="form-group">
                  <label for="last" class="col-sm-2 control-label">Last name:</label>
                  <div class="col-sm-8">
                      <input type="last" class="form-control" name="lname" placeholder="Enter Last Name">
                  </div>
               </div>
               <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email:</label>
                  <div class="col-sm-8">
                      <input type="email" class="form-control" name="email" placeholder="Enter email">
                  </div>
               </div>
               <div class="form-group">
                  <label for="cage" class="col-sm-2 control-label">Cage:</label> 
                  <div class="col-sm-8">
                     <select name="cage" class="form-control">
                        <option value="1001">1001</option>
                        <option value="1002">1002</option>
                        <option value="1003">1003</option>
                        <option value="1004">1004</option>
                        <option value="1005">1005</option>
                        <option value="1006">1006</option>
                        <option value="1007">1007</option>
                        <option value="1008">1008</option>
                        <option value="1009">1009</option>
                        <option value="1010">1010</option>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label for="restrictions" class="col-sm-2 control-label">Restrictions:</label> 
                  <div class="col-sm-8">
                     <select class="form-control" name="restriction">
                        <option value="international">International</option>
                        <option value="domestic">Domestic</option>
                        <option value="local">Local</option>
                        <option selected="selected">---</option>
                     </select>
                  </div>
               </div>
               <p>
                  <div class="col-lg-12 form-group">
                      <button type="submit" class="btn btn-block btn-lg btn-success">Hire!</button> 
                  </div>
               </p>
            </form>
            <
      </div>
      <div class="col-lg-2"></div>
   </div>
   </div>
</body>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</html>
