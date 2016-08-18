<!DOCTYPE html>
<html lang="pt-br" ng-app="app">

<meta charset="UTF-8">

<title>BEM ADV</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- Bootstrap 3.3.4 -->
<link href="<?php echo base_url('bower_components/AdminLTE/'); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet"
      type="text/css"/>
<!-- Font Awesome Icons -->
<link href="<?php echo base_url('bower_components/font-awesome/'); ?>css/font-awesome.min.css" rel="stylesheet"
      type="text/css"/>
<!-- Ionicons -->
<!-- link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/ -->
<!-- jvectormap -->
<link href="<?php echo base_url('bower_components/AdminLTE/'); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css"
      rel="stylesheet" type="text/css"/>
<!-- Theme style -->
<link href="<?php echo base_url('bower_components/AdminLTE/'); ?>dist/css/AdminLTE.min.css" rel="stylesheet"
      type="text/css"/>
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link href="<?php echo base_url('bower_components/AdminLTE/'); ?>dist/css/skins/_all-skins.min.css" rel="stylesheet"
      type="text/css"/>

<link href="<?php echo base_url('assets/css/mycss.css'); ?>" rel="stylesheet" type="text/css"/>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('assets/downloads/'); ?>html5shiv.min.js"></script>
<script src="<?php echo base_url('assets/downloads/'); ?>respond.min.js"></script>
<![endif]-->
<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url('bower_components/jquery/'); ?>dist/jquery.min.js"></script>


<script src="<?php echo base_url('assets/downloads/'); ?>angular.min.js"></script>

<script type="text/javascript">

    var app = angular.module('app', []);


    function base_url() {
        return "<?php echo urlPathClass() ?>";
    }
    function path_ajax() {
        return "<?php echo urlPathToAjax() ?>";
    }
    function site_url(controller) {
        if (typeof controller !== 'undefined') {
            return "<?php echo base_url() ?>" + controller;
        } else {
            return "<?php echo base_url() ?>";
        }
    }
</script>

<!-- magnussho@yahoo.com.br -->

</head>
<!--<body class="skin-purple sidebar-mini">-->
<body class="fixed skin-blue">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url('dashboard') ?>" class="logo">
            <span class="logo-lg"><b>BEM ADV</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs"><?php echo $this->usuariologado->getNome() ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <p>
                                    <?php echo $this->usuariologado->getNome() ?>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Configurações</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo base_url('login/logout') ?>" class="btn btn-default btn-flat">Sair</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <ul class="sidebar-menu">
                <li class="header">MENU</li>
                <li class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?> treeview">
                    <a href="<?php echo base_url('dashboard'); ?>">
                        <i class="fa fa-tachometer"></i> <span>Dashbord</span>
                    </a>
                </li>
                <li class="<?php echo $this->uri->segment(2) == 'processos' ? 'active' : '' ?> treeview">
                    <a href="<?php echo base_url('cadastros/processos'); ?>">
                        <i class="fa fa-users" aria-hidden="true"></i> <span>Processos</span>
                    </a>
                </li>
                <li class="<?php echo $this->uri->segment(2) == 'clientes' ? 'active' : '' ?> treeview">
                    <a href="<?php echo base_url('cadastros/clientes'); ?>">
                        <i class="fa fa-users" aria-hidden="true"></i> <span>Clientes</span>
                    </a>
                </li>
                <li class="<?php echo $this->uri->segment(2) == 'acoes' ? 'active' : '' ?> treeview">
                    <a href="<?php echo base_url('cadastros/acoes'); ?>">
                        <i class="fa fa-user-plus"></i> <span>Ações</span>
                    </a>
                </li>
                <li class="<?php echo $this->uri->segment(2) == 'locatarios' ? 'active' : '' ?> treeview">
                    <a href="<?php echo base_url('cadastros/locatarios'); ?>">
                        <i class="fa fa-user-plus"></i> <span>Locatários</span>
                    </a>
                </li>
                <li class="<?php echo $this->uri->segment(2) == 'sites' ? 'active' : '' ?> treeview">
                    <a href="<?php echo base_url('cadastros/sites'); ?>">
                        <i class="fa fa-user-plus"></i> <span>Sites</span>
                    </a>
                </li>
                <li class="<?php echo $this->uri->segment(2) == 'locacoes' ? 'active' : '' ?> treeview">
                    <a href="<?php echo base_url('cadastros/locacoes'); ?>">
                        <i class="fa fa-user-plus"></i> <span>Locações</span>
                    </a>
                </li>
                <li class="<?php echo $this->uri->segment(2) == 'agenda' ? 'active' : '' ?> treeview">
                    <a href="<?php echo base_url('cadastros/agenda'); ?>">
                        <i class="fa fa-user-plus"></i> <span>Agenda</span>
                    </a>
                </li>
                <li class="<?php echo $this->uri->segment(2) == 'calendario' ? 'active' : '' ?> treeview">
                    <a href="<?php echo base_url('cadastros/calendario'); ?>">
                        <i class="fa fa-calendar" aria-hidden="true"></i> <span>Calendário</span>
                    </a>
                </li>                
                <li class="<?php echo $this->uri->segment(2) == 'relatorio' ? 'active' : '' ?> treeview">
                    <a href="<?php echo base_url('cadastros/relatorio'); ?>">
                        <i class="fa fa-file" aria-hidden="true"></i> <span>Relatório</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/arquivos">
                        <i class="fa fa-cloud" aria-hidden="true"></i> <span>Cloud - Arquivos</span>
                    </a>
                </li>
                
                
                
                
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <h1>
                <small>Version 4.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="#">Dashboard</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php echo $contents ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>Copyright &copy; 2016 CARLOS</strong>.
    </footer>
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class='control-sidebar-bg'></div>

</div>
<!-- ./wrapper -->
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('bower_components/AdminLTE/'); ?>bootstrap/js/bootstrap.min.js"
        type="text/javascript"></script>

<script src="<?php echo base_url('bower_components/AdminLTE/'); ?>plugins/datatables/jquery.dataTables.js"
        type="text/javascript"></script>
<script src="<?php echo base_url('bower_components/AdminLTE/'); ?>plugins/datatables/dataTables.bootstrap.min.js"
        type="text/javascript"></script>

<script src="<?php echo base_url('assets/'); ?>js/plugins/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>js/plugins/jquery.maskmoney.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>js/base.js"></script>

<link href="<?php echo base_url('bower_components/confirm/css/jquery-confirm.css'); ?>" rel="stylesheet"
      type="text/css"/>
<script src="<?php echo base_url('bower_components/confirm/dist/jquery-confirm.min.js'); ?>"></script>


<link href="<?php echo base_url('bower_components/select2'); ?>/dist/css/select2.min.css" rel="stylesheet"/>
<script src="<?php echo base_url('bower_components/select2'); ?>/dist/js/select2.min.js"></script>

<!-- FastClick -->
<script src='<?php echo base_url('bower_components/AdminLTE/'); ?>plugins/fastclick/fastclick.min.js'></script>

<link href="<?php echo base_url('bower_components/AdminLTE/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css"
      rel="stylesheet" type="text/css"/>
<script
    src='<?php echo base_url('bower_components/AdminLTE/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('bower_components/AdminLTE/'); ?>dist/js/app.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('bower_components/AdminLTE/'); ?>plugins/sparkline/jquery.sparkline.min.js"
        type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('bower_components/AdminLTE/'); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"
        type="text/javascript"></script>
<script src="<?php echo base_url('bower_components/AdminLTE/'); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"
        type="text/javascript"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('bower_components/AdminLTE/'); ?>plugins/slimScroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('bower_components/AdminLTE/'); ?>plugins/chartjs/Chart.min.js"
        type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('bower_components/AdminLTE/'); ?>dist/js/demo.js" type="text/javascript"></script>


<?php if (file_exists('assets' . DS . 'js' . DS . 'modules' . DS . $this->uri->segment(2) . '.js')): ?>
    <script src="<?php echo base_url() . 'assets' . DS . 'js' . DS . 'modules' . DS . $this->uri->segment(2) . '.js' ?>"
            type="text/javascript"></script>
<?php endif; ?>

<?php if (file_exists('assets' . DS . 'js' . DS . 'modules' . DS . $this->uri->segment(1) . '.js')): ?>
    <script src="<?php echo base_url() . 'assets' . DS . 'js' . DS . 'modules' . DS . $this->uri->segment(1) . '.js' ?>"
            type="text/javascript"></script>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).ajaxStart(function () {
            showLoader();
        });

        $(document).ajaxStop(function () {
            hideLoader();
        });
    });
</script>

</body>
</html>
