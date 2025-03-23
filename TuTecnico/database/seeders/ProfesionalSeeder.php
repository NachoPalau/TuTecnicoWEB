<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profesional; // Asegúrate de usar el modelo correcto

class ProfesionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Datos a insertar
        $profesionals = [
            [
                "nombre" => "Juan Pérez",
                "email" => "juan.perez@example.com",
                "telefono" => "123456789",
                "localidad" => "Madrid",
                "especialidad" => "Carpintería"
            ],
            [
                "nombre" => "María López",
                "email" => "maria.lopez@example.com",
                "telefono" => "987654321",
                "localidad" => "Barcelona",
                "especialidad" => "Electricidad"
            ],
            [
                "nombre" => "Carlos García",
                "email" => "carlos.garcia@example.com",
                "telefono" => "112233445",
                "localidad" => "Sevilla",
                "especialidad" => "Fontanería"
            ]
        ];

        // Insertar los datos en la base de datos
        foreach ($profesionals as $profesional) {
            Profesional::create($profesional);
        }
    }
}
