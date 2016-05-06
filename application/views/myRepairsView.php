<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

 <link rel="stylesheet" href="../assets/sidebar/simple-sidebar.css">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">

<!DOCTYPE html>
<html>

<head>
	<title>Register a repair</title>
</head>

<?php $this->load->view('headerComponent'); ?>
<body style="padding-top: 	50px;">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php $this->load->view('sideMenu'); ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
        <?php echo form_open('RepairsController/myRepairs'); ?>
          <div class="input-container">
              <label for="filter">Filter:</label>
              <input type="text" size="20" id="filter" name="filter"/>
              <button><?php echo $filterButton ?></button>
          </div>
          <br/>
        </form>
        	<?php 
                echo "<table class=\"table\">";
                echo "<tr> <th>ID</th> 
                  <th>Name</th> 
                  <th>Device</th> 
                  <th>Status</th>";
                  $role = $this->User->getUserRole($this->session->userdata('username'));
                  if( $role == 'Repairman' || $role == 'Admin') {
                       echo "<th>Do something</th></tr>";
                  };
                 
                foreach ($UserRepairsList as $row)
                    {
                    $tmp=$row['repairId'];
                    $tmp1=$row['email'];
                    echo "<tr><td>"; 
                    echo $row['repairId'];
                    echo "<td>"; 
                    echo $row['device'];
                    echo "<td>"; 
                    echo $row['status'];
                    echo "<td>"; 
                    echo $row['type'];
                    echo "<td>"; 
                    if( $role == 'Repairman' || $role == 'Admin') {
                        echo '<form name="form" method="POST" action="/RepairsController/myRepairs">'.'
                                    <input value="'.$tmp.'" type="hidden" name="repairId">
                                    <input value="'.$tmp1.'" type="hidden" name="email">
                                    <input type="text" name="status">
                                    <input class="btn btn-default" type="submit" name="buttonSubmit" value="Update">
                                    <input class="btn btn-default" type="submit" name="buttonAccept" value="Accept">
                                    <input class="btn btn-default" type="submit" name="buttonDecline" value="Decline">
                                </form>';
                    };   
                }
                echo "</td></tr>";
                echo "</table>";
             ?>

        </div>
    </div>
</body>
</html>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
