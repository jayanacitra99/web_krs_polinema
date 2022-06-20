@extends('themes.template')
@section('konten')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">

                    <div class="d-flex">
                        <h6>List Matakuliah</h6>
                        @if (Auth::user()->role != 3)
                        <a href="" class="btn btn-primary ms-auto justify-content-end me-5" data-bs-toggle="modal"
                            data-bs-target='#addJurusan'>Tambah</a>
                        @endif
                    </div>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-secondary opacity-7">Kode Matkul</th>
                                    <th class="text-center text-secondary opacity-7">Jurusan</th>
                                    <th class="text-center text-secondary opacity-7">Prodi</th>
                                    <th class="text-center text-secondary opacity-7">Matakuliah</th>
                                    <th class="text-center text-secondary opacity-7">SKS</th>
                                    <th class="text-center text-secondary opacity-7">Kuota</th>
                                    @if (Auth::user()->role != 3)
                                    <th class="text-secondary opacity-7 text-center">action</th>
                                    @endif
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
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->id_mk
                                            }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->nama_jurusan
                                            }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->prodi }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->matkul }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->sks }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->kuota }}</span>
                                    </td>
                                    @if (Auth::user()->role != 3)
                                    <td class="align-middle text-center ">
                                        <a href="#" class="text-secondary font-weight-bold text-xm openModal"
                                            data-original-title="Edit Matkul" data-bs-toggle="modal"
                                            data-bs-target='#editMatkul{{ $d->id_mk }}'>
                                            Edit |
                                        </a>
                                        <a href="{{ url('matkul_destroy/'.$d->id_mk) }}"
                                            class="text-secondary font-weight-bold text-xm openModal"
                                            data-original-title="Delete Matkul">
                                            Delete
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end me-5 mt-3">
                            {!! $data->links() !!}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('modal')
<!-- Modal -->
<div class="modal fade" id="addJurusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color: black;"
                    aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('matkul_add') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" list="prodi" name="prodi_id">
                        <datalist id="prodi">
                            @foreach($prodi as $p)
                            <option value="{{ $p['id_prodi'] }}"> {{ $p['nama_jurusan'] }} || {{ $p['prodi'] }} </option>
                            @endforeach
                        </datalist>
                       
                    @error('prodi_id')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="Kode Matkul" aria-label="Kode Matkul"
                            name="id_mk">
                    @error('id_mk')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="Matkul" aria-label="Matkul"
                            name="matkul">
                    @error('matkul')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control form-control-lg" placeholder="SKS" aria-label="SKS"
                            name="sks">
                    @error('sks')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control form-control-lg" placeholder="180" aria-label="Kuota"
                            name="kuota">
                    @error('kuota')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@foreach($data as $d)
<div class="modal fade" id="editMatkul{{ $d->id_mk }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color: black;"
                    aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('matkul_edit', [$d->id_mk]) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <select name="prodi_id" id="" class="form-control">
                            @foreach($prodi as $p)
                            <option value="{{ $p->id_prodi }}" <?php if ($p->id_prodi == $d->prodi_id) : echo
                                "selected";
                                endif; ?>>
                                {{ $p->nama_jurusan }} || {{ $p->prodi }}
                            </option>
                            @endforeach
                        </select>
                    @error('prodi_id')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" value="{{ $d->id_mk }}"
                            aria-label="IdMK" name="id_mk">
                    @error('id_mk')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" value="{{ $d->matkul }}"
                            aria-label="Matkul" name="matkul">
                    @error('matkul')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control form-control-lg" value="{{ $d->sks }}" aria-label="SKS"
                            name="sks">
                    @error('sks')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control form-control-lg" value="{{ $d->kuota }}"
                            aria-label="Kuota" name="kuota">
                    @error('kuota')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection