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
	<title>Admin panel</title>
</head>

<?php $this->load->view('headerComponent'); ?>
<body style="padding-top: 	50px;">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php $this->load->view('adminSideMenu'); ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
        	<div class="container-fluid">
    <?php 
        echo '<form name="form" method="POST" action="/admin/Repairs">
              <select name="orderByTypeDropdown">
                  <option style="display: none;" value="'.$_SESSION['orderRepairsType'].'" selected="selected">'.$_SESSION['orderRepairsType'].'</option>
                  <option value="repairId">id</option>
                  <option value="type">type</option>
                  <option value="serial">serial</option>
                  <option value="device">device</option>
                  <option value="description">description</option>
                  <option value="status">status</option>
                  <option value="isAccepted">device</option>
                  <option value="date">date</option>
              </select>
              <select name="orderByDropdown">
                  <option style="display: none;" value="'.$_SESSION['order'].'" selected="selected">'.$_SESSION['order'].'</option>
                  <option value="ASC">ascending</option>
                  <option value="DESC">descending</option>
              </select>
              <input type="submit" name="buttonOrderBy" value="Order by">
              <input type="text" name="filter" value="'.$_SESSION['Repairsfilter'].'">
              <input type="submit" name="buttonFilterBy" value="Filter">
              <input type="submit" name="buttonClear" value="Clear filter">
              </form>';
        echo "<table class=\"table\">";
        echo "<tr>
          <th>id</th> 
          <th>type</th> 
          <th>serial</th>
          <th>device</th>
          <th>description</th>
          <th>status</th>
          <th>isAccepted</th>
          <th>Do something</th></tr>";
    
        foreach ($repairList as $row) {
            $tmp=$row['id'];
            echo "<tr><td>"; 
            echo $row['id'];
            echo "<td>"; 
            echo $row['type'];
            echo "<td>"; 
            echo $row['serial'];
            echo "<td>"; 
            echo $row['device'];
            echo "<td>";
            echo $row['description'];
            echo "<td>";
            echo $row['status'];
            echo "<td>"; 
            echo $row['isAccepted'];
            echo "<td>"; 
            echo '  <form name="form" method="POST" action="/admin/Repairs">'.'
                        <input value="'.$tmp.'" type="hidden" name="repairId">
                        <input class="btn btn-default" type="submit" onclick="return confirm(\'Are you sure you want to delete a repair?\')" name="buttonDelete" value="Delete">
                        <input class="btn btn-default" type="submit" name="buttonEdit" value="Edit">
                    </form>';
        };
        echo "</td></tr>";
        echo "</table>";
    ?>
    <?php
        if($doEdit) {
            echo $editRepair;
        }
    ?>
</div>

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


