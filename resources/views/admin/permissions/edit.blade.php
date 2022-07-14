<x-admin-master>
    @section('content')
    <div class="row">
    @if(session()->has('permission-updated'))
            <div class="alert alert-success">
                {{ session('permission-updated') }}
            </div>
    @endif
    </div>
    <div class="row">
        <div class  = "col-sm-6">
            <h1>Edit: {{$permission->name}}</h1>
    
            <form action="{{route('permissions.update', $permission->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$permission->name}}">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    
    @endsection
    
    </x-admin-master>