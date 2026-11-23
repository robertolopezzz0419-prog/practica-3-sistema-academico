<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class ProfesorSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'profesor@academico.com'],
            [
                'name' => 'Profesor',
                'password' => '12345678',
                'rol' => 'profesor',
            ]
        );
    }
}