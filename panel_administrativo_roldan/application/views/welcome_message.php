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
  <div class="container box">

    <div class="row ">
        <br>  <br>  <br>
          <div class="col-md-8 col-md-offset-2"><!-- display de errores --><section>   <!--error--> </section></div>
     </div>

      <div class="row ">
        <br>
          <div class="col-md-12 col-md-offset-2">
          <section class="table-responsive">
              <table class="table table-striped  text-secondary">
                <thead >
                  <tr>
                    <th>No. Factura        </th>
                    <!-- <th>Facturado A        </th> -->
                    <!-- <th>Nombre             </th> -->
                    <!-- <th>Fecha de Factura   </th> -->
                    <!-- <th>Valor total       </th> -->
                    <th>xml               </th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($facturas as $key => $value){ ?>
                  <tr>
                    <td>            <?php echo $value['factura_numero'];?>            </td>
                    <!-- <td>            <?php echo $value['tercero_numero'];?>            </td> -->
                    <!-- <td>            <?php echo $value['tercero_nombre'];?>            </td> -->
                    <!-- <td>            <?php echo $value['factura_fecha']; ?>            </td> -->
                    <!-- <td>            <?php echo $value['PayableAmount']; ?>            </td> -->
                    <td> <textarea> <?php echo $value['xml'];           ?></textarea> </td>
                          <!-- acciones iconos descargar renviar a correo enviar dian -->
                          <td> 
                              <a href="#" title="Descargar" class="text-secondary">
                                  <span class="fa fa-download">XML</span>
                              </a>
                              <a href="#" title="Renviar  Correo" class="text-secondary">
                                  <span class="fa fa-envelope">Mail</span>
                              </a> 
                              <a href="
                                        <?php echo site_url('dian/dian');?>
                              " title="enviar dian" class="text-secondary">
                                 <span class="fa fa-telegram">Dian</span>
                              </a>
                          </td>

                  </tr>
                  <?php  } ?>
                  
                </tbody>
              </table>
            </section>
          </div>
    </div>
  <br><br>
  </div>

  <!-- js  -->
<?php  include 'include/js.php';?>
</body>
</html>