@extends('layouts.backend.app')
@section('content')
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-lock icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Profile Security </div>
                </div>
                   
            </div>
        </div>            
        <div class="row">
            <div class="col-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        Update Password
                        <div class="btn-actions-pane-right">
                            
                        </div>
                    </div>
                    <div class="table">
                        <form method="POST"
                            action="{{ route('app.profile.password.update') }}">
                            @csrf
                            @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autofocus>
        
                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required>
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-dark" type="submit">
                                            <i class="fa fa-plus-circle"></i>
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