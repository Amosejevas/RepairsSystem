 <form name="form" method="POST" action="/admin/Users">
   <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password" >
  </div>
  <div class="form-group">
    <label for="role">roleId:</label>
    <input type="text" class="form-control" id="role" name="role">
  </div>
  <input class="btn btn-default" type="submit" name="createUser" value="Edit">
</form>