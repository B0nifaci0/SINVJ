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
                          <span class="pricing-amount">40</span>
                          <span class="pricing-period">/ mo</span>
                        </div>
                      </div>
                      <ul class="pricing-features">
                        <li>
                          <strong>2 </strong> Cuentas de usuario</li>
                        <li>
                          <strong>1 </strong> Tienda</li>
                        <li>
                          <strong>1 </strong> Sucursal</li>
                        <li>
                          <strong>1  </strong> Reporte</li>
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
                          <span class="pricing-amount blue-600">50</span>
                          <span class="pricing-period">/ mo</span>
                        </div>
                      </div>
                      <ul class="pricing-features">
                        <li>
                          <strong>2</strong> Tiendas</li>
                        <li>
                          <strong>5</strong> Usuarios</li>
                        <li>
                          <strong>2</strong> Sucursales</li>
                        <li>
                          <strong>5</strong> Reportes</li>
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
                          <span class="pricing-amount">60</span>
                          <span class="pricing-period">/ mo</span>
                        </div>
                      </div>
                      <ul class="pricing-features">
                        <li>
                          <strong>Tiendas</strong> Ilimitado</li>
                        <li>
                          <strong>Sucursales</strong> Ilimitado</li>
                        <li>
                          <strong>Usuarios</strong> Ilimitado</li>
                        <li>
                          <strong>Reportes</strong> Ilimitado</li>
                          <li>
                          <strong>Soporte</strong> Por Telefono y Correo</li>
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
        

