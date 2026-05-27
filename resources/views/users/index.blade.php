@extends('layouts.app')
@section('page-title', 'Users Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-people me-2" style="color:var(--porsche-red);"></i>All Users</span>
        <button class="btn btn-porsche btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-plus-lg me-1"></i> Add User
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="ps-3 text-muted" style="font-size:0.8rem;">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-placeholder" style="width:28px;height:28px;font-size:0.7rem;">
                                    {{ strtoupper(substr($user->name,0,1)) }}
                                </div>
                                {{ $user->name }}
                                @if($user->id === auth()->id())
                                    <span class="badge" style="background:var(--porsche-red);font-size:0.6rem;">You</span>
                                @endif
                            </div>
                        </td>
                        <td class="text-muted">{{ $user->email }}</td>
                        <td class="text-muted" style="font-size:0.8rem;">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            @if($user->id === auth()->id())
                                <button class="btn btn-sm btn-outline-danger" disabled title="Cannot delete your own account">
                                    <i class="bi bi-trash"></i>
                                </button>
                            @else
                            <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline"
                                onsubmit="return confirm('Delete this user?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                            @endif
                        </td>
                    </tr>

                    {{-- Edit Modal --}}
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h6 class="modal-title fw-bold">Edit User</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST" action="{{ route('users.update', $user) }}">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">New Password <span class="text-muted fw-normal">(leave blank to keep)</span></label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-porsche">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add User Modal --}}
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h6 class="modal-title fw-bold">Add New User</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="modal-body">
                    @if($errors->any())
                    <div class="alert alert-danger py-2" style="font-size:0.85rem;">{{ $errors->first() }}</div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-porsche">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Re-open modal on validation error
    @if($errors->any() && old('name'))
        new bootstrap.Modal(document.getElementById('addUserModal')).show();
    @endif
</script>
@endpush
@endsection
