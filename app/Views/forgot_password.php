<script src="https://accounts.google.com/gsi/client" async defer></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>

<div class="container">
      <div class="col-6 offset-3">
	  <?php echo form_open(base_url().'forgot_password/send_token', array('method'=>'post')); ?> 
				<h2 class="text-center">Forgot Password</h2>       
				
					<div class="form-group">
					<input type="text" class="form-control" placeholder="email" required="required" name="email">
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block">Send Reset Token</button>
					</div>
			<?php echo form_close(); ?>
			
			<div><h5><a href="/login">Login?</a></h5></div>
			<h5><a href="/register">Register?</a></h5></div>


		
	</div>
</div>

