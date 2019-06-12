@extends('layout.layoutdas')
@section('title')
PAGOS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')
<div class="page">
  <div class="panel-body">
	@if (session('mesage'))	
	<div class="alert alert-success">
				<strong>{{ session('mesage') }}</strong>
	</div>
		@endif
			@if (session('mesage-update'))	
	<div class="alert alert-warning">
				<strong>{{ session('mesage-update') }}</strong>
	</div>
		@endif
			@if (session('mesage-delete'))	
	<div class="alert alert-danger">
				<strong>{{ session('mesage-delete') }}</strong>
	</div>
		@endif    
  <div class="panel">
          <div class="panel-body container-fluid">
            <!-- Example Pricing List -->
            <div class="example-wrap">
              <h4 class="example-title">Tipo de Pagos</h4>
              <div class="example">
                <div class="row">
                  <div class="col-md-6 col-xl-4">
                    <div class="pricing-list">
                      <div class="pricing-header">
                        <div class="pricing-title">Free</div>
                        <div class="pricing-price">
                          <span class="pricing-currency">$</span>
                          <span class="pricing-amount">0</span>
                        </div>
                      </div>
                      <ul class="pricing-features">
                        <li>
                          <strong>2 </strong> Cuentas de usuario <i class="icon fa-user"aria-hidden="true" ></i></li>
                        <li>
                          <strong>1 </strong> Tienda <i class="site-menu-icon md-store" aria-hidden="true"></i></li>
                        <li>
                          <strong>1 </strong> Sucursal <i class="icon fa-map-marker"aria-hidden="true" ></i></li>
                        <li>
                          <strong>1  </strong> Reporte <i class="icon fa-file-text"aria-hidden="true" ></i> </li>
                      </ul>
                      <div class="pricing-footer">
                        <a class="btn btn-primary" role="button" href="#"><i class="icon md-long-arrow-right font-size-16 mr-15" aria-hidden="true"></i>Add to card</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-4">
                    <div class="pricing-list">
                      <div class="pricing-header">
                        <div class="pricing-title bg-blue-600">Premium</div>
                        <div class="pricing-price">
                          <span class="pricing-currency blue-600">$</span>
                          <span class="pricing-amount blue-600">1500</span>
                        </div>
                      </div>
                      <ul class="pricing-features">
                      <li>
                          <strong>5</strong> Usuarios <i class="icon fa-users"aria-hidden="true"></i></li>
                        <li>
                          <strong>2</strong> Tiendas <i class="site-menu-icon md-store" aria-hidden="true"></i></li>
                        
                        <li>
                          <strong>2</strong> Sucursales <i class="icon fa-map-marker" aria-hidden="true"></i></li>
                        <li>
                          <strong>5</strong> Reportes <i class="icon fa-file-text" aria-hidden="true"></i></li>
                      </ul>
                      <div class="pricing-footer">
                        <a class="btn btn-primary" role="button" href="#"><i class="icon md-long-arrow-right font-size-16 mr-15" aria-hidden="true"></i>Add to card</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-4">
                    <div class="pricing-list">
                      <div class="pricing-header">
                        <div class="pricing-title">Pro</div>
                        <div class="pricing-price">
                          <span class="pricing-currency">$</span>
                          <span class="pricing-amount">1800</span>
                        </div>
                      </div>
                      <ul class="pricing-features">
                      <li>
                          <strong>Usuarios</strong> Ilimitados <i class="icon fa-users" ></i></li>
                        <li>
                          <strong>Tiendas</strong> Ilimitadas <i class="site-menu-icon md-store" aria-hidden="true"></i></li>
                        <li>
                          <strong>Sucursales</strong> Ilimitadas <i class="icon fa-map-marker" aria-hidden="true"aria-hidden="true" ></i></li>
                        
                        <li>
                          <strong>Reportes</strong> Ilimitados <i class="icon fa-file-text" aria-hidden="true"></i></li>
                          <li>
                          <strong>Soporte</strong> Por Telefono <i class="icon fa-phone" aria-hidden="true" ></i> y Correo 
                
                  <i class="icon fa-envelope" aria-hidden="true"></i>
                            </li>
                      </ul>
                      <div class="pricing-footer">
                        <a class="btn btn-primary" role="button" href="#"><i class="icon md-long-arrow-right font-size-16 mr-15" aria-hidden="true"></i>Add to card</a>
                      </div>
                    </div>
                  </div>
                  
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endsection
        

