@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
      <h1 class="card-title">Halo, {{ Auth::user()->name }}</h1>

    </div>
  </div>

  <div class="row my-3">
    <div class="col-md-3">
      <div class="card shadow mb-3">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col">
              <small class="text-muted mb-1">Jumlah Pengguna</small>
              <h3 class="card-title mb-0">{{count($Users)}}</h3>

            </div>

          </div> <!-- /. row -->
        </div> <!-- /. card-body -->
      </div> <!-- /. card -->
    </div> <!-- /. col -->
    <div class="col-md-3">
      <div class="card shadow mb-3">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col">
              <small class="text-muted mb-1">Jumlah Antrian</small>
              <h3 class="card-title mb-0">{{count($Queues)}}</h3>

            </div>
          </div> <!-- /. row -->
        </div> <!-- /. card-body -->
      </div> <!-- /. card -->
    </div> <!-- /. col -->
    <div class="col-md-3">
      <div class="card shadow mb-3">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col">
              <small class="text-muted mb-1">Sisa Antrian</small>
              <h3 class="card-title mb-0">{{count($startQueues)}}</h3>

            </div>
          </div> <!-- /. row -->
        </div> <!-- /. card-body -->
      </div> <!-- /. card -->
    </div> <!-- /. col -->


  <div class="col-md-3">
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col">
            <small class="text-muted mb-1">Antrian Selesai</small>
            <h3 class="card-title mb-0">{{count($finishQueues)}}</h3>

          </div>
        </div> <!-- /. row -->
      </div> <!-- /. card-body -->
    </div> <!-- /. card -->
  </div> <!-- /. col -->
</div>

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

                <div class="table-responsive">
                    <table id="table-data" class="table table-stripped card-table table-vcenter text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="35%">Pengguna</th>
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
                                <td width="35%">{{ $Queue->queue_number }}</td>
                                <td width="15%">
                                    @if($Queue->queue_status == 1)
                                        <span class="btn btn-success text-white">Sudah dilayani</span>
                                    @elseif($Queue->queue_status == 0)
                                        <span class="btn btn-danger text-white">Belum dilayani</span>
                                    @endif
                                </td>
                                <td width="15%">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user{{$User->id}}">
                                        Panggil
                                      </button>

                                      <div class="modal fade" id="user{{$User->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="staticBackdropLabel">
                                                @foreach($Users as $User)
                                                @if ($User->id == $Queue->user_id)
                                                {{ $User->name }}
                                                @endif
                                                @endforeach
                                              </h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              ...
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                              <button type="button" class="btn btn-outline-success">Panggil</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
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
@endsection
