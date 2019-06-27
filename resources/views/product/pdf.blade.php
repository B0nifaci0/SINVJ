<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

            <table class="table table-hover">
              <thead>
              <tr>  
              <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                 <th scope="col">Descripción</th>
                 <th scope="col">Peso</th>
                 <th scope="col">Observaciónes</th>
                 <th scope="col">Categoría</th>
                 <th scope="col">Linea</th>
                 <th scope="col">Sucursal</th>
                 <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>

      @foreach ($products as $i => $product)
        <tr id="row{{$product->id}}">
                 <td>{{ $product->id }}</td> 
                <td>{{ $product->name }}</td>
                 <td>{{ $product->description }}</td>
                 <td>{{ $product->weigth }}</td>
                 <td>{{ $product->observations }}</td>
                 
                 <td>{{ $product->category->name }}</td>
                 <td>{{ $product->line->name }}</td>
                 <td>{{ $product->branch->name }}</td>
                 <td>{{ $product->status->name }}</td>
                </tr>
                  @endforeach
              </tbody>
            </table>
          
</html>


