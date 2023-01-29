@extends('admin.layout.master')

@section('title')
    Post List
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Posts
                        <small>List</small>
                    </h1>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr align="center">
                            <th>Category</th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Highlight</th>
                            <th>View</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td><img src="{{ $post->imageUrl() }}" alt="" width="200"></td>
                                <td>{{ $post->highlight_post == 1 ? 'X' : '' }}</td>
                                <td>{{ $post->view_counts }}</td>
                                <td class="center">
                                    <i class="fa fa-trash-o  fa-fw"></i>
                                    <a href="{{ route('admin.post.delete', $post->id) }}"> Delete</a>
                                </td>
                                <td class="center">
                                    <i class="fa fa-pencil fa-fw"></i>
                                    <a href="{{ route('admin.post.edit', $post->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $posts->links() !!}
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
