@extends('themes.template')

@section('konten')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">

                    <div class="d-flex">
                        <h6>List Prodi</h6>
                        <a href="" class="btn btn-primary ms-auto justify-content-end me-5" data-bs-toggle="modal" data-bs-target='#addJurusan'>Tambah</a>
                    </div>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-secondary opacity-7">Jurusan</th>
                                    <th class="text-center text-secondary opacity-7">Prodi</th>
                                    <th class="text-secondary opacity-7 text-center">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!count($data))
                                <tr>
                                    <td colspan="4" class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Data masih kosong</span>
                                    </td>
                                </tr>
                                @else
                                @foreach($data as $d)
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->nama_jurusan }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->prodi }}</span>
                                    </td>
                                    <td class="align-middle text-center ">
                                        <a href="#" class="text-secondary font-weight-bold text-xm openModal" data-original-title="Edit jurusan" data-bs-toggle="modal" data-bs-target='#editJurusan{{ $d->id_prodi }}'>
                                            Edit |
                                        </a>
                                        <a href="{{ url('prodi_destroy/'.$d->id_prodi) }}" class="text-secondary font-weight-bold text-xm openModal" data-original-title="Delete jurusan">
                                            Delete
                                        </a>
                                    </td>
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
<div class="modal fade" id="addJurusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color: black;" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('prodi_add') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <!-- <input type="text" class="form-control form-control-lg" placeholder="Jurusan" aria-label="Jurusan" name="jurusan_id"> -->
                        <select name="jurusan_id" id="jurusan_id" class="form-select">
                            @foreach($jurusan as $j)
                            <option value="{{ $j->id_lj }}">{{ $j->nama_jurusan }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('jurusan_id'))
                        <span class="text-danger">{{ $errors->first('jurusan_id') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="Prodi" aria-label="Prodi" name="prodi">
                        @if ($errors->has('prodi'))
                        <span class="text-danger">{{ $errors->first('prodi') }}</span>
                        @endif
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
<div class="modal fade" id="editJurusan{{ $d->id_prodi }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color: black;" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('prodi_edit', [$d->id_prodi]) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <select name="jurusan_id" id="jurusan_id" class="form-select">
                            @foreach($jurusan as $j)
                            <option value="{{ $j->id_lj }}" <?php if ($j->id_lj == $d->jurusan_id) : echo "Selected";
                                                            endif ?>>{{ $j->nama_jurusan }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('jurusan_id'))
                        <span class="text-danger">{{ $errors->first('jurusan_id') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" value="{{ $d->prodi }}" aria-label="Prodi" name="prodi">
                        @if ($errors->has('prodi'))
                        <span class="text-danger">{{ $errors->first('prodi') }}</span>
                        @endif
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