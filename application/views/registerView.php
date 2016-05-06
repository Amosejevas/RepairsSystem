<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Simple Login with CodeIgniter</title>
</head>
    <link rel="stylesheet" href="../assets/login/reset.css">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


    <link rel="stylesheet" href="../assets/login/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->

<body style="margin: 20%">
    <div class="container" style="text-align: center;">
     <div id="RegisterForm">
      <?php echo validation_errors(); ?>
     <div>
     <?php echo form_open('UsersController/register'); ?>
          <div class="input-container">
              <label for="username">Username:</label>
              <input type="text" size="20" id="username" name="username">
          </div>
          <br/>
          <div class="input-container">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email">
          </div>
          <br/>
          <div class="input-container">
              <label for="password">Password:</label>
              <input type="password" size="20" id="password" name="password"/>
          </div>
          <br/>
          <div class="input-container">
              <label for="reppass">repeat password:</label>
              <input type="password" size="20" id="reppass" name="reppass"/>
          </div>
          <br/>
          <row>
            <input type="submit" value="Finish registration"/>
            <a href="#" onclick="ToggleForms()">Login</a>
          </row>
     </form>
     </div>
    </div>
      
   </div>



   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
   <script src="../assets/login/index.js"></script>
 </body>
</html>