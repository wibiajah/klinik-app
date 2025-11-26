<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
    {
        $query = User::where('id', '!=', auth()->id());
        
        // Jika user adalah admin (bukan superadmin), hanya tampilkan karyawan
        if (auth()->user()->role === 'admin') {
            $query->where('role', 'karyawan');
        }
        
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $availablePermissions = User::getAvailablePermissions();
        
        // Role yang bisa dibuat berdasarkan role user yang login
        $availableRoles = $this->getAvailableRoles();
        
        return view('admin.users.create', compact('availablePermissions', 'availableRoles'));
    }

    public function store(Request $request)
    {
        $availableRoles = $this->getAvailableRoles();
        $availableRoleValues = implode(',', array_keys($availableRoles));
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => "required|in:{$availableRoleValues}",
            'permissions' => 'array',
            'permissions.*' => 'string|in:' . implode(',', array_keys(User::getAvailablePermissions())),
            'is_active' => 'boolean',
        ]);

        // Validasi tambahan: admin tidak bisa membuat admin lain
        if (auth()->user()->role === 'admin' && $request->role === 'admin') {
            return back()->withErrors(['role' => 'Anda tidak memiliki izin untuk membuat user dengan role admin.']);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'permissions' => $request->permissions ?? [],
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.users.index')
                        ->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        // Validasi akses: admin hanya bisa lihat karyawan
        if (!$this->canAccessUser($user)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses user ini.');
        }
        
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // Validasi akses: admin hanya bisa edit karyawan
        if (!$this->canAccessUser($user)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses user ini.');
        }
        
        $availablePermissions = User::getAvailablePermissions();
        $availableRoles = $this->getAvailableRoles();
        
        return view('admin.users.edit', compact('user', 'availablePermissions', 'availableRoles'));
    }

    public function update(Request $request, User $user)
    {
        // Validasi akses: admin hanya bisa update karyawan
        if (!$this->canAccessUser($user)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses user ini.');
        }
        
        $availableRoles = $this->getAvailableRoles();
        $availableRoleValues = implode(',', array_keys($availableRoles));
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => "required|in:{$availableRoleValues}",
            'permissions' => 'array',
            'permissions.*' => 'string|in:' . implode(',', array_keys(User::getAvailablePermissions())),
            'is_active' => 'boolean',
        ]);

        // Validasi tambahan: admin tidak bisa mengubah role ke admin
        if (auth()->user()->role === 'admin' && $request->role === 'admin') {
            return back()->withErrors(['role' => 'Anda tidak memiliki izin untuk mengubah role ke admin.']);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'permissions' => $request->permissions ?? [],
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.users.index')
                        ->with('success', 'User berhasil diupdate.');
    }

    public function updatePassword(Request $request, User $user)
    {
        // Validasi akses: admin hanya bisa update password karyawan
        if (!$this->canAccessUser($user)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses user ini.');
        }
        
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')
                        ->with('success', 'Password user berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                            ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        // Validasi akses: admin hanya bisa hapus karyawan
        if (!$this->canAccessUser($user)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses user ini.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                        ->with('success', 'User berhasil dihapus.');
    }

    public function toggleStatus(User $user)
    {
        // Prevent self-deactivation
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                            ->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
        }

        // Validasi akses: admin hanya bisa toggle status karyawan
        if (!$this->canAccessUser($user)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses user ini.');
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->route('admin.users.index')
                        ->with('success', "User berhasil {$status}.");
    }
    
    /**
     * Get available roles based on current user's role
     */
    private function getAvailableRoles()
    {
        if (auth()->user()->isSuperAdmin()) {
            return [
                'admin' => 'Admin Klinik',
                'karyawan' => 'Karyawan',
                'user' => 'User'
            ];
        }
        
        // Admin hanya bisa membuat karyawan dan user
        return [
            'karyawan' => 'Karyawan',
            'user' => 'User'
        ];
    }
    
    /**
     * Check if current user can access the given user
     */
    private function canAccessUser(User $user)
    {
        // Superadmin bisa akses semua
        if (auth()->user()->isSuperAdmin()) {
            return true;
        }
        
        // Admin hanya bisa akses karyawan dan user (bukan admin lain)
        if (auth()->user()->role === 'admin') {
            return in_array($user->role, ['karyawan', 'user']);
        }
        
        return false;
    }
}