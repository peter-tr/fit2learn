<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">

              <div class="col-lg-7">
                <h5 class="mb-3"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Shopping List</h5>
                <hr>
		
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Shopping cart</p>
                    <p class="mb-0">You have <?php echo $size?> items in your cart</p>
                  </div>
                </div>
                <?php 
                $total = 0;
                foreach ($items as $item) {

                  echo form_open(base_url().'shopping_cart/remove_course', array('id'=>'user_form','method'=>'post'));
                  $total = $total + $item['price'];
                  
                  echo '
                    <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        
                        <div class="d-flex flex-row align-items-center">
                          <div>
                            <img
                            src='.base_url().'/uploads/'.$item['thumbnail'].'
                              class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                          </div>
                          <div class="ms-3">
                            <h5>'.$item['name'].'</h5>
                          </div>
                        </div>                      
                        <div class="d-flex flex-row align-items-center">
                          <div style="width: 80px;">
                            <h5 class="mb-0">$'.$item['price'].'</h5>
                          </div>
                          <input name="courseId" type="hidden" value="'.$item['id'].'"></input>
                          <button type="submit" class="btn" ><i class="fa fa-trash fa-lg"></i></button>
                        </div>
                      </div>
                    </div>
                    </div>
                    ';
                    
                    echo form_close();
                }
                ?>

                <a target="_blank" href="shopping_cart/genPDF">
                <h6 class="mb-3">
                  <i class="fas fa-long-arrow-alt-left me-2"></i>Download PDF</h6>
                <hr>
              </a>
                

              </div>
              
              


              <div class="col-lg-5">

                <div class="card bg-primary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Card details</h5>
                        <img src=<?php echo base_url().'/uploads/'.$picPath?> alt="Admin" 
                        class="rounded-circle img-fluid rounded-3" width="150" style="width: 45px;">
                    </div>

                    <p class="small mb-2">Card type</p>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-visa fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-amex fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                    <form class="mt-4">
                      <div class="form-outline form-white mb-4">
                        <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                          placeholder="Cardholder's Name" />
                        <label class="form-label" for="typeName">Cardholder's Name</label>
                      </div>

                      <div class="form-outline form-white mb-4">
                        <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                          placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                        <label class="form-label" for="typeText">Card Number</label>
                      </div>

                      <div class="row mb-4">
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="text" id="typeExp" class="form-control form-control-lg"
                              placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                            <label class="form-label" for="typeExp">Expiration</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="password" id="typeText" class="form-control form-control-lg"
                              placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                            <label class="form-label" for="typeText">Cvv</label>
                          </div>
                        </div>
                      </div>

                    </form>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Subtotal</p>
                      <p class="mb-2">$<?php echo $total?></p>
                    </div>

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Shipping</p>
                      <p class="mb-2">$10.00</p>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                      <p class="mb-2">Total(Incl. taxes)</p>
                      <p class="mb-2">$$<?php echo $total+10?></p>
                    </div>

                    <button type="button" class="btn btn-info btn-block btn-lg">
                      <div class="d-flex justify-content-between">
                        <span>$<?php echo $total+10?></span>
                        <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                      </div>
                    </button>

                  </div>
                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>  
</section>

<section>
	<div class="container">
		<p>"Shopping cart inspired from https://mdbootstrap.com/docs/standard/extended/shopping-carts"</p>
		<p>"Awesome Font Library"</p>
	</div>
</section>

<script>

  function delete_item() {
    console.log("dasdsdaad");
    //document.getElementById('user_form').submit();
  };

</script>

