@extends('layouts.backend.app')
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
                    <a href="{{ route('app.roles.index') }}" data-toggle="create" title="role create" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-list"></i>
                    </a>
                </div>    
            </div>
        </div>            
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        @isset($role)
                            Role Update
                        @else
                            Role Create
                        @endisset
                        <div class="btn-actions-pane-right">
                            
                        </div>
                    </div>
                    <div class="table-responsive">
                        <form method="POST" 
                            action="{{ isset($role) ? route('app.roles.update',$role->id) : route('app.roles.store') }}">
                        @csrf
                        @isset($role)
                            @method('PUT')
                        @endisset
                        <div class="card-body">
                            <h5>Manage Roles</h5>
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input id="name" placeholder="Role Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name ?? old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <strong class="text-primary">Manage Permission For Role</strong>
                                @error('permissions')
                                    <p class="p-2">
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="select-all">
                                    <label for="select-all" class="custom-control-label" >Select All</label>
                                </div>
                            </div>

                            @forelse ($modules->chunk(2) as $key => $chunks)
                                <div class="form-row">
                                    @foreach ($chunks as $key=>$module)
                                        <div class="col">
                                            <h5>Module: {{ $module->name }}</h5>
                                            @foreach ($module->permissions as $key => $permission)
                                                <div class="mb-3 ml-4">
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" 
                                                        class="custom-control-input"
                                                        name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        @isset($role)
                                                            @foreach ($role->permissions as $rPermission)
                                                                {{ $permission->id == $rPermission->id ? 'checked' : '' }}
                                                            @endforeach
                                                        @endisset
                                                        id="permission-{{ $permission->id }}">
                                                        <label for="permission-{{ $permission->id }}" class="custom-control-label">{{ $permission->name }}</label>
                                                    </div>
                                                </div>                                                
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @empty
                            <div class="row">
                                <div class="col text-center">
                                    <strong>no permission</strong>
                                </div>
                            </div>
                            @endforelse
                            <button class="btn btn-dark" type="submit">
                                @isset($role)
                                    <i class="fa fa-plus-circle"></i>
                                    Update
                                @else 
                                    <i class="fa fa-plus-circle"></i>
                                    Create
                                @endisset
                            </button>
                        </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
@endsection

@push('js')
<script type="text/javascript">
    // Listen for click on toggle checkbox
    $('#select-all').click(function (event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function () {
                this.checked = false;
            });
        }
    });
</script>
@endpush