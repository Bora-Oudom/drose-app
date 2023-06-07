@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('blogs.store') }}" class="form" enctype="multipart/form-data"
            id="my-dropzone-form">
            @csrf
            <h2 class="text-light mb-4">Create Blog</h2>
            <div class="row mb-3">
                <label for="name">{{ __('Title:') }}</label>

                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    required placeholder="Blog Title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row mb-3 ">
                <label for="description">{{ __('Description:') }}</label>

                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required
                    rows="4" cols="50"></textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- File input element -->
            <div class="row mb-3">
                <label for="image">{{ __('Upload Image:') }}</label>
                <div class="dropzone-wrapper">
                    <div class="box-body"></div>
                    <div class="dropzone-desc">
                        <i class="fa-solid fa-circle-arrow-down fa-xl"></i>
                        <p>Choose an image file or drag it here.</p>
                    </div>
                    <input type="file" name="image" class="dropzone">
                </div>
            </div>
            <div class="row mb-0">
                <button id="submit-button" type="submit" class="btn btn-primary">
                    {{ __('Create') }}
                </button>
            </div>
        </form>
    </div>
@endsection
{{-- @push('footer-scripts')
    <script type="module">
        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                var htmlPreview =
                    '<img width="200" src="' + e.target.result + '" />'
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

        // // Create a new Dropzone instance
        // Dropzone.options.myDropzone = { 

        //     autoProcessQueue: false,
        //     // url: "{{ route('blogs.store') }}",
        //     paramName: 'image', // The name of the uploaded file in $_FILES
        //     maxfiles: 1,
        //     acceptedFiles: '.jpg, .jpeg, .png, .gif', // Allow only image uploads
        //     // addRemoveLinks: true, // Show remove button on uploaded files
        //     // dictRemoveFile: 'Remove', // Change the text for the "Remove" link
        //     // dictDefaultMessage: "Drop your blog cover here",
        //     // autoProcessQueue: true,
            
        //     headers: {
        //         'X-CSRF-TOKEN': "{{ csrf_token() }}"
        //     },
        //     renameFile: function(file) {
        //         return file.name.split('.').pop();
        //     },
        //     // addedfiles: function(files) {
        //     //     if (this.files.length > 1){
        //     //         myDropzone.removeFile(this.files[0]);
        //     //     }
        //     // },
            
        //     params: function(files, xhr, chunk) {
        //         return {
        //             title: $("#title").val(),
        //             description: $("#description").val()
        //         };
        //     },
            
        // };

    </script>
@endpush --}}
