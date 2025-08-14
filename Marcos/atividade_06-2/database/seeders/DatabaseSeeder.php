<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Desabilita verificação de foreign keys
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Trunca as tabelas na ordem correta para evitar erros
        DB::table('borrowings')->truncate();
        DB::table('books')->truncate();
        DB::table('publishers')->truncate();
        DB::table('authors')->truncate();
        DB::table('categories')->truncate();
        DB::table('users')->truncate();

        // Reabilita verificação de foreign keys
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Cria o usuário
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Chama os outros seeders
        $this->call([
            CategorySeeder::class,
            AuthorPublisherBookSeeder::class,
            UserBorrowingSeeder::class,
        ]);
    }
}
