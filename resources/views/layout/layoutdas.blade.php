<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    
    <title>Dashboard | Remark Material Admin Template</title>
    
    <link rel="apple-touch-icon" href={{{url('/assets/images/apple-touch-icon.png')}}}>
    <link rel="shortcut icon" href={{{url('/assets/images/favicon.ico')}}}>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href={{{url('global/css/bootstrap.min.css')}}}>
    <link rel="stylesheet" href={{{url('global/css/bootstrap-extend.min.css')}}}>
    <link rel="stylesheet" href={{{url('/assets/css/site.min.css')}}}>
    
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
    
    
    <!-- Fonts -->
    <link rel="stylesheet" href={{{url('global/fonts/material-design/material-design.min.css')}}}>
    <link rel="stylesheet" href={{{url('global/fonts/brand-icons/brand-icons.min.css')}}}>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    
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
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
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
      </div>  <div class="site-menubar-body">
        <div>
          <div>
            <ul class="site-menu" data-plugin="menu">
              <li class="site-menu-item active">
                <a class="animsition-link" href="index.html">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Dashboard</span>
                    </a>
              </li>
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                        <span class="site-menu-title">Layouts</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/menubar-fold.html">
                      <span class="site-menu-title">Menubar Fold</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/menubar-disable-hover.html">
                      <span class="site-menu-title">Menubar Disable Hover</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/menubar-open.html">
                      <span class="site-menu-title">Menubar Open</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/menubar-push.html">
                      <span class="site-menu-title">Menubar Push</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/grids.html">
                      <span class="site-menu-title">Grid Scaffolding</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/layout-grid.html">
                      <span class="site-menu-title">Layout Grid</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/headers.html">
                      <span class="site-menu-title">Different Headers</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/panel-transition.html">
                      <span class="site-menu-title">Panel Transition</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/boxed.html">
                      <span class="site-menu-title">Boxed Layout</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/two-columns.html">
                      <span class="site-menu-title">Two Columns</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/bordered-header.html">
                      <span class="site-menu-title">Bordered Header</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/menubar-flipped.html">
                      <span class="site-menu-title">Menubar Flipped</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="layouts/menubar-native-scrolling.html">
                      <span class="site-menu-title">Menubar Native Scrolling</span>
                    </a>
                  </li>
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <span class="site-menu-title">Page Aside</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                        <a class="animsition-link" href="layouts/aside-left-static.html">
                          <span class="site-menu-title">Left Static</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="layouts/aside-right-static.html">
                          <span class="site-menu-title">Right Static</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="layouts/aside-left-fixed.html">
                          <span class="site-menu-title">Left Fixed</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="layouts/aside-right-fixed.html">
                          <span class="site-menu-title">Right Fixed</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-google-pages" aria-hidden="true"></i>
                        <span class="site-menu-title">Pages</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <span class="site-menu-title">Errors</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/error-400.html">
                          <span class="site-menu-title">400</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/error-403.html">
                          <span class="site-menu-title">403</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/error-404.html">
                          <span class="site-menu-title">404</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/error-500.html">
                          <span class="site-menu-title">500</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/error-503.html">
                          <span class="site-menu-title">503</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/faq.html">
                      <span class="site-menu-title">FAQ</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/gallery.html">
                      <span class="site-menu-title">Gallery</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/gallery-grid.html">
                      <span class="site-menu-title">Gallery Grid</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/search-result.html">
                      <span class="site-menu-title">Search Result</span>
                    </a>
                  </li>
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <span class="site-menu-title">Maps</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/map-google.html">
                          <span class="site-menu-title">Google Maps</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/map-vector.html">
                          <span class="site-menu-title">Vector Maps</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/maintenance.html">
                      <span class="site-menu-title">Maintenance</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/forgot-password.html">
                      <span class="site-menu-title">Forgot Password</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/lockscreen.html">
                      <span class="site-menu-title">Lockscreen</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/login.html">
                      <span class="site-menu-title">Login</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/register.html">
                      <span class="site-menu-title">Register</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/login-v2.html">
                      <span class="site-menu-title">Login V2</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/register-v2.html">
                      <span class="site-menu-title">Register V2</span>
                      <div class="site-menu-label">
                        <span class="badge badge-info badge-round">new</span>
                      </div>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/login-v3.html">
                      <span class="site-menu-title">Login V3</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/register-v3.html">
                      <span class="site-menu-title">Register V3</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/user.html">
                      <span class="site-menu-title">User List</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/invoice.html">
                      <span class="site-menu-title">Invoice</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/blank.html">
                      <span class="site-menu-title">Blank Page</span>
                    </a>
                  </li>
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <span class="site-menu-title">Email</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/email-articles.html">
                          <span class="site-menu-title">Articles</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/email-welcome.html">
                          <span class="site-menu-title">Welcome</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/email-post.html">
                          <span class="site-menu-title">Post</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/email-thumbnail.html">
                          <span class="site-menu-title">Thumbnail</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="pages/email-news.html">
                          <span class="site-menu-title">News</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/code-editor.html">
                      <span class="site-menu-title">Code Editor</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/profile.html">
                      <span class="site-menu-title">Profile</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/profile-v2.html">
                      <span class="site-menu-title">Profile V2</span>
                      <div class="site-menu-label">
                        <span class="badge badge-info badge-round">new</span>
                      </div>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/profile-v3.html">
                      <span class="site-menu-title">Profile V3</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/site-map.html">
                      <span class="site-menu-title">Sitemap</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/project.html">
                      <span class="site-menu-title">Project</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-palette" aria-hidden="true"></i>
                        <span class="site-menu-title">Basic UI</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <span class="site-menu-title">Panel</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                        <a class="animsition-link" href="uikit/panel-structure.html">
                          <span class="site-menu-title">Panel Structure</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="uikit/panel-actions.html">
                          <span class="site-menu-title">Panel Actions</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="uikit/panel-portlets.html">
                          <span class="site-menu-title">Panel Portlets</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/buttons.html">
                      <span class="site-menu-title">Buttons</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/cards.html">
                      <span class="site-menu-title">Cards</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/dropdowns.html">
                      <span class="site-menu-title">Dropdowns</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/icons.html">
                      <span class="site-menu-title">Icons</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/list.html">
                      <span class="site-menu-title">List</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/tooltip-popover.html">
                      <span class="site-menu-title">Tooltip &amp; Popover</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/modals.html">
                      <span class="site-menu-title">Modals</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/tabs-accordions.html">
                      <span class="site-menu-title">Tabs &amp; Accordions</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/images.html">
                      <span class="site-menu-title">Images</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/badges.html">
                      <span class="site-menu-title">Badges</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/progress-bars.html">
                      <span class="site-menu-title">Progress Bars</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/carousel.html">
                      <span class="site-menu-title">Carousel</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/typography.html">
                      <span class="site-menu-title">Typography</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/colors.html">
                      <span class="site-menu-title">Colors</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="uikit/utilities.html">
                      <span class="site-menu-title">Utilties</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-format-color-fill" aria-hidden="true"></i>
                        <span class="site-menu-title">Advanced UI</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item hidden-sm-down site-tour-trigger">
                    <a href="javascript:void(0)">
                      <span class="site-menu-title">Tour</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/animation.html">
                      <span class="site-menu-title">Animation</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/highlight.html">
                      <span class="site-menu-title">Highlight</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/lightbox.html">
                      <span class="site-menu-title">Lightbox</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/scrollable.html">
                      <span class="site-menu-title">Scrollable</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/rating.html">
                      <span class="site-menu-title">Rating</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/context-menu.html">
                      <span class="site-menu-title">Context Menu</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/alertify.html">
                      <span class="site-menu-title">Alertify</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/masonry.html">
                      <span class="site-menu-title">Masonry</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/treeview.html">
                      <span class="site-menu-title">Treeview</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/toastr.html">
                      <span class="site-menu-title">Toastr</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/maps-vector.html">
                      <span class="site-menu-title">Vector Maps</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/maps-google.html">
                      <span class="site-menu-title">Google Maps</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/sortable-nestable.html">
                      <span class="site-menu-title">Sortable &amp; Nestable</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="advanced/bootbox-sweetalert.html">
                      <span class="site-menu-title">Bootbox &amp; Sweetalert</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-puzzle-piece" aria-hidden="true"></i>
                        <span class="site-menu-title">Structure</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/alerts.html">
                      <span class="site-menu-title">Alerts</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/ribbon.html">
                      <span class="site-menu-title">Ribbon</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/pricing-tables.html">
                      <span class="site-menu-title">Pricing Tables</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/overlay.html">
                      <span class="site-menu-title">Overlay</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/cover.html">
                      <span class="site-menu-title">Cover</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/timeline-simple.html">
                      <span class="site-menu-title">Simple Timeline</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/timeline.html">
                      <span class="site-menu-title">Timeline</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/step.html">
                      <span class="site-menu-title">Step</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/comments.html">
                      <span class="site-menu-title">Comments</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/media.html">
                      <span class="site-menu-title">Media</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/chat.html">
                      <span class="site-menu-title">Chat</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/testimonials.html">
                      <span class="site-menu-title">Testimonials</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/nav.html">
                      <span class="site-menu-title">Nav</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/navbars.html">
                      <span class="site-menu-title">Navbars</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/blockquotes.html">
                      <span class="site-menu-title">Blockquotes</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/pagination.html">
                      <span class="site-menu-title">Pagination</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="structure/breadcrumbs.html">
                      <span class="site-menu-title">Breadcrumbs</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-widgets" aria-hidden="true"></i>
                        <span class="site-menu-title">Widgets</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="widgets/statistics.html">
                      <span class="site-menu-title">Statistics Widgets</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="widgets/data.html">
                      <span class="site-menu-title">Data Widgets</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="widgets/blog.html">
                      <span class="site-menu-title">Blog Widgets</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="widgets/chart.html">
                      <span class="site-menu-title">Chart Widgets</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="widgets/social.html">
                      <span class="site-menu-title">Social Widgets</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="widgets/weather.html">
                      <span class="site-menu-title">Weather Widgets</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-comment-alt-text" aria-hidden="true"></i>
                        <span class="site-menu-title">Forms</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="forms/general.html">
                      <span class="site-menu-title">General Elements</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="forms/material.html">
                      <span class="site-menu-title">Material Elements</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="forms/advanced.html">
                      <span class="site-menu-title">Advanced Elements</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="forms/layouts.html">
                      <span class="site-menu-title">Form Layouts</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="forms/wizard.html">
                      <span class="site-menu-title">Form Wizard</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="forms/validation.html">
                      <span class="site-menu-title">Form Validation</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="forms/masks.html">
                      <span class="site-menu-title">Form Masks</span>
                    </a>
                  </li>
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <span class="site-menu-title">Editors</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                        <a class="animsition-link" href="forms/editor-summernote.html">
                          <span class="site-menu-title">Summernote</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="forms/editor-markdown.html">
                          <span class="site-menu-title">Markdown</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="forms/editor-ace.html">
                          <span class="site-menu-title">Ace Editor</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="forms/image-cropping.html">
                      <span class="site-menu-title">Image Cropping</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="forms/file-uploads.html">
                      <span class="site-menu-title">File Uploads</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-border-all" aria-hidden="true"></i>
                        <span class="site-menu-title">Tables</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="tables/basic.html">
                      <span class="site-menu-title">Basic Tables</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="tables/bootstrap.html">
                      <span class="site-menu-title">Bootstrap Tables</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="tables/floatthead.html">
                      <span class="site-menu-title">floatThead</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="tables/responsive.html">
                      <span class="site-menu-title">Responsive Tables</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="tables/editable.html">
                      <span class="site-menu-title">Editable Tables</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="tables/jsgrid.html">
                      <span class="site-menu-title">jsGrid</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="tables/footable.html">
                      <span class="site-menu-title">FooTable</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="tables/datatable.html">
                      <span class="site-menu-title">DataTables</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="tables/jqtabledit.html">
                      <span class="site-menu-title">Jquery Tabledit</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="tables/table-dragger.html">
                      <span class="site-menu-title">Table Dragger</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-chart" aria-hidden="true"></i>
                        <span class="site-menu-title">Chart</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="charts/chartjs.html">
                      <span class="site-menu-title">Chart.js</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="charts/gauges.html">
                      <span class="site-menu-title">Gauges</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="charts/flot.html">
                      <span class="site-menu-title">Flot</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="charts/peity.html">
                      <span class="site-menu-title">Peity</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="charts/sparkline.html">
                      <span class="site-menu-title">Sparkline</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="charts/morris.html">
                      <span class="site-menu-title">Morris</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="charts/chartist.html">
                      <span class="site-menu-title">Chartist.js</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="charts/rickshaw.html">
                      <span class="site-menu-title">Rickshaw</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="charts/pie-progress.html">
                      <span class="site-menu-title">Pie Progress</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="charts/c3.html">
                      <span class="site-menu-title">C3</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-apps" aria-hidden="true"></i>
                        <span class="site-menu-title">Apps</span>
                                <span class="site-menu-arrow"></span>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/contacts/contacts.html">
                      <span class="site-menu-title">Contacts</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/calendar/calendar.html">
                      <span class="site-menu-title">Calendar</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/notebook/notebook.html">
                      <span class="site-menu-title">Notebook</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/taskboard/taskboard.html">
                      <span class="site-menu-title">Taskboard</span>
                    </a>
                  </li>
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <span class="site-menu-title">Documents</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                        <a class="animsition-link" href="apps/documents/articles.html">
                          <span class="site-menu-title">Articles</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="apps/documents/categories.html">
                          <span class="site-menu-title">Categories</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="apps/documents/article.html">
                          <span class="site-menu-title">Article</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/forum/forum.html">
                      <span class="site-menu-title">Forum</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/message/message.html">
                      <span class="site-menu-title">Message</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/projects/projects.html">
                      <span class="site-menu-title">Projects</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/mailbox/mailbox.html">
                      <span class="site-menu-title">Mailbox</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/media/overview.html">
                      <span class="site-menu-title">Media</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/work/work.html">
                      <span class="site-menu-title">Work</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/location/location.html">
                      <span class="site-menu-title">Location</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="apps/travel/travel.html">
                      <span class="site-menu-title">Travel</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>      
          </div>
        </div>
      </div>
    </div>
</section>

<section>
  @yield('content')
    <!-- Page -->
    <div class="page">
      <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea One-->
            <div class="card card-shadow" id="widgetLineareaOne">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    User
                  </div>
                  <span class="float-right grey-700 font-size-30">1,253</span>
                </div>
                <div class="mb-20 grey-500">
                  <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  15% From this yesterday
                </div>
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea One -->
          </div>
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea Two -->
            <div class="card card-shadow" id="widgetLineareaTwo">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-flash grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    VISITS
                  </div>
                  <span class="float-right grey-700 font-size-30">2,425</span>
                </div>
                <div class="mb-20 grey-500">
                  <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  34.2% From this week
                </div>
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea Two -->
          </div>
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea Three -->
            <div class="card card-shadow" id="widgetLineareaThree">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    Total Clicks
                  </div>
                  <span class="float-right grey-700 font-size-30">1,864</span>
                </div>
                <div class="mb-20 grey-500">
                  <i class="icon md-long-arrow-down red-500 font-size-16"></i>                  15% From this yesterday
                </div>
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea Three -->
          </div>
          <div class="col-xl-3 col-md-6">
            <!-- Widget Linearea Four -->
            <div class="card card-shadow" id="widgetLineareaFour">
              <div class="card-block p-20 pt-10">
                <div class="clearfix">
                  <div class="grey-800 float-left py-10">
                    <i class="icon md-view-list grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    Items
                  </div>
                  <span class="float-right grey-700 font-size-30">845</span>
                </div>
                <div class="mb-20 grey-500">
                  <i class="icon md-long-arrow-up green-500 font-size-16"></i>                  18.4% From this yesterday
                </div>
                <div class="ct-chart h-50"></div>
              </div>
            </div>
            <!-- End Widget Linearea Four -->
          </div>

          <div class="col-xxl-7 col-lg-7">
            <!-- Widget Jvmap -->
            <div class="card card-shadow">
              <div class="card-block p-0">
                <div id="widgetJvmap" class="h-450"></div>
              </div>
            </div>
            <!-- End Widget Jvmap -->
          </div>

          <div class="col-xxl-5 col-lg-5">
            <!-- Widget Current Chart -->
            <div class="card card-shadow" id="widgetCurrentChart">
              <div class="p-30 white bg-green-500">
                <div class="font-size-20 mb-20">The current chart</div>
                <div class="ct-chart h-200">
                </div>
              </div>
              <div class="bg-white p-30 font-size-14">
                <div class="counter counter-lg text-left">
                  <div class="counter-label mb-5">Approve rate are above average</div>
                  <div class="counter-number-group">
                    <span class="counter-number">12,673</span>
                    <span class="counter-number-related text-uppercase font-size-14">pcs</span>
                  </div>
                </div>
                <button type="button" class="btn-raised btn btn-info btn-floating">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
              </div>
            </div>
            <!-- End Widget Current Chart -->
          </div>

          <div class="col-xl-4 col-lg-6">
            <!-- Widget User list -->
            <div class="card" id="widgetUserList">
              <div class="card-header cover overlay">
                <img class="cover-image h-200" src="../assets//examples/images/dashboard-header.jpg"
                  alt="..." />
                <div class="overlay-panel vertical-align overlay-background">
                  <div class="vertical-align-middle">
                    <a class="avatar avatar-100 float-left mr-20" href="javascript:void(0)">
                      <img src="../../global/portraits/5.jpg" alt="">
                    </a>
                    <div class="float-left">
                      <div class="font-size-20">Robin Ahrens</div>
                      <p class="mb-20 text-nowrap">
                        <span class="text-break">machidesign@gmail</span>
                      </p>
                      <div class="text-nowrap font-size-18">
                        <a href="" class="white mr-10">
                      <i class="icon bd-twitter"></i>
                    </a>
                        <a href="" class="white mr-10">
                      <i class="icon bd-facebook"></i>
                    </a>
                        <a href="" class="white">
                      <i class="icon bd-dribbble"></i>
                    </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-block py-0">
                <ul class="list-group list-group-full list-group-dividered mb-0">
                  <li class="list-group-item">
                    <div class="media">
                      <div class="pr-20">
                        <a class="avatar avatar-lg" href="javascript:void(0)">
                          <img class="img-fluid" src="../../global/portraits/1.jpg"
                            alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-0 mb-5">Herman Beck</h5>
                        <small>San Francisco</small>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="media">
                      <div class="pr-20">
                        <a class="avatar avatar-lg" href="javascript:void(0)">
                          <img class="img-fluid" src="../../global/portraits/2.jpg"
                            alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-0 mb-5">Mary Adams</h5>
                        <small>Salt Lake City, Utah</small>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="media">
                      <div class="pr-20">
                        <a class="avatar avatar-lg" href="javascript:void(0)">
                          <img class="img-fluid" src="../../global/portraits/3.jpg"
                            alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-0 mb-5">Caleb Richards</h5>
                        <small>Basking Ridge, NJ</small>
                      </div>
                    </div>
                  </li>
                </ul>
                <button type="button" class="btn-raised btn btn-danger btn-floating">
                  <i class="icon md-plus" aria-hidden="true"></i>
                </button>
              </div>
            </div>
            <!-- End Widget User list -->
          </div>

          <div class="col-xl-4 col-lg-6">
            <!-- Widget Chat -->
            <div class="card card-shadow" id="chat">
              <div class="card-header bg-white px-0">
                <a class="float-left" href="javascript:void(0)">
              <i class="icon md-chevron-left" aria-hidden="true"></i>
            </a>
                <div class="text-right">
                  Conversation with
                  <span class="hidden-xs-down">June Lane</span>
                  <a class="avatar ml-10" data-toggle="tooltip" href="#" data-placement="right" title="June Lane">
                    <img src="../../global/portraits/4.jpg" alt="...">
                  </a>
                </div>
              </div>
              <div class="card-block">
                <div class="chats">
                  <div class="chat chat-left">
                    <div class="chat-avatar">
                      <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="">
                        <img src="../../global/portraits/5.jpg" alt="Edward Fletcher">
                      </a>
                    </div>
                    <div class="chat-body">
                      <div class="chat-content" data-toggle="tooltip" title="11:37:08 am">
                        <p>Good morning, sir.</p>
                        <p>What can I do for you?</p>
                      </div>
                    </div>
                  </div>
                  <div class="chat">
                    <div class="chat-avatar">
                      <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="">
                        <img src="../../global/portraits/4.jpg" alt="June Lane">
                      </a>
                    </div>
                    <div class="chat-body">
                      <div class="chat-content" data-toggle="tooltip" title="11:39:57 am">
                        <p>Well, I am just looking around.</p>
                      </div>
                    </div>
                  </div>
                  <div class="chat chat-left">
                    <div class="chat-avatar">
                      <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="">
                        <img src="../../global/portraits/5.jpg" alt="Edward Fletcher">
                      </a>
                    </div>
                    <div class="chat-body">
                      <div class="chat-content" data-toggle="tooltip" title="11:40:10 am">
                        <p>If necessary, please ask me.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-white">
                <form>
                  <div class="input-group form-material">
                    <span class="input-group-prepend">
                      <a href="javascript: void(0)" class="btn btn-pure btn-default icon md-camera"></a>
                    </span>
                    <input class="form-control" type="text" placeholder="Type message here ...">
                    <span class="input-group-append">
                      <button class="btn btn-pure btn-default icon md-mail-send" type="button"></button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
            <!-- End Widget Chat -->
          </div>

          <div class="col-xl-4 col-lg-6">
            <!-- Widget Info -->
            <div class="card card-shadow">
              <div class="card-header cover overlay">
                <div class="cover-background h-200" style="background-image: url('../../global/photos/placeholder.png')"></div>
              </div>
              <div class="card-block px-30 py-20" style="height:calc(100% - 250px);">
                <div class="mb-10" style="margin-top: -70px;">
                  <a class="avatar avatar-100 bg-white img-bordered" href="javascript:void(0)">
                    <img src="../../global/portraits/2.jpg" alt="">
                  </a>
                </div>
                <div class="mb-20">
                  <div class="font-size-20">Caleb Richards</div>
                  <div class="font-size-14 grey-500">
                    <span>2 hours ago</span> |
                    <span>Comments 20</span>
                  </div>
                </div>
                <p>
                  Lorem ipsum dolLorem ip sum dolor sit amet, consectetur adipiscing elit. Integer
                  nec odio. Praesent libero.or sit amet, consectetur adipiscing
                  elit. Integer nec odio. Praesent libero.
                </p>
              </div>
            </div>
            <!-- End Widget Info -->
          </div>

          <div class="col-xxl-5 col-lg-6">
            <!-- Panel Projects -->
            <div class="panel" id="projects">
              <div class="panel-heading">
                <h3 class="panel-title">Projects</h3>
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <td>Projects</td>
                      <td>Completed</td>
                      <td>Date</td>
                      <td>Actions</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>The sun climbing plan</td>
                      <td>
                        <span data-plugin="peityPie" data-skin="red">7/10</span>
                      </td>
                      <td>Jan 1, 2017</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Edit">
                          <i class="icon md-wrench" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Delete">
                          <i class="icon md-close" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Lunar probe project</td>
                      <td>
                        <span data-plugin="peityPie" data-skin="blue">3/10</span>
                      </td>
                      <td>Feb 12, 2017</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Edit">
                          <i class="icon md-wrench" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Delete">
                          <i class="icon md-close" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Dream successful plan</td>
                      <td>
                        <span data-plugin="peityPie" data-skin="green">9/10</span>
                      </td>
                      <td>Apr 9, 2017</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Edit">
                          <i class="icon md-wrench" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Delete">
                          <i class="icon md-close" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Office automatization</td>
                      <td>
                        <span data-plugin="peityPie" data-skin="orange">5/10</span>
                      </td>
                      <td>May 15, 2017</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Edit">
                          <i class="icon md-wrench" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Delete">
                          <i class="icon md-close" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Open strategy</td>
                      <td>
                        <span data-plugin="peityPie" data-skin="brown">2/10</span>
                      </td>
                      <td>Jun 2, 2017</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Edit">
                          <i class="icon md-wrench" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default"
                          data-toggle="tooltip" data-original-title="Delete">
                          <i class="icon md-close" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- End Panel Projects -->
          </div>

          <div class="col-xxl-7 col-lg-6">
            <!-- Panel Projects Status -->
            <div class="panel" id="projects-status">
              <div class="panel-heading">
                <h3 class="panel-title">
                  Projects Status
                  <span class="badge badge-pill badge-info">5</span>
                </h3>
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <td>ID</td>
                      <td>Project</td>
                      <td>Status</td>
                      <td class="text-left">Progress</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>619</td>
                      <td>The sun climbing plan</td>
                      <td>
                        <span class="badge badge-primary">Developing</span>
                      </td>
                      <td>
                        <span data-plugin="peityLine">5,3,2,-1,-3,-2,2,3,5,2</span>
                      </td>
                    </tr>
                    <tr>
                      <td>620</td>
                      <td>Lunar probe project</td>
                      <td>
                        <span class="badge badge-warning">Design</span>
                      </td>
                      <td>
                        <span data-plugin="peityLine">1,-1,0,2,3,1,-1,1,4,2</span>
                      </td>
                    </tr>
                    <tr>
                      <td>621</td>
                      <td>Dream successful plan</td>
                      <td>
                        <span class="badge badge-info">Testing</span>
                      </td>
                      <td>
                        <span data-plugin="peityLine">2,3,-1,-3,-1,0,2,4,5,3</span>
                      </td>
                    </tr>
                    <tr>
                      <td>622</td>
                      <td>Office automatization</td>
                      <td>
                        <span class="badge badge-danger">Canceled</span>
                      </td>
                      <td>
                        <span data-plugin="peityLine">1,-2,0,2,4,5,3,2,4,2</span>
                      </td>
                    </tr>
                    <tr>
                      <td>623</td>
                      <td>Open strategy</td>
                      <td>
                        <span class="badge badge-default">Reply waiting</span>
                      </td>
                      <td>
                        <span data-plugin="peityLine">4,2,-1,-3,-2,1,3,5,2,4</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- End Panel Projects Stats -->
          </div>

        </div>
      </div>
    </div>
    <!-- End Page -->
</section>
  <!-- Core  -->
<section>
  @yield('js')
     <!-- Footer -->
    <footer class="site-footer">
      <div class="site-footer-legal">© 2018 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
      <div class="site-footer-right">
        Crafted with <i class="red-600 icon md-favorite"></i> by <a href="https://themeforest.net/user/creation-studio">Creation Studio</a>
      </div>
    </footer>
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
    <script>Config.set({{{url('assets')}}}, {{{url('assets')}}});</script>
    
    <!-- Page -->
    <script src={{{url('assets/js/Site.js')}}}></script>
    <script src={{{url('global/js/Plugin/asscrollable.js')}}}></script>
    <script src={{{url('global/js/Plugin/slidepanel.js')}}}></script>
    <script src={{{url('global/js/Plugin/switchery.js')}}}></script>
        <script src={{{url('global/js/Plugin/matchheight.js')}}}></script>
        <script src={{{url('global/js/Plugin/jvectormap.js')}}}></script>
        <script src={{{url('global/js/Plugin/peity.js')}}}></script>
    
        <script src={{{url('assets/examples/js/dashboard/v1.js')}}}></script>
</body>
</html>
