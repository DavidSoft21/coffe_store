<?php

namespace App\Models\module_coffe_store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sale extends Model
{
    #declaracion de variables
    use HasFactory;
    public $timestamps = true;
    protected $table = 'sales';
    protected $fillable = [
        'employee',
        'coffe_store',
        'payment_method'
    ];

    public static function enum(string $table = 'sales', string $columns = 'employee')
    {

        $enum = DB::select("
        SELECT column_type
        FROM information_schema.COLUMNS
        WHERE table_schema = 'coffe_store'
            AND TABLE_NAME = '$table' 
            AND column_name = '$columns';
        ");

        $string = "";
        foreach ($enum[0] as $str) {
            $string = $str;
        }

        $start = strpos($string, 'enum(');
        $end = strpos($string, ')');

        $str = substr($string, 5, $end - 5);
        $array_enum = explode(",",
            $str
        );

        $arr_enum = array();

        foreach ($array_enum as $key => $str) {

            $start = strpos($str,
                "'"
            );
            $end = strpos($str, "'");
            $value = substr($str, 1, $end - 1);
            $arr_enum[$key] = $value;
        }

        return $arr_enum;
    }

    public static function mas_vendidos()
    {

        $sales = DB::select(
            "
                select 	
                products.id as producto_id,
                products.category as categoria,
                products.name as nombre,
                products.reference as referencia,
                products.stock as stock,
                products.price as precio,
                sum(product_sale.amount) as ventas_individuales,
                count(product_sale.sale_id) as facturas
                from products  inner join product_sale 
                on products.id = product_sale.product_id 
                group by product_sale.product_id 
                order by  ventas_individuales desc
                limit 3
            "
            );

        return $sales;
    }

    public static function mas_rentables()
    {

        $sales = DB::select(
        "
            select 	
            products.id as producto_id,
            products.price as precio,
            sum(products.price * product_sale.amount) as rentabilidad,
            products.category as categoria,
            products.name as nombre,
            products.reference as referencia,
            products.stock as stock,
            sum(product_sale.amount) as cantidad    
            from products  inner join product_sale 
            on products.id = product_sale.product_id 
            group by products.id
            order by rentabilidad  desc 
            LIMIT 3;
        "
        );

        return $sales;
    }

    public static function mas_stock()
    {

        $sales = DB::select(
            "
            select 	
            products.id as producto_id,
            products.category as categoria,
            products.name as nombre,
            products.reference as referencia,
            products.stock as stock,
            max(products.stock) as mas_stock,
            products.price as precio,
            product_sale.amount as cantidad    
            from products  inner join product_sale 
            on products.id = product_sale.product_id 
            group by products.id
            order by mas_stock desc 
            LIMIT 3;

        "
        );

        return $sales;
    }

    public static function index(){

        $sales = DB::select
        (
            "
            select 	
            sales.id  as sale_id,
            sales.employee as nombre_empleado,
            sales.coffe_store as tienda,
            sales.payment_method as metodo_pago,
            sales.created_at as fecha_registro,
            sales.updated_at as fecha_actualizacion,
            products.id as producto_id,
            products.category as categoria,
            products.name as nombre,
            products.reference as referencia,
            products.price as precio,
            products.stock as stock,
            product_sale.amount as cantidad    
            from products  inner join product_sale 
            on products.id = product_sale.product_id 
            inner  join  sales 
            on product_sale.sale_id = sales.id
            group by product_sale.sale_id"
        );
        
        return $sales;
    }

    public static function show($id)
    {

        $sales = DB::select(
            "
            select 	
            sales.id  as sale_id,
            sales.employee as nombre_empleado,
            sales.coffe_store as tienda,
            sales.payment_method as metodo_pago,
            sales.created_at as fecha_registro,
            sales.updated_at as fecha_actualizacion,
            products.id as producto_id,
            products.category as categoria,
            products.name as nombre,
            products.reference as referencia,
            products.price as precio,
            products.stock as stock,
            product_sale.amount as cantidad    
            from products  inner join product_sale 
            on products.id = product_sale.product_id 
            inner  join  sales 
            on product_sale.sale_id = sales.id
            where product_sale.sale_id = ".$id
            );

        return $sales;
    }

    public static function money(int|float $number = 0, int $decimals = 0)
    {
        $f_number = number_format($number, $decimals);
        return  $f_number;
    }

    /** 
     * función que represanta la relación entre ventas y productos
     * su retorno son los productos de una venta.
     * 
    */
    public function products($id)
    {
        $sales = DB::table('sales')
            ->select(

                'sales.id as sale_id',
                'sales.employee as nombre_empleado',
                'sales.coffe_store as tienda',
                'sales.payment_method as metodo_pago',
                'sales.created_at as fecha_registro',
                'sales.updated_at as fecha_actualizacion',
                'products.id as producto_id',
                'products.category as categoria',
                'products.name as nombre',
                'products.reference as referencia',
                'products.stock as stock',
                'product_sale.amount as cantidad',

            )
            ->join('product_sale', 'sales.id', '=', 'product_sale.sale_id')
            ->join('products', 'product_sale.product_id', '=', 'products.id')
            ->where('product_sale.product_id', '=', $id)
            ->groupBy('products.id')
            ->get();

        return $sales;
    }
}
