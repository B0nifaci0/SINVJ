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
                @if( $item->status === 1 )
                <span class="text-center badge badge-secondary">Pendiente</span>
                @elseif( $item->status === 2)
                <span class="text-center badge badge-success">Existente</span>
                @elseif( $item->status === 3)
                <span class="text-center badge badge-warning">Dañado</span>
                @elseif( $item->status === 4)
                <span class="text-center badge badge-danger">Faltante</span>
                @endif
            </td>
            @if($inventory->status_report == 1 OR $inventory->status_report == 2)
                @if(Auth::user()->type_user == 1 OR Auth::user()->type_user == 2)
                    <td>
                        @if( $item->status === 1 )
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
                    </td>
                @endif
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
