<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{

    const PATH_VIEW = 'admin.banners.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Banner::query()->latest('id')->paginate(9);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('image')) {
            $data['image'] = Storage::put('banners', $data['image']);
        }

        $banner = Banner::query()->create($data);

        return redirect()->route(self::PATH_VIEW . 'index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $data = $request->all();

        $oldImage = $banner->image;

        if($request->hasFile('image')) {
            $data['image'] = Storage::put('banners', $data['image']);
        }

        $banner->update($data);

        Storage::delete($oldImage);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        Storage::delete($banner->image);

        return back();
    }
}
