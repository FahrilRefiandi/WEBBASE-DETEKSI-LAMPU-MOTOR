@extends('theme.components.main')

@section('title', 'Stream')
@section('content')

    <div class="page-wrapper">
        <div class="page-content">


            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">Stream</h4>
                    <hr>

                    <div class="row gy-3">


                        {{-- <img style="display: block;-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 25%);"
                            src="http://localhost:4000/"> --}}

                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            {{-- conten --}}
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">JL TERUSAN SULFAT</h5>

                                        {{-- img --}}
                                        <img class="img-fluid" src="http://localhost:5000/">
                                        {{-- img --}}

                                    </div>
                                </div>
                            </div>
                            {{-- conten --}}


                        </div>




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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var videoPlayer = document.getElementById('videoPlayer');
            var videoUrl = 'http://127.0.0.1:5000'; // Ganti dengan URL video yang sesuai

            videoPlayer.src = videoUrl;
        });
    </script> --}}
@endpush
