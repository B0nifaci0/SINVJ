@extends('layout.layoutdas')
@section('title')
Panel Sucursales
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')

<!-- Page -->
<div class="col-sm-12 col-lg-12">
  @if (session('mesage'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('mesage') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if (session('mesage-update'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ session('mesage-update') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if (session('mesage-delete'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session('mesage-delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif

    <div class="page-content">
      <div class="col-xs-12 col-sm-12 col-lg-12">
        <div class="panel-primary">
          <div class="panel-heading">
            <center>
              <h2 class="panel-title" style="color:white">Informacion De Producto</h2>
            </center>
            <div class="row">
              <div class="panel-actions  col-xs-12 col-sm-12 col-lg-12">
                <button onclick="window.location.href='/productos'" class="btn btn-sm small btn-floating
                  btn-primary waves-light float-right" data-toggle="tooltip" data-original-title="volver a mis productos"> <i
                  class="icon fa-reply-all " aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div></br>
        </div>
      </div>
    

    <div class="col-sm-12 col-lg-12">
      <div class="row">
          <div class="col-xs-12 col-sm-12 col-lg-9">
            <div class="panel-primary">
              <div class="panel-heading">
                <center><h2 class="panel-title" style="color:white">Producto</h2></center>
              </div>
              <div class="card card-shadow">
                    <div class="card-block p-20 pt-10">
                      <div class="clearfix">
                        <div class="row">
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Clave:</strong><span> {{$product->clave}} </span>
                            </p>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Descripción:</strong><span> {{$product->description}} </span>
                            </p>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Observaciones:</strong><span> {{$product->observations}} </span>
                            </p>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Peso:</strong><span> {{($product->weigth) ? $product->weigth : 'N/A'}} </span>
                            </p>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Categoría:</strong><span>
                                {{ ($product->category) ? $product->category->name: '' }} </span>
                            </p>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Línea:</strong><span>
                                {{ ($product->line) ? $product->line->name : 'N/A' }}</span>
                            </p>
                          </div>
                          @if(Auth::user()->type_user == 1)
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Precio Compra:</strong><span> {{$product->price_purchase}} </span>
                            </p>
                          </div>
                          @endif
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Precio Venta:</strong><span> {{$product->price}} </span>
                            </p>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Precio con descuento:</strong><span> {{$product->discount}} </span>
                            </p>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Sucursal:</strong><span>{{ ($product->branch) ? $product->branch->name: '' }}
                              </span>
                            </p>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Status:</strong>
                              @if($product->status_id == 1)
                              <span class="text-center badge badge-secondary">{{$product->status->name}}</span>
                              @endif
                              @if($product->status_id == 2)
                              <span class="text-center badge badge-success">{{$product->status->name}}</span>
                              @endif
                              @if($product->status_id == 3)
                              <span class="text-center badge badge-primary">{{$product->status->name}}</span>
                              @endif
                              @if($product->status_id == 4)
                              <span class="text-center badge badge-warning">{{$product->status->name}}</span>
                              @endif
                              @if($product->status_id == 5)
                              <span class="text-center badge badge-danger">{{$product->status->name}}</span>
                              @endif
                            </p>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-lg-4">
                            <p class="">
                              <strong>Tipo Producto:</strong>
                              @if($product->category->type_product == 1 )
                              <span class="text-center badge badge-success">Pieza</span>
                              @endif
                              @if($product->category->type_product == 2 )
                              <span class="text-center badge badge-primary">Gramos</span>
                              @endif
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-lg-3">
            <div class="panel-primary">
              <div class="panel-heading">
                <center><h2 class="panel-title" style="color:white">Imagen</h2></center>
              </div>
              <div class="card card-shadow">
                  <div class="card-block p-20 pt-10">
                    <a class="inline-block" href="{{ $product->image}}" data-plugin="magnificPopup"
                      data-close-btn-inside="false" data-fixed-contentPos="true"
                      data-main-class="mfp-margin-0s mfp-with-zoom" data-zoom='{"enabled": "true","duration":"300"}'>
                      <img class="img-fluid" src="{{ $product->image }}" alt="..." width="auto" height="auto" />
                    </div>
                </div>
            </div>
          </div>
 
      </div>
  </div>
@endsection
