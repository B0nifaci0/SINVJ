@extends('layout.layoutdas')
@section('title')
LISTA DE  GASTOS
@endsection

@section('nav')

@endsection
@section('menu')

@endsection
@section('content')

<style>
/* Style the Image Used to Trigger the Modal */
.clickme {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

.clickme:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.closeimage {
  position: absolute;
  top: 50px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.closeimage:hover,
.closeimage:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>

  <div class="panel-body">
    @if (session('mesage'))
      <div class="alert alert-success">
        <strong>{{ session('mesage') }}</strong>
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
      <div class="alert alert-danger">
        <strong>{{ session('mesage-delete') }}</strong>
      </div>
    @endif
    <div class="page-content">
      <!-- Panel Basic -->
      <div class="panel">
        <div class="panel-body">
            <div class="example-wrap">
              <h1 class="text-center panel-title">Gastos</h1>
              <div class="panel-actions float-right">
                <div class="container-fluid row float-right">
                  @if(Auth::user()->type_user == 1 )
                  <!-- Botón para Generar PDF de productos-->
                  <div class="col-6">
                    <button onclick="window.location.href='/gastos/create'" type="button" class=" btn btn-sm small btn-floating  toggler-left  btn-info waves-effect waves-light waves-round float-left"
              data-toggle="tooltip" data-original-title="Agregar">
                <i class="icon md-plus" aria-hidden="true"></i>
              </button>
                  </div>
                                    <!-- END Botón-->
                  @endif
                </div>
              </div>
            </div>
          </div>
        <div class="panel-body">
        <!-- Tabla para listar gastos-->
          <table id='table_expenses' class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Sucursal</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Sucursal</th>
                <th>Opciones</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($expenses as $expense)
                <tr id = "row{{ $expense->id }}" class="row{{ $expense->id }}">
                  <td>{{ $expense->id}}</td>
                  <td>{{ $expense->name }}</td>
                  <td>{{ $expense->descripcion }}</td>
                  <td>$ {{$expense->price}}</td>
                  <td>
                        <a class="inline-block" href="{{ $expense->image }}" data-plugin="magnificPopup"
                          data-close-btn-inside="false" data-fixed-contentPos="true"
                          data-main-class="mfp-margin-0s mfp-with-zoom" data-zoom='{"enabled": "true","duration":"300"}'>
                          <img class="img-fluid" src="{{ $expense->image }}" alt="..." width="200" height="150"
                          />
                  </td>
                  <td>{{$expense->branch ? $expense->branch->name : '' }}</td>
                  <td>
                  <!-- Botón para editar producto-->
                  <a type="button" href="/gastos/{{$expense->id}}/edit"
                      class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip"
                      data-original-title="Editar">
                      <i class="icon md-edit" aria-hidden="true"></i></a>
                  <!-- END Botón-->
                
                     <!-- Botón para generar ticket PDF de Gastos-->
                   <!--div class="col-md-6 col-md-offset-2"-->
                   <a class="btn btn-icon btn-danger waves-effect waves-light"
                        data-toggle="tooltip" data-original-title="Generar Ticket" href="gastopdf/{{$expense->id}}">
                        <i class="icon fa-file-pdf-o" aria-hidden="true"></i>
                      </a>
                <!-- </div-->
                <!-- END Botón-->
                    <!-- Botón para eliminar gasto-->
                    <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                    data-toggle="tooltip" data-original-title="Borrar"
                      alt="{{$expense->id}}" role="button">
                      <i class="icon md-delete" aria-hidden="true"></i>
                    </button>
                    <!-- END Botón-->
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <!-- END Tabla-->
        </div>
      </div>
    </div>
  </div>


@endsection
  @section('barcode-product')
  <script type="text/javascript">
  //inicializa la tabla para resposnive
    $(document).ready(function(){
        $('#table_expenses').DataTable({
            retrieve: true,
            //  responsive: true,
            //paging: false,
            //searching: false
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
              .columns.adjust()
              .responsive.recalc();
        });    
    });
    </script>
  @endsection
<!-- Función Sweet Alert para eliminar gasto-->
@section('delete-gastos')
<script type="text/javascript">

$(document).ready(function() {
  // Modal script
  $('.clickme').click(function() {
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = $(this)
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closeimage")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
  })


 setTimeout(() => {
   console.log("b")
  $("#table_expenses").on('click','.delete',function() {
    var id = $(this).attr("alt");
    console.log(id);
    Swal.fire({
      title: 'Confirmación',
      text: "¿Seguro que desea eliminar este registro?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33' ,
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Si, Borralo!'
    }).then((result) => {
      if (result.value) {
        $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        });
        $.ajax({
          url:  '/gastos/' + id,
          method: 'DELETE',
          success: function () {
            $('#table_expenses').DataTable()
            .rows('.row' + id)
            .remove()
            .draw();
            Swal.fire(
              'Eliminado',
              'El registro ha sido eliminado.',
              'success'
            )
          },
          error: function () {
            Swal.fire(
              'Eliminado',
              'El registro no ha sido eliminado.'+ id,
              'error'
            )
          }
        })
      }
    })
   });
 },500)
});

</script>
@endsection
<!-- END Función-->
@section('footer')
@endsection


