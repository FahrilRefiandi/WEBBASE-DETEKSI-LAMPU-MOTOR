@extends('theme.components.main')

@section('title', 'Cameras')
@section('content')

    <div class="page-wrapper">
        <div class="page-content">


            <div class="card">
                <div class="card-body">
                    <h4 class="d-inline">Camera</h4>
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Add Camera
                    </button>
                    <hr>

                    <div class="row gy-3">



                        <table class="table table-hover table-striped" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Ip</th>
                                    <th scope="col">Port</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                        </table>


                    </div>

                    <div class="form-row mt-3">
                        <div class="col-12">
                            <div id="todo-container"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Camera</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="location" placeholder="JL ANJASMARA ARAH UTARA" name="location" value="{{ old('location') }}">
                            <label for="location">Location</label>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="ip" placeholder="192.168.0.0" name="ip">
                                    <label for="ip">IP</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="port" placeholder="8000" name="port">
                                    <label for="port">Port</label>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="addCamera" class="btn btn-primary">Add Camera</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.datatables.net/v/ju/dt-1.13.4/datatables.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script>
        document.getElementById('addCamera').addEventListener('click', function() {


            $.ajax("{{ route('api.camera.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "Authorization": "Bearer {{ env('ACCESS_TOKEN') }}",
                },
                data: {
                    location: $('#location').val(),
                    ip: $('#ip').val(),
                    port: $('#port').val(),
                },
                success: function(data, status, xhr) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Camera Added',
                    })
                    $('#staticBackdrop').modal('hide');
                    $('#table').DataTable().ajax.reload();
                },
                error: function(res, textStatus, errorMessage) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.responseJSON.message,
                    })
                }
            });

        })
    </script>

    {{-- get data --}}
    <script>
        var columns = [{
                name: 'number',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'location',
                name: 'location'
            },
            {
                data: 'ip',
                name: 'ip'
            },
            {
                data: 'port',
                name: 'port'
            },
            {
                data: null,
                name: 'action',
                render : function(data, type, row,meta) {
                    // delete button
                    var deleteButton = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteCamera(' + row.id + ')">Delete</button>';
                    // edit button
                    var editButton = '<button type="button" class="btn btn-warning btn-sm" onclick="editCamera(' + row.id + ')">Edit</button>';

                    return editButton + ' ' + deleteButton;
                }
            },
        ]

        $(document).ready(function() {
            $("#table").DataTable({
                "processing": true,

                // "serverSide": true,
                "ajax": {
                    url: "{{ route('api.camera.show') }}",
                    type: 'GET',
                    headers: {
                        Authorization: "Bearer {{ env('ACCESS_TOKEN') }}",
                    },
                },
                "columns": columns,
            });
        });
    </script>



    <script src="https://cdn.datatables.net/v/ju/dt-1.13.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
