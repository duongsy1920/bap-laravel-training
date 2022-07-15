<x-admin-master>
    @section('content')
    <h1>Create</h1>
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="" class="form-control" placeholder="Enter title" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label for="File">Files</label>
            <input type="file" name="post_image" id="post_image" class="form-control-file @error('post_image') is-invalid @enderror">
            @error('post_image')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endsection
    @section('scripts')
    <script src={{ url('ckeditor/ckeditor.js')}}></script>
    <script>
        CKEDITOR.replace( 'body', {
            
            filebrowserBrowseUrl     : "{{ route('ckfinder_browser') }}",
            filebrowserImageBrowseUrl: "{{ route('ckfinder_browser') }}?type=Images&token=123",
            filebrowserFlashBrowseUrl: "{{ route('ckfinder_browser') }}?type=Flash&token=123", 
            filebrowserUploadUrl     : "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files", 
            filebrowserImageUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images",
            filebrowserFlashUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Flash",
        } );
        </script>
        @include('ckfinder::setup')
    @endsection
</x-admin-master>