<?php

namespace App\Http\Controllers;

use App\Models\module_coffe_store\sale;
use App\Http\Requests\StoresaleRequest;
use App\Http\Requests\UpdatesaleRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\module_coffe_store\product;
use Illuminate\Support\Facades\DB;



class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private string $error_registro_existente = "Ya existe un registro con nombre similar";
    private string $registro_no_encontrado = "El registro no existe!";
    private string $registro_insertado = "Registro insertado con exito!";
    private string $registro_no_insertado = "Registro no insertado con exito!";
    private string $registro_editado = "Registro editado con exito!";
    private string $registro_no_editado = "Registro no editado con exito!";
    private string $registro_eliminado = "Registro eliminado con exito!";
    private string $registro_no_eliminado = "Registro no eliminado con exito!";
    private string $tipo_dato_incorrecto = "Tipo de dato incorrecto!";

    public function index()
    {
        $sale_result = sale::index();
        $products = product::all();
        $sale = [];
        $index = 0;
        foreach ($sale_result as $key => $sales) {

            $sale[$index]['id'] = $sales->sale_id;
            $sale[$index]['employee'] = $sales->nombre_empleado;
            $sale[$index]['coffe_store'] = $sales->tienda;
            $sale[$index]['payment_method'] = $sales->metodo_pago;
            $sale[$index]['name'] = $sales->nombre;
            $sale[$index]['reference'] = $sales->referencia;
            $sale[$index]['price'] = "$ " . product::money(($sales->precio));
            $sale[$index]['amount'] = $sales->cantidad;
            $sale[$index]['created_at'] = $sales->fecha_registro;
            $sale[$index]['updated_at'] = $sales->fecha_actualizacion;
            $index++;
        }

        $enum_empleados = sale::enum();
        $enum_tiendas = sale::enum(columns: 'coffe_store');
        $enum_metodo_pago = sale::enum(columns: 'payment_method');
        $enum_referencias = product::enum(columns: 'reference');

        return View::make('coffe_store.sale.index')->with(compact('sale', 'products', 'enum_empleados', 'enum_tiendas', 'enum_metodo_pago', 'enum_referencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inventario()
    {
        $mas_vendidos = sale::mas_vendidos();
        $mas_rentables = sale::mas_rentables();
        $mas_stock = sale::mas_stock();
        return View::make('coffe_store.sale.inventario')->with(compact('mas_vendidos', 'mas_rentables', 'mas_stock'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreproductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $json = [];
        $product_result = $request->sale_collect;
        if (empty($product_result) == true) {
            return response()->json(['successful' => false, 'message' => $this->registro_no_insertado, 'data' => $product_result]);
        } else {
            for ($i = 0; $i < count($product_result); $i++) {

                $row['amount'] = $product_result[$i]['amount'];
                $row['coffe_store']  = $product_result[$i]['coffe_store'];
                $row['employee']  = $product_result[$i]['employee'];
                $row['name']  = $product_result[$i]['name'];
                $row['payment_method']  = $product_result[$i]['payment_method'];
                $row['price']  = $product_result[$i]['price'];
                $row['product_id']  = $product_result[$i]['product_id'];
                $row['reference']= $product_result[$i]['reference'];

                $v = Validator::make($row, [
                    'amount' => 'required|min:1',
                    'coffe_store' => 'required|max:255',
                    'employee' => 'required|max:255',
                    'name' => 'required|min:3',
                    'payment_method' => 'required|max:255',
                    'price' => 'required|numeric',
                    'product_id' => 'required|numeric|min:1',
                    'reference' => 'required|min:2'
                ]);
                if ($v->fails()) {
                    return response()->json(['successful' => false, 'message' => "", 'data' => $v->errors()]);
                }
            }

            if($v->fails() == false){

                $verificar_product_amount = 0;
                for($i=0;$i<count($product_result);$i++){

                    $producto_result = product::find($product_result[$i]['product_id']);
                    if($producto_result != null){       
                        if(intval($product_result[$i]['amount']) > $producto_result->stock ){
                            $verificar_product_amount = 1;
                        }
                    }else{
                        $verificar_product_amount = 1;
                    }
                    
                }

                if($verificar_product_amount != 1){

                    $sale = sale::create([
                        'employee' => trim(strtolower($product_result[0]['employee'])),
                        'coffe_store' => trim(strtolower($product_result[0]['coffe_store'])),
                        'payment_method' => trim(strtolower($product_result[0]['payment_method']))
                    ]);

                    for ($i = 0; $i < count($product_result); $i++) {

                        $product_sale = DB::table('product_sale')->insert([
                            'amount' => trim(strtolower($product_result[$i]['amount'])),
                            'product_id' => trim(strtolower($product_result[$i]['product_id'])),
                            'sale_id' => trim(strtolower($sale->id))
                        ]);

                        $producto_consulta = product::find($product_result[$i]['product_id']);
                        $producto_consulta->update([
                            'stock' => intval($producto_consulta->stock - intval($product_result[$i]['amount']))
                        ]);
                    }

                    return response()->json(['successful' => true, 'message' => $this->registro_insertado, 'data' => [$sale, $product_sale]]);

                }else{
                    return response()->json(['successful' => false, 'message' => "hay productos con existencias insuficientes, compra declinada!", 'data' => [[]]]);
                }

            }
            return response()->json(['successful' => true, 'message' => $this->registro_insertado, 'data' => []]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\module_coffe_store\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($show_id)
    {
        $sale_result = sale::show($show_id);
        $sale = [];
        $total_compra = 0;
        $index = 0;
        foreach ($sale_result as $key => $sales) {

            $sale[$index]['product_id'] = $sales->producto_id;
            $sale[$index]['name'] = $sales->nombre;
            $sale[$index]['reference'] = $sales->referencia;
            $sale[$index]['amount'] = intval($sales->cantidad);
            $sale[$index]['price'] = "$ ".sale::money(($sales->precio));
            $total_compra = floatval($total_compra) + intval((floatval($sales->precio) * intval($sales->cantidad)));
            $tt = sale::money($total_compra);
            $index++;
        }

        return View::make('coffe_store.sale.show')->with(compact('sale', 'tt'));
    }

}
