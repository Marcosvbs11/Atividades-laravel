<?php

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Exibe a lista paginada de usuários
     */
    public function index()
    {
        $users = \App\Models\User::paginate(10); // Paginação para 10 usuários por página
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function show(\App\Models\User $user)
    /**
     * Exibe os detalhes de um usuário
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(\App\Models\User $user)
    /**
     * Exibe o formulário de edição de um usuário
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, \App\Models\User $user)
    /**
     * Atualiza os dados do usuário, incluindo papel (role)
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->only('name', 'email'));
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,bibliotecario,cliente',
        ]);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->role  = $validated['role'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

}


