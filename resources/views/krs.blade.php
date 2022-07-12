@extends('themes.template')

@section('konten')
<?php $submitted = false; $status = "";?>
@foreach ($krs as $it)
    @if ($it->id_user == Auth::user()->id)
    <?php 
        $submitted = true;
        $status = $it->status;
    ?>
    @endif
@endforeach
@if ((!$submitted) || ($status == 'REJECTED'))
  @if ($status == 'REJECTED')
  <div class="alert alert-danger" id="notif" swalType="error" swalTitle="KRS REJECTED! Try Again." style="display: none">{{session('notif')}}</div>
  <script> window.addEventListener("load",clickNotif);</script>
  @endif
<form action="{{url('submitkrs')}}" method="POST">
    @csrf
    <div class="container-fluid py-4">
        <div class="row mt-4" >
            <div class="col-lg-7 mb-lg-0 mb-4">
              <div class="card ">
                <div class="d-flex justify-content-center">
                  <span class="mt-2 w-2 no-border"><i class="fas fa-chevron-circle-down"></i></span>
                  <select name="" id="selectJurusan" class="form-control text-center w-60">
                    <option value="" disabled selected> -- Pilih Jurusan yang Diinginkan --  </option>
                    @foreach ($jurusan as $item)
                      <option value="{{$item->id_lj}}">{{$item->nama_jurusan}}</option>
                    @endforeach
                  </select>
                  <span class="mt-2 w-2 no-border"><i class="fas fa-chevron-circle-down"></i></span>
                </div>    
                <div class="card-header pb-0 p-3">
                  <h6 class="mb-2">List Mata Kuliah</h6>
                  <div class="d-flex justify-content-between">
                    <p class="font-weight-light">Sangat Direkomendasikan</p>
                    <div class="btn btn-sm btn-success">3</div>
                    <div class="btn btn-sm btn-info">2</div>
                    <div class="btn btn-sm btn-warning">1</div>
                    <p class="font-weight-light">Kurang Direkomendasikan</p>
                  </div>
                </div>
                <div class="table-responsive p-3 max-height-vh-50">
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
                        
                        @foreach ($dataset as $item)
                        @if ($item->cluster == 3)
                          <?php $cluster="btn-success"?>
                        @elseif ($item->cluster == 2)
                          <?php $cluster="btn-info"?>
                        @else
                          <?php $cluster="btn-warning"?>
                        @endif
                            @if (($item->jurusanAsal == auth()->user()->jurusan) && ($item->id_prodi != auth()->user()->prodi))
                                <tr for="" class="jurusan{{$item->jurusanTujuan}} allMK {{$cluster}}" >
                                  <td class="w-30">
                                      <div class="d-flex px-2 py-1 align-items-center">
                                      <div>
                                          <input type="checkbox" class="checkmk" name="mk[]" value="{{$item->id_mk}}" 
                                          matkul="{{$item->matkul}}" jurusan="{{$item->nama_jurusan}}"
                                          prodi="{{$item->prodi}}" sks="{{$item->sks}}">
                                      </div>
                                        <div class="ms-4">
                                          <p class="text-xs font-weight-bold mb-0">Prodi:</p>
                                          <h6 class="text-sm mb-0">{{$item->prodi}}</h6>
                                        </div>
                                      </div>
                                  </td>
                                  <td class="w-30">
                                      <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                          <p class="text-xs font-weight-bold mb-0">Matkul:</p>
                                          <h6 class="text-sm mb-0">{{$item->matkul}}</h6>
                                        </div>
                                      </div>
                                  </td>
                                  <td class="w-30">
                                      <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                          <p class="text-xs font-weight-bold mb-0">SKS:</p>
                                          <h6 class="text-sm mb-0">{{$item->sks}}</h6>
                                        </div>
                                      </div>
                                  </td>
                                  <td class="w-30">
                                      <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                          <p class="text-xs font-weight-bold mb-0">Kuota:</p>
                                          <h6 class="text-sm mb-0">{{$item->kuota}}</h6>
                                        </div>
                                      </div>
                                  </td>
                                </tr>
                            @endif
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
  @if ($status == 'WAITING')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Submitted KRS</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2 text-md-center">
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
                @foreach ($jurusan as $item)
                      @if ($item->id_lj != auth()->user()->jurusan)
                        <?php $jurus = $item->nama_jurusan?>
                      @endif
                @endforeach
                <table id="resultKRS" userkrs="{{Auth::user()->nama}}" jurusankrs="{{$jurus}}" nimkrs="{{Auth::user()->nim}}" class="table align-items-center mb-0">
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
                                  @foreach ($matkul as $daa)
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
          $('#selectJurusan').on('change', function() {
            $("#listMK").css("display", "block");
            $('.selectedMK').remove();
            $('#submitButton').hide();
            $('.checkmk').prop('checked',false);
            $('.allMK').hide();
            var jurusan = $('#selectJurusan').val();
            $('.jurusan'+jurusan).show();
          });
        });

        $(document).ready(function () {
            $('#listMK').DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false, "pageLength":5, "paging":false,"info" : false,
            }).buttons().container().appendTo('#listMK_wrapper .col-md-6:eq(0)');

            $('#resultKRS').DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false, "searching":false, "info" : false,
              "buttons": [{
                    extend: "pdf",
                    messageTop: "NIM : "+$('#resultKRS').attr('nimkrs')+"\n Nama : "+$('#resultKRS').attr('userkrs')+"\n Jurusan : "+$('#resultKRS').attr('jurusankrs'),
                }]
            }).buttons().container().appendTo('#resultKRS_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
@section('js')
@endsection