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
            <input type="file" name="post_image" id="post_image" class="form-control-file">
        </div>
        <div class="form-group">
            <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endsection
</x-admin-master>