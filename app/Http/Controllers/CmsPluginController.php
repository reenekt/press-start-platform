<?php

namespace App\Http\Controllers;

use App\CmsApplication;
use App\CmsPlugin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CmsPluginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plugins = CmsPlugin::all();
        return view('cms_plugin.index', [
            'plugins' => $plugins
        ]);
    }

    public function download(CmsPlugin $cmsPlugin)
    {
        return Storage::disk('public')->download("plugins/$cmsPlugin->vendor/$cmsPlugin->package/$cmsPlugin->short_name.zip");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('cms_plugin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $validatedData = $request->validate([
//            'name' => [
//                'required',
//                'string',
//                Rule::unique('cms_plugins')->where('user_id', $request->user()->id),
//                'max:255',
//            ],
//            'url' => [
//                'required',
//                'url',
//                Rule::unique('cms_plugins')->where('user_id', $request->user()->id),
//                'max:255',
//            ],
//        ]);
//
//        $cmsApplication = new CmsApplication();
//        $cmsApplication->fill($validatedData);
//        $cmsApplication->user_id = $request->user()->id;
//
//        $cmsApplication->save();
//
//        return redirect()->route('cms-applications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CmsPlugin  $cmsPlugin
     * @return \Illuminate\Http\Response
     */
    public function show(CmsPlugin $cmsPlugin)
    {
//        return view('cms_plugin.show', [
//            'app' => $cmsApplication,
//        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CmsPlugin  $cmsPlugin
     * @return \Illuminate\Http\Response
     */
    public function edit(CmsPlugin $cmsPlugin)
    {
//        return view('cms_plugin.edit', [
//            'app' => $cmsApplication,
//        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CmsPlugin  $cmsPlugin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CmsPlugin $cmsPlugin)
    {
//        $validatedData = $request->validate([
//            'name' => [
//                'required',
//                'string',
//                Rule::unique('cms_plugins')->ignore($request->user()->id, 'user_id'),
//                'max:255',
//            ],
//            'url' => [
//                'required',
//                'url',
//                Rule::unique('cms_plugins')->ignore($request->user()->id, 'user_id'),
//                'max:255',
//            ],
//        ]);
//
//        $cmsApplication->fill($validatedData);
//
//        $cmsApplication->save();
//
//        return redirect()->route('cms-applications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CmsPlugin  $cmsPlugin
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsPlugin $cmsPlugin)
    {
//        $cmsApplication->delete();
//        return redirect()->route('cms-applications.index');
    }
}
