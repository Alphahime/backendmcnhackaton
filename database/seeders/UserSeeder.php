<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // Administrateurs
            [
                'name' => 'Mamadou Diop',
                'email' => 'mamadou.diop@museenoir.sn',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Aminata Ndiaye',
                'email' => 'aminata.ndiaye@museenoir.sn',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Ibrahima Sarr',
                'email' => 'ibrahima.sarr@museenoir.sn',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],

            // Utilisateurs réguliers
            [
                'name' => 'Fatou Bâ',
                'email' => 'fatou.ba@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Ousmane Fall',
                'email' => 'ousmane.fall@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Khadija Diouf',
                'email' => 'khadija.diouf@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Cheikh Mbaye',
                'email' => 'cheikh.mbaye@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Aïssatou Sow',
                'email' => 'aissatou.sow@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Modou Gueye',
                'email' => 'modou.gueye@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Rokhaya Diallo',
                'email' => 'rokhaya.diallo@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Papa Traoré',
                'email' => 'papa.traore@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Mariama Ka',
                'email' => 'mariama.ka@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Samba Niang',
                'email' => 'samba.niang@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Awa Faye',
                'email' => 'awa.faye@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Moussa Camara',
                'email' => 'moussa.camara@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Djenaba Cissé',
                'email' => 'djenaba.cisse@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Abdoulaye Wade',
                'email' => 'abdoulaye.wade@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Aminata Touré',
                'email' => 'aminata.toure@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Mamadou Lô',
                'email' => 'mamadou.lo@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sokhna Sané',
                'email' => 'sokhna.sane@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Boubacar Sy',
                'email' => 'boubacar.sy@example.sn',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $this->command->info('✅ 25 utilisateurs sénégalais créés avec succès !');
        $this->command->info('👑 3 administrateurs : Mamadou Diop, Aminata Ndiaye, Ibrahima Sarr');
        $this->command->info('👥 22 utilisateurs réguliers');
        $this->command->info('🔐 Mot de passe pour tous : password123');
    }
}