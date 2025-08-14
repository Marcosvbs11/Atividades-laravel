<div class="container">
    <h1 class="my-4">Editar Livro</h1>

    <form action="{{ route('books.update', $book) }}" method="POST">
    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">


             <!-- Campo para upload da nova imagem de capa -->
        <div class="mb-3">
            <label for="cover_image" class="form-label">Alterar Imagem de Capa (opcional)</label>
            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/*">
            @error('cover_image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Exibir imagem atual, se existir -->
        @if($book->cover_image)
            <div class="mb-3">
                <label class="form-label">Imagem Atual</label>
                <div>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Capa do livro" style="max-width: 150px; border: 1px solid #ddd; padding: 5px;">
                </div>
            </div>
        @endif

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection