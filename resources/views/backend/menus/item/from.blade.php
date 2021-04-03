@extends('layouts.backend.app')
@section('content')
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Create Menu <code> {{ $menu->name }}</code> </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('app.menus.builder',$menu->id) }}" data-toggle="create" title="user create" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-list"></i>
                    </a>
                </div>    
            </div>
        </div>            
        <div class="row">
            <div class="col-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        @isset($menuItem)
                            Menu Update
                        @else
                            Menu Create
                        @endisset
                        <div class="btn-actions-pane-right">
                            
                        </div>
                    </div>
                    <div class="table">
                        <form method="POST"
                            action="{{ isset($menuItem) ? route('app.menus.item.update',['id'=>$menu->id,'itemId'=>$menuItem->id]) : route('app.menus.item.store',$menu->id) }}">
                        @csrf
                        @isset($menuItem)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Menu Item</h5>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select class="custom-select" name="type" id="type" onchange="setItemType()">
                                            <option value="item"
                                                @isset($menuItem)
                                                    {{ $menuItem->type== 'item' ? 'selected' : '' }}
                                                @endisset
                                            
                                            >Menu Item</option>
                                            <option value="divider"
                                                @isset($menuItem)
                                                    {{ $menuItem->type== 'divider' ? 'selected' : '' }}
                                                @endisset
                                            
                                            >Divider</option>
                                        </select>
                                    </div>
                                    <div id="divider_fields">
                                        <div class="form-group">
                                            <label for="divider_title">Title of the Divider</label>
                                            <input type="text" class="form-control @error('divider_title') is-invalid @enderror" id="divider_title"
                                                   name="divider_title"
                                                   placeholder="Divider Title" value="{{ isset($menuItem) ? $menuItem->divider_title : old('divider_title') }}"
                                                   autofocus>
                                            @error('divider_title')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="item_fields">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                                   name="title"
                                                   placeholder="Title" value="{{ isset($menuItem) ? $menuItem->title : old('title') }}"
                                                   autofocus>
                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="url">Url for menu(item)</label>
                                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url"
                                                   name="url"
                                                   placeholder="url" value="{{ isset($menuItem) ? $menuItem->url : old('url') }}"
                                                   autofocus>
                                            @error('url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="target">Open In</label>
                                            <select class="custom-select @error('target') is-invalid @enderror" name="target" id="target">
                                                <option value="_self"
                                                    @isset($menuItem)
                                                        {{ $menuItem->target== '_self' ? 'selected' : '' }}
                                                    @endisset
                                                >Same Tab</option>
                                                <option value="_blank"
                                                    @isset($menuItem)
                                                        {{ $menuItem->target== '_blank' ? 'selected' : '' }}
                                                    @endisset
                                                >New Tab</option>
                                            </select>
                                            @error('target')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="icon_class">Font Icon class for the Menu Item <a target="_blank"
                                                href="https://fontawesome.com/">(Use a Fontawesome Font Class)</a> </label>
                                            <input type="text" class="form-control @error('icon_class') is-invalid @enderror" id="icon_class"
                                                   name="icon_class"
                                                   placeholder="icon class" value="{{ isset($menuItem) ? $menuItem->icon_class : old('icon_class') }}"
                                                   autofocus>
                                            @error('icon_class')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button class="btn btn-success" type="submit">
                                        @isset($menuItem)
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

@push('js')
    <script type="text/javascript">
        function setItemType(){
            if($('select[name="type"]').val() == 'divider'){
                $('#divider_fields').removeClass('d-none');
                $('#item_fields').addClass('d-none');
            }else{
                $('#divider_fields').addClass('d-none');
                $('#item_fields').removeClass('d-none');
            }
        }; setItemType();
        $('input[name="type"]').change(setItemType);
    </script>
@endpush