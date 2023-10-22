<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div class="container">
      <div class="col-8 offset-2">
			<?php echo form_open_multipart(base_url().'course/create_course'); ?>
				<h2 class="text-center p-5">New Course</h2>       
					<div class="form-group">
                        <label class="control-label font-weight-bold">Course Name</label>
						<input type="text" class="form-control" placeholder="Name" required="required" name="name">
					</div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">Price (enter without $)</label>
						<input type="text" aria-label="Amount (to the nearest dollar)" class="form-control" placeholder="Price" required="required" name="price">
					</div>
					<div class="form-group">
                        <label class="control-label font-weight-bold">Description</label>
						<textarea name="description" class="form-control" rows="5"></textarea>
					</div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">Thumbnail</label>
						<input class="form-control form-control-sm" name="userfile" id="formFileSm" type="file">
					</div>
                    <div class="form-group">
					<?= validation_list_errors() ?>
					<?php if(isset($errors)){echo print_r($errors);}?>
					</div>
                    <div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Create new Course</button>
					</div>
			<?php echo form_close(); ?>

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

<script>

    const dragArea = document.querySelector('.drag-area');
    const dragText = document.querySelector('.header');

    dragArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        dragText.textContent = "Drop to Upload";
    });

    dragArea.addEventListener('dragleave', (event) => {
        dragText.textContent = "Drag and Drop";
    });

    dragArea.addEventListener('drop', (event) => {
        event.preventDefault();
        files = event.dataTransfer.files;
        console.log(files);
        sendRequest(files);

    });

	function sendRequest(files) {

		console.log(files);
		var xhttp = new XMLHttpRequest();	
		xhttp.open("POST", "<?php echo base_url('course/ajax'); ?>", true);           
		xhttp.setRequestHeader("X-Requested-With", "XMLHTTPRequest");
		var formData = new FormData();
        
        for (let i = 0; i < files.length; i++) {
		    formData.append("file" + i.toString(), files[i]);
        }
		xhttp.send(formData);
            
        xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {                    
                alert('Response received!');
				$response = this.responseText;
				console.log($response);   
					
			}
		};

	}        
	
</script>