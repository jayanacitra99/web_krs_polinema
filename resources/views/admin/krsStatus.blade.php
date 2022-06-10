@extends('themes.template')

@section('konten')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">

                    <div class="d-flex">
                        <h6>List KRS</h6>
                    </div>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-secondary opacity-7">Nama</th>
                                    <th class="text-secondary opacity-7 text-center">Mata Kuliah</th>
                                    <th class="text-secondary opacity-7 text-center">Status</th>
                                    <th class="text-secondary opacity-7 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($krs as $item)
                                    <tr>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                              <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Username:</p>
                                                <h6 class="text-sm mb-0">{{$item->username}}</h6>
                                              </div>
                                            </div>
                                        </td>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                              <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Mata Kuliah:</p>
                                                <h6 class="text-sm mb-0">
                                                @foreach (unserialize($item->matkul) as $mk)
                                                    @foreach ($matkul as $allMK)
                                                        @if ($allMK->id_mk == $mk)
                                                            {{$allMK->matkul}},
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                </h6>
                                              </div>
                                            </div>
                                        </td>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                              <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Status:</p>
                                                <h6 class="text-sm mb-0">{{$item->status}}</h6>
                                              </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center ">
                                            @if ($item->status == 'APPROVED')
                                            <button disabled="disabled" class="btn btn-default">
                                                APPROVED
                                            </button>
                                            @elseif ($item->status == 'WAITING')
                                            <button type="button" krsURL="{{url('actionKRS/'.$item->id_krs.'/APPROVED')}}" class="btn btn-info btnAction">{{$item->id_krs}}Approve</button>
                                            <button type="button" krsURL="{{url('actionKRS/'.$item->id_krs.'/REJECTED')}}" class="btn btn-danger btnAction">Reject</button>
                                            @else
                                            <button disabled="disabled" class="btn btn-default">
                                                REJECTED
                                            </button>
                                            @endif
                                        </td> 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('css')
<script>
    $(document).ready(function(){
      $(".btnAction").click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Do it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var krsURL = $(this).attr('krsURL');
            window.location.replace(krsURL);
          }
        })
      });
    });
</script>
@endsection