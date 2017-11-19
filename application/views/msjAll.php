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

  <link rel="stylesheet" href="<?=base_url('resources/dist/css/skins/_all-skins.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('resources/select2-4.0.3/dist/css/select2.min.css')?>">
  <style type="text/css">

    #page_container {
  margin-top: 15px;
  margin-bottom: 15px;
}

#accordion_search_bar_container {
  position: relative;
}
#accordion_search_bar_container:after {
  content: '\e003';
  font-family: Glyphicons Halflings;
  width: 18px;
  height: 18px;
  position: absolute;
  right: 10px;
  bottom: 10px;
}
#accordion_search_bar_container #accordion_search_bar {
  display: block;
  margin: 10px auto;
  width: 100%;
  padding: 7px 10px;
  border: 1px solid #cacaca;
  border-radius: 25px;
  outline: 0;
}

.panel-title a {
  display: block;
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
    <!-- Content Header (Page header' -->
   <section class="content-header">
      <h1>
       Todos los Mensajes      
        </h1>
    </section>
                      
    <!-- Main content -->
    <section class="content">
      <div class="container">
           <div id="accordion_search_bar_container">
      <input type="search" 
         id="accordion_search_bar" 
         placeholder="Buscar por nombre"/>
  </div>
      
        <div class="panel-group" 
             id="accordion" 
             role="tablist" 
             aria-multiselectable="true">
             <?php if ($customer!=null) {?>
             <?php foreach ($customer as $cu): ?>
                    <div class="panel panel-primary" 
                         id="collapse<?=$cu->getCol('new_id')?>">
                      <div class="panel-heading" 
                           role="tab" 
                           id="heading_<?=$cu->getCol('new_id')?>">
                        <h4 class="panel-title">
                          <a class="collapsed" 
                             role="button" 
                             data-toggle="collapse" 
                             data-parent="#accordion" 
                             href="#collapseTwo<?=$cu->getCol('new_id')?>" 
                             aria-expanded="false" 
                             aria-controls="collapseTwo<?=$cu->getCol('new_id')?>">
                            <?=$cu->getCol('cus_email')?> <i class="fa fa-envelope-o"></i>
                          </a>


                        </h4>

                      </div>
                      <div id="collapseTwo<?=$cu->getCol('new_id')?>" 
                           class="panel-collapse collapse" 
                           role="tabpanel" 
                           aria-labelledby="heading_<?=$cu->getCol('new_id')?>">
                        <div class="panel-body">
                          <p> Nombre : <?=$cu->getCol('cus_name')?></p>
                          <p> Tema : <?=$cu->getCol('new_subject')?></p>
                          <p> Mensaje : <?=$cu->getCol('new_text')?> </p>
                          <p> Fecha : <?=$cu->getCol('cus_datesystem')?></p>
                          <p> Telefono : <?=$cu->getCol('cus_phonenumber')?></p>
                     
                      <div>
                      <button type="button" fakenewlog="<?=$cu->getCol('log_id')?>" fakenewsle="<?=$cu->getCol('new_id')?>" class="btn btn-danger deleteUsr" data-toggle='modal' data-target='#delete_modal'>Eliminar <i class="fa fa-remove"></i></button>
                      </div>

                        </div>
                      </div>

                    </div>
                    <?php endforeach ?> 
                    <?php }?>
            </div>
          
          </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


    
    <!--==== Modal enviar correos ====-->

    <div id="edit_modal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" >Responder Correo</h4>
                </div>
                <div class="modal-body text-center">
                    <form class="form-horizontal form-label-left" action="<?=site_url('MsjController/enviarMsj')?>" method="POST">
            
                        <div class="form-group">
                            <label class="control-label col-md-3" for="last-name">Para:<span class="required">*</span>
                            </label>
                            <div class="col-md-7">
                                <input type="text" id="mailToSend" name="mailToSend"  required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="last-name">Asunto:<span class="required">*</span>
                            </label>
                            <div class="col-md-7">
                                <input type="text" id="subject" name="subject"  required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3" for="last-name">Mensaje:<span class="required">*</span>
                            </label>
                            <div class="col-md-7">
                                <textarea rows="4" cols="50" id="text" name="text"  required="required" class="form-control col-md-7 col-xs-12">
                                </textarea>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">

                  <div class="col-md-2 pull-left">
                        <input type="hidden" id="newlogid" name="newlogid" class="form-control col-md-7 col-xs-12">
                    </div>

                    <div class="col-md-8">
                        <button type="button" id="modal_cancel" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-md-2">
                        <button id="btnAdd" type="submit" class="btn btn-success">Enviar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!--==== Fin Modal editar red social ====-->

     <!--====Modal Eliminar red social =====-->
 <div id="delete_modal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" >Eliminar Red Social</h4>
                </div>
                <div class="modal-body text-center">
                    <h4>¿Seguro/a que desea eliminar este mensaje?</h4><h3 id="modal_name"></h3>
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
<!--======== Fin Modal Eliminar red social ========= -->
  
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

<!-- jQuery 2.2.3 -->
<script src="<?=base_url('resources/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
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

     $("#nombrered").select2({
     theme: "classic"
});
$("#editnombrered").select2();
  });

 // <==== Fin DataTable Options ===>


  // <==== Responder Botón ===>
  $(".getMail").click(function () {
            var id = $(this).attr('fakeid');
            var subject =  $(this).attr('faketema');
            var text =  $(this).attr('fakemsj');
            var name =  $(this).attr('fakenombre');
            var newlogid = $(this).attr('fakenewlog');
                    $("#mailToSend").val(id);
                    $("#subject").val('Re:'+subject);
                    $("#text").val('Re:'+text+'\n'+'Estimado(a): '+name+'\n');
                    $("#newlogid").val(newlogid);
                    $('#carga_modal').modal('hide');
                    $('#edit_modal').modal('show').fadeIn(800);
                    
        });

    // <==== Fin Responder Botón ===>


   // <==== Eliminar Botón ===>
        var logId = 0;
        var newId = 0;
        $(".deleteUsr").click(function () {
            logId = $(this).attr('fakenewlog');
            newId = $(this).attr('fakenewsle');
        });

        $('#btnDel').click(function () {
            if (logId != 0) {
                $('#delete_modal').modal('hide');
                $.ajax({
                    type: "POST",
                    url: "<?=site_url('MsjController/eliminarMsj')?>",
                    dataType: "json",
                    data: {"logId": logId, "newId" : newId},
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

     // <==== Acordeón con  buscar===>

          (function(){
            var searchTerm, panelContainerId;
            $('#accordion_search_bar').on('change keyup paste click', function () {
              searchTerm = $(this).val();
              $('#accordion > .panel').each(function () {
                panelContainerId = '#' + $(this).attr('id');
                $(panelContainerId + ':not(:contains(' + searchTerm + '))').hide();
                $(panelContainerId + ':contains(' + searchTerm + ')').show();
              });
            });
          }());
      // fin <==== Acordeón con  buscar===>

</script>
</body>
</html>
