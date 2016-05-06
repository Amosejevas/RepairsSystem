 <form name="form" method="POST" action="/admin/Users">
   <input value="<?php echo $id ?>" type="number" name="userId">
   <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>">
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php  echo $email ?>">
  </div>
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password" >
  </div>
  <div class="form-group">
    <label for="role">roleId:</label>
    <input type="text" class="form-control" id="role" name="role" value="<?php echo $role ?>">
  </div>
  <input class="btn btn-default" type="submit" name="finishEdit" value="Edit">
</form>