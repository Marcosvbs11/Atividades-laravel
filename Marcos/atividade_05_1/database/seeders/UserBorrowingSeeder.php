<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Borrowing;
use App\Models\Book;

class UserBorrowingSeeder extends Seeder
{
    public function run()
    {
        // Verifica se existem livros antes de tentar criar empréstimos
        if (Book::count() === 0) {
            $this->command->warn('Nenhum livro encontrado. Execute o seeder de livros antes.');
            return;
        }

        // Criar 10 usuários com empréstimos
        User::factory(10)->create()->each(function ($user) {
            // Empréstimos aleatórios (entre 1 e 5) para cada usuário
            Borrowing::factory(rand(1, 5))->create([
                'user_id' => $user->id,
                'book_id' => Book::inRandomOrder()->first()->id,
            ]);
        });
    }
}

