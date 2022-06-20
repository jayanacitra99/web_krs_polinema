@extends('themes.template')

@section('konten')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <p class="mb-0">Edit Profile</p>
                <button type="submit" form="editProfile" class="btn btn-primary btn-sm ms-auto">Edit Profile</button>
            </div>
        </div>
    <div class="card-body">
        <p class="text-uppercase text-sm">User Information</p>
        <form action="{{url('editProfile/'.auth()->user()->id)}}" method="post" id="editProfile">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">NIM</label>
                    <input class="form-control" type="text" value="{{auth()->user()->nim}}" onfocus="focused(this)" onfocusout="defocused(this)" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Jurusan</label>
                    @foreach ($jurusan as $item)
                        @if ($item->id_lj == auth()->user()->jurusan)
                        <input class="form-control" type="text" value="{{$item->nama_jurusan}}" onfocus="focused(this)" onfocusout="defocused(this)" disabled>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <label for="example-text-input" class="form-control-label">Username</label>
                    <input class="form-control" type="text" value="{{auth()->user()->username}}" name="username" onfocus="focused(this)" onfocusout="defocused(this)">
                </div>
                @error('username')
                <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                <script> window.addEventListener("load",clickNotif);</script>	
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Name</label>
                    <input class="form-control" type="text" value="{{auth()->user()->nama}}" name="name" onfocus="focused(this)" onfocusout="defocused(this)">
                </div>
                @error('name')
                <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                <script> window.addEventListener("load",clickNotif);</script>	
                @enderror
            </div>
        </div>
        </form>
        <p class="text-uppercase text-sm">Change Password</p>
        <form action="{{url('changePass/'.auth()->user()->id)}}" method="post">
            @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="password" class="form-control-label">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" onfocus="focused(this)" onfocusout="defocused(this)"/>
                </div>
            </div>
                @error('password')
                <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                <script> window.addEventListener("load",clickNotif);</script>	
                @enderror
            <div class="col-md-4">
                <div class="form-group">
                    <label for="password-confirm" class="form-control-label">Confirm Password</label>
                    <input class="form-control" type="password" id="password-confirm" name="password_confirmation" autocomplete="new-password" value="{{ old('password_confirmation') }}" placeholder="Repeat your password" onfocus="focused(this)" onfocusout="defocused(this)"/>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm ms-auto">Change Password</button>
        </form>
    </div>
</div>
@endsection
@section('js')
@endsection