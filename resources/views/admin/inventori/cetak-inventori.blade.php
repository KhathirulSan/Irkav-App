<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <title>Cetak Data Inventoris</title>
</head>

<body>
    <h5 align="center"><b>Laporan Data Inventori</b></h5>
    {{-- <a href="{{ route('admin/inventori/downloadData') }}" class="btn btn-success ml-auto m-2">Cetak PDF</a> --}}
    <div class="form-group">
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Jumlah Barang</th>
                    <th>Status Barang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Inventoris as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->Nama_Barang }}</td>
                        <td>{{ $item->Kategori }}</td>
                        <td>{{ $item->Jumlah_Barang }}</td>
                        <td>{{ $item->Status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </table>
        <p>Total: {{ $total }}</p>
    </div>
</body>

{{-- <script type="text/javascript">
    window.print();
</script> --}}

</html>
