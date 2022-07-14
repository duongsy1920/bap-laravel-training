<x-admin-master>
    @section('content')
    <div class="row">
    @if(session()->has('role-updated'))
            <div class="alert alert-success">
                {{ session('role-updated') }}
            </div>
     @endif
    </div>
    <div class="row">
        <div class  = "col-sm-6">
            <h1>Edit Role: {{$role->name}}</h1>
    
            <form action="{{route('roles.update', $role->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$role->name}}">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if($permissions->isNotEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Option</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                <td><input type="Checkbox"
                                            @foreach($role->permissions as $role_permission)
                                                    @if($role_permission->slug == $permission->slug)
                                                            checked
                                                    @endif
                                            @endforeach
                                    ></td>
                                    <td>{{$permission->id}}</td>
                                    <td> <a href="{{route('permissions.edit', $permission->id)}}">{{$permission->name}}</a></td>
                                    <td>{{$permission->slug}}</td>
                                    <td>
                                    <form method="post" action="{{route('roles.permissions.attach', $role)}}">
                                            @method('PUT')
                                            @csrf
                                        <input type="hidden" name="permissions" value="{{$permission->id}}">
                                        <button type="submit" class="btn btn-primary"
                                                        @if($role->permissions->contains($permission))
                                                                disabled
                                                        @endif
                                        >Attach
                                        </button>
                                    </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('roles.permissions.detach', $role)}}">
                                                @method('PUT')
                                                @csrf
                                            <input type="hidden" name="permissions" value="{{$permission->id}}">
                                            <button type="submit" class="btn btn-danger"
                                                            @if(!$role->permissions->contains($permission))
                                                                    disabled
                                                            @endif
                                            >Detach                                                                     
                                            </button>
                                        </form>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        @endif
    </div>
    
    @endsection
    
    </x-admin-master>
    