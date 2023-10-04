<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>

<style>
  a { 
    color: inherit; 

  } 

  .card-img-top {
    width: 100%;
    height: 15vw;
    object-fit: cover;
}

</style>

<h2 class="text-center p-5">Courses</h2> 

<div class="container-fluid me-5 p-4">

<?php echo form_open(base_url().'course/', array('autocomplete'=>'off', 'id'=>'searchbar','method'=>'post', 'class'=>'form-inline my-2 my-lg-0')); ?> 

    <div class="autocomplete" style="width:300px;">
      <input id="myInput" type="text" name="searchbar" placeholder="Yoga etc">
    </div>
    <button class="btn btn-outline-success my-1 my-sm-0" type="submit">Search</button>
<?php echo form_close(); ?>



<div class="row row-cols-3 row-cols-md-3 g-4">
  
  <script>
    var courseList = []; 
  </script>

    <?php 
    foreach ($courses as $course) {
      ?>

      <script>
          courseList.push("<?php echo $course['name']?>");
      </script>
      <?php

      echo '
        <div class="col p-4">
        <a href="'.base_url().'course/'.$course['id'].'/'.$course['name'].'">
        <div class="card-img card h-100">
          <img src='.base_url().'/uploads/'.$course['thumbnail'].' class="card-img-top">
          
          <div class="card-body">
            
              <div class="row">
                <div class="col-sm-9 col-md-9" >
                  <h4 class="card-title">'.$course['name'].'</h4>
                </div>
                <div class="col-sm-9 col-md-9">
                  <h4 class="card-text">$'.$course['price'].'</h4>
                  
                </div>
                <div class="col-sm-9 col-md-9">
                  <p class="card-text">'.$course['description'].'</p>
                </div>
                <div class="col-sm-9 col-md-9">
                <h6 class="card-text">'.$course['uploadDate'].'</h6>
                </div>
            </div>
          </div>

        </div>
        </a>
      </div>
      ';
    }

  ?>

</div>
</div>

<script>

function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      
      this.parentNode.appendChild(a);
      for (i = 0; i < arr.length; i++) {
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          b = document.createElement("DIV");
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
              b.addEventListener("click", function(e) {
              inp.value = this.getElementsByTagName("input")[0].value;
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) { //up
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);

    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");

    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}

autocomplete(document.getElementById("myInput"), courseList);

</script>

<style>

* { box-sizing: border-box; }
body {
  font: 16px Arial;
}
.autocomplete {
  position: relative;
  display: inline-block;
}
input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}
input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}
input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  background-color: #e9e9e9;
}
.autocomplete-active {
  background-color: DodgerBlue !important;
  color: #ffffff;
}

</style>

<!-- https://www.w3schools.com/howto/howto_js_autocomplete.asp >

