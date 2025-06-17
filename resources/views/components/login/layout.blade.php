<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>{{ str_replace('_', ' ', config('app.name')) }} | {{ $title }} </title>
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
        {{ $slot }}
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

    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
        $(document).ready(function() {
            $("#hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#hide_password input').attr("type") == "text") {
                    $('#hide_password input').attr('type', 'password');
                    $('#hide_password i').addClass("bx-hide");
                    $('#hide_password i').removeClass("bx-show");
                } else if ($('#hide_password input').attr("type") == "password") {
                    $('#hide_password input').attr('type', 'text');
                    $('#hide_password i').removeClass("bx-hide");
                    $('#hide_password i').addClass("bx-show");
                }
            });
        });
    </script>

    @if (session('success') || session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toastLiveExample = document.getElementById('liveToast');
                const toastTime = document.getElementById('toastTime');

                // Set waktu saat ini
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
