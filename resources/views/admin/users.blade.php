@extends('layouts.admin')

@section('title', 'Manage Users - JobBridge')
@section('page-title', 'Manage Users')

@section('content')

<div class="content-card">

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="stats-row mb-4">
        <div class="mini-stat">
            <div class="num">{{ $users->total() }}</div>
            <div class="lbl">Total Users</div>
        </div>
        <div class="mini-stat">
            <div class="num">{{ $users->where('role', 'employer')->count() }}</div>
            <div class="lbl">Employers</div>
        </div>
        <div class="mini-stat">
            <div class="num">{{ $users->where('role', 'seeker')->count() }}</div>
            <div class="lbl">Seekers</div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:34px;height:34px;background:#e0f2f1;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#00897b;font-size:0.85rem;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        {{ $user->name }}
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->role == 'employer')
                        <span class="badge-employer">Employer</span>
                    @else
                        <span class="badge-seeker">Seeker</span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>
                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete"
                                onclick="return confirm('Delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($users->hasPages())
    <div class="d-flex justify-content-end mt-4">
        <ul class="pagination pagination-sm mb-0">
            @for($i = 1; $i <= $users->lastPage(); $i++)
                <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $users->appends(request()->except('page'))->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
        </ul>
    </div>
    @endif
</div>

@endsection