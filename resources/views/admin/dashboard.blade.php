@extends('themes.template')

@section('konten')
<div class="container-fluid py-4">
    @if (Auth::user()->role == 1)
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                                    <h5 class="font-weight-bolder">
                                        List Jurusan
                                    </h5>
                                    <p class="mb-0">
                                        <a href="{{route('jurusan')}}">
                                            <span class="text-success text-sm font-weight-bolder">Check Details</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h5 class="font-weight-bolder">
                                        List Prodi
                                    </h5>
                                    <p class="mb-0">
                                        <a href="{{route('prodi')}}">
                                            <span class="text-success text-sm font-weight-bolder">Check Details</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h5 class="font-weight-bolder">
                                        List MatKul
                                    </h5>
                                    <p class="mb-0">
                                        <a href="{{route('matkul')}}">
                                            <span class="text-success text-sm font-weight-bolder">Check Details</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h5 class="font-weight-bolder">
                                        Dataset
                                    </h5>
                                    <p class="mb-0">
                                        <a href="" data-toggle="modal" data-target="#modal-dataset">
                                            <span class="text-success text-sm font-weight-bolder">Upload New Dataset</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h3 class="card-title">Approved KRS</h3>
                    </div>
                
                    <div class="card-body">
                        <?php $totalJurusan = 0?>
                        @foreach ($jurusan as $item)
                            <?php $jumlah = 0?>
                            @foreach ($krsapp as $kapp)
                                @if ($kapp->jurusan == $item->id_lj)
                                    <?php $jumlah += 1?>
                                @endif
                            @endforeach
                            <div id="approve{{$totalJurusan++}}" naJu="{{$item->nama_jurusan}}" appJu="{{$jumlah}}"></div>
                        @endforeach
                        <div id="dataAppr" totalJu="{{$totalJurusan}}"></div>
                        <canvas id="approvedChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h3 class="card-title" >Rejected KRS</h3>
                    </div>
                
                    <div class="card-body">
                        <?php $totalJurusan = 0?>
                        @foreach ($jurusan as $item)
                            <?php $jumlah = 0?>
                            @foreach ($krsrej as $krej)
                                @if ($krej->jurusan == $item->id_lj)
                                    <?php $jumlah += 1?>
                                @endif
                            @endforeach
                            <div id="reject{{$totalJurusan++}}" naJu="{{$item->nama_jurusan}}" appJu="{{$jumlah}}"></div>
                        @endforeach
                      <canvas id="rejectedChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
          </div>
    @else
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                                    <h5 class="font-weight-bolder">
                                        KRS
                                    </h5>
                                    <p class="mb-0">
                                        <a href="{{route('krs')}}">
                                            <span class="text-success text-sm font-weight-bolder">Check Details</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h5 class="font-weight-bolder">
                                        List MataKuliah
                                    </h5>
                                    <p class="mb-0">
                                        <a href="{{route('matkul')}}">
                                            <span class="text-success text-sm font-weight-bolder">Check Details</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="modal fade" id="modal-dataset">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{url('importDataset')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <select name="asal" id="" class="form-control form-control-lg">
                <option disabled selected>-- PILIH ASAL JURUSAN -- </option>
                @foreach ($jurusan as $item)
                    <option value="{{$item->id_lj}}">{{$item->nama_jurusan}}</option>
                @endforeach
            </select>
          </div>
            
        @error('asal')
          <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
          <script> window.addEventListener("load",clickNotif);</script>
        @enderror
        <div class="mb-3">
            <select name="tujuan" id="" class="form-control form-control-lg">
                <option disabled selected>-- PILIH TUJUAN JURUSAN -- </option>
                @foreach ($jurusan as $item)
                    <option value="{{$item->id_lj}}">{{$item->nama_jurusan}}</option>
                @endforeach
            </select>
        </div>
        @error('tujuan')
            <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
            <script> window.addEventListener("load",clickNotif);</script>
        @enderror
            <input type="file" name="file" class="form-control form-control-lg" id="file" accept=".csv,.xlsx">
        @error('file')
            <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
            <script> window.addEventListener("load",clickNotif);</script>
        @enderror
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="submit" class="btn btn-primary">Upload</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@section('js')
<script>
    // $(document).ready(function() {
    //     const jurusanArray = new Array();
    //     $.ajax({
    //         type: "GET",
    //         url: "getJurusan",       
    //         success: function (data) {
    //             jQuery.each( data, function( i, val ) {
    //                 jurusanArray.push(val.nama_jurusan);
    //             });
    //             alert(jurusanArray);
    //         }
    //     });
    // });
</script>
<script>
    $(function () {
        var totalJu = $('#dataAppr').attr('totalJu');
        var jurusanArray = new Array();
        var dataApp = new Array();
        var colorData = new Array();
        for (let index = 0; index < totalJu; index++) {
            colorData.push("#"+Math.floor(Math.random()*16777215).toString(16));
            jurusanArray.push($('#approve'+index).attr('naJu'));
            dataApp.push(parseInt($('#approve'+index).attr('appJu')));
        }
        var dataRej = new Array();
        for (let index = 0; index < totalJu; index++) {
            dataRej.push(parseInt($('#reject'+index).attr('appJu')));
        }

        var appData        = {
            labels: jurusanArray,
            datasets: [
                {
                data: dataApp,
                backgroundColor : colorData,
                }
            ]
        }
        var rejData        = {
            labels: jurusanArray,
            datasets: [
                {
                data: dataRej,
                backgroundColor : colorData,
                }
            ]
        }
      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var appPieChartCanvas = $('#approvedChart').get(0).getContext('2d')
      var appPieData        = appData;
      var appPieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(appPieChartCanvas, {
        type: 'pie',
        data: appPieData,
        options: appPieOptions
      })

      var rejPieChartCanvas = $('#rejectedChart').get(0).getContext('2d')
      var rejPieData        = rejData;
      var rejPieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(rejPieChartCanvas, {
        type: 'pie',
        data: rejPieData,
        options: rejPieOptions
      })
  
    })
  </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection