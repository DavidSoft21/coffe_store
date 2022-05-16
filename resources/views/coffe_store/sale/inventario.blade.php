@extends('plantilla.plantilla')
@section('content')
<div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Mas rentables</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <br>
                    <table id="table_1" name="table_1" class="table  text-center table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary">ID</th>
                                <th class="text-center bg-success">PRODUCT</th>
                                <th class="text-center bg-success">INDIVIDUAL SALES</th>
                                <th class="text-center bg-success">RENTABILITY</th>

                                <th class="text-center">CATEGORY</th> 
                            </tr>
                        </thead>
                        @foreach($mas_rentables as $key => $productos) 

                        <tr>
                            <td  class="text-center bg-danger"> 
                                <span name="product_id ">{{ $productos->producto_id }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="product_name">{{ $productos->nombre }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="product_amount">{{ number_format($productos->cantidad) }}</span>
                            </td>
                            <td  class="text-center bg-danger"> 
                                <span name="product_rentability">{{ "$ ".number_format($productos->rentabilidad) }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="product_categoria">{{ $productos->categoria }}</span>
                            </td>
                            
                            
                            
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
</div>
<div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Mas vendidos</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <br>
                    <table id="table_2" name="table_2" class="table  text-center table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary">ID</th>
                                <th class="text-center  bg-success">PRODUCT</th>
                                <th class="text-center  bg-success">INDIVIDUAL SALES</th>
                                <th class="text-center bg-success"># INVOICES</th>
                                <th class="text-center">PRICE</th>
                                <th class="text-center">CATEGORY</th>
                            </tr>
                        </thead>

                        
                        
                        @foreach($mas_vendidos as $key => $producto) 

                        <tr>
                            <td  class="text-center bg-danger"> 
                                <span name="product_id">{{ $producto->producto_id }}</span>
                            </td>
                            <td  class="text-center "> 
                                <span name="product_name">{{ $producto->nombre }}</span>
                            </td>
                            <td  class="text-center bg-danger"> 
                                <span name="product_ventas_individuales">{{ $producto->ventas_individuales }}</span>
                            </td>
                            <td  class="text-center "> 
                                <span name="product_invoices">{{ number_format($producto->facturas) }}</span>
                            </td>
                            <td  class="text-center" > 
                                <span name="product_stock">{{ "$ ".number_format($producto->precio) }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="product_categoria">{{ $producto->categoria }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>


</div>
<div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Mas stock</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <br>
                    <table id="table_3" name="table_3" class="table  text-center table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary">ID</th>
                                <th class="text-center  bg-success">PRODUCT</th>
                                <th class="text-center bg-success">STOCK</th>
                                <th class="text-center bg-success">PRICE</th>
                                <th class="text-center">CATEGORY</th>
                            </tr>
                        </thead>

                        
                        
                        @foreach($mas_stock as $key => $producto) 

                        <tr>
                            <td  class="text-center bg-danger"> 
                                <span name="product_id">{{ $producto->producto_id }}</span>
                            </td>
                            <td  class="text-center "> 
                                <span name="product_name">{{ $producto->nombre }}</span>
                            </td>
                            <td  class="text-center bg-danger"> 
                                <span name="product_stock">{{ number_format($producto->mas_stock) }}</span>
                            </td>
                            <td  class="text-center" > 
                                <span name="product_price">{{ "$ ".number_format($producto->precio,0) }}</span>
                            </td>
                            <td  class="text-center"> 
                                <span name="product_categoria">{{ $producto->categoria }}</span>
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