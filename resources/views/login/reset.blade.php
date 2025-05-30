<x-login.layout>
    <x-slot:title>Reset Password</x-slot:title>
    <div class="section-authentication-cover">
        <div class="">
            <div class="row g-0">
                <div
                    class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                    <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/login-images/reset-password-cover.svg') }}"
                                class="img-fluid" width="600" alt="" />
                        </div>
                    </div>
                </div>
                <div
                    class="col-12 col-xl-5 col-xxl-4 auth-cover-right bg-light align-items-center justify-content-center">
                    <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                        <div class="card-body p-sm-5">
                            <div class="">
                                <div class="mb-4 text-center bx-spin">
                                    <img src="{{ asset('assets/images/logo-icon.png') }}" width="60"
                                        alt="" />
                                </div>
                                <div class="text-start mb-4">
                                    <h5 class="">Generate New Password</h5>
                                    <p class="mb-0">We received your reset password request. Please enter your new
                                        password!</p>
                                </div>
                                <form action="{{ route('reset-password-proses') }}" method="POST">
                                    @csrf
                                    <div class="col-12 mb-3">
                                        <label for="password" class="form-label">New Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0" id="password"
                                                name="password" placeholder="Enter New Password" minlength="8" required> <a
                                                href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class='bx bx-hide'></i></a>
                                        </div>
                                        @error('password')
                                            <div class="text-sm text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="password_confirmation" class="form-label">Confirm
                                            Password</label>
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
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-white">Change Password</button> <a
                                            href="{{ route('login') }}" class="btn btn-light"><i
                                                class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end row-->
        </div>
    </div>
</x-login.layout>
