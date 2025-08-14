    <i class="bi bi-plus"></i> Adicionar Livro (Com Select)
    </a>

    <table class="table table-striped">
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Capa</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Ações</th>
@@ -30,20 +31,24 @@
            @forelse($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td style="width: 60px;">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Capa do livro" style="max-width: 50px; max-height: 70px; object-fit: cover; border: 1px solid #ddd; padding: 2px;">
                        @else
                            <img src="https://i.pinimg.com/736x/cd/7a/ec/cd7aeca45c51ecc9ef1b435027803439.jpg" alt="Capa padrão" style="max-width: 50px; max-height: 70px; object-fit: cover; border: 1px solid #ddd; padding: 2px;">
                        @endif
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>
                        <!-- Botão de Visualizar -->
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> Visualizar
                        </a>

                        <!-- Botão de Editar -->
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Editar
                        </a>

                        <!-- Botão de Deletar -->
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
@@ -55,16 +60,14 @@
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum livro encontrado.</td>
                    <td colspan="5">Nenhum livro encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Controles de Paginação -->
    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
</div>
@endsection