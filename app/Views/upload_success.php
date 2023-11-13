<h3>Your file was successfully uploaded!</h3>

<ul>
    <?php echo $fileName;?>

</ul>

<img src=<?php echo base_url().'/public/uploads/'.$fileName?> >
<img src=<?php echo base_url().'/public/uploads/profile_pics/'.$fileName?> >
<img src=<?php echo base_url().'/public/uploads/1682263307_5d1254bb02c9af3d3649.png'?> >


<p><?= anchor(base_url().'upload', 'Upload Another File!') ?></p>