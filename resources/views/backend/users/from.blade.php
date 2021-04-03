@extends('layouts.backend.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
<style>
    .dropify-wrapper .dropify-message p{
        font-size: initial;
    }
</style>
@endpush
@section('content')
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-check icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Role Management </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('app.users.index') }}" data-toggle="create" title="user create" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-list"></i>
                    </a>
                </div>    
            </div>
        </div>            
        <div class="row">
            <div class="col-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        @isset($user)
                            User Update
                        @else
                            User Create
                        @endisset
                        <div class="btn-actions-pane-right">
                            
                        </div>
                    </div>
                    <div class="table">
                        <form method="POST"
                            enctype="multipart/form-data" 
                            action="{{ isset($user) ? route('app.users.update',$user->id) : route('app.users.store') }}">
                        @csrf
                        @isset($user)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">User Information</h5>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" placeholder="Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}" autocomplete="name">
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input id="email" placeholder="Email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" autocomplete="email">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password"
                                        {{ !isset($user) ? 'required':'' }}>
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input id="confirm_password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="password"
                                        {{ !isset($user) ? 'required':'' }}>
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <div class="card-body">
                                        <h5 class="card-title">Select Role And Status</h5>
                                        <div class="form-group">
                                            <label for="role">Select Role </label>
                                            

                                            <select id="role" class="js-example-basic-multiple form-control @error('role') is-invalid @enderror" name="role">
                                                <option value=""> ---select role --- </option>
                                                @foreach ($roles as $key=>$role)
                                                    <option value="{{ $role->id }}"
                                                            @isset($user)
                                                                {{ $user->role->id == $role->id ? 'selected' : '' }}
                                                            @endisset
                                                        >{{ $role->name }}</option>
                                                @endforeach
                                            </select>
            
                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="avatar">Avatar</label>
                                            

                                            <input type="file" id="avatar" class="dropify form-control @error('avatar') is-invalid @enderror" name="avatar"
                                            value="{{ isset($user) ? $user->getFirstMediaUrl('avatar') : ''  }}"
                                            data-default-file="{{ isset($user) ? $user->getFirstMediaUrl('avatar') : '' }}"
                                            {{ !isset($user) ? 'required':'' }}>
            
                                            @error('avatar')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input  type="checkbox"
                                                        class="custom-control-input" 
                                                        id="status"
                                                        @isset($user)
                                                            {{ $user->status == true ? 'checked' : '' }}
                                                        @endisset
                                                        name="status">
                                                <label class="custom-control-label" 
                                                       for="status">Status</label>
                                            </div>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button class="btn btn-dark" type="submit">
                                            @isset($user)
                                                <i class="fa fa-plus-circle"></i>
                                                Update
                                            @else 
                                                <i class="fa fa-plus-circle"></i>
                                                Create
                                            @endisset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </form>
                </div>
            </div>
        </div>
        
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
        $('.js-example-basic-multiple').select2();
    });
</script>
@endpush