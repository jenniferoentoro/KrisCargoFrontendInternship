<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') - Kris Kargo Bahtera</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
crossorigin="anonymous" referrerpolicy="no-referrer" />        -->

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
        integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <div class="overlay"></div>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('components.header')

            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Content -->
            @yield('main')

            <div id="loadingModal" class="modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        {{-- <div class="modal-header">
                            <h3 class="text-2xl font-bold">Loading...</h3>
                        </div> --}}
                        <div class="modal-body text-center p-5">
                            <div class="spinner-border" role="status">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
        integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        flatpickr(".datepicker-input", {
            dateFormat: "d-m-Y",
            disableMobile: "true",
        });
        //but value is still in Y-m-d format
    </script>
    @stack('scripts')

    <script>
        var userName =
            "{{ session('success') }}"; // Get the user's name from the session data passed by the controller

        // Check if the user's name is not empty
        if (userName) {
            // Set the user's name in web storage (localStorage or sessionStorage)
            localStorage.setItem('user_name', userName);
        }

        $('#header-user-name').html(localStorage.getItem('user_name'));
        $('#btn-logout').on('click', function(e) {
            //clear storage user_name
            localStorage.removeItem('user_name');
        });
    </script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $('.collapse').on('show.bs.collapse', function() {
            $('.collapse.show').each(function() {
                $(this).collapse('hide');
            });
        });


        const body2 = document.querySelector('body');

        const onBodyClassChange = () => {
            // $('.dropdown').removeClass('active');
            // $('.dropdown-menu').removeClass('show');


            $('.main-sidebar .dropdown').removeClass('active');
            $('.main-sidebar .dropdown-menu').hide(); // hide the dropdown menu

            // alert("test");
            $('.main-sidebar .collapse').collapse('hide');
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.main-sidebar .dropdown-menu').style.display = 'none';
            });


            if (body2.classList.contains('sidebar-mini')) {

                $('.main-sidebar .nav-link.dropdown-toggle').removeAttr('data-toggle');
                console.log('The sidebar-mini class exists');
            } else {
                $('.main-sidebar .nav-link.dropdown-toggle').attr('data-toggle', 'collapse');

                console.log('The sidebar-mini class does not exist');
            }
        };

        const observer = new MutationObserver(onBodyClassChange);
        observer.observe(body2, {
            attributes: true
        });



        //stop data-toggle when on sidebar-mini
        // $('.nav-link.nav-link-lg').on('click', function () {
        //     $('.collapse').collapse('hide');
        //     document.addEventListener('DOMContentLoaded', function() {
        //         document.querySelector('.dropdown-menu').style.display = 'none';
        //     });
        //     $('.dropdown').removeClass('active');
        //     body = document.querySelector('body');
        //     console.log(body.classList);
        //     if (body.classList.contains('sidebar-mini')) {
        //         // Do something if the class exists
        //         $('.nav-link.dropdown-toggle').attr('data-toggle', 'collapse');

        //         console.log('The sidebar-mini class does not exist');
        //     } else {
        //         // add class


        //         $('.nav-link.dropdown-toggle').removeAttr('data-toggle');
        //         console.log('The sidebar-mini class exists');
        //     }
        //     // $('.nav-link.dropdown-toggle').removeAttr('data-toggle');



        // });
    </script>



    @yield('script')
</body>

</html>
