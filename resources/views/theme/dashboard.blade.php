@extends('theme.components.main')

@section('title', 'Dashboard')
@section('content')

    <div class="page-wrapper">
        <div class="page-content">


            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">Dashboard</h4>
                    <hr>

                    <div class="row gy-3">

                        <div class="accessToken"></div>


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


@endsection

@push('js')
    {{-- clipboard --}}
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
    {{-- axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{-- get data from api with axios and bearer token --}}

    <script>
        let html = document.querySelector('.accessToken');
        axios.get('/user/token')
            .then(response => {

                var i=0;
                response.data.data.forEach(element => {
                    html.innerHTML += `<label for="personalaccess">Personal Access Token</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="${element.token}"
                                id="foo${i}" readonly >
                            <span class="input-group-text">
                                <button class="btn copy" data-clipboard-target="#foo${i}">
                                    <i class="fadeIn animated bx bx-copy"></i>
                                </button>
                            </span>
                        </div>`;
                    i++;
                })

            });













        var clipboard = new ClipboardJS('.copy');

        clipboard.on('success', function(e) {
            e.clearSelection();
        });

        clipboard.on('error', function(e) {});
    </script>
@endpush
