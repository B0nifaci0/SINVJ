  @yield('menuAA')
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
                <h5 class="site-menubar-user">{{$user->name}}</h5>
                <p class="site-menubar-email">{{$user->email}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>  
      <div class="site-menubar-body">
        <div>
          <div>
          <!-- AA =(0)  Administrator-->
            <ul class="site-menu" data-plugin="menu">
                <li class="site-menu-item active">
                  <a class="animsition-link" href="/principal">
                    <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                    <span class="site-menu-title">InicioJEJ</span>
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
                          <i class="site-menu-icon fa-diamond" aria-hidden="true"></i>
                            <span class="site-menu-title">Mis Productos</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                      <i class="site-menu-icon fa-file-pdf-o" aria-hidden="true"></i>
                        <span class="site-menu-title">Reportes</span> 
                      <span class="site-menu-arrow"></span> 
                    </a>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/reportes-productos">
                          <i class="site-menu-icon fa-ellipsis-h" aria-hidden="true"></i>
                            <span class="site-menu-title">Reportes</span>
                        </a>
                      </li>
                    </ul>
                    <!--
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="#">
                          <i class="site-menu-icon fa-ellipsis-h" aria-hidden="true"></i>
                            <span class="site-menu-title">Reporte gr por sucursal en total y en $.</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="#">
                          <i class="site-menu-icon fa-ellipsis-h" aria-hidden="true"></i>
                            <span class="site-menu-title">Reportes de Traspaso.</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="#">
                          <i class="site-menu-icon fa-ellipsis-h" aria-hidden="true"></i>
                            <span class="site-menu-title">Reportes de Apartado.</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="#">
                          <i class="site-menu-icon fa-ellipsis-h" aria-hidden="true"></i>
                            <span class="site-menu-title">Reportes Productos de Estatus vendido.</span>
                        </a>
                      </li>
                    </ul>
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href=" ">
                          <i class="site-menu-icon fa-ellipsis-h" aria-hidden="true"></i>
                            <span class="site-menu-title">Reporte de las ultimas entradas por fecha.</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                    </ul>-->
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

                    <li class="site-menu-item">
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
                          <a class="animsition-link" href="/traspasos">
                          <i  class="site-menu-icon fa-exchange" aria-hidden="true"></i>
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
                        <i  class="site-menu-icon icon md-money-box"  aria-hidden="true"></i>
                          <span class="site-menu-title">Mis Gastos</span>
                      </a>
                    </li>
                    </ul>
                    <ul class="site-menu-sub">
                    <li class="site-menu-item">
                        <a class="animsition-link" href="/reportes-gastos">
                        <i  class="site-menu-icon fa-file-pdf-o" aria-hidden="true"></i>
                          <span class="site-menu-title">Reporte de fdghjGastos</span>
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
                        <a class="animsition-link" href=" ">
                        <i class="site-menu-icon icon md-money-box" aria-hidden="true"></i>
                          <span class="site-menu-title">Reporte de Nomina</span>
                      </a>
                    </li>
                    </ul>
                  </li>  
              </ul>
            <!-- AA =(0) END-Administrator-->

º         </div>
        </div>

      </div>

      </div>



<style>
  .view{
    display: none;
  }
</style>

  <!-- Core  -->
