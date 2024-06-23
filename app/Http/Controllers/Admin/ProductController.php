<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    const PATH_VIEW = 'admin.products.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $catalogue = Catalogue::query()->first();
        // dd($catalogue->product);
        $data = Product::query()->with(['catalogue', 'tags'])->latest('id')->get();
        // dd($data->first()->toArray());
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catalogues = Catalogue::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('catalogues','colors', 'sizes', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $dataProduct = $request->except('product_variants', 'tags', 'product_galleries');
        // dd($dataProduct);
        $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($dataProduct['is_hot_deal']) ? 1 : 0;
        $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
        $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];
        if($dataProduct['img_thumbnail']) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }

        $dataProductVariantsTMP = $request->product_variants;
        $dataProductVariants = [];
        foreach($dataProductVariantsTMP as $key => $item) {

            $tmp = explode('-', $key);

            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
                'image' => $item['image'] ?? null
            ];

        }

        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->product_galleries ?: [];

        //Sử dụng try-catch để dùng cho sql transaction
        try {
            DB::beginTransaction();

            /** @var Product $product */ 
            $product = Product::query()->create($dataProduct);

            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_id'] = $product->id;
                if($dataProductVariant['image']) {
                    $dataProductVariant['image'] = Storage::put('products', $dataProductVariant['image']);
                }

                ProductVariant::query()->create($dataProductVariant);
            }

            $product->tags()->sync($dataProductTags);

            foreach($dataProductGalleries as $image) {
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => Storage::put('products', $image)
                ]);
            }

            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // dd($product->galleries());
        
        try {
            DB::transaction(function() use ($product) {
                $product->tags()->sync([]);
                $product->galleries()->delete();
                $product->variants()->delete();
                $product->delete();
            }, 3);

        } catch (\Exception $exception) {
            return back();
        }
    }
}
