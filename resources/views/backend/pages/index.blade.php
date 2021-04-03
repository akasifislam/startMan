@extends('layouts.backend.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Page Management </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('app.pages.create') }}" data-toggle="create" title="role create" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-user-plus"></i>
                    </a>
                </div>    
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Page Management
                        <div class="btn-actions-pane-right">
                            
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#sl</th>
                                <th>Title</th>
                                <th class="text-center">URL</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Last Modified</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($pages as $key => $page)
                                <tr>
                                    <td class="text-center text-muted">{{ $key+1 }}</td>
                                    <td>
                                        {{ $page->title }}
                                    </td>
                                    <td class="text-center">
                                        <a target="_blank" href="{{ route('page',$page->slug) }}">{{ $page->slug }}</a>
                                    </td>
                                    <td class="text-center">
                                        @if ($page->status==true)
                                        <span class="badge badge-info">Active</span>
                                        @else 
                                        <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $page->updated_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('app.pages.edit',$page->id) }}" id="PopoverCustomT-4" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button"
                                                onclick="deleteData({{ $page->id }})"  
                                                id="PopoverCustomT-4" 
                                                class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form  method="POST"
                                                id="delete-form-{{ $page->id }}"
                                                action="{{ route('app.pages.destroy',$page->id) }}" 
                                                style="display: none">

                                            @csrf
                                            @method('Delete')

                                        </form>
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