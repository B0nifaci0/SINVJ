<section>
  @yield('menu2')
  <div class="site-menubar">
    <div class="site-menubar-header">
      <div class="cover overlay">
        <img class="cover-image" src="{{{url('dashboard-assets/assets/examples/images/dashboard-header.jpg')}}}"
        alt="...">
        <div class="overlay-panel vertical-align overlay-background">
          <div class="vertical-align-middle">
            <a class="avatar avatar-lg" href="javascript:void(0)">

                <img src="{{{url('dashboard-assets/assets/images/users/avatar.png')}}}" alt="">



            </a>
            <div class="site-menubar-info">
              <h5 class="site-menubar-user">Joyeria</h5>
              <p class="site-menubar-email"></p>
            </div>
          </div>
        </div>
      </div>
    </div>




<!-- Menu desplegable -->
<div class="site-menubar-body scrollable scrollable-inverse is-enabled scrollable-vertical" style="position: relative">
  <div>
    <div>
      <ul class="site-menu">
       <li class="site-menu-item has-sub">
          <a href="javascript:void(0)">
            <i class="site-menu-icon md-comment-alt-text" aria-hidden="true"></i>
            <span class="site-menu-title">Catalogos</span>
            <span class="site-menu-arrow"></span>
          </a>
          <ul class="site-menu-sub">

          <li class="site-menu-item">
                <a class="animsition-link" href="/usuarios">
                  <span class="site-menu-title">Usuarios</span>
                </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
</div>

<style>
  .view{
    display: none;
  }
</style>

  <!-- Core  -->

</section>
