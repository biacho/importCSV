<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Import CSV</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body class="antialiased">
        <div class="container position-absolute top-50 start-50 translate-middle">
            <form id="import-csv-form" method="POST"  action="{{ url('import') }}" accept-charset="utf-8" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div>
                        <label for="file" class="form-label">Choose CSV file to import.</label>
                        <input class="form-control form-control-lg" id="file" type="file" name="file">
                        @error('file')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>            
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </div>     
            </form>

        <!-- @if(session('reportData')) -->
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Report</h4>
                
                <div class="w-25">
                    <table class="table table-sm table-borderless align-middle">
                        <tbody>
                            <tr>
                                <th scope="row" style="text-align: end">Import Time (sec):</th>
                                <td>{{ session('reportData.importTime') }}</td>
                            </tr>
                                <tr>
                                <th scope="row" style="text-align: end">Rows to import:</th>
                                <td>{{ session('reportData.rowsToImport') }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: end">Imported:</th>
                                <td>{{ session('reportData.importSuccess') }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: end">Failed:</th>
                                <td>{{ session('reportData.importFailure') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>            
            <div class="">
            </div>
        <!-- @endif -->
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    </body>
</html>
