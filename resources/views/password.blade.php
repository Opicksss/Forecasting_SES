<x-layout>
    <x-slot:title>Ubah Password</x-slot:title>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Password</div>
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

                                    <div class="mt-3">
                                        <h4>{{ ucwords($user->name) }}</h4>
                                        <p class="font-size-sm mb-2">{{ $user->email }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body ">
                                <form action="{{ route('profile.password', $user->id) }}" method="POST" class="row g-3">
                                    @csrf
                                    @method('put')
                                    <div class="row mb-3 mt-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Password Lama</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group" id="hide_show_password">
                                                <input type="password" class="form-control border-end-0"
                                                    name="current_password" placeholder="Password Lama" minlength="8" required>
                                                <a href="javascript:;" class="input-group-text bg-transparent">
                                                    <i class="bx bx-hide"></i></a>
                                            </div>
                                            @error('password')
                                                <div class="text-sm text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Password Baru</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0" id="password"
                                                    name="password" placeholder="Minimal 8 Karakter" minlength="8" required>
                                                <a href="javascript:;" class="input-group-text bg-transparent">
                                                    <i class="bx bx-hide"></i></a>
                                            </div>
                                            @error('password')
                                                <div class="text-sm text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Confirm Password</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group" id="hide_password">
                                                <input type="password" class="form-control border-end-0"
                                                    id="password_confirmation" name="password_confirmation"
                                                    placeholder="Confirm Password" minlength="8" required> <a
                                                    href="javascript:;" class="input-group-text bg-transparent"><i
                                                        class='bx bx-hide'></i></a>
                                            </div>
                                            @error('password')
                                                <div class="text-sm text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                            <label for="password-label" style="font-size: 12px;">* Minimal Password 8 Karakter !</label>
                                        </div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 mt-3 mb-1 ">
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
