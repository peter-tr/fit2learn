<script src="https://accounts.google.com/gsi/client" async defer></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>

<div class="container">
      <div class="col-4 offset-4">
	  <?php echo form_open(base_url().'login/check_login', array('id'=>'login_form','method'=>'post')); ?> 
				<h2 class="text-center">Login</h2>       
				
					<div class="form-group">
					<?php if(isset($_COOKIE['email'])) {
							echo '<input type="text" class="form-control" value='.$_COOKIE['email'].' required="required" name="username">';
						} else {
							echo '<input type="text" class="form-control" placeholder="email" required="required" name="username">';	
						} ?>	
					</div>
					<div class="form-group">
					<?php if(isset($_COOKIE['password'])) {
							echo '<input type="password" class="form-control" value='.$_COOKIE['password'].' required="required" name="password">';
						} else {
							echo '<input type="password" class="form-control" placeholder="password" required="required" name="password">';	
						} ?>	
					</div>
					<div class="form-group">
					<div class="g-recaptcha" data-sitekey="6LcmurglAAAAAJvp4P1U1tBP4kqTGmG0Egw13sLO"></div>
					</div>
					<div class="form-group">
					<?php echo $error; ?>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block">Log in</button>
					</div>
					<div class="clearfix">
						<label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
						<a href="/forgot_password" class="float-right">Forgot Password?</a>
					</div>    
			<?php echo form_close(); ?>
			<div><h5><a href="register">Register?</a></h5></div>

			<div id="g_id_onload"
				data-client_id="824149307833-rf7n7f39ms75cuhrq2vfkkc07nckiuds.apps.googleusercontent.com"
				data-callback="sendRequest"
				data-context="signin"
				data-ux_mode="popup"
				data-auto_prompt="false">
			</div>

			<div class="g_id_signin"
				data-type="standard"
				data-shape="rectangular"
				data-theme="outline"
				data-text="signin_with"
				data-size="large"
				data-logo_alignment="left">
			</div>
		
	</div>
</div>

<?php echo form_open(base_url().'register/google_account', array('id'=>'google_form','method'=>'post')); ?>     
	<input id="google_id" type="hidden" placeholder="" name="id" >
	<input id="google_email" type="hidden" placeholder="" name="email" >
	<input id="google_fName" type="hidden" placeholder="" name="fName" >
	<input id="google_lName" type="hidden" placeholder="" name="lName" >
<?php echo form_close(); ?>


<script>

		function sendRequest(googleUser) {

			console.log(googleUser);
			var xhttp = new XMLHttpRequest();	
			xhttp.open("POST", "<?php echo base_url('auth/ajax'); ?>", true);           
			xhttp.setRequestHeader("X-Requested-With", "XMLHTTPRequest");
			var formData = new FormData();
			formData.append("id_token", googleUser.credential);
			xhttp.send(formData);
            
            xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {                    
                   alert('Response received!');
					$response = this.responseText;
					console.log($response);   
					
					const myArray = $response.split("/");
					$id = myArray[0];
					$fName = myArray[1];
					$lName = myArray[2];
					$email = myArray[3];

					console.log($email);

					document.getElementById('google_id').value = $id;
					document.getElementById('google_email').value = $email;
					document.getElementById('google_fName').value = $fName;
					document.getElementById('google_lName').value = $lName;
					document.getElementById('google_form').submit();
				}
			};

		}        
		
	</script>
