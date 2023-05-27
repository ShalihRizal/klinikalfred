@extends('layouts.app')
@section('title', 'Dokter')


@section('content')
<!-- Container fluid  -->
<!-- ============================================================== -->
<!-- <div class="container-fluid"> -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- basic table -->
@if (session('successMessage'))

@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header w-100">
                @if (session('message'))

                <strong id="msgId" hidden>{{ session('message') }}</strong>


                @endif
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="h3">Dokter</h3>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- <div class="addData"> --}}
                <a href="javascript:void(0)" class="btn btn-success btnAdd mb-3">
                    <strong class="text-white">{{-- <i class="fe fe-plus fe-16"></i> --}} Tambah Dokter</strong>
                </a>
                {{-- </div> --}}

                <div class="table-responsive">
                    <table id="table-data" class="table table-stripped card-table table-vcenter text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="35%">Nama</th>
                                <th width="35%">Gambar</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($Doctor) == 0)
                            <tr>
                                <td colspan="5" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($Doctor as $Doctorv)
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td width="35%">{{ $Doctorv->doctor_name }}</td>
                                <td width="35%"><img src="{{$url}}app/public/{{ $Doctorv->doctor_image }}" width="200" alt=""></td>
                                <td width="15%">
                                    @if($Doctorv->id > 0)
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-warning text-white"
                                        data-id="{{ $Doctorv->id }}" data-toggle="tooltip"
                                        data-placement="top" title="Ubah">Ubah
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-danger btnDelete text-white"
                                        data-url="{{ url('doctor/delete/'. $Doctorv->id	) }}"
                                        data-toggle="tooltip" data-placement="top" title="Hapus">Hapus
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
<!-- </div> -->
<!-- ============================================================== -->
<!-- End Container fluid  -->

<!-- Modal Add -->
<div class="modal addModal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Dokter</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('doctor/store') }}" method="POST" id="addForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                        <label class="form-label">Nama Dokter</label>
                                        <input type="text" class="form-control" name="doctor_name"
                                            id="doctor_name" placeholder="Masukan Nama Dokter"
                                            value="{{ old('doctor_name') }}" required>

                                    </div>
                                </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                        <label class="form-label">Gambar Dokter</label>
                                        <input type="file" class="form-control" name="doctor_image"
                                            id="doctor_image" placeholder="Masukan Gambar Dokter"
                                            value="{{ old('doctor_image') }}">

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                            <label class="form-label">Spesialis Dokter</label>
                                            <input type="text" class="form-control" name="doctor_speciality"
                                                id="doctor_speciality" placeholder="Masukan Spesialis Dokter"
                                                value="{{ old('doctor_speciality') }}" required>

                                        </div>
                                    </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Add -->
@endsection

@section('script')
<script type="text/javascript">
    $('.btnAdd').click(function () {
        document.getElementById("addForm").reset();
        $('.addModal form').attr('action', "{{ url('doctor/store') }}");
        $('.addModal .modal-title').text('Tambah Doktor');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('doctor/getdata') }}";

        $('.addModal form').attr('action', "{{ url('doctor/update') }}" + '/' + id);

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                console.log(data);

                if (data.status == 1) {
                    $('#doctor_name').val(data.result.doctor_name);
                    // $('#doctor_image').val(data.result.doctor_image);
                    $('#doctor_speciality').val(data.result.doctor_speciality);
                    $('.addModal .modal-title').text('Ubah Dokter');
                    $('.addModal').modal('show');

                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert('Error : Gagal mengambil data');
            }
        });

    });

    $('.btnDelete').click(function () {
        $('.btnDelete').attr('disabled', true)
        var url = $(this).attr('data-url');
        Swal.fire({
            title: 'Apakah anda yakin ingin menghapus data?',
            text: "Kamu tidak akan bisa mengembalikan data ini setelah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya. Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (data) {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Terhapus!',
                                'Data Berhasil Dihapus.',
                                'success'
                            ).then(() => {
                                location.reload()
                            })
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        Swal.fire(
                            'Gagal!',
                            'Gagal menghapus data.',
                            'error'
                        );
                    }
                });
            }
        })
    });

    $("#addForm").validate({
        rules: {
            user_id: "required",
            queue_status: "required",
            queue_number: "required",
        },
        messages: {
            user_id: "Berita tidak boleh kosong",
            queue_status: "Pilih status",
            queue_number: "Data tidak boleh kosong",
        },
        errorElement: "em",
        errorClass: "invalid-feedback",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            $(element).parents('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        }
    });

    var notyf = new Notyf({
        duration: 5000,
        position: {
            x: 'right',
            y: 'top'
        }
    });
    var msg = $('#msgId').html()
    if (msg !== undefined) {
        notyf.success(msg)
    }

</script>
@endsection
