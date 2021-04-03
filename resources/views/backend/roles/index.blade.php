@extends('layouts.backend.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
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
                    <a href="{{ route('app.roles.create') }}" data-toggle="create" title="role create" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-user-plus"></i>
                    </a>
                </div>    
            </div>
        </div>
        
       
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Active Users
                        <div class="btn-actions-pane-right">
                            
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Permissions</th>
                                <th class="text-center">Last Update</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                <tr>
                                    <td class="text-center text-muted">#{{ $key+1 }}</td>
                                   
                                    <td class="text-center">{{ $role->name }}</td>
                                    <td class="text-center">
                                        @if ($role->permissions->count() > 0)
                                        <span class="badge badge-info">{{ $role->permissions->count() }}</span>
                                        @else 
                                        <span class="badge badge-danger">NO Permission Found</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $role->updated_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('app.roles.edit',$role->id) }}" id="PopoverCustomT-4" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @if ($role->deletable==true)
                                        <button type="button"
                                                onclick="deleteData({{ $role->id }})"  
                                                id="PopoverCustomT-4" 
                                                class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form  method="POST"
                                                id="delete-form-{{ $role->id }}"
                                                action="{{ route('app.roles.destroy',$role->id) }}" 
                                                style="display: none">

                                            @csrf
                                            @method('Delete')

                                        </form>
                                        @endif
                                    </td>
                                </tr> 
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        } );
    </script>
@endpush