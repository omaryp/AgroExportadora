<?php

use Illuminate\Database\Seeder;

class ParametroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $this::tipo_comprobante();
        $this::estado_order_compra();
        $this::forma_de_pago();
        $this::destino_compra();
        $this::tipo_moneda();
        $this::tipo_cobro();
    }

    public static function tipo_cobro(){
        //estados
        DB::table('parametros')->insert([
            'codigo' => 6,
            'codtab' => '',
            'descor' => 'Tipo de Cobro',
            'deslar' => 'Tipo de Cobro',
            'valent' => 0,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 6,
            'codtab' => '01',
            'descor' => 'Detracción',
            'deslar' => 'Detracción',
            'valent' => 1,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 6,
            'codtab' => '02',
            'descor' => 'Retención',
            'deslar' => 'Retención',
            'valent' => 2,
            'valdec' => 0.0,
        ]);
    }

    public static function tipo_moneda(){
        //estados
        DB::table('parametros')->insert([
            'codigo' => 5,
            'codtab' => '',
            'descor' => 'Tipo de Moneda',
            'deslar' => 'Tipo de Moneda',
            'valent' => 0,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 5,
            'codtab' => '01',
            'descor' => 'Soles',
            'deslar' => 'Soles',
            'valent' => 1,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 5,
            'codtab' => '02',
            'descor' => 'Dólares',
            'deslar' => 'Dólares',
            'valent' => 2,
            'valdec' => 0.0,
        ]);
    }

    public static function tipo_comprobante(){
        //estados
        DB::table('parametros')->insert([
            'codigo' => 4,
            'codtab' => '',
            'descor' => 'Tipos de comprobante',
            'deslar' => 'Tipos de comprobante',
            'valent' => 0,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 4,
            'codtab' => '00',
            'descor' => 'Otros',
            'deslar' => 'Otros',
            'valent' => 0,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 4,
            'codtab' => '01',
            'descor' => 'Factura',
            'deslar' => 'Factura',
            'valent' => 1,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 4,
            'codtab' => '03',
            'descor' => 'Boleta de Venta',
            'deslar' => 'Boleta de Venta',
            'valent' => 3,
            'valdec' => 0.0,
        ]);
    }

    public static function forma_de_pago(){
        DB::table('parametros')->insert([
            'codigo' => 2,
            'codtab' => '',
            'descor' => 'Forma de Pago',
            'deslar' => 'Forma de Pago',
            'valent' => 0,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 2,
            'codtab' => '01',
            'descor' => 'Crédito',
            'deslar' => 'Crédito',
            'valent' => 1,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 2,
            'codtab' => '02',
            'descor' => 'Efectivo',
            'deslar' => 'Efectivo',
            'valent' => 2,
            'valdec' => 0.0,
        ]);
        //
    }

    public static function destino_compra(){
        //
        
        DB::table('parametros')->insert([
            'codigo' => 1,
            'codtab' => '',
            'descor' => 'Destino de recursos',
            'deslar' => 'Destino de recursos',
            'valent' => 0,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 1,
            'codtab' => '01',
            'descor' => 'Oficina',
            'deslar' => 'Oficina',
            'valent' => 1,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 1,
            'codtab' => '02',
            'descor' => 'Proyección Humanitaria',
            'deslar' => 'Proyección Humanitaria',
            'valent' => 2,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 1,
            'codtab' => '03',
            'descor' => 'Producción',
            'deslar' => 'Producción',
            'valent' => 3,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 1,
            'codtab' => '04',
            'descor' => 'Otros',
            'deslar' => 'Otros',
            'valent' => 4,
            'valdec' => 0.0,
        ]);
    }

    public static function estado_order_compra(){
        //estados
        DB::table('parametros')->insert([
            'codigo' => 3,
            'codtab' => '',
            'descor' => 'Estados Orden de pago',
            'deslar' => 'Estados Orden de pago',
            'valent' => 0,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 3,
            'codtab' => '01',
            'descor' => 'Ingresada',
            'deslar' => 'Ingresada',
            'valent' => 1,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 3,
            'codtab' => '02',
            'descor' => 'Aprobada',
            'deslar' => 'Aprobada',
            'valent' => 2,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 3,
            'codtab' => '03',
            'descor' => 'Por Pagar',
            'deslar' => 'Por Pagar',
            'valent' => 3,
            'valdec' => 0.0,
        ]);
        DB::table('parametros')->insert([
            'codigo' => 3,
            'codtab' => '04',
            'descor' => 'Cancelada',
            'deslar' => 'Cancelada',
            'valent' => 4,
            'valdec' => 0.0,
        ]);
    }
}
