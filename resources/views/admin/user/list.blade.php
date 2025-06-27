@extends('admin.layouts.master')

@section('title', 'User List Page')

@section('content')
<main class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-uppercase">User List</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check me-2"></i> <span id="notice"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-6">
            @if (request('key'))
                <p class="text-secondary">Search key: <span class="text-success">{{ request('key') }}</span></p>
            @endif
        </div>
        <div class="col-md-6">
            <form action="{{ route('user#list') }}" method="GET" class="d-flex justify-content-end">
                @csrf
                <input type="text" name="key" class="form-control w-50 me-2" placeholder="Search" value="{{ request('key') }}">
                <button type="submit" class="btn btn-dark">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="mb-3">
        <h5><i class="fa-solid fa-database"></i> Total: <span class="fw-bold">{{ $users->count() }}</span></h5>
    </div>

    <div class="table-responsive">
        @if (count($users) != 0)
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="userTable">
                            <input type="hidden" class="userId" value="{{ $user->id }}">
                            <td class="col-2">
                                @if ($user->image == null)
                                    <img src="{{ asset('image/defaultUser.png') }}" class="img-thumbnail shadow-sm" style="width: 60px; height: 60px; object-fit: cover;" alt="Default User">
                                @else
                                    <img src="{{ asset('storage/' . $user->image) }}" class="img-thumbnail shadow-sm" style="width: 60px; height: 60px; object-fit: cover;" alt="User Image">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->gender ?? '___' }}</td>
                            <td>{{ $user->phone ?? '___' }}</td>
                            <td>{{ $user->address ?? '___' }}</td>
                            <td>
                                <select class="form-select userStatus">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @else
            <div class="text-center text-muted py-5">
                <h4><i class="fa-solid fa-user-slash me-2"></i>No users found</h4>
            </div>
        @endif
    </div>
</main>
@endsection

@section('scriptSection')
<script>
    $('.userStatus').each(function () {
        $(this).change(function () {
            let userId = $(this).closest('.userTable').find('.userId').val();
            let role = $(this).val();

            $.ajax({
                type: 'GET',
                url: 'http://127.0.0.1:8000/user/changeUserRole',
                data: {
                    role: role,
                    userId: userId
                },
                dataType: 'json',
                success: function (response) {
                    window.location.reload();
                }
            });
        });
    });
</script>
@endsection
