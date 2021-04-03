@extends('layouts.backend.app')
@section('content')
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Menu Builder <code>{{ $menu->name }}</code> </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('app.menus.index') }}" data-toggle="create" title="user create" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-list"></i>
                    </a>
                    <a href="{{ route('app.menus.item.create',$menu->id) }}" data-toggle="create" title="user create" class="btn-shadow mr-3 btn btn-info">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>    
            </div>
        </div>            
        <div class="row">
            <div class="col-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="card-title">How to Use:</div>
                        <p>You can output a menu anything by your site calling <code>menu('menu')</code> </p>
                    </div>
                </div>

                <div class="main-card mb-3 card">
                    <div class="card-body menu-builder">
                        <div class="card-title">Drag and drop the menu items blew the re-arrange :</div>
                        <div class="dd">
                            <ol class="dd-list">
                                @forelse ($menu->menuItems as $item)
                                <li class="dd-item" data-id="{{ $item->id }}">
                                    <div class="pull-right item_actions">
                                        <a href="{{ route('app.menus.item.edit',['id'=>$menu->id,'itemId'=>$item->id]) }}" id="PopoverCustomT-4" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button"
                                                onclick="deleteData({{ $item->id }})"  
                                                id="PopoverCustomT-4" 
                                                class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form  method="POST"
                                                id="delete-form-{{ $item->id }}"
                                                action="{{ route('app.menus.item.destroy',['id'=>$menu->id,'itemId'=>$item->id]) }}" 
                                                style="display: none">
    
                                            @csrf
                                            @method('Delete')
                                        </form>
                                    </div>
                                    <div class="dd-handle">
                                        @if ($item->type=='divider')
                                        <strong>Divider:{{ $item->divider_title }}</strong>
                                        @else
                                        <span>{{ $item->title }}</span>
                                        <small class="url">{{ $item->url }}</small>
                                        @endif
                                    </div>
                                    @if (!$item->childs->isEmpty())
                                    <ol class="dd-list">
                                        @foreach ($item->childs as $childItem)
                                        <li class="dd-item" data-id="{{ $childItem->id }}">
                                            <div class="pull-right item_actions">
                                                <a href="{{ route('app.menus.item.edit',['id'=>$menu->id,'itemId'=>$childItem->id]) }}" id="PopoverCustomT-4" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button"
                                                        onclick="deleteData({{ $childItem->id }})"  
                                                        id="PopoverCustomT-4" 
                                                        class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form  method="POST"
                                                        id="delete-form-{{ $childItem->id }}"
                                                        action="{{ route('app.menus.item.destroy',['id'=>$menu->id,'itemId'=>$childItem->id]) }}" 
                                                        style="display: none">
            
                                                    @csrf
                                                    @method('Delete')
                                                </form>
                                            </div>
                                            <div class="dd-handle">
                                                @if ($childItem->type=='divider')
                                                <strong>Divider:{{ $childItem->divider_title }}</strong>
                                                @else
                                                <span>{{ $childItem->title }}</span>
                                                <small class="url">{{ $childItem->url }}</small>
                                                @endif
                                            </div>
                                        </li>    
                                    @empty
                                    <div class="text-center">
                                        <strong>no menu items found</strong>
                                    </div>   
                                    @endforelse 
                                    </ol>
                                    @endif
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@endsection








@push('js')
<script type="text/javascript">
    $(function () {
        $('.dd').nestable({maxDepth: 2});
        $('.dd').on('change', function (e) {
            // console.log(JSON.stringify($('.dd').nestable('serialize')));
            $.post('{{ route('app.menus.order',$menu->id) }}', {
                order: JSON.stringify($('.dd').nestable('serialize')),
                _token: '{{ csrf_token() }}'
            }, function (data) {
                iziToast.success({
                    title: 'Success',
                    message: 'Successfully updated menu order.',
                });
            });
        });
    });
</script>
@endpush