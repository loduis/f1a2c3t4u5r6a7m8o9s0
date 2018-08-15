<!DOCTYPE html>
<html>
  <head>
       <?php  include 'include/head.php';?>
  </head> 
<body>
<?php  include 'include/nav.php';?>
  <div class="container box">

    <div class="row ">
            <br>
          <div class="col-md-8 col-md-offset-2"><!-- display de errores --><section>   <!--error--> </section></div>
     </div>

     <div class="row ">
        <br>
          <div class="col-md-8 col-md-offset-2">

<?php  echo form_open('empresa/set_empresa','class="form-inline"'); ?>


<div class="form-group">
        <label for="Prefix">Prefijo</label>                
        <input class="form-control" type ="text" name="Prefix" required value="<?php if(isset($get['0']['Prefix'])) echo $get['0']['Prefix'] ?>">
</div>

<div class="form-group"> 
          <label for="Prefix">Desde</label>                  
          <input class="form-control" type ="text" name="From" required  value="<?php if(isset($get['0']['From'])) echo $get['0']['From'] ?>">
</div>

<div class="form-group"> 
          <label for="Prefix">Hasta</label>                  
          <input class="form-control" type ="text" name="To" required    value="<?php if(isset($get['0']['To'])) echo $get['0']['To'] ?>">
</div>

<div class="form-group"> 
          <label for="Prefix">Autorización de factura</label>
          <input class="form-control" type ="text" name="InvoiceAuthorization" required value="<?php if(isset($get['0']['InvoiceAuthorization'])) echo $get['0']['InvoiceAuthorization'] ?>">
</div>

<div class="form-group"> 
          <label for="Prefix">Fecha inicio resolución</label>
          <input class="form-control" type ="text" name="StartDate" required value="<?php if(isset($get['0']['StartDate'])) echo $get['0']['StartDate'] ?>">
</div>

<div class="form-group"> 
          <label for="Prefix">Fecha final resolución</label> 
          <input class="form-control" type ="text" name="EndDate" required value="<?php if(isset($get['0']['EndDate'])) echo $get['0']['EndDate'] ?>">
</div>

<div class="form-group"> 
          <label for="Prefix">software ID</label>            
          <input class="form-control" type ="text" name="SoftwareID" required value="<?php if(isset($get['0']['SoftwareID'])) echo $get['0']['SoftwareID'] ?>">
</div>

<div class="form-group"> 
          <label for="Prefix">Clave tecnica</label>          
          <input class="form-control" type ="text" name="ClTec" required value="<?php if(isset($get['0']['ClTec'])) echo $get['0']['ClTec'] ?>">
</div>

<div class="form-group"> 
          <label for="Prefix">Pin</label>                    
          <input class="form-control" type ="text" name="Pin" required value="<?php if(isset($get['0']['Pin'])) echo $get['0']['Pin'] ?>">
</div>


              <input type="submit" value="guardar" />
              </form>  
          </div>
     </div>



  </div>
  <!-- js  -->
<?php  include 'include/js.php';?>
</body>
</html>
