<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>MyPEWEB-CMS</title>
 <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url('resources/bootstrap/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('resources/plugins/datatables/dataTables.bootstrap.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('resources/dist/css/AdminLTE.min.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url('resources/dist/css/skins/_all-skins.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('resources/select2-4.0.3/dist/css/select2.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('resources/bootstrap/css/bootstrap3-wysihtml5.min.css')?>">


  <link href="<?=base_url('resources/css/fileinput.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('resources/themes/explorer/theme.css')?>" rel="stylesheet">
   
  <!-- load the JS files in the right order -->
  <script src="<?=base_url('resources/js/fileinput.js')?>"></script>
  <script src="<?=base_url('resources/themes/explorer/theme.js')?>"></script>

 <style type="text/css">
  li,ol, li {
  margin: 0;
  padding: 0;
  list-style: none;
}
.reorder_ul> li {
        list-style: none;
        background: rgb(255, 255, 255);
        border: 1px solid rgb(196, 196, 196);
        margin: 5px 0;
        font-size: 24px;
      }

.reorder_link {
  color: #3675B4;
  border: solid 2px #3675B4;
  border-radius: 3px;
  background: #fff;
  font-size: 11px;
  padding: 50% 8%;
  font-weight: bold;
  width: 100px;
  transition: all 0.35s;
  -moz-transition: all 0.35s;
  -webkit-transition: all 0.35s;
  -o-transition: all 0.35s;
  
  
.reorder_link:hover {
  color: #fff;
  border: solid 2px #3675B4;
  background: #3675B4;
  box-shadow: none;
}
#reorder-helper{margin: 18px 10px;padding: 10px;}
.light_box {
  background: #efefef;
  padding: 20px;
  margin: 10px 0;
  text-align: center;
  font-size: 1.2em;
}
.thumb{
     height: 150px;
     border: 1px solid #000;
     margin: 10px 5px 0 0;
}

}

</style>

</head>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
   <!-- Logo -->
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <?php foreach ($log as $logo): ?>
      <?php if($logo->get('con_logo') != NULL || !empty($logo->get('con_logo')) ){?>
        <a href="<?=site_url('LoginController/volverIndex')?>" class="logo">
      <span class="logo-mini"><img src="<?=base_url('')?>resources/images/logo/<?=$logo->get('con_logo')?>" style="width: 100%; height: 100%;"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?=base_url('')?>resources/images/logo/<?=$logo->get('con_logo')?>" style="width: 140px; height: 50px;"></span>
    </a>
    <?php }else{?>
     <a href="<?=site_url('LoginController/volverIndex')?>" class="logo">
      <span class="logo-mini">SLG</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Sin Logo</span>
    </a>
    <?php } ?>
    <?php endforeach ?>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php if($this->session->userdata('imagen') != NULL || !empty($this->session->userdata('imagen'))){?>
              <img src="<?=base_url('')?>resources/images/admin/<?=$this->session->userdata('imagen')?>" style ="width:25px; height:25px" class="user-image" alt="User Image">
              <?php }else{ ?>
                <img src="<?=base_url('')?>resources/images/mype.jpg" style ="width:25px; height:25px" class="user-image" alt="User Image">
             <?php } ?> 
              <span class="hidden-xs"><?php echo $this->session->userdata('username');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <?php if($this->session->userdata('imagen') != NULL || !empty($this->session->userdata('imagen'))){?>
                <img src="<?=base_url('')?>resources/images/admin/<?=$this->session->userdata('imagen')?>"  class="img-circle" alt="User Image">
                <?php }else{ ?>
                <img src="<?=base_url('')?>resources/images/mype.jpg"  class="img-circle" alt="User Image">
                 <?php } ?> 
                <p>
                  <?php echo $this->session->userdata('username');?>
                  <small>Administrador</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <center>
                <div class="pull" style="float: center;">
                  <a href="<?=site_url('LoginController/logoutUser')?>" class="btn btn-danger btn-flat"><i class="fa fa-power-off" aria-hidden="true"></i> Salir</a>
                </div>
              </center>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
      
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <?php if($this->session->userdata('imagen') != NULL || !empty($this->session->userdata('imagen'))){?>
          <img src="<?=base_url('')?>resources/images/admin/<?=$this->session->userdata('imagen')?>" style="width:40px; height: 40px" class="img-circle" alt="User Image">
          <?php }else{ ?>
          <img src="<?=base_url('')?>resources/images/mype.jpg" style="width:40px; height: 40px" class="img-circle" alt="User Image">
          <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username');?></p>
          Administrador
         
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Navegación</li>

             <li class="treeview">
          <a href="<?=site_url('ConfController')?>">
            <i class="fa fa-cog"></i>
            <span>Configuración</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
        </li>
         <li class="treeview">
          <a href="<?=site_url('EmpresaController')?>">
            <i class="fa fa-book"></i>
            <span>Empresa</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
        </li>

              <li class="treeview">
          <a href="<?=site_url('ProductoController')?>">
            <i class="fa fa-archive" aria-hidden="true"></i>
            <span>Productos</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
        </li>


           <li class="treeview">
          <a href="<?=site_url('CategoriasController')?>">
            <i class="fa fa-tag" aria-hidden="true"></i>
            <span>Categoría</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
        </li>    
            
         <li class="treeview">
          <a href="<?=site_url('RedesController')?>">
            <i class="fa fa-facebook-official"></i>
            <span>Redes Sociales</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
        </li>

        <li class="treeview">
          <a href="<?=site_url('TeamController')?>">
            <i class="fa fa-users"></i>
            <span>Equipo de trabajo</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?=site_url('AdminController')?>">
            <i class="fa fa-user"></i>
            <span>Usuarios</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
        </li>
           <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope-o"></i>
            <span>Mensajes</span>
            <span class="pull-right-container">
              <span class="fa fa-angle-left pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=site_url('MsjController')?>"><i class="fa fa-circle-o"></i> Sin Responder</a></li>
            <li><a href="<?=site_url('MsjController/msjRespondidos')?>"><i class="fa fa-circle-o"></i> Respondidos/Enviados</a></li>
            <li><a href="<?=site_url('MsjController/msjAll')?>"><i class="fa fa-circle-o"></i> Todos </a></li>
          </ul>
        </li>

         <li class="treeview">
          <a href="<?=site_url('MsjController/viewCorreos')?>">
            <i class="fa fa-exchange"></i>
            <span>Correos Registrados</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
        </li>
       


       
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">  
<!--Aqui va el contenido-->

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" >Nuevo Producto</h4>
                </div>
                <div class="modal-body text-center">
               <form class="form-horizontal form-label-left"  enctype="multipart/form-data"  action="<?=site_url('ProductoController/agregarProductoslisto')?>" method="POST">
           <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Nombre Producto<span class="required">*</span>
                      </label>
                       <div class="col-md-7">
                      <input type="text" id="nompro" name="product[pro_name]" value="" required="required" class="form-control col-md-7 col-xs-12"></div>
                      
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3" for="last-name">Subtitulo Producto<span class="required">*</span>
                      </label>
                      <div class="col-md-7">
                          <input type="text" id="subpro" name="product[pro_subtitle]" value="" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                  </div>
                 
                  <div class="form-group">
                   <label class="control-label col-md-3" for="last-name">Moneda<span class="required">*</span>
                      </label>
                      <div class="col-md-3">
                          <select name="product[pro_currency]" id="currency" required="required"  class="js-example-tokenizer form-control select2 miniselect"  style="width: 100%" value="" >
                                  <option value="CLP">CLP</option>
                                  <option value="USD">USD</option>
                                 

                          </select>
                      </div>
                      <label class="control-label col-md-1" for="last-name">Precio<span class="required">*</span>
                      </label>
                      <div class="col-md-3">
                          <input type="text" id="prepro" name="product[pro_price]" value="" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3" for="first-name">Tipo de descuento<span class="required">*</span></label>
                       <div class="col-md-3">
                        <select id="tipo" value="" name="product[pro_discounttype]" class="js-example-tokenizer form-control select2 miniselect"  style="width: 100%">
                         <option value="">Escoger método</option>
                          <option value="1">Porcentaje</option>
                          <option value="2">Valor</option>
                      </select>
                      </div>
                      <label class="control-label col-md-1" for="first-name">Descuento<span class="required">*</span>
                      </label>
                       <div class="col-md-3">
                      <input type="text" id="descpro" name="product[pro_discount]" value="" required="required" class="form-control col-md-6 col-xs-12"></div>
                      </div> 

                    <div class="form-group">
                      <label class="control-label col-md-3" for="last-name">Valor Total<span class="required">*</span>
                      </label>
                      <div class="col-md-2">
                       <input type="text" id="valortotal" name="product[pro_total]" value="" required="required" class="form-control col-md-7 col-xs-12">   
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Estado<span class="required">*</span>
                      </label>
                       <div class="col-md-3">
                          <select name="product[pro_status]" id="estpro"  class="js-example-tokenizer form-control select2"  style="width: 100%" value="">
                                  <option value="1">Activa</option>
                                  <option value="0">Inactiva</option>
                                 

                          </select>
                      </div>
                      <label class="control-label col-md-1" for="stock">Stock<span class="required">*</span>
                      </label>
                       <div class="col-md-3">
                          <input type="number" id="stock" name="product[pro_stock]" value="" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Categoría<span class="required">*</span>
                      </label>
                       <div class="col-md-7">


                          <select name="product[pro_cat_id]" id="catpro"  class="js-example-tokenizer form-control select2"  style="width: 100%" value="">
                          <optgroup label="--Categorías--">
                          <?php 
                          $aux = '';
                          foreach ($categoriaspadres as $cat){ ?> 
                          <option value="<?=$cat->get('cat_id')?>"><?=$cat->get('cat_name')?></option>
                          
                          <?php } ?>
                          <optgroup label="--SubCategorías--">

                          <?php foreach ($subcategorias as $subcat){?>
                          
                          <?php if($subcat->get('Categoria')!= $aux){?>
                             <optgroup label="<?=$subcat->get('Categoria')?>">
                             <?php $aux = $subcat->get('Categoria'); }?>
                            <option value="<?=$subcat->get('ID')?>"><?=$subcat->get('SubCategoria')?></option>
                            <?php } ?>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-8 " align="center" style="margin-left: 18%">
                    <textarea id="compose-textarea" name="product[pro_description]" class="form-control col-md-7 ">
                    </textarea>
                    <br>
                  </div>
              <br>
              <div class="col-lg-12">
                        <div class="form-group col-md-3">

                          <label class="control-label " for="img">Foto Portada</label>
                          <input type="file" class="form-control"  id="photo1" name="photo_1" accept="image/*">
                         
                        </div>    
                        <div class="form-group col-md-3">
                          <label class="control-label" for="img">Foto 2</label>
                          <input type="file"  class="form-control" name="photo_2" accept="image/*">
                        </div>  

                        <div class="form-group col-lg-3">
                          <label class="control-label " for="img">Foto 3</label>
                          <input type="file"  class="form-control" name="photo_3" accept="image/*">
                        </div>  

                        <div class="form-group col-lg-3">
                          <label class="control-label " for="img">Foto 4</label>
                          <input type="file"  class="form-control" name="photo_4" accept="image/*">
                        </div>  
                  </div>
             

                  <div class="col-lg-12">
                    <div class="form-group col-lg-6">
                           <output id="list"></output>
                      </div>

                  </div>    
                    <div class="col-md-12">
                        <button type="button" id="modal_cancel" class="btn btn-default" data-dismiss="modal" style="margin-right: : 1%">Cancelar</button>
                    <button id="btnAdd" type="submit" class="btn btn-success">Guardar</button></div> 
                    </div>

                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                </div>
                </form>


   <!--== FOOTER ==-->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright Clínica MYPE inacap</a>.</strong> derechos reservados
  </footer>
 <!--== FIN FOOTER ==-->


            </div> 
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<script src="<?=base_url('resources/select2-4.0.3/vendor/jquery-3.2.1.min.js')?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url('resources/bootstrap/js/bootstrap.min.js')?>"></script>
<!-- DataTables -->
<script src="<?=base_url('resources/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('resources/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<!-- SlimScroll -->
<script src="<?=base_url('resources/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
<!-- FastClick -->
<script src="<?=base_url('resources/plugins/fastclick/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('resources/dist/js/app.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('resources/dist/js/demo.js')?>"></script>
<script src="<?=base_url('resources/select2-4.0.3/dist/js/select2.min.js')?>"></script>
<script src="<?=base_url('resources/bootstrap/js/bootstrap3-wysihtml5.all.min.js')?>"></script>
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });

   $("#catpro").select2({
     theme: "classic"
});
$("#catpro").select2();
</script> 


    
<script>
$(document).ready(function(){
$('#tipo').on('change', function() {
  var tipo = this.value;
  if(tipo == 1){
   $('input').keyup(function(){
        
        num =  parseInt($('#prepro').val());
        IVA =  parseInt($('#descpro').val());
        porcentaje = num * IVA /100;
        total = num - porcentaje;
        document.getElementById("valortotal").value=total;
        
    });
  }
  if(tipo == 2){
   $('input').keyup(function(){
        
        num =  parseInt($('#prepro').val());
        IVA =  parseInt($('#descpro').val());
        total = num - IVA;
        document.getElementById("valortotal").value=total;
        
    });
  }
})
   
});
                               
</script>
</body>
</html>