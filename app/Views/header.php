<html>

<head>
    <title>Fit2Learn</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <script>
        // Show select image using file input.
        function readURL(input) {
            $('#default_img').show();
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#select')
                        .attr('src', e.target.result)
                        .width(300)
                        .height(200);

                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Fit2Learn</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto px-4">
                <?php if (session()->get('email')) {
                    echo'
                    <li class="nav-item px-4">
                        <a href="'.base_url().'"> Home </a> 
                    </li>
                    <li class="nav-item px-4">
                        <a href="'.base_url().'user_profile"> Profile </a> 
                    </li>
                    <li class="nav-item px-4">
                        <a href="'.base_url().'course"> Courses </a> 
                    </li>
                    <li class="nav-item px-4">
                     <a href="'.base_url().'course/new_course"> New Course </a> 
                    </li>';
                }
                ?>
            </ul>
            <ul class="navbar-nav my-lg-0">
                

        </div>
        
    
        
        <a href="<?php echo base_url(); ?>shopping_cart"><i class="mx-4 fa fa-shopping-cart fa-lg" style="color: #1760de;"></i> </a> 
        
        <?php if (session()->get('email')) { ?>
            <a class="mx-4" href="<?php echo base_url(); ?>login/logout"> Logout </a>
        <?php } else { ?>
            <a class="mx-4" href="<?php echo base_url(); ?>login"> Login </a>
        <?php } ?>
    </nav>
    <div class="container-fluid">
