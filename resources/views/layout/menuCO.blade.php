<section>
    @yield('menuCO')
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
              <!-- CO =(2) Colaborador-->
              @if($user->type_user == 2)
              <ul class="site-menu" data-plugin="menu">
                  <li class="site-menu-item active">
                    <a class="animsition-link" href="/sucursal">
                      <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                      <span class="site-menu-title">Iniciooo</span>
                    </a>
                  </li>
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
                    <ul class="site-menu-sub">
                      <li class="site-menu-item">
                          <a class="animsition-link" href="/productosCOP">
                          <i class="site-menu-icon fa-diamond" aria-hidden="true"></i>
                            <span class="site-menu-title">Mis Productos</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!--END-Sucursales-->
                  <!--Ventas-->
                  <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
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
                          <a class="animsition-link" href="/ventasCO">
                          <i class="site-menu-icon fa-line-chart" aria-hidden="true"></i>
                            <span class="site-menu-title">Mis Ventas</span>
                        </a>
                      </li>
                    </ul>
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
                  </li>
                  <!--END-Ventas-->
                    </ul>
                  </li>
                </ul>
        <!-- CO =(2) END-Colaborador-->    
</section>