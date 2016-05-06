            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
	 					<h1>Register a repair!</h1>
	 					<hr>
	 					<?php echo $Success ?>
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?php echo form_open('RepairsController/register'); ?>
							<div class="form-ticket_type">
							    <?php echo form_error('username'); ?>
								<label for="ticket_type">Ticket type:</label>
								<input
								  type="text"
								  class="form-control"
								  id="ticket_type"
								  name="ticket_type"
								  placeholder="Warranty/Non-Warranty"
								  value= <?php echo $PrevType; ?>
								>
							</div>
							<div class="form-group">
								<label for="serial_number">Serial number:</label>
								<input
								  type="text"
								  class="form-control"
								  id="serial_number"
								  name="serial_number"
								  placeholder="Serial number from the back of your device"
								  value= <?php echo $PrevSerial; ?>
								  >
							</div>
							<div class="form-group">
								<label for="device_name">Device name:</label>
								<input
								  type="text"
								  class="form-control"
								  id="device_name"
								  name="device_name"
								  placeholder="Device type, brand, model"
								  value= <?php echo $PrevModel; ?>
								  >
							</div>
							<div class="form-group">
								<label for="fault_description">Fault description:</label>
								<textarea class="form-control" rows="3"
								  id="fault_description"
								  name="fault_description"
								  placeholder="Describe how did it happened and other details."
								></textarea>
							</div>
							<button type="submit" class="btn btn-default" >Submit</button>
						</form>
                    </div>
                </div>
            </div>