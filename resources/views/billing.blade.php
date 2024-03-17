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
                        <form action="/transaction" method="post">
                            @csrf
                            <input type="hidden" name="slug" id="slug">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                {{-- <input type="text" required id="name" class="form-control" autocomplete="off"
                                    autofocus name="name">
                                <ul data-bs-spy="scroll" data-bs-smooth-scroll="true" class="list-group" id="tbodyfordata"
                                    style="position:absolute;width:270px;z-index:1;max-height:50px;">

                                </ul> --}}
                                <select class="name form-control" onchange="cari()" name="name">
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
                                <button class="btn btn-success">Simpan</button>
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

    <script>
        const name = document.querySelector('.name');
        // const temp = document.getElementById('temporary');
        const remain = document.getElementById('remaining');
        const slug = document.getElementById('slug');

        // console.log(name.value)
        // name.addEventListener("change", (e) => {
        //     console.log('sa')
        // })

        function cari() {
            result = name.value;

            const url = "result?search=" + result;
            console.log(url)
            fetch(url)
                .then((resp) => resp.json())
                .then(function(data) {
                    // console.log(data)
                    remain.value = Rupiah(data.payment.remaining);
                    slug.value = data.slug
                })
            const Rupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }
        }
    </script>
    <script>
        // const name = document.getElementById('name');
        // const temp = document.getElementById('temporary');
        // const remain = document.getElementById('remaining');
        // const slug = document.getElementById('slug');

        // name.addEventListener('keyup', function(e) {
        //     // console.log(e.target.value)
        //     const valName = e.target.value;
        //     const url = "/search-name?search=" + valName;
        //     // console.log(url);
        //     fetch(url)
        //         .then((resp) => resp.json())
        //         .then(function(data) {
        //             // console.log(data)
        //             let tbodyref = document.getElementById('tbodyfordata');
        //             tbodyref.style.display = 'block'
        //             tbodyref.innerHTML = '';

        //             let results = data;
        //             if (results != null) {
        //                 results.map(function(result) {
        //                     let li = document.createElement('li');
        //                     li.innerText = result.name;
        //                     tbodyref.appendChild(li);
        //                     li.classList.add('list-group-item', 'result')

        //                 });
        //                 const resultes = document.querySelectorAll('.result');
        //                 resultes.forEach(resultas => {
        //                     resultas.addEventListener('click', function(e) {
        //                         // console.log(e.target.innerText)
        //                         const resultName = e.target.innerText;
        //                         const url = "/result?search=" + resultName;
        //                         name.value = resultName;
        //                         tbodyref.innerHTML = '';
        //                         tbodyref.style.display = 'none';
        //                         fetch(url)
        //                             .then((resp) => resp.json())
        //                             .then(function(data) {
        //                                 // console.log(data)
        //                                 slug.value = data.slug;
        //                                 if (data.payment != 0) {
        //                                     temp.value = Rupiah(data.payment.remaining);
        //                                 } else {
        //                                     temp.value = 0;
        //                                 }
        //                             })
        //                             .catch(function(error) {
        //                                 console.log(error);
        //                             })

        //                     })
        //                 });
        //             }

        //         })
        //         .catch(function(error) {
        //             console.log(error);
        //         });
        // });

        //  
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.name').select2();

        });
    </script>
@endsection
