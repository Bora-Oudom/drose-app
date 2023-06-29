@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($blog, [
            'method' => 'PATCH',
            'route' => ['blogs.update', $blog->id],
            'class' => 'form',
            'enctype' => 'multipart/form-data',
            'id' => 'my-dropzone-form',
        ]) !!}
        @csrf
        <h2 class="text-light">Edit Blog</h2>
        <div class="row mb-3">
            {{-- <label for="name">{{ __('Title:') }}</label> --}}

            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                required placeholder="Blog Title" value="{{ $blog->title }}">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row mb-3">
            {{-- <label for="description">{{ __('Description:') }}</label> --}}
            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required
                rows="4" cols="50">{{ $blog->description }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row mb-3">
            {{-- <label for="image">{{ __('Upload Image:') }}</label> --}}
            <div class="dropzone-wrapper">
                <div class="box-body">
                    @if ($blog->image)
                        <img width="200" src="{{ url('image/' . $blog->image) }}" />
                    @endif
                </div>
                <input type="file" name="image" class="dropzone @error('image') is-invalid @enderror">
            </div>
            @error('image')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row
                mb-0">
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
            </button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
{{-- @push('footer-scripts')
    <script type="module">
       function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                var htmlPreview =
                    '<img width="200" src="' + e.target.result + '" />';
                var wrapperZone = $(input).parent();
                var previewZone = $(input).parent().parent().find('.preview-zone');
                var desc = $(input).siblings('.dropzone-desc');
                var boxZone = $(input).siblings('.box-body');  //$(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                wrapperZone.removeClass('dragover');
                // previewZone.removeClass('hidden');
                boxZone.empty();
                desc.addClass('hidden');
                boxZone.append(htmlPreview);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".dropzone").change(function() {
            readFile(this);
        });

        $('.dropzone-wrapper').on('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
        });

        $('.dropzone-wrapper').on('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
        });

        $('.remove-preview').on('click', function() {
        var boxZone = $(this).parents('.preview-zone').find('.box-body');
        var previewZone = $(this).parents('.preview-zone');
        var dropzone = $(this).parents('.form-group').find('.dropzone');
        boxZone.empty();
        previewZone.addClass('hidden');
        reset(dropzone);
        });
    </script>
@endpush --}}
