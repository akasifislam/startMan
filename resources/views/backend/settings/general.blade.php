@extends('layouts.backend.app')
@section('content')
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Gemeral Setting</div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('app.dashboard') }}" data-toggle="create" title="user create" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-list"></i>
                    </a>
                </div>    
            </div>
        </div>            
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('app.settings.general') }}" class="list-group-item list-group-item-action">General</a>
                    <a href="{{ route('app.settings.general') }}" class="list-group-item list-group-item-action">Appearance</a>
                    <a href="{{ route('app.settings.general') }}" class="list-group-item list-group-item-action">Mail</a>
                    <a href="{{ route('app.settings.general') }}" class="list-group-item list-group-item-action">Sociallite</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">How to Use</h5>
                        <p>you can get the value of each setting  <code>setting('key')</code> </p>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="table">
                        <form method="POST"
                            action="{{ route('app.settings.general.update') }}">
                        @csrf
                            @method('PUT')
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="card-body">
                                    {{-- <h5 class="card-title">Basic Information</h5> --}}
                                    <div class="form-group">
                                        <label for="site_title">Site Title</label>
                                        <input id="site_title" placeholder="Site Title" type="text" class="form-control @error('site_title') is-invalid @enderror" name="site_title" value="{{ setting('site_title') ?? old('site_title') }}">
        
                                        @error('site_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="site_description">SiteDescription</label>
                                        <textarea id="site_description" class="form-control @error('site_description') is-invalid @enderror" name="site_description">{{ setting('site_description') ?? old('site_description') }}</textarea>

        
                                        @error('site_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="site_address">Site Address</label>
                                        <textarea id="site_address" class="form-control @error('site_address') is-invalid @enderror" name="site_address">{{ setting('site_address') ?? old('site_address') }}</textarea>

        
                                        @error('site_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-arrow-circle-up"></i>
                                        Update
                                       
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