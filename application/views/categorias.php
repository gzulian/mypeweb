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
</style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
        <!-- mini logo for sidebar mini 50x50 pixels -->
      <?php foreach ($log as $logo): ?>
      <?php if($logo->get('con_logo') != NULL || !empty($logo->get('con_logo')) || $logo->get('con_logo') != '' ){?>
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
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
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


           <li class="treeview active">
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
    <!-- Content Header (Page header' -->
   <section class="content-header">
      <h1>
       Categorías
      </h1>
    </section>
                      
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
                <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#new_modal"><i class="fa fa-plus"></i> Nueva Categoría </button>
                <button style="margin-right:  2%" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalist"><i class="fa fa-list-ol"></i> Ordenar Categorías</button>   
                
            </div>
              
            <!-- /.box-header -->
            <div class="box-body">
            <?php if($categorias != null){?>
              <table id="example1" class="table table-bordered table-striped">
                
                <thead>
                <th>Nombre Categoría</th>
                <th>Categoría Padre</th>
                <th>Estado Categoría</th>
                <th>Posición Categoría</th>
                <th>Editar</th>
                <th>Eliminar</th>
                </thead>

                <tbody>
                <tr>
                 <?php foreach ($categorias as $cat){ ?>
                  
                    <td><?=$cat->get('cat_name')?></td>
                    <td>
                      <?php foreach ($categorias as $cate) {
                           if ($cat->get('cat_parent')==$cate->get('cat_id')) {?>
                          <?=$cate->get('cat_name')?>
                         <?php 
                           }
                        }?>         
                    </td>
                    <?php if($cat->get('cat_status')==0){ ?>
                    <?php echo "<td>Inactiva</td>";?>
                    <?php }else{?>
                    <?php echo "<td>Activa</td>";?>
                    <?php } ?>
                    <?php if($cat->get('cat_position')==0){ ?>
                    <?php echo "<td>Sin asignar</td>";?>
                    <?php }else{?>
                    <td><?=$cat->get('cat_position')?></td>
                    <?php } ?>
                    <td style="width: 5px;"> <a type='button' fakeid="<?=$cat->get('cat_id')?>" class='btn btn-default editUsr pull-right'><i class="fa fa-pencil"></i></a></td>
                    <td style="width: 4px;"><a type='button' fakeid="<?=$cat->get('cat_id')?>" class='btn btn-danger deleteUsr pull-right deleteUsr' data-toggle='modal' data-target='#delete_modal'> <i class="fa fa-user-times" ></i></a></td>
                    </tr>
                   <?php } ?>
                

                </tfoot>
              </table>
              <?php }else{?>
                                <center>
                                  <h3>No hay categorías registradas</h3>
                                </center>
                                <?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </section>
    <!-- /.content -->
    
  <div id="modalist" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" >Editar posiciones</h4>
                </div>
                <div class="modal-body text-center">
               
    <div class="gallery">
        <ul class="reorder_ul reorder-photos-list">
        
        <?php 
      //Fetch all images from database
      foreach($catParents as $dra){
    ?>
            <li id="image_li_<?=$dra->get('cat_id')?>" class="ui-sortable-handle"><a href="javascript:void(0);" style="float:none;" class="image_link"><span><?=$dra->get('cat_name')?></span></a></li>
        <?php }  ?>
        </ul>
    </div>   
<div id="reorder-helper" class="light_box" style="display:none;">Arrastra los nombres para ordenar.<br></div>
                <div class="modal-footer">
                    <div class="col-md-2 pull-left">
                        <button type="button" id="btnRst" class="btn btn-primary" style="display : none">Reset Password</button>
                    </div>
                    <div class="col-md-8">
                        <button type="button" id="modal_cancel" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-md-1">
                        <a href="javascript:void(0);" class="btn outlined mleft_no reorder_link" id="save_reorder">Editar Posiciones</a>
    
                    </div>
              
                
            </div>
        </div>
    </div>
</div></div>


  <div id="modasublist" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" >Editar posiciones</h4>

                </div>
              </div>
                <div class="modal-body text-center">
               
    <div class="gallery">
        <ul class="reorder_ul reorder-photos-list">
        
    <?php 
      //Fetch all images from database
      foreach($cat as $dras){
    ?>
            <li id="image_li_<?=$dras->get('cat_id')?>" class="ui-sortable-handle"><a href="javascript:void(0);" style="float:none;" class="image_link"><span><?=$dras->get('cat_name')?></span></a></li>
        <?php }  ?>
        </ul>
    </div>   
<div id="reorder-helper" class="light_box" style="display:none;">Arrastra los nombres para ordenar.<br></div>
                <div class="modal-footer">
                    <div class="col-md-2 pull-left">
                        <button type="button" id="btnRst" class="btn btn-primary" style="display : none">Reset Password</button>
                    </div>
                    <div class="col-md-8">
                        <button type="button" id="modal_cancel" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-md-1">
                        <a href="javascript:void(0);" class="btn outlined mleft_no reorder_link" id="save_reorder">Editar Posiciones</a>
    
                    </div>
              
                
            </div>
        </div>
    </div>
</div></div>

  

    <!--==== Modal Nuevas Categorias ====-->

    <div id="new_modal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" >Nueva Categoría</h4>
                </div>
                <div class="modal-body text-center">
                    <form class="form-horizontal form-label-left" action="<?=site_url('CategoriasController/agregarCategorias')?>" method="POST">
                        <div class="form-group">
                            <label class="control-label col-md-3" for="first-name">Nombre Categoría<span class="required">*</span>
                            </label>
                             <div class="col-md-7">
                            <input type="text" id="nomcat" name="nomcat"  required="required" class="form-control col-md-7 col-xs-12"></div>
                            
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3" for="first-name">Categoría padre<span class="required">*</span>
                            </label>
                            <div class="col-md-7">
                            <select id="parcat" name="parcat" class="js-example-tokenizer form-control select2 miniselect"  style="width: 100%">
                               <option value="NULL">Elegir Categoría Padre</option>
                                <?php foreach ($catParents as $par) {?>
                                <option value="<?=$par->get('cat_id')?>"><?=$par->get('cat_name')?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="first-name">Estado<span class="required">*</span>
                            </label>
                             <div class="col-md-7">
                                <select name="estcat" id="estcat"  class="js-example-tokenizer form-control select2"  style="width: 100%">
                                        <option value="0">Inactiva</option>
                                        <option value="1">Activa</option>
                                </select>
                            </div>
                        </div>
                      
                </div>

                <div class="modal-footer">
                    <div class="col-md-2 pull-left">
                        <button type="button" id="btnRst" class="btn btn-primary" style="display : none">Reset Password</button>
                    </div>
                    <div class="col-md-8">
                        <button type="button" id="modal_cancel" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-md-2">
                        <button id="btnAdd" type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--==== fin modal agregar Categoria =====-->
    
    <!--==== Modal editar categoria ====-->

    <div id="edit_modal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" >Editar Categoría</h4>
                </div>
                <div class="modal-body text-center">
                    <form class="form-horizontal form-label-left" action="<?=site_url('CategoriasController/editarCategorias')?>" method="POST">
                        <div class="form-group">
                            <label class="control-label col-md-3" for="first-name">Nombre Categoría<span class="required">*</span>
                            </label>
                             <div class="col-md-7">
                            <input type="text" id="editnomcat" name="editnomcat"  required="required" class="form-control col-md-7 col-xs-12"></div>
                            
                        </div>
                        <div class="form-group">
                             <label class="control-label col-md-3" for="first-name">Categoría padre<span class="required">*</span>
                            </label>
                            <div class="col-md-7">
                            <select id="editparcat" name="editparcat" class="js-example-tokenizer form-control select2 miniselect"  style="width: 100%">
                               <option value="null">Elegir Categoría Padre</option>
                                <?php foreach ($catParents as $par) {?>
                                <option value="<?=$par->get('cat_id')?>"><?=$par->get('cat_name')?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br>
                        <br>
                         <div class="form-group">
                            <label class="control-label col-md-3" for="first-name">Estado<span class="required">*</span>
                            </label>
                             <div class="col-md-7">
                                <select name="editestcat" id="editestcat"  class="js-example-tokenizer form-control select2"  style="width: 100%">
                                        <option value="0">Inactiva</option>
                                        <option value="1">Activa</option>
                                       

                                </select>
                            </div>
                        </div>
                    
                </div>

                <div class="modal-footer">
                    <div class="col-md-2 pull-left">
                        <input type="hidden" id="editcat" name="editcat"   class="form-control col-md-7 col-xs-12">
                    </div>
                    <div class="col-md-8">
                        <button type="button" id="modal_cancel" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-md-2">
                        <button id="btnAdd" type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!--==== Fin Modal editar categoria ====-->

     <!--====Modal Eliminar categoria =====-->
 <div id="delete_modal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" >Eliminar Categoría</h4>
                </div>
                <div class="modal-body text-center">
                    <h4>¿Seguro/a que desea eliminar la categoría?</h4><h3 id="modal_name"></h3>
                    <div class="modal-footer">
                        <div class="col-md-4">
                            <button id="btnDel" type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                        <div class="col-md-8">
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--======== Fin Modal Eliminar categoria ========= -->

  
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
   <strong>Copyright Clínica MYPE inacap</a>.</strong> derechos reservados
  </footer>
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
<!-- page script -->

<script>

// <==== DataTable Options ===>
 $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

     $("#parcat").select2({
     theme: "classic"
});
$("#editparcat").select2();
  });

 // <==== Fin DataTable Options ===>


  // <==== Editar Botón ===>
  $(".editUsr").click(function () {
            var id = $(this).attr('fakeid');
            console.log(id);
            $.ajax({
                type: "POST",
                url: "<?=site_url('CategoriasController/detalleCategorias')?>",
                dataType: "json",
                data:{"idcat" : id},
                beforeSend: function () {
                    $("#editnomcat").val("");
                    $("#editparcat").val("");
                    $("#editestcat").val("");
                    $("#editposcat").val("");
                    $('#carga_modal').modal('show');
                },
                success: function(data) {
                    console.log(data.nombre);
                    console.log(data.parent);
                    console.log(data.estado);
                    console.log(data.posicion);
                    $("#editnomcat").val(data.nombre).trigger("change");
                    $("#editparcat").val(data.parent);
                    $("#editestcat").val(data.estado);
                    $("#editposcat").val(data.posicion);
                    $("#editcat").val(data.id);
                    $('#carga_modal').modal('hide');
                    $('#edit_modal').modal('show').fadeIn(800);
                    
                },
                   error:function (data) {
                    $('#carga_modal').modal('hide');
                    alert("lo sentimos no pudimos cargar los datos solicitados, favor intente mas tarde");
                },
                
                complete : function(xhr, status) {
                    $('#carga_modal').modal('hide');
                }
            });
        });

    // <==== Fin Editar Botón ===>


  
 // <==== Fin Editar posicion===>


        // <==== Eliminar Botón ===>
        var iddelete = 0;
        $(".deleteUsr").click(function () {
            iddelete = $(this).attr('fakeid');
        });

        $('#btnDel').click(function () {
            if (iddelete != 0) {
                $('#delete_modal').modal('hide');
                $.ajax({
                    type: "POST",
                    url: "<?=site_url('CategoriasController/eliminarCategorias')?>",
                    dataType: "json",
                    data: {"idcat": iddelete},
                    beforeSend: function () {
                        $('#carga_modal').modal('show');
                    },
                    success: function (data) {
                        $('#carga_modal').modal('hide');
                    },
                    complete: function (xhr, status) {
                        $('#carga_modal').modal('hide');
                        location.reload();
                    }
                });
            }else{
                alert("No se ha seleccionado ningun usuario a eliminar");
            }
        });
  // <==== Fin Eliminar Botón ===>




</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.reorder_link').on('click',function(){
    $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
    $('.reorder_link').html('Guardar');
    $('.reorder_link').attr("id","save_reorder");
    $('#reorder-helper').slideDown('slow');
    $('.image_link').attr("href","javascript:void(0);");
    $('.image_link').css("cursor","move");
    $("#save_reorder").click(function( e ){
      if( !$("#save_reorder i").length ){
        $(this).html('').prepend('<img src="<?=base_url('')?>resources/images/refresh-animated.gif"/>');
        $("ul.reorder-photos-list").sortable('destroy');
        $("#reorder-helper").html( "Guardando , por favor espere" ).removeClass('light_box').addClass('notice notice_error');
  
        var h = [];
        $("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
        
        $.ajax({
          type: "POST",
          url: "<?=site_url('CategoriasController/guardar')?>",
          data: {ids: " " + h + ""},
          success: function(){
            window.location.reload();
          }
        }); 
        return false;
      } 
      e.preventDefault();   
    });
  });
});
</script>
</body>
</html>
