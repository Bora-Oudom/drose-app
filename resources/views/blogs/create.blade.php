@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('blogs.store') }}" class="form" enctype="multipart/form-data">
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
            <div class="row mb-3">
                <label for="description">{{ __('Description:') }}</label>

                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required
                    rows="4" cols="50"></textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row mb-3">
                <label for="image">{{ __('Image:') }}</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="row mb-0">
                <button type="submit" class="btn btn-primary">
                    {{ __('Create') }}
                </button>
            </div>
        </form>
    </div>
@endsection
{{-- @push('footer-scripts')
    <script type="text/javascript">
        $('#browse-file').click(function() {
            $('#dropzone').click();
        })
        Dropzone.options.dropzone = {
            // clickable: false,
            autoProcessQueue: true,
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 100,
            acceptedFiles: ".fasta",
            addRemoveLinks: false,
            dictDefaultMessage: 'drag here',
            disablePreviews: true,
            previewsContainer: false,
            success: function(file, response) {
                let numItems = $('#preview-uploaded-files p').length + 1;
                $("#dropzone").removeClass('dz-started');
                $('#preview-uploaded-files').append("<p class='p-file'>" + numItems + "_" + response.fileName +
                    "</p>");
                $(".dz-message").removeClass('d-none');
                $(".loading").addClass('d-none');
                $('#browse-file').removeClass('disable');
                $('#browse-file').attr("disabled", false);
                $('#run-analysis').removeClass('disable');
                $('#run-analysis').attr("disabled", false);
                console.log(response);
            },
            uploadprogress: function(file, progress, bytesSent) {
                $(".loading").removeClass('d-none');
                $(".dz-message").addClass('d-none');
                $('#browse-file').addClass('disable');
                $('#browse-file').attr("disabled", true);
                $('#run-analysis').addClass('disable');
                $('#run-analysis').attr("disabled", true);
            },
            init: function() {
                this.on("maxfilesexceeded", function(file) {
                    $('#dropzone').addClass('disable');
                    $('#dropzone').attr("disabled", true);
                    $('#browse-file').addClass('disable');
                    $('#browse-file').attr("disabled", true);
                    $("#dropzone").removeClass('dz-started');
                    alert("maximum FASTA file(s) allow to upload 100!");
                });
                this.hiddenFileInput.removeAttribute('multiple');
            },
            error: function(file, response) {
                return false;
            },
        };
    </script>
@endpush --}}
