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
                    <br>
                    <table id="table_compras" name="table_crear" class="table  text-center table-bordered table-striped">
                        <div class="row">
                            <div class="form-group col-md-2" style="margin-bottom:15px; margin-right: 20px !important">    
                                <label for="total_compra" class="" style="">Total Compra</label>
                                <input disabled="true" type="text" style="" class="form-control" name="total_compra" id="product_name" placeholder="TOTAL COMPRA" value="$ {{$tt}}"> 
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                            
                                <th class="text-center">PRODUCT</th>
                            
                                <th class="text-center">REFERENCE</th>

                                <th class="text-center">PRICE</th>

                                <th class="text-center">AMOUNT</th>
                            </tr>
                        </thead>
                        
                        @foreach($sale as $producto) 
                        <tr>
                            <td  class="text-center"> 
                                <span name="sale_id">{{ $producto['product_id'] }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="sale_employeee">{{ $producto['name'] }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="sale_coffe_store">{{ $producto['reference'] }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="sale_payment_method">{{ $producto['price'] }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="sale_payment_method">{{ $producto['amount'] }}</span>
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