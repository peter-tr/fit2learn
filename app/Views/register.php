<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script async defer
    	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgXo2FPejxI87BxICHX_xz1H9ie8mP7m8&libraries=places&callback=initMap" type="text/javascript"
		onload="googleFunction()">
</script>

<div class="container">
      <div class="col-8 offset-2">
			<?php echo form_open(base_url().'register/new_user'); ?>
				<h2 class="text-center">Register</h2>
					<div class="form-group">
						<?php if (isset($fName)){ 
									echo '<input type="hidden" class="form-control" value="'.$fName.'" required="required" name="firstName" readonly>'; 
								} else {
									echo '<input type="text" class="form-control" placeholder="First Name" required="required" name="firstName">';
								}
						?>
					</div>
					<div class="form-group">
						<?php if (isset($lName)){ 
									echo '<input type="hidden" class="form-control" value="'.$lName.'" required="required" name="lastName" readonly>'; 
								} else {
									echo '<input type="text" class="form-control" placeholder="Last Name" required="required" name="lastName">';
								}
						?>
					</div> 
					<div class="form-group">
						<?php if (isset($email)){ 
									echo '<input type="hidden" class="form-control" value="'.$email.'" required="required" name="email" readonly>'; 
								} else {
									echo '<input type="text" class="form-control" placeholder="email" required="required" name="email">';
								}
						?>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Phone Number" required="required" name="phoneNumber">
					</div>  
					<div class="form-group">
						<input data-provide="datepicker" type="text" class="form-control" placeholder="Date of Birth" required="required" name="dob">
					</div>
					<div class="form-group">					
						<input type="text" id="address" class="form-control" placeholder="Address" required="required" name="address">
					</div>
					<?php if (isset($fName)){ 
									echo '<input type="hidden" class="form-control" value="complexNumber" name="password" readonly>
											<input type="hidden" class="form-control" value="complexNumber" name="passwordConfirm" readonly>';
								} else {
									echo '<div class="form-group">
											<input type="password" class="form-control" placeholder="Password (must be atleast 10 characters long)" required="required" name="password">
										</div>
										<div class="form-group">
											<input type="password" class="form-control" placeholder="Password Confirm" required="required" name="passwordConfirm">
										</div>';
								}
						?> 
						
					<div class="form-group">
					<?php if(isset($errors)){echo print_r($errors);}?>
					</div>
					<div class="form-group">
						<button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
					</div>
					<div class="clearfix">
						<a href="login" class="float-right">Login Instead</a>
					</div>    
			<?php echo form_close(); ?>
			<?= validation_list_errors() ?>
	</div>
</div>

<script>
	
	function googleFunction() {
		$(document).ready(function () {
			google.maps.event.addDomListener(window, 'load', initialize);
		});

		function initialize() {
			var input = document.getElementById('address');
			var autocomplete = new google.maps.places.Autocomplete(input);
		}
	}
</script>

