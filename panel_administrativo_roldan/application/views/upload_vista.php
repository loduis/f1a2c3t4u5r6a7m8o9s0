<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
  <head>
       <?php  include 'include/head.php';?>
  </head> 
<body>
  <?php  include 'include/nav.php';?>
  <div class="container box">

    <div class="row ">
        <br>  <br>  <br>
          <div class="col-md-8 col-md-offset-2"><!-- display de errores --><section>   <!--error--> </section></div>
     </div>

     <div class="row ">
        <br>
          <div class="col-md-8 col-md-offset-2">
              <?php  if(isset($error)) echo $error;?>
              <?php echo form_open_multipart('upload/do_upload');?>
              <input type="file" name="userfile" size="20" />
              <input type="submit" value="upload" />
              </form>  
          </div>
     </div>
  <br><br>
  </div>

  <!-- js  -->
<?php  include 'include/js.php';?>
</body>
</html>
