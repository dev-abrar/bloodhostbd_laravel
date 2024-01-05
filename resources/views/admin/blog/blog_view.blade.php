@extends('layouts.dashboard')

@section('content')
@can('view_blog')
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Blog List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Title</th>
                            <th>Time</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>{{$blog->title}}</td>
                                <td>{{$blog->created_at->format('d-M-Y')}}</td>
                                <td>
                                    <img width="100" src="{{asset('upload/blog')}}/{{$blog->img}}" alt="">
                                </td>
                                <td>
                                    <a href="{{route('blog.delete', $blog->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
<h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
@endcan
<div class="container">
    <div class="row">
        <div class="col-lg">
            <div class="mb-3">
                {{$blogs->links()}}
            </div>
        </div>
    </div>
  </div>
@endsection