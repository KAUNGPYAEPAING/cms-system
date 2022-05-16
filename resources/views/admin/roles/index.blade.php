<x-admin-master>

    @section('content')

        <div class="row">

            <div class="col-sm-3">

                <form action="{{ route('admin.role.store') }}" method="post" >

                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="">
                        <div>
                            @error('name')
                                <span><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary" name="submit">Create</button>

                </form>

            </div>


            <div class="col-sm-9">

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                                <tbody>
            


                                        @foreach ($roles as $role)
                                        <tr>

                                            <td>{{ $role->id }}</td>
                                            <td><a href="{{ route('admin.role.edit', $role) }}">{{ $role->name }}</a></td>
                                            <td>{{ $role->slug }}</td>
                                            <td>
                                                <form action="{{ route('admin.role.destroy', $role) }}" method="post">

                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger">Delete</button>


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

        </div>


    @endsection


</x-admin-master>