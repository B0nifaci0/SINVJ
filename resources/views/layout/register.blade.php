<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    
    <title>Registrate | SINVJ Admin Template</title>
    
    <link rel="apple-touch-icon" href="../../assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href={{{url('global/css/bootstrap.min.css')}}}>
    <link rel="stylesheet" href={{{url('global/css/bootstrap-extend.min.css')}}}>
    <link rel="stylesheet" href={{{url('assets/css/site.min.css')}}}>
    
    <!-- Plugins -->
    <link rel="stylesheet" href={{{url('global/vendor/animsition/animsition.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/asscrollable/asScrollable.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/switchery/switchery.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/intro-js/introjs.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/slidepanel/slidePanel.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/flag-icon-css/flag-icon.css')}}}>
    <link rel="stylesheet" href={{{url('global/vendor/waves/waves.css')}}}>
    <link rel="stylesheet" href={{{url('assets/examples/css/pages/register-v2.css')}}}>
    
    
    <!-- Fonts -->
    <link rel="stylesheet" href={{{url('global/fonts/material-design/material-design.min.css')}}}>
    <link rel="stylesheet" href={{{url('global/fonts/brand-icons/brand-icons.min.css')}}}>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">

    
    <!--[if lt IE 9]>
    <script src="../../../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    
    <!--[if lt IE 10]>
    <script src="../../../global/vendor/media-match/media.match.min.js"></script>
    <script src="../../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->
    
    <!-- Scripts -->
    <script src={{{url('global/vendor/breakpoints/breakpoints.js')}}}></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition page-register-v2 layout-full page-dark">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <main class="">
            @yield('content')
    </main>

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
        <script src={{{url('global/vendor/jquery-placeholder/jquery.placeholder.js')}}}></script>
    
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
    <script>Config.set('assets', '../../assets');</script>
    
    <!-- Page -->
    <script src={{{url('assets/js/Site.js')}}}></script>
    <script src={{{url('global/js/Plugin/asscrollable.js')}}}></script>
    <script src={{{url('global/js/Plugin/slidepanel.js')}}}></script>
    <script src={{{url('global/js/Plugin/switchery.js')}}}></script>
        <script src={{{url('global/js/Plugin/jquery-placeholder.js')}}}></script>
        <script src={{{url('global/js/Plugin/material.js')}}}></script>
    
    <script>
      (function(document, window, $){
        'use strict';
    
        var Site = window.Site;
        $(document).ready(function(){
          Site.run();
        });
      })(document, window, jQuery);
    </script>
<script type="text/javascript">
$(".estados").change(function(){
  var selector =  $(this).attr("alt"); 
  var id_estado = $(this).val();
  var url = '/estados/' + id_estado + '/municipios';
  $.get(url, function(json){  
    $('#municipios_' + selector).empty();
    //alert('#municipios_' + selector);
        $.each(json,function(i, municipio){
          $('#municipios_' + selector).append('<option value = '+ municipio.id +'>' + municipio.name +'</option>')
        });
  });
});
$(".municipios").change(function(){
      var id_municipio = $(this).val();
      var selector = $(this).attr("alt");
      $("#id_municipio_" + selector).val(id_municipio);
    });
</script>
  </body>
</html>
