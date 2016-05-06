<div class="container-fluid">
	<?php 
		echo '<form name="form" method="POST" action="/admin/Users">
        	      <input class="btn btn-default" type="submit" name="buttonCreate" value="Create new user">
			  </form>';
        echo '<form name="form" method="POST" action="/admin/Users">
              <select name="orderByTypeDropdown">
                  <option style="display: none;" value="'.$_SESSION['orderType'].'" selected="selected">'.$_SESSION['orderType'].'</option>
                  <option value="repairId">repairId</option>
                  <option value="username">username</option>
                  <option value="email">email</option>
                  <option value="roleId">role</option>
              </select>
              <select name="orderByDropdown">
                  <option value="ASC">ascending</option>
                  <option value="DESC">descending</option>
              </select>
              <input type="submit" name="buttonOrderBy" value="Order by">
              <input type="text" name="filter" value="'.$_SESSION['Usersfilter'].'">
              <input type="submit" name="buttonFilterBy" value="Filter">
              <input type="submit" name="buttonClear" value="Clear filter">
              </form>';
        echo "<table class=\"table\">";
        echo "<tr>
          <th>id</th> 
          <th>username</th> 
          <th>email</th>
          <th>role</th>
          <th>Do something</th></tr>";
    
        foreach ($userList as $row){
            $tmp=$row['id'];
            $name=$row['username'];
            echo "<tr><td>"; 
            echo $row['id'];
            echo "<td>"; 
            echo $row['username'];
            echo "<td>"; 
            echo $row['email'];
            echo "<td>"; 
            echo $row['roleId'];
            echo "<td>"; 
            echo '  <form name="form" method="POST" action="/admin/Users">'.'
	                    <input value="'.$tmp.'" type="hidden" name="userId">
	                    <input class="btn btn-default" type="submit" onclick="return confirm(\'Are you sure you want to delete '.$name.'?\')" name="buttonDelete" value="Delete">
	                    <input class="btn btn-default" type="submit" onclick="return confirm(\'Are you sure you want to block '.$name.'?\')" name="buttonBlock" value="Block">
	                    <input class="btn btn-default" type="submit" name="buttonEdit" value="Edit">
                    </form>';
        };
        echo "</td></tr>";
        echo "</table>";
    ?>
</div>
