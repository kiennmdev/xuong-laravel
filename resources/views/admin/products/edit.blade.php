@extends('admin.layouts.master')

@section('title')
    Chỉnh sửa sản phẩm
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Chỉnh sửa sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form action="{{ route('admin.products.update', $productEdit->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin sản phẩm</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">

                                <div class="col-xxl-4 col-md-4">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $productEdit->name }}">
                                    </div>
                                    <div>
                                        <label for="sku" class="form-label">SKU</label>
                                        <input type="text" class="form-control" id="sku" name="sku"
                                            value="{{ $productEdit->sku }}">
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Price regular</label>
                                        <input type="number" class="form-control" id="name" name="price_regular"
                                            value="{{ $productEdit->price_regular }}">
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Price sale</label>
                                        <input type="number" class="form-control" id="name" name="price_sale"
                                            value="{{ $productEdit->price_sale }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="name" class="form-label">Catalogues</label>
                                        <select class="form-select" name="catalogue_id" id="name">
                                            @foreach ($catalogues as $id => $name)
                                                <option value="{{ $id }}"
                                                    @selected($productEdit->catalogue_id == $id)>
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Img thumbnail</label>
                                        <input type="file" class="form-control" id="name" name="img_thumbnail">
                                        <div style="height: 100%" class="pt-4">
                                            <img src="{{ \Storage::url($productEdit->img_thumbnail) }}" alt=""
                                                width="100%">
                                        </div>
                                    </div>

                                </div>
                                <!--end col-->
                                <div class="col-xxl-8 col-md-8">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-check form-switch form-switch-success">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="SwitchCheck2" name="is_active" value="1"
                                                    @checked($productEdit->is_active)>
                                                <label class="form-check-label" for="SwitchCheck2">Is Active</label>
                                            </div>

                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-switch form-switch-danger">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="SwitchCheck3" name="is_hot_deal" value="1"
                                                    @checked($productEdit->is_hot_deal)>
                                                <label class="form-check-label" for="SwitchCheck3">Is Hot Deal</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-switch form-switch-info">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="SwitchCheck3" name="is_good_deal" value="1"
                                                    @checked($productEdit->is_good_deal)>
                                                <label class="form-check-label" for="SwitchCheck3">Is Good Deal</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-switch form-switch-primary">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="SwitchCheck3" name="is_new" value="1"
                                                    @checked($productEdit->is_new)>
                                                <label class="form-check-label" for="SwitchCheck3">Is New</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-switch form-switch-warning">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="SwitchCheck3" name="is_show_home" value="1"
                                                    @checked($productEdit->is_show_home)>
                                                <label class="form-check-label" for="SwitchCheck3">Is Show Home</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" rows="2" name="description">{{ $productEdit->description }}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="material" class="form-label">Material</label>
                                            <textarea class="form-control" id="material" rows="2" name="material">{{ $productEdit->material }}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="user_manual" class="form-label">User manual</label>
                                            <textarea class="form-control" id="user_manual" rows="2" name="user_manual">{{ $productEdit->user_manual }}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" id="content" rows="2" name="content">{{ $productEdit->content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->

                            </div>
                            <!--end row-->
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>
                    </div><!-- end card header -->
                    <div class="card-body" style="height: 400px; overflow: scroll">
                        <div class="live-preview">
                            <div class="row gy-4">

                                <table>
                                    <tr>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Quantity</th>
                                        <th>Image</th>
                                        <th></th>
                                    </tr>

                                    @foreach ($sizes as $sizeID => $sizeName)
                                        @foreach ($colors as $colorID => $colorName)
                                            <tr>
                                                <td>{{ $sizeName }}</td>
                                                <td>
                                                    <div
                                                        style="width: 20px; height: 20px; background-color: {{ $colorName }}">
                                                    </div>
                                                </td>

                                                @php
                                                    $url = '';
                                                    $quantity = 0;
                                                    foreach ($productEdit->variants as $variant) {
                                                        if (
                                                            $variant->product_size_id == $sizeID &&
                                                            $variant->product_color_id == $colorID
                                                        ) {
                                                            $url = \Storage::url($variant->image);
                                                            $quantity = $variant->quantity;
                                                        }
                                                    }
                                                @endphp

                                                <td>
                                                    <input type="number"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]"
                                                        id="" value="{{ $quantity }}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="file"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][image]"
                                                        id="" class="form-control">
                                                </td>
                                                <td>
                                                    <img src="{{ $url }}" alt="" width="50px">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </table>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">List Galleries</h4>
                        <button type="button" class="btn btn-primary" id="addGallery">Thêm ảnh</button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="boxGalleryImg" style="overflow: scroll; height: 400px">

                                <div class="col-xxl-12 col-md-12 d-flex">
                                @foreach ($productEdit->galleries as $key => $gallery)
                                        <div class="mx-2">
                                            <div>
                                                <img class="mt-3 {{ $gallery->status == 0 ? 'opacity-50' : '' }}"
                                                    id="gallery_img_{{ $gallery->id }}"
                                                    src="{{ \Storage::url($gallery->image) }}" alt=""
                                                    width="100px">
                                                <!-- Custom Checkboxes Color -->
                                                <div class="form-check form-switch form-switch-secondary">
                                                    <input type="hidden"
                                                        name="product_galleries[edit-gallery][{{ $gallery->id }}]"
                                                        value="0">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="status_gallery_{{ $gallery->id }}"
                                                        onclick="changeStatus('{{ $gallery->id }}')" value="1"
                                                        name="product_galleries[edit-gallery][{{ $gallery->id }}]"
                                                        {{ $gallery->status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="status_gallery_{{ $gallery->id }}">Hiện/Ẩn</label>
                                                </div>
                                            </div>

                                        </div>
                                        @endforeach
                                    </div>


                                <!--end row-->
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>

            <!--end row-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tags</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">

                                <div class="col-xxl col-md">
                                    <div>
                                        <label for="tags" class="form-label">Tags</label>
                                        <select name="tags[]" id="tags" multiple class="form-select">
                                            @foreach ($tags as $id => $name)
                                                <option value="{{ $id }}"
                                                    @foreach ($productEdit->tags as $tag)
                                                            {{ $tag->pivot->tag_id == $id ? 'selected' : '' }} @endforeach>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>

            <!--end row-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>

            <!--end row-->
        </div>
    </form>
@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection

@section('scripts')
    <script>
        let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();

        let addGalleryBtn = document.getElementById('addGallery')

        addGalleryBtn.addEventListener('click', (e) => {

            let addGalleryElement = `<div id="box_${id}" class="col-xxl-4 col-md-4">
        
        <div>
            <label for="gallery_${id}" class="form-label">Image gallery</label>
            <div class="d-flex">
                <input type="file" class="form-control" id="gallery_${id}"
                name="product_galleries[]">
                <button type="button" class="btn btn-danger" onclick="removeGalleryImg('box_${id}')"><span class="bx bx-trash"></span></button>
            </div>
        </div>

    </div>`;

            let boxGalleryImg = document.getElementById('boxGalleryImg')

            $(boxGalleryImg).append(addGalleryElement);
        })

        function removeGalleryImg(param) {
            if (confirm('Bạn có muốn xóa không?')) {
                $(`#${param}`).remove()
            }
        }

        function changeStatus(id) {
            let image = document.getElementById(`gallery_img_${id}`);

            let checkbox = document.getElementById(`status_gallery_${id}`);

            if (checkbox.checked && $(image).hasClass('opacity-50')) {
                // image.classList.add("opacity-50");
                $(image).removeClass("opacity-50");
            } else {
                // image.classList.remove("opacity-50");
                $(image).addClass("opacity-50");
            }

        }
    </script>
@endsection
