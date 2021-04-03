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
                        <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Role Management </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('app.pages.index') }}" data-toggle="create" title="user create" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-list"></i>
                    </a>
                </div>    
            </div>
        </div>            
        <div class="row">
            <div class="col-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        @isset($page)
                            Page Update
                        @else
                            Page Create
                        @endisset
                        <div class="btn-actions-pane-right">
                            
                        </div>
                    </div>
                    <div class="table">
                        <form method="POST"
                            enctype="multipart/form-data" 
                            action="{{ isset($page) ? route('app.pages.update',$page->id) : route('app.pages.store') }}">
                        @csrf
                        @isset($page)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Basic Information</h5>
                                    <div class="form-group">
                                        <label for="title">Page Title</label>
                                        <input id="title" placeholder="Page title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $page->title ?? old('title') }}">
        
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="excerpt">Excerpt</label>
                                        <textarea id="excerpt" class="form-control @error('excerpt') is-invalid @enderror" name="excerpt">{{ $page->excerpt ?? old('excerpt') }}</textarea>

        
                                        @error('excerpt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Section Body</label>
                                        <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body">{{ $page->body ?? old('body') }}</textarea>

        
                                        @error('body')
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
                                        <h5 class="card-title">Select Image And Status</h5>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            

                                            <input type="file" id="image" class="dropify form-control @error('image') is-invalid @enderror" name="image"
                                            value="{{ isset($page) ? $page->getFirstMediaUrl('image') : ''  }}"
                                            data-default-file="{{ isset($page) ? $page->getFirstMediaUrl('image') : '' }}"
                                            {{ !isset($page) ? 'required':'' }}>
            
                                            @error('image')
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
                                                        @isset($page)
                                                            {{ $page->status == true ? 'checked' : '' }}
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
                                            @isset($page)
                                                <i class="fa fa-plus-circle"></i>
                                                Update
                                            @else 
                                                <i class="fa fa-plus-circle"></i>
                                                Create
                                            @endisset
                                        </button>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="card-body">
                                        <h5 class="card-title">Meta Info</h5>
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description">{{ $page->meta_description ?? old('meta_description') }}</textarea>

            
                                            @error('meta_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            <textarea id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords">{{ $page->meta_keywords ?? old('meta_keywords') }}</textarea>

            
                                            @error('meta_keywords')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
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
<script src="https://cdn.tiny.cloud/1/k8af2gnw02hlpb8xmtlwrt4mdnx4vcz5n9uza1mzke9e5ifq/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script type="text/javascript">
    tinymce.init({
            selector: '#body',
            plugins: 'print preview paste importcss searchreplace autolink directionality code visualblocks visualchars image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | preview | insertfile image media link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            image_advtab: true,
            content_css: '//www.tiny.cloud/css/codepen.min.css',
            importcss_append: true,
            height: 400,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
    });
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
@endpush