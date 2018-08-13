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
              <?php echo form_open('empresa/set_empresa');?>
<span>Prefijo</span>                
<input type ="text" name="Prefix" required value="<?php if(isset($get['0']['Prefix'])) echo $get['0']['Prefix'] ?>"><br>

<span>Desde</span>                  
<input type ="text" name="From" required  value="<?php if(isset($get['0']['From'])) echo $get['0']['From'] ?>"><br>

<span>Hasta</span>                  
<input type ="text" name="To" required    value="<?php if(isset($get['0']['To'])) echo $get['0']['To'] ?>"><br>

<span>Autorización de factura</span>
<input type ="text" name="InvoiceAuthorization" required value="<?php if(isset($get['0']['InvoiceAuthorization'])) echo $get['0']['InvoiceAuthorization'] ?>"><br>

<span>Fecha inicio resolución</span>
<input type ="text" name="StartDate" required value="<?php if(isset($get['0']['StartDate'])) echo $get['0']['StartDate'] ?>"><br>

<span>Fecha final resolución</span> 
<input type ="text" name="EndDate" required value="<?php if(isset($get['0']['EndDate'])) echo $get['0']['EndDate'] ?>"><br>

<span>software ID</span>            
<input type ="text" name="SoftwareID" required value="<?php if(isset($get['0']['SoftwareID'])) echo $get['0']['SoftwareID'] ?>"><br>

<span>Clave tecnica</span>          
<input type ="text" name="ClTec" required value="<?php if(isset($get['0']['ClTec'])) echo $get['0']['ClTec'] ?>"><br>

<span>Pin</span>                    
  <input type ="text" name="Pin" required value="<?php if(isset($get['0']['Pin'])) echo $get['0']['Pin'] ?>"><br>


              <input type="submit" value="guardar" />
              </form>  
          </div>
     </div>



  </div>
  <!-- js  -->
<?php  include 'include/js.php';?>
</body>
</html>
