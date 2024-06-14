@extends('admin.layouts.master')

@section('title')
    Thêm mới danh mục
@endsection

@section('content')
    <form action="{{route('admin.catalogues.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">File:</label>
            <input type="file" class="form-control" id="cover" name="cover">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="is_active" checked>
            <label class="form-check-label" for="exampleCheck1">Is active</label>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
