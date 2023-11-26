<script src="https://accounts.google.com/gsi/client" async defer></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>

<div class="container">
      <div class="col-8 offset-2">
			<?php echo form_open(base_url().'forgot_password/verify_token'); ?>
				<h3 class="text-center">An Email has been sent with a reset Token. Please input 6 digit number to reset your password</h3>
					<div class="form-group">
						<input type="text" placeholder="Email" class="form-control" required="required" name="email">
					</div>
					<div class="form-group">
						<input type="text" placeholder="New Password" class="form-control" required="required" name="password">
					</div> 
					<div class="form-group">
						<input type="text" placeholder="Password Confirm" class="form-control" required="required" name="passwordConfirm">
					</div>     
					<div class="form-group">
						<input type="text" placeholder="Forgot Token" class="form-control" required="required" name="forgotToken">
					</div>
					<div class="form-group">
					<?php echo $error; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Submit</button>
					</div>
			<?php echo form_close(); ?>
		
			
			<div><h5><a href="/login">Login?</a></h5></div>
			<h5><a href="/register">Register?</a></h5></div>


		
	</div>
</div>

