<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Book;  // Não esqueça de importar o modelo Book!

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relacionamento muitos-para-muitos com Book via tabela borrowings
    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrowings')
                    ->withPivot('borrowed_at', 'returned_at')
                    ->withTimestamps();
    }
}
