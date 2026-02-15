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
                        <form action="{{ route('customer.add') }}" method="post" id="formAdd">
                            @csrf

                            <div class="mb-3 ">
                                <label for="name" class="form-label">Nama <span class="text-danger">*</span> </label>
                                <span><i id="load" style="display:none;"
                                        class="bx bx-refresh-cw-alt bx-spin"></i></span>
                                <input type="text" name="name" id="name" onkeypress="checkName(this)"
                                    class="form-control" required>
                                <p style="display: none;margin-left:20px;margin-top:5px;" id="resultName" class="text-danger">nama sudah
                                    ada</p>
                            </div>
                            <div class="mb-3">
                                <label for="size" class="form-label">Ukuran</label>
                                <select name="size" id="size" class="form-select">
                                    <option value="" selected disabled>-- Pilih Ukuran ---</option>
                                    @foreach ($price as $item)
                                        <option value="{{ $item->id }}" data-price="{{ $item->price_sale  }}" >{{ $item->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="color" class="form-label">Warna</label>
                                <select name="color" id="color" class="form-select">
                                    <option value="" selected disabled>-- Pilih Warna ---</option>
                                    @foreach ($color as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Jenis</label>
                                <select name="category" id="category" class="form-select">
                                    <option value="" selected disabled>-- Pilih Jenis ---</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}" data-price="{{ $item->nominal }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($sess != null)
                                <div class="mb-3">
                                    <label for="session" class="form-label">Sesi</label>
                                    <select name="session" id="session" class="form-select">
                                        <option value="" selected disabled>-- Pilih Jenis ---</option>
                                        @foreach ($sess as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                            <button type="submit" disabled="true" class="btn btn-primary" id="btn-save">Simpan</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')

    <script>
        function checkName(obj) {
            let val = $(obj).val();

            $.ajax({
                url: "{{ route('customer.getName') }}",
                type: 'get',
                data: {
                    name: val
                },
                beforeSend: function() {
                    $('#load').show()
                },
                success: function(res) {

                    let data = res.name;
                    $('#resultName').show('');
                    if (data.length > 0) {
                        $('#resultName').removeClass('text-success');
                        $('#resultName').addClass('text-danger');
                        $('#resultName').text('Nama Sudah ada');
                        $('#btn-save').attr('disabled', true)
                    } else {

                        $('#resultName').removeClass('text-danger');
                        $('#resultName').addClass('text-success');
                        $('#resultName').text('Nama Belum Terdaftar');
                        $('#btn-save').attr('disabled', false)
                    }
                },
                error: function(res) {
                   Notiflix.Notify.failure('Terjadi Kesalahan')
                },
                complete:function(){
                    $('#load').hide()
                }
            })
        }
    </script>
@endsection
@endsection
