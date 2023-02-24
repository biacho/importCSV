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
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-3">
            <div>
                <label for="file" class="form-label">Choose CSV file to import.</label>
                <input class="form-control form-control-lg" form="mapping" id="file" type="file" name="file" onchange="trigger()">
                @error('file')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>            
        </div>    

        @if(session('reportData'))
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Report</h4>
                <div class="w-25">
                    <table class="table table-sm table-borderless align-middle">
                        <tbody>
                            <tr>
                                <th scope="row" style="text-align: end">Import Time (sec):</th>
                                <td>{{ session('reportData.execTime') }}</td>
                            </tr>
                                <tr>
                                <th scope="row" style="text-align: end">Rows to import:</th>
                                <td>{{ session('reportData.toImport') }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: end">Imported:</th>
                                <td>{{ session('reportData.success') }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: end">Failed:</th>
                                <td>{{ session('reportData.fails') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>           
        @endif
        </div>

        <!-- Modal -->
        <div class="modal fade" id="colMapping" tabindex="-1" aria-labelledby="colMappingLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="colMappingLabel">Column Mapping</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="resetFileInput()"></button>
                    </div>
                    <div class="modal-body">
                        @include('mapping')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetFileInput()">Cancel</button>
                        <button type="submit" form="mapping" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.3.slim.js" integrity="sha256-DKU1CmJ8kBuEwumaLuh9Tl/6ZB6jzGOBV/5YpNE2BWc=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

        <script>
            function trigger() 
            {
                console.log('Works!');
                const modalToggle = document.getElementById('colMapping'); 
                const mappingModal = new bootstrap.Modal('#colMapping', {
                    keyboard: false                
                });
                mappingModal.show(modalToggle)
            }

            function resetFileInput() 
            {
                $("#file").val('');
            }
        </script>
    </body>
</html>
