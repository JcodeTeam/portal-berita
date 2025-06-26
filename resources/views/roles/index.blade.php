@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>
        </div>

        @if ($roles->isEmpty())
            <div class="alert alert-info">Tidak ada peran yang tersedia.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Peran</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td class="text-center">
                                    @if (!in_array($role->id, [1, 2, 3]))
                                        <div class="d-flex justify-content-center gap-2">

                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editRoleModal{{ $role->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>

                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                onsubmit="return confirmDelete(event, this);" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>

                                        @include('roles.edit-modal', ['role' => $role])
                                    @else
                                        <span class="text-muted">Tidak dapat diubah</span>
                                    @endif
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $roles->links() }}
        @endif
    </div>

    @include('roles.create-modal')
@endsection
