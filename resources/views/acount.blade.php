<x-layout>
    <x-slot:title>Acount</x-slot:title>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ str_replace('_', ' ', config('app.name')) }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Acount</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">Manajemen Acount</h6>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#create"><i
                    class="bx bx-plus bx-spin-hover"></i>Acount</button>
        </div>

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table align-middle mb-0 table-hover">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10px;">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Foto</th>
                                <th class="no-export" style="width: 80px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userss as $user)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($user->name) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td style="text-align: center;">
                                        @if ($user->foto && file_exists(storage_path('app/public/' . $user->foto)))
                                            <img class="card-img" src="/storage/{{ $user->foto }}" alt="Maintenance"
                                                style="max-width: 50px; max-height: 50px; object-fit: contain;">
                                        @else
                                            <img class="card-img" src="{{ asset('img/profilDefault.jpg') }}"
                                                alt="Maintenance"
                                                style="max-width: 50px; max-height: 50px; object-fit: contain;">
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="d-flex order-actions">
                                            <button type="button" style="padding: 3px 6px; "
                                                class="ms-2 flip-animation btn btn-light border-secondary"
                                                title="Update" data-bs-toggle="modal"
                                                data-bs-target="#update{{ $user->id }}">
                                                <i class="bx bx-edit-alt me-0"></i>
                                            </button>
                                            <button type="button" style="padding: 3px 6px; "
                                                class="ms-2 flip-animation btn btn-light border-secondary "
                                                title="Delete" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $user->id }}">
                                                <i class="bx bx-trash text-danger me-0"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal update -->
                                <div class="modal fade" id="update{{ $user->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                    aria-labelledby="update{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Akun {{ ucwords($user->name) }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('acount.update', $user->id) }}" method="POST"
                                                    enctype="multipart/form-data" class="row g-3 ">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mt-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            value="{{ $user->name }}" name="name"
                                                            placeholder="Nama Lengkap" required>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                            value="{{ $user->email }}" name="email"
                                                            placeholder="Email Aktif" required>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="foto" class="form-label">Foto</label>
                                                        <div class="mb-2">
                                                            @if ($user->foto && file_exists(storage_path('app/public/' . $user->foto)))
                                                                <img class="card-img me-1 mb-2"
                                                                    src="/storage/{{ $user->foto }}"
                                                                    alt="Maintenance"
                                                                    style="max-width: 50px; max-height: 50px; object-fit: contain;">
                                                                <label for="foto" class="form-label"
                                                                    style="font-size: 10px;">Pilih Foto Jika Ingin
                                                                    Merubah
                                                                    !</label>
                                                                <input type="file" class="form-control"
                                                                    id="foto" name="foto" accept="image/*">
                                                            @else
                                                                <input type="file" class="form-control"
                                                                    id="foto" name="foto" accept="image/*">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <div class="input-group" id="show_hide_password">
                                                            <input type="password" class="form-control border-end-0"
                                                                id="password" name="password"
                                                                placeholder="Minimal 8 Karakter" minlength="8">
                                                            <a href="javascript:;"
                                                                class="input-group-text bg-transparent">
                                                                <i class="bx bx-hide"></i></a>
                                                        </div>
                                                        <label for="password" class="form-label"
                                                            style="font-size: 10px;">Jika Tidak Ada Perubahan Password
                                                            Tidak
                                                            Perlu di Isi !</label>
                                                    </div>
                                                    <div class="mt-1 mb-2">
                                                        <label for="password_confirmation" class="form-label">Confirm
                                                            Password</label>
                                                        <div class="input-group" id="hide_password">
                                                            <input type="password" class="form-control border-end-0"
                                                                id="password_confirmation"
                                                                name="password_confirmation"
                                                                placeholder="Confirm Password" minlength="8">
                                                            <a href="javascript:;"
                                                                class="input-group-text bg-transparent">
                                                                <i class="bx bx-hide"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset"
                                                            class="btn btn-outline-secondary">Reset</button>
                                                        <button type="submit"
                                                            class="btn btn-outline-light">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- //Modal update -->
                                <!-- Modal delete -->
                                <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                    aria-labelledby="delete{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header justify-content-center">
                                                <h5 class="modal-title text-danger">
                                                    Konfirmasi Penghapusan
                                                </h5>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body text-center">
                                                <p class="mb-4">
                                                    Apakah Anda yakin ingin menghapus Akun
                                                    <strong style="font-size: 1rem;">{{ ucwords($user->name) }}
                                                        ?</strong>
                                                    Tindakan ini tidak dapat dibatalkan.
                                                </p>
                                                <div class="d-flex justify-content-center">
                                                    <i class="bx bx-alarm-exclamation bx-tada bx-flip-horizontal text-warning"
                                                        style="font-size: 7rem;"></i>
                                                </div>
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="modal-footer justify-content-center gap-3">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Close
                                                </button>
                                                <form action="{{ route('acount.destroy', $user->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger">Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- //Modal delete -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal create -->
    <div class="modal fade" id="create" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="create" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Akun Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('acount.store') }}" method="POST" enctype="multipart/form-data"
                        class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div>
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nama Lengkap" required>
                            <div class="invalid-feedback">
                                Masukkan Nama Lengkap!
                            </div>
                        </div>
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email Aktif" required>
                            <div class="invalid-feedback">
                                Masukkan Email Aktif!
                            </div>
                        </div>
                        <div>
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto"
                                accept="image/*" required>
                            <div class="invalid-feedback">
                                Upload Foto Anda!
                            </div>
                        </div>`
                        <div>
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" id="password"
                                    name="password" placeholder="Minimal 8 Karakter" minlength="8" required>
                                <a href="javascript:;" class="input-group-text bg-transparent">
                                    <i class="bx bx-hide"></i></a>
                                <div class="invalid-feedback">
                                    Masukkan Password!
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm Password" minlength="8"
                                    required>
                                <a href="javascript:;" class="input-group-text bg-transparent">
                                    <i class="bx bx-hide"></i></a>
                                <div class="invalid-feedback">
                                    Masukkan Confirm Password!
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            <button type="submit" class="btn btn-outline-light">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //Modal create -->

</x-layout>
