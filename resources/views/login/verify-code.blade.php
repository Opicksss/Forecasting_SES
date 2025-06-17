<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>{{ str_replace('_', ' ', config('app.name')) }} | Verify Code </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

</head>

<body class="bg-theme bg-theme2">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">
                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="assets/images/login-images/forgot-password-cover.svg" class="img-fluid"
                                    width="600" alt="" />
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-12 col-xl-5 col-xxl-4 auth-cover-right bg-light align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="p-3">
                                    <div class="text-center">
                                        <img src="assets/images/icons/forgot-2.png" width="100" alt="" />
                                    </div>
                                    <h4 class="mt-5 font-weight-bold">Verify Your Email Code</h4>
                                    <p class="mb-0">Enter the 6-digit code sent to your email to change password</p>
                                    <form action="{{ route('verify-code-proses') }}" method="POST">
                                        @csrf
                                        <div class="my-3">
                                            <label class="form-label">Verification Code</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Your Email Address" id="code" name="code"
                                                required>
                                            <p class="small mt-1">The code will expire in <span
                                                    id="countdown-text">10:00</span></p>
                                            <div class="text-end">
                                                <a href="{{ route('forgot') }}" id="resend-link"
                                                    class="text-secondary ">Didn't get the code?</a>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-white">Verify</button>
                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            <a href="{{ route('login') }}" class="btn btn-light"><i
                                                    class='bx bx-arrow-back me-1'></i>Back to
                                                Login</a>
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
    </div>
    <!--end wrapper-->
    <x-toast></x-toast>
    <!--start switcher-->
    <x-setting></x-setting>
    <!--end switcher-->

    <!--plugins-->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    @if (session('success') || session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toastLiveExample = document.getElementById('liveToast');
                const toastTime = document.getElementById('toastTime');

                const currentTime = new Date();
                const formattedTime = currentTime.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                toastTime.textContent = formattedTime;

                const toast = new bootstrap.Toast(toastLiveExample);
                toast.show();
            });
        </script>
    @endif

    <script>
        document.getElementById('conditions').addEventListener('change', function() {
            var submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = !this.checked;
            submitBtn.style.opacity = this.checked ? '1' : '0.5';
        });
    </script>

    <script>
        const createdAt = {{ $created_at }};
        const expireDuration = 600;
        const now = Math.floor(Date.now() / 1000);

        let remaining = expireDuration - (now - createdAt);
        remaining = remaining > 0 ? remaining : 0;

        const countdownTextEl = document.getElementById('countdown-text');
        const resendLink = document.getElementById('resend-link');

        resendLink.style.pointerEvents = 'none';
        resendLink.style.cursor = 'not-allowed';

        const timer = setInterval(() => {
            const minutes = Math.floor(remaining / 60);
            const seconds = remaining % 60;

            const formatted = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            countdownTextEl.textContent = formatted;

            if (remaining <= 480 && resendLink.style.pointerEvents === 'none') {
                resendLink.style.pointerEvents = 'auto';
                resendLink.style.cursor = 'pointer';
                resendLink.classList.remove('text-secondary');
            }

            if (remaining <= 0) {
                clearInterval(timer);
                countdownTextEl.textContent = "Expired";
                document.getElementById('code').disabled = true;
                document.querySelector('button[type="submit"]').disabled = true;
            }

            remaining--;
        }, 1000);
    </script>

    <script>
        $(".switcher-btn").on("click", function() {
                $(".switcher-wrapper").toggleClass("switcher-toggled")
            }), $(".close-switcher").on("click", function() {
                $(".switcher-wrapper").removeClass("switcher-toggled")
            }),


            $('#theme1').click(theme1);
        $('#theme2').click(theme2);
        $('#theme3').click(theme3);
        $('#theme4').click(theme4);
        $('#theme5').click(theme5);
        $('#theme6').click(theme6);
        $('#theme7').click(theme7);
        $('#theme8').click(theme8);
        $('#theme9').click(theme9);
        $('#theme10').click(theme10);
        $('#theme11').click(theme11);
        $('#theme12').click(theme12);
        $('#theme13').click(theme13);
        $('#theme14').click(theme14);
        $('#theme15').click(theme15);

        function theme1() {
            $('body').attr('class', 'bg-theme bg-theme1');
        }

        function theme2() {
            $('body').attr('class', 'bg-theme bg-theme2');
        }

        function theme3() {
            $('body').attr('class', 'bg-theme bg-theme3');
        }

        function theme4() {
            $('body').attr('class', 'bg-theme bg-theme4');
        }

        function theme5() {
            $('body').attr('class', 'bg-theme bg-theme5');
        }

        function theme6() {
            $('body').attr('class', 'bg-theme bg-theme6');
        }

        function theme7() {
            $('body').attr('class', 'bg-theme bg-theme7');
        }

        function theme8() {
            $('body').attr('class', 'bg-theme bg-theme8');
        }

        function theme9() {
            $('body').attr('class', 'bg-theme bg-theme9');
        }

        function theme10() {
            $('body').attr('class', 'bg-theme bg-theme10');
        }

        function theme11() {
            $('body').attr('class', 'bg-theme bg-theme11');
        }

        function theme12() {
            $('body').attr('class', 'bg-theme bg-theme12');
        }

        function theme13() {
            $('body').attr('class', 'bg-theme bg-theme13');
        }

        function theme14() {
            $('body').attr('class', 'bg-theme bg-theme14');
        }

        function theme15() {
            $('body').attr('class', 'bg-theme bg-theme15');
        }
    </script>
</body>

</html>
