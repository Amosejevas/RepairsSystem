 <form name="form" method="POST" action="/admin/Repairs">
   <input value="<?php echo $id ?>" type="number" name="repairId">
   <div class="form-group">
    <label for="type">Type:</label>
    <input type="text" class="form-control" id="type" name="type" value="<?php echo $type ?>">
  </div>
  <div class="form-group">
    <label for="serial">Serial:</label>
    <input type="text" class="form-control" id="serial" name="serial" value="<?php  echo $serial ?>">
  </div>
  <div class="form-group">
    <label for="device">Device:</label>
    <input type="text" class="form-control" id="device" name="device" value="<?php echo $device ?>" >
  </div>
  <div class="form-group">
    <label for="desription">Description:</label>
    <input type="text" class="form-control" id="description" name="description" value="<?php echo $description ?>">
  </div>
  <div class="form-group">
    <label for="status">Status:</label>
    <input type="text" class="form-control" id="status" name="status" value="<?php echo $status ?>">
  </div>
  <div class="form-group">
    <label for="isAccepted">Is accepted:</label>
    <input type="text" class="form-control" id="isAccepted" name="isAccepted" value="<?php echo $isAccepted ?>">
  </div>
  <input class="btn btn-default" type="submit" name="finishEdit" value="Update">
</form>