@extends('plantilla.plantilla')
@section('content')
<form method="POST" role="form" action=" {{ route('sale.store') }} " enctype="multipart/form-data" name="crear" id="crear">
    @csrf
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Compras</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Button trigger modal -->
                    <button type="submit" class="btn btn-success btn-sm" style="width:60px;margin-bottom:10px">
                        comprar
                    </button>
                    
                    <br>
                    <table id="table_crear" name="table_crear" class="table  text-center table-bordered table-striped">
                        <!-- Modal -->
                    <div class="row">
                        <div class="form-group col-md-4" style=""> 
                            <select style="" class="form-control select2" name="employee" id="employee" required="true" required="true">
                                <option value="">Seleccionar...</option>
                                @foreach ($enum_empleados as $key  => $empleados)
                                    <option value="{{$empleados}}"> {{ $empleados }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4" style=""> 
                            <select style="" class="form-control select2" name="coffe_store" id="coffe_store" required="true">
                                <option value="">Seleccionar...</option>
                                @foreach ($enum_tiendas as $key  => $tiendas)
                                    <option value="{{$tiendas}}"> {{ $tiendas }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4" style=""> 
                            <select style="" class="form-control select2" name="payment_method" id="payment_method" required="true">
                                <option value="">Seleccionar...</option>
                                @foreach ($enum_metodo_pago as $key  => $pago)
                                    <option value="{{$pago}}"> {{ $pago }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">PRODUCT</th>
                                <th class="text-center">PRICE</th>
                                <th class="text-center">REFERENCE</th>
                                <th class="text-center">AMOUNT</th>
                                <th class="text-center">CHECK</th>
                            </tr>
                        </thead>
                        
                        @foreach($products as $product) 
                        <tr>
                            <td  class="text-center"> 
                                <span name="product_id">{{ $product['id'] }}</span>
                            </td>
                            <td  class="text-center">
                                <span name="product_name">{{ $product['name'] }}</span>
                            </td>
                            <td  class="text-center">
                                <span name="product_price">{{ "$ ".number_format($product['price'],0,'.','.'); }}</span>
                                <input type="hidden" name="price" id="price" value="{{$product['price'] }}">
                            </td>
                            <td  class="text-center">
                                <span id="preference" name="product_reference">{{ $product['reference'] }}</span>
                            </td>
                            @if($product->stock < 1)
                                <td  class="text-center"><input type="number" style="" class="form-control" name="product_amount" id="product_amount" placeholder="PRODUCTO AGOTADO" disabled="true"> </td>       
                            @else
                                <td  class="text-center"><input type="number" style="" class="form-control" name="product_amount" id="product_amount" placeholder="CANTIDAD"> </td>
                            @endif
                        
                            @if($product->stock < 1)
                                <td class="text-center"><input  type="checkbox" name="checkbox" id="" disabled="true"></td>       
                            @else
                                <td class="text-center"><input  type="checkbox" name="checkbox" id=""></td>       
                            @endif
                            
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>


    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</form>

<div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Facturas</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                
                    <br>
                    <table id="table_facturas" name="table_crear" class="table  text-center table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                            
                                <th class="text-center">EMPLOYEE</th>
                            
                                <th class="text-center">COFFE STORE</th>

                                <th class="text-center">PAYMENT METHOD</th>
                            
                                <th class="text-center">CREATED AT</th>
                            
                                <th class="text-center">UPDATE AT</th>
                            
                                <th class="text-center">SHOW</th>
                            </tr>
                        </thead>
                        
                        @foreach($sale as $ventas) 
                        <tr>
                            <td  class="text-center"> 
                                <span name="sale_id">{{ $ventas['id'] }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="sale_employeee">{{ $ventas['employee'] }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="sale_coffe_store">{{ $ventas['coffe_store'] }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="sale_payment_method">{{ $ventas['payment_method'] }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="sale_payment_method">{{ $ventas['created_at'] }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="sale_payment_method">{{ $ventas['updated_at'] }}</span>
                            </td>
                            <td  class="text-center"> 
                                <a class="btn btn-info btn-sm" href="{{ route('sale.show', $ventas['id'] ) }}" target="_black" role="button">Show</a>
                                  
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>


    </div>

@endsection
@push('scripts')
<script src="{{ asset('/js/sale.js') }}"></script>
@endpush