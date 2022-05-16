<x-admin-master>
    @section('content')

        @if (session()->has('role-updated'))
            <div class="alert alert-success">
                {{session('role-updated')}}
            </div>
        @endif

        <h3>Edit Page : {{$role->name}}</h3>

        <div class="col-sm-3">

            <form action="{{ route('admin.role.update', $role) }}" method="post" >

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="" value="{{ $role->name }}">
                    <div>
                        @error('name')
                            <span><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-primary" name="submit">Update</button>

            </form>

        </div>

        @if ($permissions->isNotEmpty())
        <div class="col-sm-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Option</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                            </tfoot>
                            <tbody>
        


                                    @foreach ($permissions as $permission)
                                    <tr>

                                        <td>
                                            <input type="checkbox" 
        
                                                @foreach ($role->permissions as $role_permission)
                                                    
                                                    @if ($role_permission->slug == $permission->slug)
                                                        checked
                                                    @endif
        
                                                @endforeach
                                                
                                            ></td>
                                        <td>{{ $permission->name }}</a></td>
                                        <td>{{ $permission->slug }}</td>
                                        <td>

                                            <form action=" {{ route('user.role.attach', $role) }} " method="post">
    
                                            @method('PUT')
                                            @csrf
                                                
                                            <input type="hidden" name="role" value="{{ $permission->id }}">
    
                                            <button class="btn btn-primary"
                                            
                                                                                    
                                            @if ($role->permissions->contains($permissions))
                                            disabled
                                            @endif
                                            >
                                                Attach
                                            </button>
    
    
    
    
                                            </form>
    
                                        </td>
    
                                        
                                        <td>
    
                                            <form action=" {{ route('user.role.detach', $role) }} " method="post">
    
                                            @method('PUT')
                                            @csrf
                                                
                                            <input type="hidden" name="role" value="{{ $permission->id }}">
    
                                            <button class="btn btn-danger"
                                            @if (!$role->permissions->contains($permission))
                                            disabled
                                            @endif
                                            >
                                                detach
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
        

        </div>
        @endif



    @endsection
</x-admin-master>