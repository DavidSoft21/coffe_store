@extends('plantilla.plantilla')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Productos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" style="width:60px" data-toggle="modal" data-target="#modal_create">
                    Crear
                </button>
                <!-- Modal -->
                <br>
                <br>
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CATEGORY</th>
                            <th>NAME</th>
                            <th>REFERENCE</th>
                            <th>PRICE</th>
                            <th>STOCK</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    @for($i=0;$i < count($products);$i++) 
                    <tr>
                        <td>{{ $products[$i]['id'] }}</td>
                        <td>{{$cat = $products[$i]['category'] }}</td>
                        <td>{{$products[$i]['name'] }}</td>
                        <td>{{$ref = $products[$i]['reference']}}</td>
                        <td>{{ '$ '.$products[$i]['price']}}</td> 
                        <td>{{ number_format($products[$i]['stock']).' und[s]'}}</td>          
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" style="width:60px" data-target="#modal_update_{{$products[$i]['id']}}">
                                Editar
                            </button>
                            
                            <div class="btn-group btn-md" role="group">
                                <form method="POST" role="form" action=" {{ route('product.eliminar', $products[$i]['id']) }} " enctype="multipart/form-data" name="eliminar" id="eliminar">
                                    @csrf
                                    @method('HEAD')
                                    <input type="hidden" id="delete_id"  name="delete_id" value="{{ $products[$i]['id'] }}">
                                    <button type="submit" class="btn btn-danger btn-sm" style="width:60px">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal Editar -->
                    <div class="modal fade" id="modal_update_{{$products[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="POST" role="form" action=" {{ route('product.actualizar', $products[$i]['id'] ) }} " enctype="multipart/form-data" name="editar_{{$products[$i]['id']}}" id="frm_update">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title" id="exampleModalLabel">Editar Producto</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        @csrf
                                        <div class="box-body">
                                            
                                            @include('coffe_store.product._fields',compact('cat','ref'))
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-info">
                                        <button type="button" class="btn btn-danger btn-sm" style="width:60px" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success btn-sm" style="width:60px" id="frm_editar">Guardar</button>
                                    </div>
                                </div>
                                <input type="hidden" id="edit_id"  name="edit_id" value="{{ $products[$i]['id'] }}">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                            </form>     
                        </div>
                    </div>
                    <!-- Modal Editar -->
                    @endfor 
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <!-- Modal Crear -->
    <div class="modal fade" id="modal_create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" role="form" action=" {{ route('product.store') }} " enctype="multipart/form-data" name="crear" id="crear">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" id="exampleModalLabel">Crear Producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                            <div class="box-body">
                                {{$cat = '',$ref = ''}}
                                @include('coffe_store.product._fields',compact('cat','ref'))
                            </div>
                    </div>
                    <div class="modal-footer bg-info">
                        <button type="button" class="btn btn-danger btn-sm" style="width:60px" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success btn-sm" style="width:60px" id="frm_crear">Guardar</button>
                    </div>
                </div>
                <meta name="csrf-token" content="{{ csrf_token() }}" />
            </form>     
        </div>
    </div>
    <!-- Modal Crear -->
</div>
@endsection
@push('scripts')
<script src="{{ asset('/js/product.js') }}"></script>
@endpush