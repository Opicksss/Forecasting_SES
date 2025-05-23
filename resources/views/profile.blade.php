<x-layout>
    <x-slot:title>Profile</x-slot:title>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ ucwords($user->name) }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center my-1">
                                    @if ($user->foto && file_exists(storage_path('app/public/' . $user->foto)))
                                        <img class="rounded-circle p-1 bg-secondary" src="/storage/{{ $user->foto }}"
                                            alt="Maintenance" style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <img class="rounded-circle p-1 bg-secondary"
                                            src="{{ asset('img/profilDefault.jpg') }}" alt="Maintenance"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    @endif

                                    <div class="mt-2">
                                        <h4>{{ ucwords($user->name) }}</h4>
                                        <p class="font-size-sm mb-3">{{ $user->email }}</p>

                                        <!-- Tombol New Foto dan Reset Sejajar -->
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-light" data-bs-toggle="modal"
                                                data-bs-target="#foto">New Foto</button>
                                            <button class="btn btn-light px-4" data-bs-toggle="modal"
                                                data-bs-target="#reset">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body ">
                                <form action="{{ route('profile.update', $user->id) }}" method="POST" class="row g-3">
                                    @csrf
                                    @method('put')
                                    <div class="row mb-5 mt-5">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Nama Lengkap" value="{{ $user->name }}" required />
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email Aktif" value="{{ $user->email }}" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 mt-3 mb-3">
                                            <button type="button" class="btn btn-light"
                                                id="openModalButton">Save
                                                Changes</button>
                                            <button type="reset" class="btn btn-light ms-1"
                                                id="openModalButton">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal foto -->
    <div class="modal fade" id="foto" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="foto" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload New Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.foto', $user->id) }}" method="POST"
                        enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="foto" class="form-label">New Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto"
                                accept="image/*" required>
                            <div class="invalid-feedback">
                                Upload Foto Baru Anda !
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-light">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //Modal foto -->
    <!-- Modal reset -->
    <div class="modal fade" id="reset" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="reset" aria-hidden="true">
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
                        Apakah Anda yakin ingin menghapus foto
                        <strong style="font-size: 1rem;">{{ ucwords($user->name) }}
                            ?</strong>
                        Tindakan ini tidak dapat dibatalkan.
                    </p>
                    <div class="d-flex justify-content-center">
                        <i class="bi bi-exclamation-circle-fill text-warning" style="font-size: 3rem;"></i>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer justify-content-center gap-3">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close
                    </button>
                    <form action="{{ route('profile.reset', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-outline-danger">Reset
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //Modal reset -->
    <!-- Modal data -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="data" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title text-warning">
                        Konfirmasi Perubahan
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <p class="mb-4">
                        Apakah Anda yakin ingin menyimpan perubahan ini?
                    </p>
                    <div class="d-flex justify-content-center">
                        <i class="bi bi-exclamation-circle-fill text-warning" style="font-size: 3rem;"></i>
                    </div>
                </div>
                <div class="modal-footer justify-content-center gap-3">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-light" id="confirmSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- //Modal data -->

</x-layout>
