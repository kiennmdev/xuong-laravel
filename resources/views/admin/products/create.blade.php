@extends('admin.layouts.master')

@section('title')
    Thêm mới sản phẩm
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
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
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div>
                                        <label for="sku" class="form-label">SKU</label>
                                        <input type="text" class="form-control" id="sku" name="sku"
                                            value="{{ \Str::random(8) }}">
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Price regular</label>
                                        <input type="number" class="form-control" id="name" name="price_regular"
                                            value="0">
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Price sale</label>
                                        <input type="number" class="form-control" id="name" name="price_sale"
                                            value="0">
                                    </div>
                                    <div class="mt-3">
                                        <label for="name" class="form-label">Catalogues</label>
                                        <select class="form-select" name="catalogue_id" id="name">
                                            @foreach ($catalogues as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">Img thumbnail</label>
                                        <input type="file" class="form-control" id="name" name="img_thumbnail">
                                    </div>

                                </div>
                                <!--end col-->
                                <div class="col-xxl-8 col-md-8">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-check form-switch form-switch-success">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="SwitchCheck2" checked name="is_active" value="1">
                                                <label class="form-check-label" for="SwitchCheck2">Is Active</label>
                                            </div>

                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-switch form-switch-danger">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="SwitchCheck3" name="is_hot_deal" checked value="1">
                                                <label class="form-check-label" for="SwitchCheck3">Is Hot Deal</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-switch form-switch-info">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="SwitchCheck3" name="is_good_deal" checked value="1">
                                                <label class="form-check-label" for="SwitchCheck3">Is Good Deal</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-switch form-switch-primary">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="SwitchCheck3" name="is_new" checked value="1">
                                                <label class="form-check-label" for="SwitchCheck3">Is New</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-switch form-switch-warning">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="SwitchCheck3" name="is_show_home" checked value="1">
                                                <label class="form-check-label" for="SwitchCheck3">Is Show Home</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" rows="2" name="description"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="material" class="form-label">Material</label>
                                            <textarea class="form-control" id="material" rows="2" name="material"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="user_manual" class="form-label">User manual</label>
                                            <textarea class="form-control" id="user_manual" rows="2" name="user_manual"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" id="content" rows="2" name="content"></textarea>
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
                    <div class="card-body" style="height: 300px; overflow: scroll">
                        <div class="live-preview">
                            <div class="row gy-4">

                                <table>
                                    <tr>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Quantity</th>
                                        <th>Image</th>
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
                                                <td>
                                                    <input type="number"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]"
                                                        id="" value="100" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="file"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][image]"
                                                        id="" class="form-control">
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
                        <h4 class="card-title mb-0 flex-grow-1">Galleries</h4>
                        <button type="button" class="btn btn-primary" id="addGallery">Thêm ảnh</button>
                    </div>
                    <!-- end card header -->

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="boxGalleryImg">

                                <div class="col-xxl-4 col-md-4">

                                    <div>
                                        <label for="gallery_1" class="form-label">Image gallery</label>
                                        <input type="file" class="form-control" id="gallery_1"
                                            name="product_galleries[]">
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
                                                <option value="{{ $id }}">{{ $name }}</option>
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
                        <button type="submit" class="btn btn-success">Thêm Mới</button>
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
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('content');

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
            if(confirm('Bạn có muốn xóa không?')) {
                $(`#${param}`).remove()
            }
        }

    </script>
@endsection
