@extends('layouts.backend.app')

@section('content')
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-user icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Users Management </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('app.users.edit',$user->id) }}" id="PopoverCustomT-4" class="btn btn-primary btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{ route('app.users.index') }}" data-toggle="create" title="role list" class="btn-shadow btn-sm mr-3 btn btn-success">
                        <i class="fa fa-list"></i>
                    </a>
                </div>    
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <img width="200px" height="200px" src="{{ isset($user) ? $user->getFirstMediaUrl('avatar') : ''  }}" class="img-fluid img-thumbnail" alt="avatar">
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="main-card mb-3 card">
                    <div class="card-body p-0">
                       <table class="table table-striped table-hover table-bordered mb-0">
                           <tbody>
                               <tr>
                                   <th scope="row">Name</th>
                                   <td>{{ $user->name }}</td>
                               </tr>
                               <tr>
                                   <th scope="row">Email</th>
                                   <td>{{ $user->email }}</td>
                               </tr>
                               <tr>
                                   <th scope="row">Role</th>
                                   <td>
                                    @if ($user->role)
                                        <span class="badge badge-info">{{ $user->role->name }}</span>
                                    @else
                                        <span class="badge badge-danger">No role found :(</span>
                                    @endif
                                   </td>
                               </tr>
                               <tr>
                                   <th scope="row">Status</th>
                                   <td>
                                    @if ($user->status==true)
                                        <span class="badge badge-info">Active</span>
                                    @else 
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                   </td>
                               </tr>
                               <tr>
                                    <th scope="row">Created Profile</th>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                               </tr>
                               <tr>
                                    <th scope="row">Profile Last Update</th>
                                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                               </tr>
                           </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
        
@endsection