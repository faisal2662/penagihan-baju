@extends('layouts.main')

@section('container')
    @include('sweetalert::alert')

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="section">
        <div class="row justify-content-center">
            <div class="col col-lg-8 col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div style="float: right; margin-top:30px;">
                            <a href="customer" class="btn btn-secondary">Kembali</a>
                        </div>
                        <div class="card-title">Tambah Data</div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="add-customer" method="post">
                            @csrf

                            <div class="mb-3 ">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="size" class="form-label">Ukuran</label>
                                <select name="size" id="size" class="form-select">
                                    <option value="" selected disabled>-- Pilih Ukuran ---</option>
                                    @foreach ($price as $item)
                                        <option value="{{ $item->slug }}">{{ $item->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="color" class="form-label">Warna</label>
                                <select name="color" id="color" class="form-select">
                                    <option value="" selected disabled>-- Pilih Warna ---</option>
                                    @foreach ($color as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Jenis</label>
                                <select name="category" id="category" class="form-select">
                                    <option value="" selected disabled>-- Pilih Jenis ---</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($sess != null)
                                <div class="mb-3">
                                    <label for="session" class="form-label">Sesi</label>
                                    <select name="session" id="session" class="form-select">
                                        <option value="" selected disabled>-- Pilih Jenis ---</option>
                                        @foreach ($sess as $item)
                                            <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="Belum Lunas" selected>Belum</option>
                                    <option value="Lunas">Lunas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Total" class="form-label">Total</label>
                                <input type="text" id="totalTemp" class="form-control" readonly>
                                <input type="hidden" name="total" id="total" class="form-control" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const size = document.getElementById('size');
        const totalTemp = document.getElementById('totalTemp');
        const total = document.getElementById('total');
        const category = document.getElementById('category')
        // @foreach ($price as $item)
        //     console.log({{ $item->id }})
        // @endforeach
        // const hsl = JSON.parse('{{ json_encode($price) }}');
        const array = {!! json_encode($price) !!};

        size.addEventListener('change', function(e) {
            const size = e.target.value;
            const hs = array.find((e) => e.slug == size)
            totalTemp.value = rupiah(hs.price_sale)
            total.value = hs.price_sale
        });

        category.addEventListener('change', function(e) {
            const category = e.target.value;
            if (category === 'panjang') {
                totalTemp.value = convers(totalTemp.value)
                tot = parseInt(totalTemp.value)
                totalTemp.value = rupiah(tot += 5000);
                total.value = tot
                console.log(tot)
            } else {

                const hs = array.find((e) => e.slug == size.value)
                totalTemp.value = rupiah(hs.price_sale)
                total.value = hs.price_sale
            }

        })

        function convers(r) {
            $num = Number(r.replace(/[^0-9.-]+/g, ""));
            return $num + "000";
        }
        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }
    </script>
@endsection
