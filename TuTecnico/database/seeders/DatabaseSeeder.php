<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\User;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('12341234'); // Contraseña común para todos
        
        $this->seedClientes($password);
        $this->seedProfesionales($password);
    }

    protected function seedClientes($password)
    {
        $clientes = [
            [
                "name" => "Alejandro Gómez Pérez",
                "email" => "alejandro.gomez@example.com",
                "password" => $password,
                "telefono" => "612345679",
                "tipo" => "cliente",
                "localidad" => "Madrid",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Marta Díaz López",
                "email" => "marta.diaz@example.com",
                "password" => $password,
                "telefono" => "623456780",
                "tipo" => "cliente",
                "localidad" => "Barcelona",
                "created_at" => now(),
                "updated_at" => now()
            ],
            // ... (continuar con 18 clientes más)
            [
                "name" => "Laura Fernández Castro",
                "email" => "laura.fernandez@example.com",
                "password" => $password,
                "telefono" => "689012345",
                "tipo" => "cliente",
                "localidad" => "Valencia",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ];

        foreach ($clientes as $cliente) {
            User::create($cliente);
        }
    }

    protected function seedProfesionales($password)
    {
        $profesionales = [
            [
                "name" => "Juan Pérez Gómez",
                "email" => "juan.perez@example.com",
                "password" => $password,
                "telefono" => "612345678",
                "tipo" => "profesional",
                "localidad" => "Madrid",
                "especialidad" => "Carpintería",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "María López García",
                "email" => "maria.lopez@example.com",
                "password" => $password,
                "telefono" => "623456789",
                "tipo" => "profesional",
                "localidad" => "Barcelona",
                "especialidad" => "Electricidad",
                "created_at" => now(),
                "updated_at" => now()
            ],
            // ... (continuar con 18 profesionales más)
            [
                "name" => "Carlos Martínez Ruiz",
                "email" => "carlos.martinez@example.com",
                "password" => $password,
                "telefono" => "634567890",
                "tipo" => "profesional",
                "localidad" => "Valencia",
                "especialidad" => "Fontanería",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ];

        foreach ($profesionales as $profesional) {
            User::create($profesional);
        }
    
    }
}
