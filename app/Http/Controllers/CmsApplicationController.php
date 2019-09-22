<?php

namespace App\Http\Controllers;

use App\CmsApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CmsApplicationController extends Controller
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
        $apps = CmsApplication::where('user_id', Auth::user()->id)->get();
        return view('cms_application.index', [
            'apps' => $apps
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms_application.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('cms_applications')->where('user_id', $request->user()->id),
                'max:255',
            ],
            'url' => [
                'required',
                'url',
                Rule::unique('cms_applications')->where('user_id', $request->user()->id),
                'max:255',
            ],
        ]);

        $cmsApplication = new CmsApplication();
        $cmsApplication->fill($validatedData);
        $cmsApplication->user_id = $request->user()->id;

        $cmsApplication->save();

        return redirect()->route('cms-applications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CmsApplication  $cmsApplication
     * @return \Illuminate\Http\Response
     */
    public function show(CmsApplication $cmsApplication)
    {
        return view('cms_application.show', [
            'app' => $cmsApplication,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CmsApplication  $cmsApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(CmsApplication $cmsApplication)
    {
        return view('cms_application.edit', [
            'app' => $cmsApplication,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CmsApplication  $cmsApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CmsApplication $cmsApplication)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('cms_applications')->ignore($request->user()->id, 'user_id'),
                'max:255',
            ],
            'url' => [
                'required',
                'url',
                Rule::unique('cms_applications')->ignore($request->user()->id, 'user_id'),
                'max:255',
            ],
        ]);

        $cmsApplication->fill($validatedData);

        $cmsApplication->save();

        return redirect()->route('cms-applications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CmsApplication  $cmsApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsApplication $cmsApplication)
    {
        $cmsApplication->delete();
        return redirect()->route('cms-applications.index');
    }
}
