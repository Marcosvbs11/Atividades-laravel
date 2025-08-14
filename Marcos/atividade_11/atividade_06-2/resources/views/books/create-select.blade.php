<div class="container">
    <h1 class="my-4">Adicionar Livro (Com Select)</h1>

    <form action="{{ route('books.store.select') }}" method="POST">
    <form action="{{ route('books.store.select') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
@@ -61,8 +61,18 @@
            @enderror
        </div>

        <!-- Novo campo para upload da imagem de capa -->
        <div class="mb-3">
            <label for="cover_image" class="form-label">Imagem de Capa (opcional)</label>
            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/*">
            @error('cover_image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
