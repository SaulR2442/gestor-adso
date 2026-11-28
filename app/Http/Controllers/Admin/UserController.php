<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $role = (string) $request->get('role', '');

        $users = User::query()
            ->when($q, fn ($sql) => $sql->where(fn ($w) => $w
                ->where('name', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%")
            ))
            ->when(
                in_array($role, ['admin', 'instructor', 'aprendiz'], true),
                fn ($sql) => $sql->where('role', $role)
            )
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'q', 'role'));
    }

    public function create()
    {
        $roles = ['admin', 'instructor', 'aprendiz'];

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'role' => ['required', Rule::in(['admin', 'instructor', 'aprendiz'])],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $password = $data['password'] ?? Str::password(12);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($password),
        ]);

        $message = "Usuario creado: {$user->email}.";
        if (empty($data['password'])) {
            $message .= " Contraseña temporal: {$password}";
        }

        return redirect()->route('admin.users.index')->with('ok', $message);
    }

    public function edit(User $user)
    {
        $roles = ['admin', 'instructor', 'aprendiz'];

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(['admin', 'instructor', 'aprendiz'])],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if ($request->user()->is($user) && $data['role'] !== 'admin') {
            return back()->with('error', 'No puedes quitarte el rol de administrador a ti mismo.');
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('ok', 'Usuario actualizado');
    }

    public function destroy(Request $request, User $user)
    {
        if ($request->user()->is($user)) {
            return back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('ok', 'Usuario eliminado');
    }
}
