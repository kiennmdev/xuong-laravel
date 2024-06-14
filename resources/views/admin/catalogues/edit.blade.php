@extends('admin.layouts.master')

@section('title')
    Cập nhật danh mục: {{$model->name}}
@endsection

@section('content')
    <form action="{{route('admin.catalogues.update', $model->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{$model->name}}">
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">File:</label>
            <input type="file" class="form-control" id="cover" name="cover">
            <img src="{{\Storage::url($model->cover)}}" alt="" width="100px">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="is_active" @if ($model->is_active)
                checked
            @endif>
            <label class="form-check-label" for="exampleCheck1">Is active</label>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
