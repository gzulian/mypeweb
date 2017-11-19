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


}

</style>

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

              <li class="treeview active">
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
    <!-- Content Header (Page header' -->
   <section class="content-header">
      <h1>
       Productos
      </h1>
    </section>
                      
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
                 <a href="<?=site_url('ProductoController/agregarProductos')?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Nuevo producto </button> </a>
                <a href="<?=site_url('ProductoController/viewPosProd')?>"> <button style="margin-right:  2%" class="btn btn-primary pull-right"><i class="fa fa-list-ol"></i> Orden </button>   </a>

                 
            </div>
              
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table">
            <?php if($productos != null){?>
              <table id="example1" class="table table-bordered table-striped">
                
                <thead>
                <th>Nombre Producto</th>
                <th>Moneda Producto</th>
                <th>Posición Producto</th>
                <th>Estado Producto</th>
                <th>Precio total Producto</th>
                <th>Editar</th>
                <th>Eliminar</th>
                </thead>

                <tbody>
                <tr>
                 <?php foreach ($productos as $pro): ?>
                  
                    <td><?=$pro->get('pro_name')?></td>
                    <td><?=$pro->get('pro_currency')?></td>
                     <?php if($pro->get('pro_position')==0){ ?>
                    <?php echo "<td>Sin asignar</td>";?>
                    <?php }else{?>
                    <td><?=$pro->get('pro_position')?></td>
                    <?php } ?>
                    <?php if($pro->get('pro_status')==0){ ?>
                    <?php echo "<td>Inactiva</td>";?>
                    <?php }else{?>
                    <?php echo "<td>Activa</td>";?>
                    <?php } ?>
                    <td><?=$pro->get('pro_total')?></td>
                    <td style="width: 5px;"> 
                    <form method="post" action="<?=site_url('ProductoController/editarProductos')?>">
                        <input type="hidden" name="idpro" value="<?=$pro->get('pro_id')?>">
                    <button class='btn btn-default pull-right' type="submit"><i class="fa fa-pencil"></i></button>
                    </form>

                    </a></td>
                    <td style="width: 4px;"><a type='button' fakeid="<?=$pro->get('pro_id')?>" class='btn btn-danger deleteUsr pull-right deleteUsr' data-toggle='modal' data-target='#delete_modal'> <i class="fa fa-user-times" ></i></a></td>
                    
                    </tr>
                   <?php endforeach ?>
                
               <?php }else{?>
                                <center>
                                  <h3>No hay productos registrados</h3>
                                </center>
                                <?php } ?>
          </tfoot>
              </table>
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
      foreach($productos as $dra){
    ?>
            <li id="image_li_<?=$dra->get('pro_id')?>" class="ui-sortable-handle"><a href="javascript:void(0);" style="float:none;" class="image_link"><span><?=$dra->get('pro_name')?></span></a></li>
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
          </div>

</div>

     <!--====Modal Eliminar Producto =====-->
 <div id="delete_modal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" >Eliminar Producto</h4>
                </div>
                <div class="modal-body text-center">
                    <h4>¿Seguro/a que desea eliminar el producto?</h4><h3 id="modal_name"></h3>
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
<!--======== Fin Modal Eliminar Producto ========= -->

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
   <strong>Copyright Clínica MYPE inacap</a>.</strong> derechos reservados
  </footer>
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

     $("#nompro").select2({
     theme: "classic"
});
$("#editnompro").select2();
  });

 // <==== Fin DataTable Options ===>


  // <==== Editar Botón ===>
  $(".editUsr").click(function () {
            var id = $(this).attr('fakeid');
            console.log(id);
            $.ajax({
                type: "POST",
                url: "<?=site_url('ProductoController/editarProductos')?>",
                dataType: "json",
                data:{"idpro" : id},
                beforeSend: function () {
                    $("#editnompro").val("");
                    $("#editsubpro").val("");
                    $("#editdespro").val("");
                    $("#editprepro").val("");
                    $("#editmonpro").val("");
                    $("#editestpro").val("");
                    $("#editcatpro").val("");
                    $("#editdescpro").val("");
                    $("#editdescuento").val("");
                    $('#carga_modal').modal('show');
                },
                success: function(data) {
                    console.log(data.nombre);
                    console.log(data.subtitulo);
                    console.log(data.descripcion);
                    console.log(data.precio);
                    console.log(data.moneda);
                    console.log(data.estado);
                    console.log(data.categoria);
                    console.log(data.descuento);
                    console.log(data.descuentot);
                    $("#editnompro").val(data.nombre).trigger("change");
                    $("#editsubpro").val(data.subtitulo);
                    $("#editdespro").val(data.descripcion);
                    $("#editprepro").val(data.precio);
                    $("#editmonpro").val(data.moneda);
                    $("#editestpro").val(data.estado);
                    $("#editcatpro").val(data.categoria);
                    $("#editdescpro").val(data.descuento);
                    $("#editdescuento").val(data.descuentot);
                    $("#editpro").val(data.id);
                    $('#carga_modal').modal('hide');
                    $('#edit_modal').modal('show').fadeIn(800);
                   
   
                },                
                complete : function(xhr, status) {
                    $('#carga_modal').modal('hide');
                }
            });
        });

    // <==== Fin Editar Botón ===>



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
                    url: "<?=site_url('ProductoController/eliminarProductos')?>",
                    dataType: "json",
                    data: {"idpro": iddelete},
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
</body>
</html>
