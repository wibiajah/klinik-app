{{-- resources/views/admin/users/index.blade.php --}}
<x-admin-layout title="Kelola User">
    <style>
        :root {
            --primary-green: #00bc84;
            --light-gray: #f8f9fa;
            --dark-gray: #6c757d;
            --border-gray: #e0e0e0;
        }
        
        .custom-card {
            border: 1px solid var(--border-gray);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            background: white;
            border: 1px solid var(--border-gray);
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            transition: transform 0.2s;
            min-height: 100px;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .stat-icon {
            font-size: 1.5rem;
            color: var(--primary-green);
            margin-bottom: 0.5rem;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin: 0;
        }
        
        .stat-label {
            font-size: 0.75rem;
            color: var(--dark-gray);
            text-transform: uppercase;
            font-weight: 600;
            margin: 0;
        }
        
        .custom-badge {
            background-color: var(--primary-green) !important;
            color: white !important;
            font-weight: 500;
        }
        
        .table-header {
            background-color: #f1f1f1 !important;
            font-weight: 600;
            color: #333;
            cursor: pointer;
            user-select: none;
            position: relative;
        }
        
        .table-header:hover {
            background-color: #e9ecef !important;
        }
        
        .sort-icon {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.8rem;
            color: var(--dark-gray);
        }
        
        .search-container {
            background: white;
            border: 1px solid var(--border-gray);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .search-input {
            border: 1px solid var(--border-gray);
            border-radius: 4px;
            padding: 0.5rem;
        }
        
        .search-input:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(2, 183, 35, 0.25);
        }
        
        .btn-action {
            border: none;
            border-radius: 4px;
            padding: 0.4rem 0.6rem;
            font-size: 0.8rem;
            margin-right: 0.2rem;
            transition: all 0.2s;
        }
        
        .page-title {
            font-weight: bold;
            color: #333;
        }
        
        .alert {
            border-radius: 8px;
            border: none;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            color: var(--dark-gray);
        }
        
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--dark-gray);
        }
        
        .empty-icon {
            font-size: 3rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #333;
            border: 2px solid var(--border-gray);
        }
        
        .role-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .permission-badge {
            display: inline-block;
            padding: 2px 6px;
            margin: 1px;
            border-radius: 8px;
            font-size: 0.65rem;
            font-weight: 500;
        }
        
        .btn-add-user {
            background-color: var(--primary-green);
            color: white;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-add-user:hover {
            background-color: #028a1c;
            color: white;
            text-decoration: none;
        }

        /* Tab Styles */
        .custom-tabs {
            border: none;
            margin-bottom: 0;
        }
        
        .custom-tabs .nav-link {
            border: 1px solid var(--border-gray);
            border-bottom: none;
            background-color: #f8f9fa;
            color: #333;
            font-weight: 500;
            border-radius: 8px 8px 0 0;
            margin-right: 2px;
            transition: all 0.2s;
        }
        
        .custom-tabs .nav-link:hover {
            background-color: #e9ecef;
            color: #333;
        }
        
        .custom-tabs .nav-link.active {
            background-color: white;
            border-color: var(--border-gray);
            color: var(--primary-green);
            font-weight: 600;
        }
        
        .tab-content {
            border: 1px solid var(--border-gray);
            border-radius: 0 8px 8px 8px;
            background: white;
        }
        
        .tab-badge {
            background-color: var(--primary-green);
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 5px;
        }
        
        .inactive-tab-badge {
            background-color: #dc3545;
            color: white;
        }

        /* Action Buttons Styles */
        .action-buttons {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .btn-detail {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
        }

        .btn-detail:hover {
            background-color: #0056b3;
            color: white;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #212529;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            color: #212529;
            text-decoration: none;
        }

        .btn-toggle {
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-toggle.btn-deactivate {
            background-color: #dc3545;
            color: white;
        }

        .btn-toggle.btn-deactivate:hover {
            background-color: #c82333;
        }

        .btn-toggle.btn-activate {
            background-color: #28a745;
            color: white;
        }

        .btn-toggle.btn-activate:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-delete:hover {
            background-color: #545b62;
        }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 page-title">Kelola User</h1>
            <a href="{{ route('admin.users.create') }}" class="btn-add-user">
                <i class="fas fa-plus me-2"></i>Tambah User
            </a>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-green); text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kelola User</li>
            </ol>
        </nav>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">{{ $users->total() }}</div>
                    <div class="stat-label">Total User</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="stat-number">{{ $users->where('role', 'superadmin')->count() }}</div>
                    <div class="stat-label">Super Admin</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <div class="stat-number">{{ $users->where('role', 'admin')->count() }}</div>
                    <div class="stat-label">Admin</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-number">{{ $users->where('is_active', true)->count() }}</div>
                    <div class="stat-label">User Aktif</div>
                </div>
            </div>
        </div>

        <!-- Search Container -->
        <div class="search-container">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label class="form-label fw-semibold">Cari Nama:</label>
                    <input type="text" id="searchNama" class="form-control search-input" placeholder="Masukkan nama user...">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label fw-semibold">Cari Email:</label>
                    <input type="text" id="searchEmail" class="form-control search-input" placeholder="Masukkan email...">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label fw-semibold">Filter Role:</label>
                    <select id="filterRole" class="form-control search-input">
                        <option value="">Semua Role</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="karyawan">Karyawan</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs custom-tabs" id="userTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="active-users-tab" data-bs-toggle="tab" data-bs-target="#active-users" type="button" role="tab" aria-controls="active-users" aria-selected="true">
                    <i class="fas fa-user-check me-2"></i>User Aktif
                    <span class="tab-badge">{{ $users->where('is_active', true)->count() }}</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="inactive-users-tab" data-bs-toggle="tab" data-bs-target="#inactive-users" type="button" role="tab" aria-controls="inactive-users" aria-selected="false">
                    <i class="fas fa-user-times me-2"></i>User Nonaktif
                    <span class="tab-badge inactive-tab-badge">{{ $users->where('is_active', false)->count() }}</span>
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="userTabsContent">
            <!-- Active Users Tab -->
            <div class="tab-pane fade show active" id="active-users" role="tabpanel" aria-labelledby="active-users-tab">
                <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: var(--light-gray); border-bottom: 1px solid var(--border-gray);">
                    <h6 class="m-0 fw-bold" style="color: #333;">
                        <i class="fas fa-user-check me-2" style="color: var(--primary-green);"></i>Daftar User Aktif
                    </h6>
                    <span class="badge custom-badge">{{ $users->where('is_active', true)->count() }} Aktif</span>
                </div>
                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show m-3 auto-dismiss" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show m-3 auto-dismiss" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="activeUsersTable">
                            <thead>
                                <tr>
                                    <th class="table-header" onclick="sortTable(0, 'activeUsersTable')">
                                        No
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(1, 'activeUsersTable')">
                                        Nama
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(2, 'activeUsersTable')">
                                        Email
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(3, 'activeUsersTable')">
                                        Role
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header">
                                        Permissions
                                    </th>
                                    <th class="table-header">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $activeUsers = $users->where('is_active', true); @endphp
                                @forelse($activeUsers as $user)
                                <tr>
                                    <td class="fw-semibold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-3">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role === 'superadmin')
                                            <span class="role-badge" style="background-color: #e3f2fd; color: #1976d2;">Super Admin</span>
                                        @elseif($user->role === 'admin')
                                            <span class="role-badge" style="background-color: #f3e5f5; color: #7b1fa2;">Admin</span>
                                        @elseif($user->role === 'karyawan')
                                            <span class="role-badge" style="background-color: #e8f5e8; color: #2e7d32;">Karyawan</span>
                                        @else
                                            <span class="role-badge" style="background-color: #f5f5f5; color: #757575;">{{ ucfirst($user->role) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->role === 'superadmin')
                                            <span class="permission-badge" style="background-color: #e3f2fd; color: #1976d2;">
                                                <i class="fas fa-check-circle me-1"></i>All Permissions
                                            </span>
                                        @elseif($user->permissions && count($user->permissions) > 0)
                                            <div>
                                                @foreach($user->permissions as $permission)
                                                    <span class="permission-badge" style="background-color: #f3e5f5; color: #7b1fa2;">
                                                        {{ \App\Models\User::getAvailablePermissions()[$permission] ?? $permission }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="permission-badge" style="background-color: #ffebee; color: #c62828;">
                                                <i class="fas fa-times-circle me-1"></i>No permissions
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <!-- Detail Button -->
                                            <a href="{{ route('admin.users.show', $user) }}" class="btn-detail" title="Lihat Detail">
                                                <i class="fas fa-eye me-1"></i>Detail
                                            </a>
                                            
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn-edit" title="Edit User">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            
                                            <!-- Deactivate Button -->
                                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-toggle btn-deactivate" title="Nonaktifkan User" 
                                                        onclick="return confirm('Yakin ingin menonaktifkan user ini?')">
                                                    <i class="fas fa-ban me-1"></i>Nonaktif
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                            <p class="mb-0">Belum ada user aktif yang terdaftar</p>
                                            <small class="text-muted">User yang aktif akan tampil di sini</small>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Inactive Users Tab -->
            <div class="tab-pane fade" id="inactive-users" role="tabpanel" aria-labelledby="inactive-users-tab">
                <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: #fff5f5; border-bottom: 1px solid #ffcdd2;">
                    <h6 class="m-0 fw-bold" style="color: #333;">
                        <i class="fas fa-user-times me-2" style="color: #dc3545;"></i>Daftar User Nonaktif
                    </h6>
                    <span class="badge" style="background-color: #dc3545; color: white;">{{ $users->where('is_active', false)->count() }} Nonaktif</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="inactiveUsersTable">
                            <thead>
                                <tr>
                                    <th class="table-header" onclick="sortTable(0, 'inactiveUsersTable')">
                                        No
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(1, 'inactiveUsersTable')">
                                        Nama
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(2, 'inactiveUsersTable')">
                                        Email
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header" onclick="sortTable(3, 'inactiveUsersTable')">
                                        Role
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="table-header">
                                        Permissions
                                    </th>
                                    <th class="table-header">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $inactiveUsers = $users->where('is_active', false); @endphp
                                @forelse($inactiveUsers as $user)
                                <tr style="opacity: 0.7;">
                                    <td class="fw-semibold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-3" style="background-color: #ffebee; border-color: #ffcdd2;">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role === 'superadmin')
                                            <span class="role-badge" style="background-color: #e3f2fd; color: #1976d2;">Super Admin</span>
                                        @elseif($user->role === 'admin')
                                            <span class="role-badge" style="background-color: #f3e5f5; color: #7b1fa2;">Admin</span>
                                        @elseif($user->role === 'karyawan')
                                            <span class="role-badge" style="background-color: #e8f5e8; color: #2e7d32;">Karyawan</span>
                                        @else
                                            <span class="role-badge" style="background-color: #f5f5f5; color: #757575;">{{ ucfirst($user->role) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->role === 'superadmin')
                                            <span class="permission-badge" style="background-color: #e3f2fd; color: #1976d2;">
                                                <i class="fas fa-check-circle me-1"></i>All Permissions
                                            </span>
                                        @elseif($user->permissions && count($user->permissions) > 0)
                                            <div>
                                                @foreach($user->permissions as $permission)
                                                    <span class="permission-badge" style="background-color: #f3e5f5; color: #7b1fa2;">
                                                        {{ \App\Models\User::getAvailablePermissions()[$permission] ?? $permission }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="permission-badge" style="background-color: #ffebee; color: #c62828;">
                                                <i class="fas fa-times-circle me-1"></i>No permissions
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <!-- Detail Button -->
                                            <a href="{{ route('admin.users.show', $user) }}" class="btn-detail" title="Lihat Detail">
                                                <i class="fas fa-eye me-1"></i>Detail
                                            </a>
                                            
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn-edit" title="Edit User">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            
                                            <!-- Activate Button -->
                                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-toggle btn-activate" title="Aktifkan User"
                                                        onclick="return confirm('Yakin ingin mengaktifkan user ini?')">
                                                    <i class="fas fa-check-circle me-1"></i>Aktifkan
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="fas fa-user-times"></i>
                                            </div>
                                            <p class="mb-0">Tidak ada user yang dinonaktifkan</p>
                                            <small class="text-muted">User yang dinonaktifkan akan tampil di sini</small>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <script>
        // Auto dismiss alerts after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.auto-dismiss');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 3000);
            });
        });

        // Search functionality
        document.getElementById('searchNama').addEventListener('keyup', function() {
            filterTable();
        });

        document.getElementById('searchEmail').addEventListener('keyup', function() {
            filterTable();
        });

        document.getElementById('filterRole').addEventListener('change', function() {
            filterTable();
        });

        function filterTable() {
            const searchNama = document.getElementById('searchNama').value.toLowerCase();
            const searchEmail = document.getElementById('searchEmail').value.toLowerCase();
            const filterRole = document.getElementById('filterRole').value.toLowerCase();
            
            // Filter both active and inactive tables
            filterTableById('activeUsersTable', searchNama, searchEmail, filterRole);
            filterTableById('inactiveUsersTable', searchNama, searchEmail, filterRole);
        }

        function filterTableById(tableId, searchNama, searchEmail, filterRole) {
            const table = document.getElementById(tableId);
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    const nama = cells[1].textContent.toLowerCase();
                    const email = cells[2].textContent.toLowerCase();
                    const role = cells[3].textContent.toLowerCase();

                    const showRow = (
                        (searchNama === '' || nama.includes(searchNama)) &&
                        (searchEmail === '' || email.includes(searchEmail)) &&
                        (filterRole === '' || role.includes(filterRole))
                    );

                    rows[i].style.display = showRow ? '' : 'none';
                }
            }
        }

        // Table sorting
        let sortDirection = {};

        function sortTable(columnIndex, tableId) {
            const table = document.getElementById(tableId);
            const tbody = table.getElementsByTagName('tbody')[0];
            const rows = Array.from(tbody.getElementsByTagName('tr'));
            
            // Skip if no data rows
            if (rows.length === 0 || (rows.length === 1 && rows[0].cells.length === 1)) {
                return;
            }

            // Create unique key for this table and column
            const sortKey = `${tableId}_${columnIndex}`;
            
            // Determine sort direction
            const currentDirection = sortDirection[sortKey] || 'asc';
            const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
            sortDirection[sortKey] = newDirection;

            // Update sort icons for this table only
            const headers = table.getElementsByClassName('sort-icon');
            for (let i = 0; i < headers.length; i++) {
                headers[i].className = 'fas fa-sort sort-icon';
            }
            
            const currentHeader = table.getElementsByClassName('sort-icon')[columnIndex];
            if (currentHeader) {
                currentHeader.className = newDirection === 'asc' ? 'fas fa-sort-up sort-icon' : 'fas fa-sort-down sort-icon';
            }

            // Sort rows
            rows.sort((a, b) => {
                let aValue = a.cells[columnIndex].textContent.trim();
                let bValue = b.cells[columnIndex].textContent.trim();

                // Handle numeric sorting for specific columns (No column)
                if (columnIndex === 0) {
                    aValue = parseInt(aValue) || 0;
                    bValue = parseInt(bValue) || 0;
                }

                if (aValue < bValue) {
                    return newDirection === 'asc' ? -1 : 1;
                }
                if (aValue > bValue) {
                    return newDirection === 'asc' ? 1 : -1;
                }
                return 0;
            });

            // Re-append sorted rows
            rows.forEach(row => tbody.appendChild(row));
        }

        // Tab functionality to update badge counts
        document.addEventListener('DOMContentLoaded', function() {
            const tabTriggers = document.querySelectorAll('[data-bs-toggle="tab"]');
            
            tabTriggers.forEach(function(tab) {
                tab.addEventListener('shown.bs.tab', function(event) {
                    // You can add additional functionality here when tabs are switched
                    console.log('Tab switched to:', event.target.id);
                });
            });
        });
    </script>
</x-admin-layout>