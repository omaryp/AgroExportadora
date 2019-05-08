<?php

use Illuminate\Database\Seeder;

class ParametroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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
}
