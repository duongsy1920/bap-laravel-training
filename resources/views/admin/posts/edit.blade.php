<x-admin-master>
    @section('content')

        <h1>Edit a Post</h1>

        <form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       id="title"
                       aria-describedby=""
                       placeholder="Enter title"
                       value="{{$post->title}}"

                >
            </div>
            <div class="form-group">
                <div><img height="100px" src="{{$post->post_image}}" alt=""></div>
                <label for="file">File</label>
                <input type="file"
                       name="post_image"
                       class="form-control-file @error('post_image') is-invalid @enderror"
                       id="post_image">
                @error('post_image')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>


            <div class="form-group">
                         <textarea
                                 name="body"
                                 class="form-control"
                                 id="body"
                                 cols="30"
                                 rows="10">{{$post->body}}</textarea>
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