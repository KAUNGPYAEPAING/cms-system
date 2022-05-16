<x-admin-master>

    @section('content')

    <h1>Create Post</h1>

    <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" aria-describedby="emailHelp" placeholder="">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" name="body" aria-label="With textarea" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="file">file</label>
            <input type="file" class="form-control" name="post_image"  placeholder="">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>


    @endsection

</x-admin-master>
