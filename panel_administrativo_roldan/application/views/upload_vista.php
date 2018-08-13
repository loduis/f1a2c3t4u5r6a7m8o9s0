<!DOCTYPE html>
<html>
  <head>
       <?php  include 'include/head.php';?>
  </head> 

<div class="container">

  <div class="row">
        <div class="col-sm">
            <!-- One of three columns -->
        </div>
        <div class="col-sm">
            <!-- display de errores -->
        <section>   <!--error--> </section>
        </div>
        <div class="col-sm">
            <!-- One of three columns -->
        </div>
   </div>



   <div class="row">
        <div class="col-sm">
          <!-- One of three columns -->
        </div>
        <div class="col-sm">
          <!-- display upload -->
        <section> 
            <?php  if(isset($error)) echo $error;?>
            <?php echo form_open_multipart('upload/do_upload');?>
            <input type="file" name="userfile" size="20" />
            <br /><br />
            <input type="submit" value="upload" />
            </form>  
        </section>
        </div>
        <div class="col-sm">
          <!-- One of three columns -->
        </div>
   </div>



   <div class="row">
        <div class="col-sm">
          <!-- One of three columns -->
        </div>
        <div class="col-sm">
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
        <div class="col-sm">
          <!-- One of three columns -->
        </div>
   </div>

</div>
  <!-- js  -->
<?php  include 'include/js.php';?>
</body>
</html>
