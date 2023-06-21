<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height:100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Style Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    {{-- CDN Bootsrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body style="height:100%;">
    <div id="app" style="height: 100%; display: flex; flex-direction: column;">

        @include('layouts.include.navbar')



        <main style="flex: 1;display:flex;">
            @include('layouts.include.sidebar')


            <div class="ContentS1" style="flex: 1;display:flex;flex-direction:column;">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                @yield('content')
            </div>
        </main>

    </div>


    {{-- scripts --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>


    <script>
        let table = new DataTable('#myTable');

        let exportButton = document.getElementById('exportButton');
        exportButton.addEventListener('click', function() {
            // Retrieve the DataTable columns and data
            let columns = table.columns().header().toArray().map(header => header.innerText);
            let data = table.data().toArray();


            // Find the index of the "Action" column
            let actionColumnIndex = columns.findIndex(column => column === 'Action');

            // Filter out the "Action" column from the columns and data
            let filteredColumns = columns.filter((column, index) => index !== actionColumnIndex);
            let filteredData = data.map(row => row.filter((_, index) => index !== actionColumnIndex));

            // Create a new workbook and worksheet
            let workbook = XLSX.utils.book_new();
            let worksheet = XLSX.utils.aoa_to_sheet([filteredColumns, ...filteredData]);

            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');

            // Save the workbook as an Excel file
            XLSX.writeFile(workbook, 'table_data.xlsx');


        });
    </script>
    <script>
        function sendMarkRequest(id = null) {
            return $.ajax("{{ route('markNotification') }}", {
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                }
            });
        }

        $(function() {
            $('.mark-as-read').click(function() {
                let request = sendMarkRequest($(this).data('id'));
                request.done(() => {
                    $(this).parents('div.alert').remove();
                });
            });

            $('#mark-all').click(function() {
                let request = sendMarkRequest();
                request.done(() => {
                    $('div.alert').remove();
                });
            });
        });
    </script>
</body>

</html>
