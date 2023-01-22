@extends('layouts.app')
@section('title', 'Antrian')


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
                        <h3 class="h3">Antrian</h3>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- <div class="addData"> --}}
                <a href="javascript:void(0)" class="btn btn-success btnAdd mb-3">
                    <strong class="text-white">{{-- <i class="fe fe-plus fe-16"></i> --}} Tambah Antrian</strong>
                </a>
                {{-- </div> --}}

                <div class="table-responsive">
                    <table id="table-data" class="table table-stripped card-table table-vcenter text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="35%">Pengguna</th>
                                <th width="35%">Prioritas</th>
                                <th width="35%">Antrian</th>
                                <th width="15%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($Queues) == 0)
                            <tr>
                                <td colspan="5" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($Queues as $Queue)
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td width="35%">
                                    @foreach($Users as $User)
                                    @if ($User->id == $Queue->user_id)
                                    {{ $User->name }}
                                    @endif
                                    @endforeach
                                </td>
                                <td width="35%">{{ $Queue->priority_number }}</td>
                                <td width="35%">{{ $Queue->queue_number }}</td>
                                <td width="15%">
                                    @if($Queue->queue_status == 2)
                                        <span class="btn btn-success text-white">Sudah dilayani</span>
                                    @elseif($Queue->queue_status == 1)
                                        <span class="btn btn-warning text-white">Sedang dilayani</span>
                                    @elseif($Queue->queue_status == 0)
                                        <span class="btn btn-danger text-white">Belum dilayani</span>
                                    @endif
                                </td>
                                <td width="15%">
                                    @if($Queue->id	 > 0)
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-warning text-white"
                                        data-id="{{ $Queue->id	 }}" data-toggle="tooltip"
                                        data-placement="top" title="Ubah">Ubah
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-danger btnDelete text-white"
                                        data-url="{{ url('queue/delete/'. $Queue->id	) }}"
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
                <h5 class="modal-title">Tambah Antrian</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('queue/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Pengguna </label>
                                    <select class="form-control" name="user_id" id="user_id">
                                        <option value="">- Pilih Pengguna -</option>
                                        @if(sizeof($Users) > 0)
                                        @foreach($Users as $User)
                                        <option value="{{ $User->id }}">
                                            {{ $User->name }} - {{ $User->email }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="col-md-12">
                            <div class="form-group">
                                    <label class="form-label">Pilih Pengguna</label>
                                    <input type="text" class="form-control" name="user_id"
                                        id="user_id" placeholder="Masukan Pilih Pengguna"
                                        value="{{ old('user_id') }}">

                                </div>
                            </div> --}}

                            <div class="col-md-12">
                                <div class="form-group">
                                        <label class="form-label">Prioritas</label>
                                        <input type="text" class="form-control" name="priority_number"
                                            id="priority_number" placeholder="Masukan Prioritas Antrian"
                                            value="{{ old('priority_number') }}">

                                    </div>
                                </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                        <label class="form-label">Posisi Antrian</label>
                                        <input type="text" class="form-control" name="queue_number"
                                            id="queue_number" placeholder="Masukan Posisi Antrian"
                                            value="{{ old('queue_number') }}">

                                    </div>
                                </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Pilih Status </label>
                                    <select class="form-control" name="queue_status" id="queue_status">
                                        <option value="">- Pilih Status -</option>
                                        <option value="2">Sudah dilayani</option>
                                        <option value="1">Sedang dilayani</option>
                                        <option value="0">Belum dilayani</option>
                                    </select>
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
        $('.addModal form').attr('action', "{{ url('queue/store') }}");
        $('.addModal .modal-title').text('Tambah Antrian');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('queue/getdata') }}";

        $('.addModal form').attr('action', "{{ url('queue/update') }}" + '/' + id);

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                console.log(data);

                if (data.status == 1) {
                    $('#access_token_device_id').val(data.result.access_token_device_id);
                    $('#user_id').val(data.result.user_id);
                    $('#queue_number').val(data.result.queue_number);
                    $('#priority_number').val(data.result.priority_number);
                    $('#queue_status').val(data.result.queue_status);
                    $('.addModal .modal-title').text('Ubah Antrian');
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
            user_id: "Antrian tidak boleh kosong",
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
