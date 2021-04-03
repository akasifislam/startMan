@extends('layouts.backend.app')
@section('content')
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Create Menu </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('app.menus.index') }}" data-toggle="create" title="user create" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-list"></i>
                    </a>
                </div>    
            </div>
        </div>            
        <div class="row">
            <div class="col-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        @isset($menu)
                            Menu Update
                        @else
                            Menu Create
                        @endisset
                        <div class="btn-actions-pane-right">
                            
                        </div>
                    </div>
                    <div class="table">
                        <form method="POST"
                            action="{{ isset($menu) ? route('app.menus.update',$menu->id) : route('app.menus.store') }}">
                        @csrf
                        @isset($menu)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    {{-- <h5 class="card-title">Basic Information</h5> --}}
                                    <div class="form-group">
                                        <label for="name">Menu Name</label>
                                        <input id="name" placeholder="Page name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $menu->name ?? old('name') }}">
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ $menu->description ?? old('description') }}</textarea>

        
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-success" type="submit">
                                        @isset($menu)
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
                </form>
                </div>
            </div>
        </div>
        
@endsection