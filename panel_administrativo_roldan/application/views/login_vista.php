<!DOCTYPE html>
<html>
  <head>
       <?php  include 'include/head.php';?>
  </head> 

<body class="login-page">
<div class="login-box">

      <div class="login-logo">
           <img src="https://www.gruporoldan.com.co/images/cliente/imagen_id_roldangr.png">
           <?php if (isset($mensaje)) echo "<br><h4><strong>".$mensaje."</strong></h4>";?>
      </div>

      <div class="login-box-body">
          <p class="login-box-msg">Acceso al sistema</p>
          <?php /*<form>*/ echo form_open('login/acceso'); ?>
              <div class="form-group has-feedback">
                  <input type="email" name="correo"  class="form-control" placeholder="Correo electronico" required>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                  <input type="password" name="clave" class="form-control" placeholder="clave" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
                  <br>
              <div class="row">
                    <div class="col-xs-8">
                        <!-- <a href= "<?php echo site_url('register') ?>  "> ¿Aún no tienes una cuenta?</a><br> -->
                        <a href="<?php echo site_url('recover') ?>">¿Olvido su clave ?</a><br>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                    </div>
              </div>
          </form>
      </div>

</div>
<?php  include 'include/js.php';?>
</body>
</html>
