@extends('layouts.main')

@section('container')
    @include('sweetalert::alert')

    <style>
        .result {
            cursor: pointer;
        }

        .result:hover {
            background: #d3d3d3;
        }
    </style>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Penagihan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-7">
                <div class="card rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">Penagihan</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="form-taking">
                            @csrf
                            <input type="hidden" name="slug" id="slug">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                {{-- <input type="text" required id="name" class="form-control" autocomplete="off"
                                    autofocus name="name">
                                <ul data-bs-spy="scroll" data-bs-smooth-scroll="true" class="list-group" id="tbodyfordata"
                                    style="position:absolute;width:270px;z-index:1;max-height:50px;">

                                </ul> --}}
                                <select class="name form-control" name="name">
                                    <option selected disabled>Cari Nama</option>
                                    @foreach ($cust as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cash" class="form-lable">Bayar</label>
                                <input type="number" required name="cash" id="cash" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success" id="simpan">Simpan</button>
                            </div>
                            <div class="mb-3">
                                <label for="temporary" class="form-label">Sisa Bayar</label>
                                <input type="text" name="remaining" id="remaining" disabled class="form-control">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.name').select2();

        });
    </script>
    <script>
        $("#form-taking").on("submit", function(e) {
            e.preventDefault();
            console.log($(this).serialize());

            $.ajax({
                data: $('#form-taking').serialize(),
                url: "{{ route('take') }}",
                type: "POST",
                datatype: 'json',
                success: function(data) {
                    console.log(data);
                },
                error: function(data) {
                    console.log('error :', data)
                }
            })
        });
    </script>
@endsection
