@if($validation != 0)
<table id='example' class="table table-hover dataTable table-striped w-full" data-plugin="dataTable">
    <thead>
        <tr>
            <th>Clave</th>
            <th>Peso</th>
            <th>Descripcion</th>
            <th>Status</th>
            @if($inventory->status_report == 1 OR $inventory->status_report == 2)
            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
            <th>Opciones</th>
            @endif
            @endif
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Clave</th>
            <th>Peso</th>
            <th>Descripcion</th>
            <th>Status</th>
            @if($inventory->status_report == 1 OR $inventory->status_report == 2)
            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
            <th>Opciones</th>
            @endif
            @endif
        </tr>
    </tfoot>
    <tbody>
        @foreach ($inventory->products as $item)
        <tr id="row{{ $inventory->id }}">
            <td>{{$item->clave}}</td>
            @if($item->weigth)
            <td>{{$item->weigth}} gr</td>
            @else
            <td>No Tiene Peso</td>
            @endif
            <td>{{ $item->description }}</td>
            <td>
                @if( $item->status === null )
                <span class="text-center badge badge-secondary">Pendiente</span>
                @elseif( $item->status === 1)
                <span class="text-center badge badge-success">Existente</span>
                @elseif( $item->status === 2)
                <span class="text-center badge badge-warning">Dañado</span>
                @elseif( $item->status === 3)
                <span class="text-center badge badge-danger">Faltante</span>
                @endif
            </td>
            @if($inventory->status_report == 1 OR $inventory->status_report == 2)
            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
            <td>
                @if( $item->status === null )
                <button class="btn btn-success exist" alt="{{ $item->id }}">
                    Existente
                    <i class="icon md-check"></i>
                </button>
                <button class="btn btn-warning damaged" alt="{{ $item->id }}">
                    Dañado
                </button>
                <button class="btn btn-danger lost" alt="{{ $item->id }}">
                    Faltante
                </button>
                @else
                <button class="btn btn-info restart" alt="{{ $item->id }}">
                    Restaurar
                </button>
                @endif
                @endif
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@else
<table id='example' class="table table-hover dataTable table-striped w-full">
    <thead>
        <tr>
            <th>Clave</th>
            <th>Peso</th>
            <th>Descripcion</th>
            <th>Status</th>
            @if($inventory->status_report == 1 OR $inventory->status_report == 2)
                @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                    <th>Opciones</th>
                @endif
            @endif
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Clave</th>
            <th>Peso</th>
            <th>Descripcion</th>
            <th>Status</th>
            @if($inventory->status_report == 1 OR $inventory->status_report == 2)
                @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                    <th>Opciones</th>
                @endif
            @endif
        </tr>
    </tfoot>
    <tbody>
        <tr id="row{{ $inventory->id }}">
            @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                <td colspan="5" style ="text-align:center;">No hay resultados</td>
            @else
                <td colspan="4"style ="text-align:center;">No hay resultados</td>
            @endif
        </tr>
    </tbody>
</table>
@endif
<form method="post" action="/inventory/check" id="form" class="d-none">
    {{ csrf_field() }}
    <input type="text" name="inventory_id" id="inventory_id">
    <input type="text" name="status" id="status">
    <input type="text" name="discar_cause" id="discar_cause">
    <input type="text" name="status_product" id="status_product">
</form>

@section('delete-categorias')
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').on('click', '.exist', function () {
            let id = $(this).attr("alt");

            Swal.fire({
                title: 'Confirmación',
                text: "¿El producto se encuentra en inventario?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.value) {
                    $('#inventory_id').val(id);
                    $('#status_product').val(2);
                    $('#status').val(1);
                    $('#form').submit();
                }
            })
        });

        $('#example').on('click', '.lost', function () {
            let id = $(this).attr("alt");

            Swal.fire({
                title: 'Confirmación',
                text: "¿El producto NO se encuentra en inventario?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.value) {
                    $('#inventory_id').val(id);
                    $('#status').val(3);
                    $('#discar_cause').val(1);
                    $('#status_product').val(5);
                    $('#form').submit();
                }
            })

        });

        $('#example').on('click', '.damaged', function () {
            let id = $(this).attr("alt");

            Swal.fire({
                title: 'Confirmación',
                text: "¿El producto se encuentra dañado?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4caf50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.value) {
                    $('#inventory_id').val(id);
                    $('#status').val(2);
                    $('#discar_cause').val(2);
                    $('#status_product').val(4);
                    $('#form').submit();
                }
            })

        });
        $('#example').on('click', '.restart', function () {
            let id = $(this).attr("alt");

            var message = "¿Desea restablecer este producto?";
            Swal.fire({
                title: message,
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    return fetch('/check-user', {
                        method: 'POST',
                        body: JSON.stringify({ password: password }),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Contraseña incorrecta`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    $('#inventory_id').val(id);
                    $('#status_product').val(2);
                    $('#status').val(null);
                    $('#discar_cause').val(null);
                    $('#form').submit();
                }
            })
        });
    });
</script>
@endsection