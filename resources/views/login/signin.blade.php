<x-login.layout>
    <x-slot:title>Login</x-slot:title>
    <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">

                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="assets/images/login-images/login-cover.svg"
                                    class="img-fluid auth-img-cover-login" width="650" alt="" />
                            </div>
                        </div>

                    </div>

                    <div
                        class="col-12 col-xl-5 col-xxl-4 auth-cover-right bg-light align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center bx-spin">
                                        <img src="assets/images/logo-icon.png" width="60" alt="">
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">{{ str_replace('_', ' ', config('app.name')) }} Login</h5>
                                        <p class="mb-0">Please log in to your account</p>
                                    </div>
                                    <div class="form-body">
                                        <form action="{{ route('login-proses') }}" method="POST" class="row g-3" validate>
                                            @csrf
                                            <div class="col-12">
                                                <label for="login" class="form-label">Email Or Username</label>
                                                <input type="text" class="form-control" id="login" name="login"
                                                    placeholder="Input Email" value="{{ old('login') }}" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"
                                                        id="password" name="password"
                                                        placeholder="Enter Password" required> <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class="bx bx-hide"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6 text-end"> <a
                                                    href="{{route('forgot')}}">Forgot Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-light mb-3">Sign in</button>
                                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
            </div>
        </div>
</x-login.layout>
