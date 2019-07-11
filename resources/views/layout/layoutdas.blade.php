<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Dashboard | Remark Material Admin Template</title>
    
    <link rel="apple-touch-icon" href={{{url('/assets/images/apple-touch-icon.png')}}}>
    <link rel="shortcut icon" href={{{url('/assets/images/favicon.ico')}}}>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href={{{url('global/css/bootstrap.min.css')}}}>
    <link rel="stylesheet" href={{{url('global/css/bootstrap-extend.min.css')}}}>
    <link rel="stylesheet" href={{{url('/assets/css/site.min.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/select2/select2.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/editable-table/editable-table.css')}}}>



             
    <!-- Plugins -->
    <link rel="stylesheet" href={{{url('global/vendor/animsition/animsition.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/asscrollable/asScrollable.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/switchery/switchery.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/intro-js/introjs.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/slidepanel/slidePanel.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/flag-icon-css/flag-icon.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/waves/waves.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/chartist/chartist.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/jvectormap/jquery-jvectormap.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}}>
    <link rel="stylesheet" href={{{url('assets/examples/css/dashboard/v1.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/blueimp-file-upload/jquery.fileupload.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/dropify/dropify.css')}}}>

    <!--datatables -->
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-bs4/dataTables.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css')}}}>
    <link rel="stylesheet" href={{{url('assets/examples/css/tables/datatable.css')}}}>
    
    <!-- Fonts -->
    <link rel="stylesheet" href={{{url('global/fonts/material-design/material-design.min.css')}}}>
    <link rel="stylesheet" href={{{url('global/fonts/brand-icons/brand-icons.min.css')}}}>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <link rel="stylesheet" href={{{url('global/fonts/font-awesome/font-awesome.css')}}}>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>


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
    <!--[if lt IE 9]>
    <script src={{{url('global/vendor/html5shiv/html5shiv.min.js')}}}></script>
    <![endif]-->
    
    <!--[if lt IE 10]>
    <script src={{{url('global/vendor/media-match/media.match.min.js')}}}></script>
    <script src={{{url('global/vendor/respond/respond.min.js')}}}></script>
    <![endif]-->
    
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
          <img class="navbar-brand-logo" src={{{url('/images/logo.png')}}} title="Remark">
          <span class="navbar-brand-text hidden-xs-down"> Remark</span>
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
            <li class="nav-item hidden-sm-down" id="toggleFullscreen">
              <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                <span class="sr-only">Toggle fullscreen</span>
              </a>
            </li>
            <li class="nav-item hidden-float">
              <a class="nav-link icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                role="button">
                <span class="sr-only">Toggle Search</span>
              </a>
            </li>
            <li class="nav-item dropdown dropdown-fw dropdown-mega">
              <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="fade"
                role="button">Mega <i class="icon md-chevron-down" aria-hidden="true"></i></a>
              <div class="dropdown-menu" role="menu">
                <div class="mega-content">
                  <div class="row">
                    <div class="col-md-4">
                      <h5>UI Kit</h5>
                      <ul class="blocks-2">
                        <li class="mega-menu m-0">
                          <ul class="list-icons">
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="advanced/animation.html">Animation</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="uikit/buttons.html">Buttons</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="uikit/colors.html">Colors</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="uikit/dropdowns.html">Dropdowns</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="uikit/icons.html">Icons</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="advanced/lightbox.html">Lightbox</a></li>
                          </ul>
                        </li>
                        <li class="mega-menu m-0">
                          <ul class="list-icons">
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="uikit/modals.html">Modals</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="uikit/panel-structure.html">Panels</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="structure/overlay.html">Overlay</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="uikit/tooltip-popover.html ">Tooltips</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="advanced/scrollable.html">Scrollable</a></li>
                            <li><i class="md-chevron-right" aria-hidden="true"></i><a href="uikit/typography.html">Typography</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5>Media
                        <span class="badge badge-pill badge-success">4</span>
                      </h5>
                      <ul class="blocks-3">
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src={{{url('global/photos/placeholder.png')}}} alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="../../global/photos/placeholder.png" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="../../global/photos/placeholder.png" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="../../global/photos/placeholder.png" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="../../global/photos/placeholder.png" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="../../global/photos/placeholder.png" alt="..." />
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5 class="mb-0">Accordion</h5>
                      <!-- Accordion -->
                      <div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true"
                        role="tablist">
                        <div class="panel">
                          <div class="panel-heading" id="siteMegaAccordionHeadingOne" role="tab">
                            <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseOne" data-parent="#siteMegaAccordion"
                              aria-expanded="false" aria-controls="siteMegaCollapseOne">
                              Collapsible Group Item #1
                            </a>
                          </div>
                          <div class="panel-collapse collapse" id="siteMegaCollapseOne" aria-labelledby="siteMegaAccordionHeadingOne"
                            role="tabpanel">
                            <div class="panel-body">
                              De moveat laudatur vestra parum doloribus labitur sentire partes, eripuit praesenti
                              congressus ostendit alienae, voluptati ornateque accusamus
                              clamat reperietur convicia albucius.
                            </div>
                          </div>
                        </div>
                        <div class="panel">
                          <div class="panel-heading" id="siteMegaAccordionHeadingTwo" role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#siteMegaCollapseTwo"
                              data-parent="#siteMegaAccordion" aria-expanded="false"
                              aria-controls="siteMegaCollapseTwo">
                              Collapsible Group Item #2
                            </a>
                          </div>
                          <div class="panel-collapse collapse" id="siteMegaCollapseTwo" aria-labelledby="siteMegaAccordionHeadingTwo"
                            role="tabpanel">
                            <div class="panel-body">
                              Praestabiliorem. Pellat excruciant legantur ullum leniter vacare foris voluptate
                              loco ignavi, credo videretur multoque choro fatemur mortis
                              animus adoptionem, bello statuat expediunt naturales.
                            </div>
                          </div>
                        </div>
    
                        <div class="panel">
                          <div class="panel-heading" id="siteMegaAccordionHeadingThree" role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#siteMegaCollapseThree"
                              data-parent="#siteMegaAccordion" aria-expanded="false"
                              aria-controls="siteMegaCollapseThree">
                              Collapsible Group Item #3
                            </a>
                          </div>
                          <div class="panel-collapse collapse" id="siteMegaCollapseThree" aria-labelledby="siteMegaAccordionHeadingThree"
                            role="tabpanel">
                            <div class="panel-body">
                              Horum, antiquitate perciperet d conspectum locus obruamus animumque perspici probabis
                              suscipere. Desiderat magnum, contenta poena desiderant
                              concederetur menandri damna disputandum corporum.
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Accordion -->
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          <!-- End Navbar Toolbar -->
    
          <!-- Navbar Toolbar Right -->
          <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up"
                aria-expanded="false" role="button">
                <span class="flag-icon flag-icon-us"></span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-gb"></span> English</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-fr"></span> French</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-cn"></span> Chinese</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-de"></span> German</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-nl"></span> Dutch</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="../../global/portraits/5.jpg" alt="...">
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-card" aria-hidden="true"></i> Billing</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
              </div>
            </li>
            <li class="nav-item dropdown">
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
            </li>
            <li class="nav-item dropdown">
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
            </li>
            <li class="nav-item" id="toggleChat">
              <a class="nav-link" data-toggle="site-sidebar" href="javascript:void(0)" title="Chat"
                data-url="site-sidebar.tpl">
                <i class="icon md-comment" aria-hidden="true"></i>
              </a>
            </li>
          </ul>
          <!-- End Navbar Toolbar Right -->
    
          <div class="navbar-brand navbar-brand-center">
            <a href="index.html">
              <img class="navbar-brand-logo navbar-brand-logo-normal" src="../assets/images/logo.png"
                title="Remark">
              <img class="navbar-brand-logo navbar-brand-logo-special" src="../assets/images/logo-colored.png"
                title="Remark">
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
          <img class="cover-image" src="../assets//examples/images/dashboard-header.jpg"
            alt="...">
          <div class="overlay-panel vertical-align overlay-background">
            <div class="vertical-align-middle">
              <a class="avatar avatar-lg" href="javascript:void(0)">
                <img src="../../global/portraits/1.jpg" alt="">
              </a>
              <div class="site-menubar-info">
                <h5 class="site-menubar-user">Machi</h5>
                <p class="site-menubar-email">machidesign@gmail.com</p>
              </div>
            </div>
          </div>
        </div>
      </div>  
      <div class="site-menubar-body">
        <div>
          <div>
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
                  <li class="site-menu-item">
                        <a class="animsition-link" href="/productos">
                        <i class="site-menu-icon fa-diamond" aria-hidden="true"></i>
                          <span class="site-menu-title">Productos</span>
                          </a>
                    </li>

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

                    <li class="site-menu-item">
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

              
            </div>
          </div>
        </div>
    </div>
</section>

<section>
  @yield('content')
</section>
<!-- Footer -->
  <section>
    @yield('footer')
    <footer class="site-footer">
      <div class="site-footer-legal">© 2019 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202"></a></div>
      <div class="site-footer-right">
        Creado  <i class="red-600 icon md-pineapple"></i> por <a href="https://themeforest.net/user/creation-studio">Digital-Pineapple</a>
      </div>
    </footer>
  </section>
<section>
  @yield('js')
    <!-- Core  -->
    <script src={{{url('global/vendor/babel-external-helpers/babel-external-helpers.js')}}}></script>
    <script src={{{url('global/vendor/jquery/jquery.js')}}}></script>
    <script src={{{url('global/vendor/popper-js/umd/popper.min.js')}}}></script>
    <script src={{{url('global/vendor/bootstrap/bootstrap.js')}}}></script>
    <script src={{{url('global/vendor/animsition/animsition.js')}}}></script>
    <script src={{{url('global/vendor/mousewheel/jquery.mousewheel.js')}}}></script>
    <script src={{{url('global/vendor/asscrollbar/jquery-asScrollbar.js')}}}></script>
    <script src={{{url('global/vendor/asscrollable/jquery-asScrollable.js')}}}></script>
    <script src={{{url('global/vendor/waves/waves.js')}}}></script>
    
    <!-- Plugins -->
    <script src={{{url('global/vendor/switchery/switchery.js')}}}></script>
    <script src={{{url('global/vendor/intro-js/intro.js')}}}></script>
    <script src={{{url('global/vendor/screenfull/screenfull.js')}}}></script>
    <script src={{{url('global/vendor/slidepanel/jquery-slidePanel.js')}}}></script>
    <script src={{{url('global/vendor/chartist/chartist.min.js')}}}></script>
    <script src={{{url('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js')}}}></script>
    <script src={{{url('global/vendor/jvectormap/jquery-jvectormap.min.js')}}}></script>
    <script src={{{url('global/vendor/jvectormap/maps/jquery-jvectormap-world-mill-en.js')}}}></script>
    <script src={{{url('global/vendor/matchheight/jquery.matchHeight-min.js')}}}></script>
    <script src={{{url('global/vendor/peity/jquery.peity.min.js')}}}></script>
    <script src={{{url('global/vendor/select2/select2.full.min.js')}}}></script>
    <script src={{{url('global/vendor/jquery-ui/jquery-ui.js')}}}></script>
        <script src={{{url('global/vendor/blueimp-tmpl/tmpl.js')}}}></script>
        <script src={{{url('global/vendor/blueimp-canvas-to-blob/canvas-to-blob.js')}}}></script>
        <script src={{{url('global/vendor/blueimp-load-image/load-image.all.min.js')}}}></script>
        <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload.js')}}}></script>
        <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-process.js')}}}></script>
        <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-image.js')}}}></script>
        <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-audio.js')}}}></script>
        <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-video.js')}}}></script>
        <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-validate.js')}}}></script>
        <script src={{{url('global/vendor/blueimp-file-upload/jquery.fileupload-ui.js')}}}></script>
        <script src={{{url('global/vendor/dropify/dropify.min.js')}}}></script>
    
        
    <!-- datatables -->
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
    <script src={{{url('assets/examples/js/forms/uploads.js')}}}></script>

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
  </body>

    <script src={{{url('global/js/Plugin/matchheight.js')}}}></script>
    <script src={{{url('global/js/Plugin/jvectormap.js')}}}></script>
    <script src={{{url('global/js/Plugin/peity.js')}}}></script>

    <script src={{{url('assets/examples/js/dashboard/v1.js')}}}></script>

    <!-- datatable -->
    <script src={{{url('global/js/Plugin/datatables.js')}}}></script>
    <script src={{{url('assets/examples/js/tables/datatable.js')}}}></script>
    <script src={{{url('assets/examples/js/uikit/icon.js')}}}></script>

    

    
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

  



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
</body>
</html>
