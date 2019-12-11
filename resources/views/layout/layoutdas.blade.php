<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <meta name="author" content="">

    <title>Admin | SINVJ</title>

    <link rel="apple-touch-icon" href={{{url('/assets/images/apple-touch-icon.png')}}}>
    <link rel="shortcut icon" href={{{url('/assets/images/favicon.ico')}}}>

    <!-- Stylesheets -->
    <link rel="stylesheet" href={{{url('global/css/bootstrap.min.css')}}}>
    <link rel="stylesheet" href={{{url('global/css/bootstrap-extend.min.css')}}}>
    <link rel="stylesheet" href={{{url('/assets/css/site.min.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/select2/select2.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/editable-table/editable-table.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/icheck/icheck.css')}}}>
  <link rel="stylesheet" href={{{url('assets/examples/css/forms/advanced.css')}}}>





    <!-- Plugins -->
        <!--<link rel="stylesheet" href={{{url('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}}>-->
    <link rel="stylesheet" href={{{url('global/vendor/animsition/animsition.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/asscrollable/asScrollable.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/switchery/switchery.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/intro-js/introjs.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/slidepanel/slidePanel.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/flag-icon-css/flag-icon.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/waves/waves.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/chartist/chartist.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/jvectormap/jquery-jvectormap.css')}}}>
    <link rel="stylesheet" href={{{url('assets/examples/css/dashboard/v1.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/blueimp-file-upload/jquery.fileupload.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/dropify/dropify.css')}}}>
    <!-- Fonts -->
    <link rel="stylesheet" href={{{url('global/fonts/material-design/material-design.min.css')}}}>
    <link rel="stylesheet" href={{{url('global/fonts/brand-icons/brand-icons.min.css')}}}>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <link rel="stylesheet" href={{{url('global/fonts/font-awesome/font-awesome.css')}}}>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <link rel="stylesheet" href="{{{url('/global/css/bootstrap-extend.min.css')}}}">
  <link rel="stylesheet" href="{{{url('dashboard-assets/assets/global/css/bootstrap.min.css')}}}">

    <!--<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>-->


    <!--DATA TABLES CSS-->
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-bs4/dataTables.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('assets/examples/css/tables/datatable.css')}}}>
    <!--DATE PICKER-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

    <!--[if lt IE 9]-->
    <script src={{{url('global/vendor/html5shiv/html5shiv.min.js')}}}></script>
    <!--[endif]-->

    <!--[if lt IE 10]-->
    <script src={{{url('global/vendor/media-match/media.match.min.js')}}}></script>
    <script src={{{url('global/vendor/respond/respond.min.js')}}}></script>
    <!--[endif]-->

    <!-- Scripts -->
    <script src={{{url('global/vendor/breakpoints/breakpoints.js')}}}></script>

    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition dashboard">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<section>
      @yield('nav')
      <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse"
      role="navigation">

      <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
          data-toggle="menubar">
          <span class="sr-only">Toggle navigation</span>
          <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
          data-toggle="collapse">
          <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
          <img class="navbar-brand-logo" src={{{url('/images/logo.png')}}}>
          <span class="navbar-brand-text hidden-xs-down">SINVJ</span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
          data-toggle="collapse">
          <span class="sr-only">Toggle Search</span>
          <i class="icon md-search" aria-hidden="true"></i>
        </button>
      </div>

      <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
          <!-- Navbar Toolbar -->
          <ul class="nav navbar-toolbar">
            <li class="nav-item hidden-float" id="toggleMenubar">
              <a class="nav-link" data-toggle="menubar" href="#" role="button">
                <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
              </a>
            </li>
            <!--Pantalla Completa-->
            <li class="nav-item hidden-sm-down" id="toggleFullscreen">
              <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                <span class="sr-only">Toggle fullscreen</span>
              </a>
            </li>
            <!--Buscar-->
            <li class="nav-item hidden-float">
              <a class="nav-link icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                role="button">
                <span class="sr-only">Toggle Search</span>
              </a>
            </li>

          </ul>
          <!-- End Navbar Toolbar -->

          <!-- Navbar Toolbar Right -->
          <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">

            <li class="nav-item dropdown">
              <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="../../global/portraits/5.jpg" alt="...">
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Perfil</a>
                <a class="dropdown-item" href="/pagos" role="menuitem"><i class="icon  md-money" aria-hidden="true"></i> Pagos</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout" role="menuitem"><i class="icon md-power" aria-hidden="true"></i>Cerrar Sesión</a>
              </div>
            </li>
            <!--Notifications-->
            <!--<li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                aria-expanded="false" data-animation="scale-up" role="button">
                <i class="icon md-notifications" aria-hidden="true"></i>
                <span class="badge badge-pill badge-danger up">5</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                <div class="dropdown-menu-header">
                  <h5>NOTIFICATIONS</h5>
                  <span class="badge badge-round badge-danger">New 5</span>
                </div>

                <div class="list-group">
                  <div data-role="container">
                    <div data-role="content">
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon md-receipt bg-red-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">A new order has been placed</h6>
                            <time class="media-meta" datetime="2017-06-12T20:50:48+08:00">5 hours ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon md-account bg-green-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Completed the task</h6>
                            <time class="media-meta" datetime="2017-06-11T18:29:20+08:00">2 days ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon md-settings bg-red-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Settings updated</h6>
                            <time class="media-meta" datetime="2017-06-11T14:05:00+08:00">2 days ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon md-calendar bg-blue-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Event started</h6>
                            <time class="media-meta" datetime="2017-06-10T13:50:18+08:00">3 days ago</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon md-comment bg-orange-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Message received</h6>
                            <time class="media-meta" datetime="2017-06-10T12:34:48+08:00">3 days ago</time>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="dropdown-menu-footer">
                  <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                    <i class="icon md-settings" aria-hidden="true"></i>
                  </a>
                  <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    All notifications
                  </a>
                </div>
              </div>
            </li>-->
            <!--END-Notifications-->

            <!--Messages-->
            <!--<li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Messages"
                aria-expanded="false" data-animation="scale-up" role="button">
                <i class="icon md-email" aria-hidden="true"></i>
                <span class="badge badge-pill badge-info up">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                <div class="dropdown-menu-header" role="presentation">
                  <h5>MESSAGES</h5>
                  <span class="badge badge-round badge-info">New 3</span>
                </div>

                <div class="list-group" role="presentation">
                  <div data-role="container">
                    <div data-role="content">
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <span class="avatar avatar-sm avatar-online">
                              <img src="../../global/portraits/2.jpg" alt="..." />
                              <i></i>
                            </span>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Mary Adams</h6>
                            <div class="media-meta">
                              <time datetime="2017-06-17T20:22:05+08:00">30 minutes ago</time>
                            </div>
                            <div class="media-detail">Anyways, i would like just do it</div>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <span class="avatar avatar-sm avatar-off">
                              <img src="../../global/portraits/3.jpg" alt="..." />
                              <i></i>
                            </span>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Caleb Richards</h6>
                            <div class="media-meta">
                              <time datetime="2017-06-17T12:30:30+08:00">12 hours ago</time>
                            </div>
                            <div class="media-detail">I checheck the document. But there seems</div>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <span class="avatar avatar-sm avatar-busy">
                              <img src="../../global/portraits/4.jpg" alt="..." />
                              <i></i>
                            </span>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">June Lane</h6>
                            <div class="media-meta">
                              <time datetime="2017-06-16T18:38:40+08:00">2 days ago</time>
                            </div>
                            <div class="media-detail">Lorem ipsum Id consectetur et minim</div>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <span class="avatar avatar-sm avatar-away">
                              <img src="../../global/portraits/5.jpg" alt="..." />
                              <i></i>
                            </span>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Edward Fletcher</h6>
                            <div class="media-meta">
                              <time datetime="2017-06-15T20:34:48+08:00">3 days ago</time>
                            </div>
                            <div class="media-detail">Dolor et irure cupidatat commodo nostrud nostrud.</div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="dropdown-menu-footer" role="presentation">
                  <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                    <i class="icon md-settings" aria-hidden="true"></i>
                  </a>
                  <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    See all messages
                  </a>
                </div>
              </div>
            </li>-->
            <!--END-Messages-->

            <!-- toggleChat-->
            <!--<li class="nav-item" id="toggleChat">
              <a class="nav-link" data-toggle="site-sidebar" href="javascript:void(0)" title="Chat"
                data-url="site-sidebar.tpl">
                <i class="icon md-comment" aria-hidden="true"></i>
              </a>
            </li>-->
            <!--END-toggleChat-->
          </ul>
          <!-- End Navbar Toolbar Right -->
          <div class="navbar-brand navbar-brand-center">
            <a href="/principal">
            <img class="navbar-brand-logo navbar-brand-logo-normal" src={{{url('/images/logo.png')}}} title="Centro Joyero">
              <img class="navbar-brand-logo navbar-brand-logo-special" src="../assets/images/logo-colored.png"
                title="Centro Joyero">
            </a>
          </div>
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
          <form role="search">
            <div class="form-group">
              <div class="input-search">
                <i class="input-search-icon md-search" aria-hidden="true"></i>
                <input type="text" class="form-control" name="site-search" placeholder="Search...">
                <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
                  data-toggle="collapse" aria-label="Close"></button>
              </div>
            </div>
          </form>
        </div>
        <!-- End Site Navbar Seach -->
      </div>
    </nav>
</section>

<section>

  @yield('menu')
  <div class="site-menubar">
      <div class="site-menubar-header">
        <div class="cover overlay">
          <img class="cover-image" src="../assets/examples/images/dashboard-header.jpg"
            alt="...">
          <div class="overlay-panel vertical-align overlay-background">
            <div class="vertical-align-middle">
              <a class="avatar avatar-lg" href="javascript:void(0)">
                <img src="../../global/portraits/1.jpg" alt="">
              </a>
              <div class="site-menubar-info">
                <h5 class="site-menubar-user">{{Auth::user()->name}}</h5>
                <p class="site-menubar-email">{{Auth::user()->email}}</p>
                <h6 class="site-menubar-email">
                    @if(Auth::user()->type_user == 1 )
                        <h6>Administrador</h6>
                    @endif
                    @if(Auth::user()->type_user  == 2)
                        <h6>Sub-Administrador</h6>
                    @endif
                    @if(Auth::user()->type_user == 3)
                      <h6>Colaborador</h6>
                    @endif</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="site-menubar-body">
        <div>
          <div>
          <!--Menú AA =(1)  Administrator-->
          @if(Auth::user()->type_user == 1)
            <ul class="site-menu" data-plugin="menu">
                <li class="site-menu-item active">
                  <a class="animsition-link" href="/principal">
                    <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                    <span class="site-menu-title">Inicio</span>
                  </a>
                </li>
                <li class="site-menu-item has-sub">
                  <a href="javascript:void(0)">
                    <i class="site-menu-icon md-store" aria-hidden="true"></i>
                      <span class="site-menu-title">Tienda</span>
                    <span class="site-menu-arrow"></span>
                  </a>
                  <ul class="site-menu-sub">
                  <li class="site-menu-item has-sub">
                    <a  href="javascript:void(0)">
                      <i class="site-menu-icon fa-diamond" aria-hidden="true"></i>
                        <span class="site-menu-title">Productos</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/productos">
                          <i class="site-menu-icon fa-tags" aria-hidden="true"></i>
                            <span class="site-menu-title">Productos</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/reportes-productos">
                          <i class="site-menu-icon fa-file-pdf-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Reporte de Productos</span>
                        </a>
                    </ul>
                  </li>

                    <li class="site-menu-item">
                        <a class="animsition-link" href="/sucursales">
                        <i class="site-menu-icon md-pin-drop" aria-hidden="true"></i>
                          <span class="site-menu-title">Sucursales</span>
                      </a>
                    </li>

                    <li class="site-menu-item has-sub">
                    <a  href="javascript:void(0)">
                      <i class="site-menu-icon md-pin-drop" aria-hidden="true"></i>
                        <span class="site-menu-title">Inventarios</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/inventarios">
                          <i  class="site-menu-icon md-pin-drop" aria-hidden="true"></i>
                            <span class="site-menu-title">Inventarios</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/reportinventarios">
                          <i  class="site-menu-icon fa-file-pdf-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Reporte de Inventarios</span>
                        </a>
                      </li>
                    </ul>
                  </li>

                    <li class="site-menu-item">
                        <a class="animsition-link" href="/categorias">
                        <i class="site-menu-icon md-collection-bookmark" aria-hidden="true"></i>
                          <span class="site-menu-title">Categorias</span>
                      </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="/lineas">
                        <i class="site-menu-icon md-accounts-list" aria-hidden="true"></i>
                          <span class="site-menu-title">Lineas</span>
                      </a>
                    </li>

                    <li class="site-menu-item has-sub">
                    <a  href="javascript:void(0)">
                      <i class="site-menu-icon fa-shopping-basket" aria-hidden="true"></i>
                        <span class="site-menu-title">Ventas</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/ventas/create">
                          <i class="site-menu-icon fa-cart-arrow-down" aria-hidden="true"></i>
                            <span class="site-menu-title">Agregar Venta</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                    <li class="site-menu-item">
                        <a class="animsition-link" href="/ventas">
                        <i class="site-menu-icon fa-line-chart" aria-hidden="true"></i>
                          <span class="site-menu-title">Mis Ventas</span>
                      </a>
                    </li>
                    </ul>
                    <ul class="site-menu-sub">
                    <li class="site-menu-item">
                        <a class="animsition-link" href="#">
                        <i  class="site-menu-icon fa-file-pdf-o" aria-hidden="true"></i>
                          <span class="site-menu-title">Reporte de ventas por sucursal y Estatus</span>
                      </a>
                    </li>
                    </ul>
                  </li>

                    <li class="d-none site-menu-item">
                        <a class="animsition-link" href="/status">
                        <i class="site-menu-icon fa-check-square-o" aria-hidden="true"></i>
                          <span class="site-menu-title">Estatus</span>
                      </a>
                    </li>

                    <li class="site-menu-item has-sub">
                    <a  href="javascript:void(0)">
                      <i class="site-menu-icon fa-exchange" aria-hidden="true"></i>
                        <span class="site-menu-title">Traspasos</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/traspasosAA">
                          <i  class="site-menu-icon fa-long-arrow-right" aria-hidden="true"></i>
                            <span class="site-menu-title">Mis Traspasos</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="#">
                          <i  class="site-menu-icon fa-file-pdf-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Reporte de traspasos por sucursal</span>
                        </a>
                      </li>
                    </ul>
                  </li>

                    <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <i class="site-menu-icon icon md-money-box" aria-hidden="true"></i>
                        <span class="site-menu-title">Gastos</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                    <li class="site-menu-item">
                        <a class="animsition-link" href="/gastos">
                        <i  class="site-menu-icon icon fa-book"  aria-hidden="true"></i>
                          <span class="site-menu-title">Mis Gastos</span>
                      </a>
                    </li>
                    </ul>
                    <ul class="site-menu-sub">
                    <li class="site-menu-item">
                        <a class="animsition-link" href="reportes-gastos">
                        <i  class="site-menu-icon fa-file-pdf-o" aria-hidden="true"></i>
                          <span class="site-menu-title">Reporte de Gastos</span>
                      </a>
                    </li>
                    </ul>
                  </li>
                  </ul>
                </li>
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <i class="site-menu-icon md-assignment-account" aria-hidden="true"></i>
                        <span class="site-menu-title">Usuarios</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/usuarios">
                          <i class="site-menu-icon icon fa-address-card-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Mis Usuarios</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/comisiones">
                          <i class="site-menu-icon icon md-money-box" aria-hidden="true"></i>
                            <span class="site-menu-title">Comisiones</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                        <a class="animsition-link" href="recibo">
                        <i class="site-menu-icon icon md-money-box" aria-hidden="true"></i>
                          <span class="site-menu-title">Recibo de Nomina</span>
                        </a>
                      </li>
                    </ul>
                    <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <i class="site-menu-icon fa-group" aria-hidden="true"></i>
                        <span class="site-menu-title">Clientes</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/mayoristas">
                          <i class="site-menu-icon icon fa-user-circle" aria-hidden="true"></i>
                            <span class="site-menu-title">Mayoristas</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <i class="site-menu-icon fa-group" aria-hidden="true"></i>
                        <span class="site-menu-title">Grupos</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/grupos">
                          <i class="site-menu-icon icon fa-address-card-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Mis grupos</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/grupos/invitacion">
                          <i class="site-menu-icon icon fa-wechat" aria-hidden="true"></i>
                            <span class="site-menu-title">Unirme a un grupo</span>
                        </a>
                      </li>
                    </ul>
                  </li>
              </ul>
            @endif
            <!--Menú AA =(1) END-Administrator-->

            <!--Menú SA =(2) Sub-Administrator-->
            @if(Auth::user()->type_user == 2)

              <ul class="site-menu" data-plugin="menu">
                  <li class="site-menu-item active">
                    <a class="animsition-link" href="/principal">
                      <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                      <span class="site-menu-title">Inicio</span>
                    </a>
                  </li>
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <i class="site-menu-icon md-store" aria-hidden="true"></i>
                        <span class="site-menu-title">Tienda</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                  <li class="site-menu-item has-sub">
                    <a  href="javascript:void(0)">
                      <i class="site-menu-icon fa-diamond" aria-hidden="true"></i>
                        <span class="site-menu-title">Productos</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/productos">
                          <i class="site-menu-icon fa-tags" aria-hidden="true"></i>
                            <span class="site-menu-title">Productos Tienda</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/productos/create">
                          <i class="site-menu-icon fa-plus" aria-hidden="true"></i>
                            <span class="site-menu-title">Agregar Productos</span>
                        </a>
                        </li>
                         <li class="site-menu-item">
                          <a class="animsition-link" href="/reportes-productos">
                          <i class="site-menu-icon fa-file-pdf-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Reportes De Entradas</span>
                        </a>
                        </li>
                    </ul>
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/sucursales">
                          <i class="site-menu-icon md-pin-drop" aria-hidden="true"></i>
                            <span class="site-menu-title">Sucursales</span>
                        </a>
                      </li>


                      <li class="site-menu-item">
                          <a class="animsition-link" href="/categorias">
                          <i class="site-menu-icon md-collection-bookmark" aria-hidden="true"></i>
                            <span class="site-menu-title">Categorias</span>
                        </a>
                      </li>

                      <li class="site-menu-item">
                        <a class="animsition-link" href="/sucursales">
                        <i class="site-menu-icon md-pin-drop" aria-hidden="true"></i>
                          <span class="site-menu-title">Inventarios</span>
                      </a>
                    </li>

                      <li class="site-menu-item">
                          <a class="animsition-link" href="/lineas">
                          <i class="site-menu-icon md-accounts-list" aria-hidden="true"></i>
                            <span class="site-menu-title">Lineas</span>
                        </a>
                      </li>

                      <li class="site-menu-item">
                          <a class="animsition-link" href="/ventas">
                          <i class="site-menu-icon fa-line-chart" aria-hidden="true"></i>
                            <span class="site-menu-title">Ventas</span>
                        </a>
                      </li>

                      <li class="d-none site-menu-item">
                          <a class="animsition-link" href="/status">
                          <i class="site-menu-icon fa-check-square-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Estatus</span>
                        </a>
                      </li>


                      <li class="site-menu-item">
                          <a class="animsition-link" href="/pagos">
                          <i class="site-menu-icon md-money" aria-hidden="true"></i>
                            <span class="site-menu-title">Pagos</span>
                        </a>
                      </li>

                      <li class="site-menu-item">
                          <a class="animsition-link" href="/traspasos">
                          <i class="site-menu-icon fa-exchange" aria-hidden="true"></i>
                            <span class="site-menu-title">Traspasos</span>
                        </a>
                      </li>

                      <li class="site-menu-item">
                          <a class="animsition-link" href="/gastos">
                          <i class="site-menu-icon icon md-money-box" aria-hidden="true"></i>
                            <span class="site-menu-title">Gastos</span>
                        </a>
                      </li>

                    </ul>
                  </li>
                  <li class="site-menu-item ">
                      <a class="animsition-link" href="/usuarios">
                        <i class="site-menu-icon md-assignment-account" aria-hidden="true"></i>
                        <span class="site-menu-title">Usuarios</span>
                      </a>
                    </li>
                </ul>
              @endif
              <!--Menú SA =(2) END-Sub-Administrator-->

              <!--Menú CO =(3) Colaborador-->
              @if(Auth::user()->type_user == 3)
              <ul class="site-menu" data-plugin="menu">
                  <li class="site-menu-item active">
                    <a class="animsition-link" href="/sucursal">
                      <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                      <span class="site-menu-title">Inicio</span>
                    </a>
                  </li>
                    <!-- Productos-->
                    <ul class="site-menu-sub">
                    <li class="site-menu-item">
                          <a class="animsition-link" href="/productosCO">
                            <i class="site-menu-icon fa-diamond" aria-hidden="true"></i>
                            <span class="site-menu-title">Productos</span>
                          </a>
                      </li>
                    </ul>
                  <!--END-Productos-->
                  <!--Sucursales-->
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <i class="site-menu-icon md-pin-drop" aria-hidden="true"></i>
                        <span class="site-menu-title">Sucursal</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <!-- Mis Productos-->
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/sucursalproductoCO">
                          <i class="site-menu-icon fa-tags" aria-hidden="true"></i>
                            <span class="site-menu-title">Productos Tienda</span>
                        </a>
                      </li>
                    </ul>
                    <!-- END Mis Productos-->
                  </li>
                  <!--END-Sucursales-->
                  <!--Ventas-->
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <i class="site-menu-icon fa-shopping-basket" aria-hidden="true"></i>
                        <span class="site-menu-title">Ventas</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <!-- Agregar Venta-->
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/ventas/create">
                          <i class="site-menu-icon fa-cart-arrow-down" aria-hidden="true"></i>
                            <span class="site-menu-title">Agregar Venta</span>
                        </a>
                      </li>
                    </ul>
                    <!-- END Agregar Venta-->
                    <!-- Mis Ventas-->
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/ventasCO">
                          <i class="site-menu-icon fa-line-chart" aria-hidden="true"></i>
                            <span class="site-menu-title">Mis Ventas</span>
                        </a>
                      </li>
                    </ul>
                    <!-- END Mis Ventas-->
                    <!--END-Ventas-->
                    <!-- Traspasos-->
                    <li class="site-menu-item has-sub">
                    <a  href="javascript:void(0)">
                      <i class="site-menu-icon fa-exchange" aria-hidden="true"></i>
                        <span class="site-menu-title">Traspasos</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <!-- Mis Traspasos-->
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/traspasos">
                          <i  class="site-menu-icon fa-long-arrow-right" aria-hidden="true"></i>
                            <span class="site-menu-title">Mis Traspasos</span>
                        </a>
                      </li>
                    </ul>
                    <!-- END Mis Taspasos-->
                    <!-- END Taspasos-->
                    <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <i class="site-menu-icon icon md-money-box" aria-hidden="true"></i>
                        <span class="site-menu-title">Gastos</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                    <li class="site-menu-item">
                        <a class="animsition-link" href="/gastos">
                        <i  class="site-menu-icon icon fa-book"  aria-hidden="true"></i>
                          <span class="site-menu-title">Mis Gastos</span>
                      </a>
                    </li>
                    </ul>
                    <ul class="site-menu-sub">
                    <li class="site-menu-item">
                        <a class="animsition-link" href="#">
                        <i  class="site-menu-icon fa-file-pdf-o" aria-hidden="true"></i>
                          <span class="site-menu-title">Reporte de Gastos</span>
                      </a>
                    </li>
                    </ul>
                  </li>
                  </ul>
                  </li>
                    </ul>
                  </li>
                </ul>
              @endif
                <!-- CO =(3) END-Colaborador-->
            </div>
          </div>
        </div>
    </div>
</section>

<section>
  @yield('content')
</section>
<!-- Footer
  <section>
    @yield('footer')
    <footer class="site-footer">
      <div class="site-footer-legal">© 2019 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202"></a></div>
      <div class="site-footer-right">
        Creado  <i class="red-600 icon md-pineapple"></i> por <a href="https://themeforest.net/user/creation-studio">Digital-Pineapple</a>
      </div>
    </footer>
  </section>
<section>-->
  @yield('js')
    <!-- Core  -->
      <script src="{{{url('/global/vendor/jquery/jquery.js')}}}"></script>

    <script src={{{url('global/vendor/babel-external-helpers/babel-external-helpers.js')}}}></script>
    <script src={{{url('global/vendor/jquery/jquery.min.js')}}}></script>
    <script src={{{url('global/vendor/popper-js/umd/popper.min.js')}}}></script>
    <script src={{{url('global/vendor/bootstrap/bootstrap.js')}}}></script>
    <script src={{{url('global/vendor/animsition/animsition.js')}}}></script>
    <script src={{{url('global/vendor/mousewheel/jquery.mousewheel.js')}}}></script>
    <script src={{{url('global/vendor/asscrollbar/jquery-asScrollbar.js')}}}></script>
    <script src={{{url('global/vendor/asscrollable/jquery-asScrollable.js')}}}></script>
    <script src={{{url('global/vendor/waves/waves.js')}}}></script>

    <!-- Plugins -->
    <script src={{{url('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js')}}}></script>
    <script src={{{url('global/vendor/switchery/switchery.js')}}}></script>
    <script src={{{url('global/vendor/intro-js/intro.js')}}}></script>
    <script src={{{url('global/vendor/screenfull/screenfull.js')}}}></script>
    <script src={{{url('global/vendor/slidepanel/jquery-slidePanel.js')}}}></script>
    <script src={{{url('global/vendor/chartist/chartist.min.js')}}}></script>
    <!--<script src={{{url('global/vendor/jvectormap/jquery-jvectormap.min.js')}}}></script>-->
    <!--<script src={{{url('global/vendor/jvectormap/maps/jquery-jvectormap-world-mill-en.js')}}}></script>-->
    <script src={{{url('global/vendor/matchheight/jquery.matchHeight-min.js')}}}></script>
    <script src={{{url('global/vendor/peity/jquery.peity.min.js')}}}></script>
    <script src={{{url('global/vendor/select2/select2.full.min.js')}}}></script>
    <script src={{{url('global/vendor/jquery-ui/jquery-ui.js')}}}></script>
    <script src={{{url('global/vendor/blueimp-tmpl/tmpl.js')}}}></script>
    <!-- <script src={{{url('global/vendor/blueimp-canvas-to-blob/canvas-to-blob.js')}}}></script>
    <script src={{{url('global/vendor/blueimp-load-image/load-image.all.min.js')}}}></script>
    <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload.js')}}}></script>
    <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-process.js')}}}></script>
    <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-image.js')}}}></script>
    <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-audio.js')}}}></script>
    <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-video.js')}}}></script>
    <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-validate.js')}}}></script>
    <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-ui.js')}}}></script>
    <script src={{{url('global/vendor/dropify/dropify.min.js')}}}></script>-->


    <!-- Scripts -->
    <script src={{{url('global/js/Component.js')}}}></script>
    <script src={{{url('global/js/Plugin.js')}}}></script>
    <script src={{{url('global/js/Base.js')}}}></script>
    <script src={{{url('global/js/Config.js')}}}></script>

    <script src={{{url('assets/js/Section/Menubar.js')}}}></script>
    <script src={{{url('assets/js/Section/Sidebar.js')}}}></script>
    <script src={{{url('assets/js/Section/PageAside.js')}}}></script>
    <script src={{{url('assets/js/Plugin/menu.js')}}}></script>

    <!-- Config -->
    <script src={{{url('global/js/config/colors.js')}}}></script>
    <script src={{{url('assets/js/config/tour.js')}}}></script>
    <!--<script>Config.set({{{url('assets')}}},{{{url('assets')}}});</script>-->

    <!-- Page -->
    <script src={{{url('assets/js/Site.js')}}}></script>
    <script src={{{url('global/js/Plugin/asscrollable.js')}}}></script>
    <script src={{{url('global/js/Plugin/slidepanel.js')}}}></script>
    <script src={{{url('global/js/Plugin/switchery.js')}}}></script>
    <script src={{{url('global/js/Plugin/matchheight.js')}}}></script>
    <script src={{{url('global/js/Plugin/jvectormap.js')}}}></script>
    <script src={{{url('global/js/Plugin/peity.js')}}}></script>
    <script src={{{url('global/js/Plugin/select2.js')}}}></script>
    <script src={{{url('assets/examples/js/dashboard/v1.js')}}}></script>
    <script src={{{url('global/js/Plugin/dropify.js')}}}></script>
    <!--<script src={{{url('assets/examples/js/forms/uploads.js')}}}></script>-->

    <!--DATA TABLES-->
    <script src={{{url('global/vendor/datatables.net/jquery.dataTables.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-bs4/dataTables.bootstrap4.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-rowgroup/dataTables.rowGroup.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-scroller/dataTables.scroller.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-responsive/dataTables.responsive.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-buttons/dataTables.buttons.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-buttons/buttons.html5.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-buttons/buttons.flash.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-buttons/buttons.print.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-buttons/buttons.colVis.js')}}}></script>
        <script src={{{url('global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js')}}}></script>
        <script src={{{url('global/vendor/asrange/jquery-asRange.min.js')}}}></script>
        <script src={{{url('global/vendor/bootbox/bootbox.js')}}}></script>
        <script src={{{url('global/js/Plugin/switchery.js')}}}></script>
        <script src={{{url('global/js/Plugin/datatables.js')}}}></script>

        <script src={{{url('assets/examples/js/tables/datatable.js')}}}></script>
        <script src={{{url('assets/examples/js/uikit/icon.js')}}}></script>

    <script src={{{url('global/js/Plugin/matchheight.js')}}}></script>
    <script src={{{url('global/js/Plugin/jvectormap.js')}}}></script>
    <script src={{{url('global/js/Plugin/peity.js')}}}></script>

    <script src={{{url('assets/examples/js/dashboard/v1.js')}}}></script>
    <script src={{{url('global/js/Plugin/icheck.js')}}}></script>

    <!-- datatable -->
    <script src={{{url('global/js/Plugin/datatables.js')}}}></script>
    <script src={{{url('assets/examples/js/tables/datatable.js')}}}></script>
    <script src={{{url('assets/examples/js/uikit/icon.js')}}}></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src={{{url('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js')}}}></script>
      <script src={{{url('global/vendor/tooltip/tooltip-popover.js')}}}></script>
  <script src="{{{url('global/js/components/material.js')}}}"></script>
  <script src="{{{url('global/vendor/bootstrap/bootstrap.js')}}}"></script>



    @section('delete-categorias')
    @show
    @section('delete-lineas')
    @show
    @section('delete-ventas')
    @show
    @section('delete-productos')
    @show
    @section('delete-usuarios')
    @show
    @section('delete-status')
    @show
    @section('delete-sucursales')
    @show
    @section('delete-gastos')
    @show
    @section('listado-productos')
    @show
    @section('calcular-precio')
    @show
    @section('precio-linea')
    @show
    @section('date-time')
    @section('disabled-submit')
    @show
    @section('colaborador-sucursal')
    @show
    @section('branch-user')
    @show
    @section('agregar-cliente')
    @show
    @section('filter')
    @section('barcode-product')
    @show
    @section('example')
    @show
    @section('traspaso')
    @show

</body>
</html>
