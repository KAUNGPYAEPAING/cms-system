<x-admin-master>

    @section('content')

    <h1>Edit Post</h1>

    <form method="post" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">

        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" aria-describedby="emailHelp" value="{{ $post->title }}" placeholder="">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" name="body" aria-label="With textarea" cols="30" rows="10">{{ $post->body }}</textarea>
        </div>
        <div class="form-group">
            <label for="file">file</label>
            <input type="file" class="form-control" name="post_image"  placeholder="">
            <div><img src="{{ $post->post_image }}" alt="" height="100px"></div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>


    @endsection

</x-admin-master>
