<?php

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'ci' => '85456217',
            'nombre' => 'kirito',
            'apellidos'=>'kirigaya kazuto',
            'genero' => 'masculino',
            'fecha_nacimiento'=>'1990-01-05',
            'estado_civil'=>'soltero',
            'direccion'=>'direccion',
            'telefono'=>'telefono',
            'avatar'=>'data:image/jpeg;base64,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'
        ]);
        DB::table('clientes')->insert([
            'ci' => '854562185',
            'nombre' => 'kirito1',
            'apellidos'=>'yokokurama',
            'genero' => 'masculino',
            'fecha_nacimiento'=>'1991-01-05',
            'estado_civil'=>'casado',
            'direccion'=>'america 485',
            'telefono'=>'67916774',
            'avatar'=>'data:image/jpeg;base64,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'

        ]);
    }
}
