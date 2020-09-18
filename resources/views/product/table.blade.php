@forelse ($products as $product)
<tr colspan="6" data-toggle="collapse" data-target="#num{{$product->id}}" class="accordion-toggle">
    <td class="tablet"><i class="fas fa-angle-down rotate-icon"></i></td>
    <td>{{$product->clave}}</td>
    <td>{{ $product->description }}</td>
    <td>{{ ($product->category) ? $product->category->name : '' }}</td>
    <td>{{ $product->observations }}</td>
    <td class="desktop">{{ $product->branch->name }}</td>
    <td class="desktop">
        @if($product->status_id == 1)
        <span class="text-center badge badge-secondary">{{$product->status->name}}</span>
        @elseif($product->status_id == 2)
        <span class="text-center badge badge-success">{{$product->status->name}}</span>
        @elseif($product->status_id == 3)
        <span class="text-center badge badge-primary">{{$product->status->name}}</span>
        @elseif($product->status_id == 4)
        <span class="text-center badge badge-warning">{{$product->status->name}}</span>
        @elseif($product->status_id == 5)
        <span class="text-center badge badge-danger">{{$product->status->name}}</span>
        @endif
    </td>
    <td class="desktop">{{($product->line) ? $product->line->name : 'N/A' }}</td>
    <td class="desktop">${{$product->price_purchase}}</td>
    <td class="desktop">${{$product->price }}</td>
    @if(Auth::user()->type_user == 1)
    <td class="desktop">${{$product->discount}}</td>
    <td class="desktop">

                        <!-- Botón para show producto-->
                          <a type="button" href="/productos/{{$product->id}}/info"
                          class="btn btn-icon btn-primary waves-effect waves-light waves-round" data-toggle="tooltip"
                          data-original-title="Info producto">
                          <i class="icon fa-search" aria-hidden="true"></i></a>
                        <!-- END Botón-->
        <!-- Botón para editar producto-->
        <a type="button" href="/productos/{{$product->id}}/edit"
            class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip"
            data-original-title="Editar">
            <i class="icon md-edit" aria-hidden="true"></i></a>
        <!-- END Botón-->
        <!-- Botón para eliminar producto -->
        <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete" alt="{{$product->id}}"
            role="button" data-toggle="tooltip" data-original-title="Borrar">
            <i class="icon md-delete" aria-hidden="true"></i>
        </button>
    </td>
    @endif
</tr>
<tr>
<tr class="tablet">
    <td colspan="6" class="hiddenRow">
        <div class="accordian-body collapse p-3" id="num{{$product->id}}">
            <p>
                <strong>Sucursal:</strong>
                {{ $product->branch->name }}
            </p>
            <p>
                <strong>Estatus:</strong>
                @if($product->status_id == 1)
                <span class="text-center badge badge-secondary">{{$product->status->name}}</span>
                @elseif($product->status_id == 2)
                <span class="text-center badge badge-success">{{$product->status->name}}</span>
                @elseif($product->status_id == 3)
                <span class="text-center badge badge-primary">{{$product->status->name}}</span>
                @elseif($product->status_id == 4)
                <span class="text-center badge badge-warning">{{$product->status->name}}</span>
                @elseif($product->status_id == 5)
                <span class="text-center badge badge-danger">{{$product->status->name}}</span>
                @endif
            </p>

            <p>
                <strong>Linea:</strong>
                {{($product->line) ? $product->line->name : 'N/A' }}
            </p>
            @if(Auth::user()->type_user == 1)
            <p>
                <strong>Precio compra: </strong>
                ${{$product->price_purchase}}
            </p>
            @endif
            <p>
                <strong>Precio: </strong>
                ${{$product->price }}
            </p>
            @if(Auth::user()->type_user == 1)
            <p>
                <strong>Precio descuento:</strong>
                ${{$product->discount}}</p>
            <p>
                <!-- Botón para editar producto-->
                <strong>Opciones: </strong>
                      <!-- Botón para show producto-->
                          <a type="button" href="/productos/{{$product->id}}/info"
                          class="btn btn-icon btn-primary waves-effect waves-light waves-round" data-toggle="tooltip"
                          data-original-title="Info producto">
                          <i class="icon fa-search" aria-hidden="true"></i></a>
                        <!-- END Botón-->
                <a type="button" href="/productos/{{$product->id}}/edit"
                    class="btn btn-icon btn-info waves-effect waves-light waves-round" data-toggle="tooltip"
                    data-original-title="Editar">
                    <i class="icon md-edit" aria-hidden="true"></i></a>
                <!-- END Botón-->
                <!-- Botón para eliminar producto -->
                <button class="btn btn-icon btn-danger waves-effect waves-light waves-round delete"
                    alt="{{$product->id}}" role="button" data-toggle="tooltip" data-original-title="Borrar">
                    <i class="icon md-delete" aria-hidden="true"></i>
                </button>
            </p>
            @endif
        </div>
    </td>
</tr>
</tr>
@empty
<tr>
    <td colspan="5">No se encontrarón resultados</td>
</tr>
@endforelse
<tr>
    <td colspan="5" align="center">
        {{ $products->onEachSide(1)->links() }}
    </td>
</tr>