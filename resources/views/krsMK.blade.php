@extends('themes.template')

@section('konten')
<?php $submitted = false?>
@foreach ($krs as $it)
    @if ($it->id_user == Auth::user()->id)
    <?php 
        $submitted = true;
        $status = $it->status;
    ?>
    @endif
@endforeach
@if (!$submitted)
<form action="{{url('submitkrs')}}" method="POST">
    @csrf
    <div class="container-fluid py-4">
      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card ">
            <select name="" id="" class="form-control text-center">
              <option value="" disabled selected> -- Pilih Jurusan yang Diinginkan -- </option>
              @foreach ($jurusan as $item)
                  <option value="{{$item->id_lj}}">{{$item->nama_jurusan}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
        <div class="row mt-4" >
            
            <div class="col-lg-7 mb-lg-0 mb-4">
              <div class="card ">
                <select name="" id="" class="form-control text-center">
                    <option value="" disabled selected> -- Pilih Jurusan yang Diinginkan -- </option>
                    @foreach ($jurusan as $item)
                        <option value="{{$item->id_lj}}">{{$item->nama_jurusan}}</option>
                    @endforeach
                </select>
                <div class="card-header pb-0 p-3">
                  <div class="d-flex justify-content-between">
                    <h6 class="mb-2">List Mata Kuliah</h6>
                  </div>
                </div>
                <div class="table-responsive p-3">
                  <table id="listMK" class="table table-hover" style="display: none">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    <tbody>
                        @if(!count($data))
                        <tr>
                            <td colspan="5" class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">Data masih kosong</span>
                            </td>
                        </tr>
                        @else
                        @foreach($data as $d)
                        <?php $rekom = ": "?>
                            @foreach ($dataset as $sat)
                                @if ($d->id_mk == $sat->id_mk)
                                    <?php $cluster = $sat->cluster?>
                                    @foreach ($dataset as $set)
                                        @if (($set->cluster == $cluster) && ($d->id_mk != $set->id_mk))
                                            @foreach ($data as $dd)
                                                @if ($set->id_mk == $dd->id_mk)
                                                    <?php $rekom = $rekom . $dd->matkul . ', '?>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        <tr for="">
                            <td class="w-30">
                                <div class="d-flex px-2 py-1 align-items-center">
                                <div>
                                    <input type="checkbox" class="checkmk" name="mk[]" value="{{$d->id_mk}}" 
                                    matkul="{{$d->matkul}}" jurusan="{{$d->nama_jurusan}}"
                                    prodi="{{$d->prodi}}" sks="{{$d->sks}}" rekom="{{$rekom}}">
                                </div>
                                  <div class="ms-4">
                                    <p class="text-xs font-weight-bold mb-0">Prodi:</p>
                                    <h6 class="text-sm mb-0">{{$d->prodi}}</h6>
                                  </div>
                                </div>
                            </td>
                            <td class="w-30">
                                <div class="d-flex px-2 py-1 align-items-center">
                                  <div class="ms-4">
                                    <p class="text-xs font-weight-bold mb-0">Matkul:</p>
                                    <h6 class="text-sm mb-0">{{$d->matkul}}</h6>
                                  </div>
                                </div>
                            </td>
                            <td class="w-30">
                                <div class="d-flex px-2 py-1 align-items-center">
                                  <div class="ms-4">
                                    <p class="text-xs font-weight-bold mb-0">SKS:</p>
                                    <h6 class="text-sm mb-0">{{$d->sks}}</h6>
                                  </div>
                                </div>
                            </td>
                            <td class="w-30">
                                <div class="d-flex px-2 py-1 align-items-center">
                                  <div class="ms-4">
                                    <p class="text-xs font-weight-bold mb-0">Kuota:</p>
                                    <h6 class="text-sm mb-0">{{$d->kuota}}</h6>
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
            <div class="col-lg-5">
              <div class="card">
                <div class="card-header pb-0 p-3 d-flex">
                  <h6 class="mb-0">Selected: Matkul</h6>
                  <input type="submit" name="submit" id="submitButton" class="btn btn-sm btn-primary ms-auto justify-content-end me-5" style="display: none" value="Submit">
                </div>
                <div class="card-body p-3">
                  <ul class="list-group" id="selectedMK">
                  </ul>
                </div>
              </div>
            </div>
        </div>
    </div>
</form>
@else
@else
  @if ($status == 'PENDING')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Submitted KRS</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <h2>WAITING FOR APRROVAL</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Submitted KRS</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-3">
                <table id="resultKRS" userkrs="{{Auth::user()->username}}" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Program Studi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SKS</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($krs as $show)
                          @if ($show->id_user == Auth::user()->id)
                              @foreach (unserialize($show->matkul) as $mk)
                                  @foreach ($data as $daa)
                                      @if ($daa->id_mk == $mk)
                                          <tr>
                                              <td>
                                              <div class="d-flex px-2 py-1">
                                                  <div class="d-flex flex-column justify-content-center">
                                                      <h6 class="mb-0 text-sm">{{$daa->matkul}}</h6>
                                                  </div>
                                              </div>
                                              </td>
                                              <td>
                                                  <p class="text-xs font-weight-bold mb-0">{{$daa->prodi}}</p>
                                              </td>
                                              <td>
                                                  <p class="text-xs font-weight-bold mb-0">{{$daa->nama_jurusan}}</p>
                                              </td>
                                              <td>
                                                  <p class="text-xs font-weight-bold mb-0">{{$daa->sks}}</p>
                                              </td>
                                          </tr>
                                      @endif
                                  @endforeach
                              @endforeach
                          @endif
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
@endif
@endif
@endsection
@section('css')
    

    <script type="text/javascript">
        var check = 0;
        $(document).ready(function() {
            $('input[type=checkbox][class=checkmk]').change(function() {
                if ($(this).is(':checked')) {
                    var li = '<li id="list'+$(this).val()+'" class="list-group-item border-0 d-flex selectedMK justify-content-between ps-0 mb-2 border-radius-lg">'+
                                '<div class="d-flex align-items-center">'+
                                    '<div class="icon col-1 icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">'+
                                    '<i class="ni ni-mobile-button text-white opacity-10"></i>'+
                                    '</div>'+
                                    '<div class="d-flex flex-column">'+
                                    '<h6 class="mb-1 text-dark text-sm">'+$(this).attr("matkul")+'</h6>'+
                                    '<span class="text-xs">'+$(this).attr("jurusan")+' ('+$(this).attr("prodi")+'), <span class="font-weight-bold">'+$(this).attr("sks")+' SKS</span></span>'+
                                    '<span class="text-xs">Rekomendasi :  <span class="font-weight-bold">'+$(this).attr("rekom")+'</span></span>'+
                                    '</div>'+
                                '</div>'+
                            '</li>';
                    $('#selectedMK').append(li);
                    check += 1;
                    if (check != 0) {
                        $('#submitButton').show();
                    }
                }
                else {
                    $('#list'+$(this).val()).remove();
                    check -= 1;
                    if (check == 0) {
                        $('#submitButton').hide();
                    }
                }
            });
        });
        $(document).ready(function () {
            $('#listMK').DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false, "pageLength":5,
            }).buttons().container().appendTo('#listMK_wrapper .col-md-6:eq(0)');

            $('#resultKRS').DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false, "searching":false, "info" : false,
              "buttons": [{
                    extend: "pdf",
                    messageTop: "Nama : "+$('#resultKRS').attr('userkrs'),
                }]
            }).buttons().container().appendTo('#resultKRS_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
@section('js')
@endsection