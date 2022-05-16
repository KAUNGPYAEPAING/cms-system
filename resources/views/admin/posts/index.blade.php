<x-admin-master>
    @section('content')

    <h1>All Posts</h1>

    @if (Session::has('message'))

        <div class="alert alert-danger">{{ Session::get('message') }}</div>

    @elseif (Session::has('post-created-message'))

    <div class="alert alert-success">{{ Session::get('post-created-message') }}</div>

    @elseif (Session::has('post-update-message'))

    <div class="alert alert-info">{{ Session::get('post-update-message') }}</div>

    @endif


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Body</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Body</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($posts as $post)

                        <tr>
                            <td>{{ $post->id }}</td>
                            <th>{{ $post->user->name }}</th>
                            <td><a href="{{ route('post.edit', $post->id) }}">{{ $post->title }}</a></td>
                            <td>
                                <img height="40px" src="{{ $post->post_image }}" alt="">
                            </td>
                            <td>{{ $post->body }}</td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td>{{ $post->updated_at->diffForHumans() }}</td>
                            <td>



                            @can('view', $post) {{-- //user who can view the post can see delete button --}}

                            <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                @csrf
                                
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </td>
                            </form>

                            @endcan
                            
                        </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    @endsection

    @endsection
</x-admin-master>
