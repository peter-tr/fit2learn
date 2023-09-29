<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<style>
  a { 
    color: inherit; 
  } 

  .card-img-top {
    width: 100%;
    height: 30vw;
    object-fit: cover;
}

  .admin {
  <?php if (!$admin) {
    echo 'display: none;';
    }
  ?>
  }

</style>

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

<h1 class="text-center p-5"><?php echo $name?></h1>    

<div class="container">
    <div>
        <img src='<?php echo base_url().'/uploads/'.$thumbnail?>' class="card-img-top">
          <div class="mt-6 p-3 admin">
            <a class="btn btn-primary" data-toggle="collapse" 
            href="#collapseExample" role="button" aria-expanded="false" 
            aria-controls="collapseExample">Change Thumbnail Picture</a>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <?= form_open_multipart(base_url().'course/update_thumbnail') ?>
                    <input class="form-control form-control-sm" name="userfile" id="formFileSm" type="file">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="hidden" name="name" value="<?php echo $name?>">
                    <input class="form-control form-control-sm" type="submit">
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    



<div class="col-md-10 offset-1 p-4">

<div class="row">
<div class="col-5">
  <h5 class="text-left p-2">Favourites: <?php echo count($favouriteCount) ?></h5>  

</div>


<div class="col-5">
			          <?php echo form_open_multipart(base_url().'course/favourite'); ?>   
                <div class="form-group">
                  <input name="id" type="text" value ="<?php echo $id?>" hidden>
                  <input name="email" type="text" value ="<?php echo session()->get('email')?>" hidden>
                  <?php if ($favouriteCheck) {
						      echo '<button type="submit" class="btn btn-danger btn-block">Unfavourite?</button>';
                  } else {
                  echo '<button type="submit" class="btn btn-primary btn-block">Favourite?</button>';
                  }  ?> 
					      </div>
			          <?php echo form_close(); ?>
</div>

                </div>


            <?php echo form_open(base_url().'course/update', array('id'=>'user_form','method'=>'post')); ?> 
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Owner</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="owner" class="border-0 col-lg-12" value='<?php echo $owner?>' readonly></input>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="owner" class="border-0 col-lg-12" value='<?php echo $email?>' readonly></input>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                        <div class="col-sm-3">
                      <h6 class="mb-0">Course Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="name" class="change border-0 col-lg-12" value='<?php echo $name?>' readonly></input>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Upload Date</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="uploadDate" class="change border-0 col-lg-12" value='<?php echo $uploadDate?>' readonly></input>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Price ($AUD)</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="price" class="change border-0 col-lg-12" value='<?php echo $price?>' readonly></input>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Description</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <textarea name="description" class="change border-0 col-lg-12" readonly><?php echo $description ?></textarea>
                    </div>
                  </div>
                  <hr>
                  <div class="row admin">
                    <div class="col-sm-12">
                      <a id="editButton" class="btn btn-info " onclick = "editClick()">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <input name="id" type="hidden" value='<?php echo $id?>' readonly></input>
          <?php echo form_close(); ?>

          <div class="col-5 offset-8">
			          <?php echo form_open_multipart(base_url().'shopping_cart/add_course'); ?>   
                <div class="form-group">
                  <input name="id" type="text" value ="<?php echo $id?>" hidden>
                  <input name="email" type="text" value ="<?php echo session()->get('email')?>" hidden>
                  <?php if ($pending) {
						      echo '<button type="submit" class="btn btn-success btn-block">Add to Cart</button>';
                  } else {
                  echo '<button type="submit" class="btn btn-danger btn-block">Remove from Cart</button>';
                  }  ?> 
					      </div>
			          <?php echo form_close(); ?>
              </div>



            <h2 class="text-left p-2">Resources</h2> 
            <div class="col-md-10 offset-1 p-4">

            <?php echo form_open(base_url().'course_document/update', array('id'=>'user_form','method'=>'post')); ?> 

              <div class="card mb-12">
                <div class="card-body">

                <?php 
                $counter = 0;
                foreach ($resources as $resource) {
                  $counter++;
                  #print_r($resource);
                  echo '
                  
                  <div class="row">
                    <div class="col-sm-2">
                        <h6 class="mb-0">'.$counter.'</h6>
                    </div>
                    <a target="_blank" href="'.base_url().'/uploads/'.$resource["path"].'">
                    <div class="col-sm-10">
                        <h6 class="mb-0">'.$resource['name'].'</h6>
                    </a>
                    </div>
                  </div>
                  <hr>
                  ';
                }
                ?>
                    <div class="col-sm-12 admin">
                      <a id="editButton" class="btn btn-info " onclick = "//editClick()">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <input name="id" type="hidden" value='<?php echo $id?>' readonly></input>
          <?php echo form_close(); ?>
      
          <div class="container col-10 p-4 my-3 admin">
              <h4>Upload your files</h4>
              <div class=" drag-area p-5 my-3 border">
                <div class="icon">
                  <i class="fas fa-images"></i>
                </div>
                <span class="header">Drag and Drop </span>
                <span class="header"> or <span class="btn p-1 border button">browse</span> </span>
                <input class="browse" type="file" name="userfile" hidden multiple>
              </div>
          </div>

    </div>
            
    <div class="col-10 offset-1">

    <h2 class="text-left p-2">Comments</h2> 
    
    <?php echo form_open(base_url().'course/comment/add', array('id'=>'user_form','method'=>'post')); ?> 

              <div class="card mb-12">
                <div class="card-body">

                <?php 
                $counter = 0;
                foreach ($comments as $comment) {
                  $counter++;
                  #print_r($resource);
                  echo '
                  
                  <div class="row">
                    <div class="col-sm-2">
                      <img src='.base_url().'/uploads/'.$comment['picPath'].' alt="Admin" class="rounded-circle img-fluid">
                    </div>
                    <div class="col-sm-2">
                      <h4 style="font-size: 2vw;" class="mb-0">'.$comment['firstName'].' '.$comment['lastName'].'</h4> 
                    </div>
                    <div class="col-sm-7">
                        <p>'.$comment['text'].'</p>
                    </div>
                    <div class="col-sm-9">
                        
                    </div>
                    <div class="col-sm-3">
                        <h6 class="mb-0">'.$comment['uploadDate'].'</h6>
                    </div>
                  </div>
                  <hr>
                  ';
                }
                ?>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">Add a comment</label>
						            <textarea name="comment" class="form-control" rows="5"></textarea>
					          </div>
                    <div class="col-sm-3 form-group">
						          <button type="submit" class="btn btn-primary btn-block">Publish</button>
					          </div>
                  </div>
                </div>
              </div>
            </div> 
            <input name="id" type="hidden" value='<?php echo $id?>' readonly></input>
          <?php echo form_close(); ?>

              </div>

              <div class="col-4 offset-4 p-5 m-5 admin">
			          <?php //echo form_open_multipart(base_url().'course/delete'); ?>   
                <div class="form-group">
                  <input name="id" type="text" value ="<?php echo $id?>" hidden>
						      <button type="submit" class="btn btn-danger btn-block">Delete Course</button>
					      </div>
			          <?php //echo form_close(); ?>
              </div>


  </div>
  </div>



            
<script>

  let btn = document.querySelector('.button');
  let input = document.querySelector('.browse');

  let resourses;

  btn.onclick = () => {
    input.click();
  };

  input.addEventListener('change', function() {
    files = this.files;
    console.log(files);

    sendRequest(files);

  })

    const dragArea = document.querySelector('.drag-area');
    const dragText = document.querySelector('.header');

    dragArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        console.log("file is inside the drag area");
        dragText.textContent = "Drop to Upload";
    });

    dragArea.addEventListener('dragleave', (event) => {
        console.log("file is outside the drag area");
        dragText.textContent = "Drag and Drop";
    });

    dragArea.addEventListener('drop', (event) => {
        event.preventDefault();
        console.log("file is dropped");
        
        files = event.dataTransfer.files;
        console.log(files);

        sendRequest(files);

    });

	function sendRequest(files) {

		//console.log(files);
		var xhttp = new XMLHttpRequest();	
		xhttp.open("POST", "<?php echo base_url('course/ajax'); ?>", true);           
		xhttp.setRequestHeader("X-Requested-With", "XMLHTTPRequest");
		var formData = new FormData();

      formData.append("id", <?php echo $id ?>);
        
        for (let i = 0; i < files.length; i++) {
		    formData.append("file" + i.toString(), files[i]);
        }
		xhttp.send(formData);
            
        xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {                    
                alert('Response received!');
				$response = this.responseText;
				console.log("Response: " + $response);   

        window.location.reload();
					
			}
		};

	}        
	
</script>



