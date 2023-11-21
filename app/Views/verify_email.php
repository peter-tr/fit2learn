<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div class="container">
      <div class="col-8 offset-2">
			<?php echo form_open(base_url().'check_otp/'.$email.''); ?>
				<h3 class="text-center">An Email has been sent with a One Time Password (OTP). Please input 6 digit number to verify your email</h3>       
					<div class="form-group">
						<input type="number" class="form-control" required="required" name="otp">
					</div>
					<div class="form-group">
					<?php echo $error; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Verify</button>
					</div>
			<?php echo form_close(); ?>
		
	</div>
</div>
