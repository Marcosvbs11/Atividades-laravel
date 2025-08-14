<?php
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
public function storeWithId(Request $request)
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        Book::create($request->all());
        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }
public function storeWithSelect(Request $request)
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        Book::create($request->all());
        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }

    public function edit(Book $book)
{
    $publishers = Publisher::all();
    $authors = Author::all();
    $categories = Category::all();
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

    return view('books.edit', compact('book', 'publishers', 'authors', 'categories'));
}
        return view('books.edit', compact('book', 'publishers', 'authors', 'categories'));
    }

public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'publisher_id' => 'required|exists:publishers,id',
        'author_id' => 'required|exists:authors,id',
        'category_id' => 'required|exists:categories,id',
    ]);
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

    $book->update($request->all());
        $data = $request->all();

    return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso.');
}
        if ($request->hasFile('cover_image')) {
            // Apaga imagem antiga se existir
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            // Salva nova imagem
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

public function show(Book $book)
{
    // Carregando autor, editora e categoria do livro com eager loading
    $book->load(['author', 'publisher', 'category']);
        $book->update($data);

    // Carregar todos os usuários para o formulário de empréstimo
    $users = User::all();
        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso.');
    }

    return view('books.show', compact('book','users'));
}
    public function destroy(Book $book)
    {
        // Apaga imagem do storage se existir
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

public function index()
{
    // Carregar os livros com autores usando eager loading e paginação
    $books = Book::with('author')->paginate(20);
        return redirect()->route('books.index')->with('success', 'Livro deletado com sucesso.');
    }

    return view('books.index', compact('books'));
    public function show(Book $book)
    {
        // Carregando autor, editora e categoria do livro com eager loading
        $book->load(['author', 'publisher', 'category']);

}
        // Carregar todos os usuários para o formulário de empréstimo (se aplicável)
        $users = User::all();

        return view('books.show', compact('book', 'users'));
    }

    public function index()
    {
        // Carregar os livros com autores usando eager loading e paginação
        $books = Book::with('author')->paginate(20);

        return view('books.index', compact('books'));
    }
}