<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php //header("Content-type: text/xml"); echo $xml['1']['xml']; ?>
<!DOCTYPE html>
<html>
  <head>
       <?php  include 'include/head.php';?>
  </head> 
<body>
  <?php  include 'include/nav.php';?>
  <h3>Su archivo fue cargado correctamente</h3>
  <div class="container box">

    <div class="row ">
        <br>  <br>  <br>
          <div class="col-md-8 col-md-offset-2"><!-- display de errores --><section>   <!--error--> </section></div>
     </div>

	    <div class="row ">
		        <br>
		          <div class="col-md-8 col-md-offset-2">

				<ul class="list-group"><?php 
					 foreach ($resultado as $item => $value):?>
							<li class="list-group-item"><?php echo $item;?>: <?php echo $value;?></li>
					<?php endforeach; ?>
				</ul>

				<p><?php echo anchor('upload', 'Sube otro archivo!'); ?></p>
	     </div>
     </div>
  <br><br>
  </div>

  <!-- js  -->
<?php  include 'include/js.php';?>
</body>
</html>
