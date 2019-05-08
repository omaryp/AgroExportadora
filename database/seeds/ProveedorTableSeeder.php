<?php

use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Proveedor::class,50)->create();
    }
}
