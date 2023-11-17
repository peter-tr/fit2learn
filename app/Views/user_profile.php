<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script async defer
    	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgXo2FPejxI87BxICHX_xz1H9ie8mP7m8&libraries=places&callback=initMap" type="text/javascript">
		  onload="googleFunction()">
</script>
<script>

      function submit() {
        document.getElementById('user_form').submit();
      }
      function changeInputs() {

        $("#editButton").removeClass("btn-info");
        $("#editButton").addClass("btn-success");

        document.getElementById('editButton').innerHTML = 'Submit';
        $(".change").each(function (index, element) {
          $(this).attr("readonly", false);
          $(this).removeClass("border-0");
          $(this).addClass("form-control");
        
          });
      }

      var toggle = 0;
      function editClick() {
        toggle = toggle + 1;
        if (toggle % 2 == 1) {
          changeInputs();
        } else {
          submit();
        }
      }

</script>

</br>
<div class="container">
    <div class="main-body">
        
          <div class="row gutters-mg">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src=<?php echo base_url().'/uploads/'.$picPath?> alt="Admin" class="rounded-circle" width="150" height="150">
                    <div class="mt-6">
                      <h4><?php echo $name?></h4>
                      <a class="btn btn-primary" data-toggle="collapse" 
                      href="#collapseExample" role="button" aria-expanded="false" 
                      aria-controls="collapseExample">Change Profile Picture</a>
                            <div class="collapse" id="collapseExample">
                              <div class="card card-body">
                            <?= form_open_multipart(base_url().'upload/profile_pic') ?>
                          <input class="form-control form-control-sm" name="userfile" id="formFileSm" type="file">
                          <input class="form-control form-control-sm" type="submit">
                          <?php echo form_close(); ?>
                              </div>
                          </div>
                     

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
            <?php echo form_open(base_url().'user_profile/update', array('id'=>'user_form','method'=>'post')); ?> 
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="email" class="border-0 col-lg-12" value='<?php echo $email?>' readonly></input>
                    
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">First Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="fName" class="change border-0 col-lg-12" value='<?php echo $fName?>' readonly></input>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Last Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="lName" class="change border-0 col-lg-12" value='<?php echo $lName?>' readonly></input>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="phone" class="change border-0 col-lg-12" value='<?php echo $phone?>' readonly></input>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input id= "address" name="address" class="change border-0 col-lg-12" value="<?php echo $address?>" readonly></input>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a id="editButton" class="btn btn-info " onclick = "editClick()">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <iframe width="640" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $address; ?>&output=embed"></iframe>  
          </div>
        </div>
        <?php echo form_close(); ?>      
        
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





