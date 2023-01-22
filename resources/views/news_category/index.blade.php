@extends('layouts.app')
@section('title', 'Kategori Berita')


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
                        <h3 class="h3">Kategori Berita</h3>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- <div class="addData"> --}}
                <a href="javascript:void(0)" class="btn btn-success btnAdd mb-3">
                    <strong class="text-white">{{-- <i class="fe fe-plus fe-16"></i> --}} Tambah Kategori Berita</strong>
                </a>
                {{-- </div> --}}

                <div class="table-responsive">
                    <table id="table-data" class="table table-stripped card-table table-vcenter text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="35%">Nama Kategori</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($NewsCategories) == 0)
                            <tr>
                                <td colspan="3" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($NewsCategories as $NewsCategory)
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td width="35%">{{ $NewsCategory->news_category_name }}</td>
                                <td width="15%">
                                    @if($NewsCategory->id	 > 0)
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-warning text-white"
                                        data-id="{{ $NewsCategory->id	 }}" data-toggle="tooltip"
                                        data-placement="top" title="Ubah">Ubah
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-danger btnDelete text-white"
                                        data-url="{{ url('news-category/delete/'. $NewsCategory->id	) }}"
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
                <h5 class="modal-title">Tambah Kategori Berita</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('news-category/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                        <label class="form-label">Nama Kategori Berita</label>
                                        <input type="text" class="form-control" name="news_category_name"
                                            id="news_category_name" placeholder="Masukan Nama Kategori Berita"
                                            value="{{ old('news_category_name') }}">

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
        $('.addModal form').attr('action', "{{ url('news-category/store') }}");
        $('.addModal .modal-title').text('Tambah Kategori Berita');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('news-category/getdata') }}";

        $('.addModal form').attr('action', "{{ url('news-category/update') }}" + '/' + id);

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                console.log(data);

                if (data.status == 1) {
                    $('#news_category_name').val(data.result.news_category_name);
                    $('.addModal .modal-title').text('Ubah Kategori Berita');
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
            user_id: "Kategori Berita tidak boleh kosong",
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
