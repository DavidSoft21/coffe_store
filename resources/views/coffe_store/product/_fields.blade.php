<div class="row">
    <!-- field identificacion del producto -->
    <div class="form-group col-12" style="margin-bottom:15px; margin-right: 20px !important">    
        <label for="product_id" class="" style="">ID</label>
        <input disabled type="number" style="" class="form-control" name="product[id]" id="id_{{old('product.id', isset($products[$i]['id'] )) ? $products[$i]['id']  : ''}}" placeholder="ID" value="{{old('product.id', isset($products[$i]['id'] )) ? $products[$i]['id']  : ''}}"> 
    </div>
    <!-- field nombre del producto -->
    <div class="form-group col-12" style="margin-bottom:15px; margin-right: 20px !important">    
        <label for="product_name" class="" style="">NOMBRE</label>
        <input type="text" style="" class="form-control" name="product[name]" id="product_name" placeholder="NOMBRE" value="{{old('product.name', isset($products[$i]['name'] )) ? $products[$i]['name']  : ''}}"> 
    </div>
</div>

<div class="row">
    <!--field referencia del producto-->
    <div class="form-group col-12" style="margin-bottom:15px; margin-right: 20px !important"> 
        <label for="product_reference" style="">REFERENCIA</label>
        <select style="" class="form-control select2" name="product[reference]" id="product_reference">
            <option value="">Seleccionar...</option>
            @foreach ($enum_referencias as $key  => $referencia)
                <option value="{{ $referencia }}" {{old('product.reference',$referencia ? $ref : '') == $referencia  ? ' selected' : '' }}> {{ $referencia }} </option>
            @endforeach
        </select>
    </div>
    <!--field categoria del producto-->
    <div class="form-group col-12" style="margin-bottom:15px; margin-right: 20px !important"> 
        <label for="product_category" style="">CATEGORIA</label>
        <select style="" class="form-control select2" name="product[category]" id="product_category">
            
            <option value="">Seleccionar...</option>
            @foreach ($enum_categorias as $key  => $categoria)
                <option value="{{$categoria}}" {{old('product.category',  $categoria ? $cat  : '' ) == $categoria  ? 'selected' : ''}}> {{ $categoria }} </option>
            @endforeach

        </select>
    </div>
</div>

<div class="row">
    <!-- field precio del producto-->
    <div class="form-group col-12" style="margin-bottom:15px; margin-right: 20px !important">  
        <label for="product_price" class="" style="">PRECIO</label>
        <input type="text" style="" class="form-control " name="product[price]" id="product_price" placeholder="PRECIO" value="{{old('product.price', isset($products[$i]['price'])) ? $products[$i]['price'] : ''}}"> 
    </div>
    <!-- field nombre del producto-->
    <div class="form-group col-12" style="margin-bottom:15px; margin-right: 20px !important">  
        <label for="product_stock" class="" style="">STOCK</label>
        <input type="number" style="" class="form-control " name="product[stock]" id="product_stock" placeholder="STOCK" value="{{old('product.stock', isset($products[$i]['stock'])) ? $products[$i]['stock'] : ''}}"> 
    </div>
</div>




