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
          <div class="col-md-8 col-md-offset-2"><!-- display de errores --><section>   <--error--> </section></div>
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


    <div class="row ">
        <br>
          <div class="col-md-8 col-md-offset-2">
          <section>
              <table border="1">
                <thead>
                  <tr>
                    <th>No. Factura     </th>
                    <th>Facturado A     </th>
                    <th>Fecha de Factura  </th>
                    <th>Fecha Envio     </th>
                    <th>Respuesta     </th>
                    <th>Ver         </th>
                    <th>Renviar       </th>
                    <th>Otro        </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>No. Factura     </td>
                    <td>Facturado A     </td>
                    <td>Fecha de Factura  </td>
                    <td>Fecha Envio     </td>
                    <td>Respuesta     </td>
                    <td>Ver         </td>
                    <td>Renviar       </td>
                    <td>Otro        </td>
                  </tr>
                </tbody>
              </table>
            </section>
          </div>
    </div>

  </div>
  <!-- js  -->
<?php  include 'include/js.php';?>
</body>
</html>
