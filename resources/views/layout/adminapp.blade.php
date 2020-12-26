<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>

    <link rel="shortcut icon" href="untar.ico" type="image/x-icon">

    <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js"
        integrity="sha256-+Q/z/qVOexByW1Wpv81lTLvntnZQVYppIL1lBdhtIq0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"
        integrity="sha256-8zyeSXm+yTvzUN1VgAOinFgaVFEFTyYzWShOy9w7WoQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"
        integrity="sha512-qzgd5cYSZcosqpzpn7zF2ZId8f/8CHmFKZ8j7mU4OUXTNRd5g+ZHBPsgKEwoqxCtdQvExE5LprwwPAgoicguNg=="
        crossorigin="anonymous"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap.min.css"
        integrity="sha512-1r2gsUynzocV5QbYgEwbcNGYQeQ4jgHUNZLl+PMr6o248376S3f9k8zmXvsKkU06wH0MrmQacKd0BjJ/kWeeng=="
        crossorigin="anonymous" />
</head>

<body>
    <main>
        <div class="wrapper">
            @include('layout.sidebar-admin')

            <div class="content">
                @include('layout.navbar-admin')
                <div class="main">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    @yield ('js')

    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('activesidebar');
            });
        });

        function ddProdi() {
            document.getElementById("ddprodi").classList.toggle("showdd");
        }

        function ddFakultas() {
            document.getElementById("ddfakultas").classList.toggle("showdd");
        }

        function ddLulusan() {
            document.getElementById("ddlulusan").classList.toggle("showdd");
        }

        function ddTgl() {
            document.getElementById("ddtgl").classList.toggle("showdd");
        }

        $(function() {
            $("#myTable").tablesorter();
        });
    </script>
</body>
</html>
