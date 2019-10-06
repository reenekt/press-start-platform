<?php

namespace App\Http\Controllers;

use App\CmsApplication;
use App\CmsPlugin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $apps = CmsApplication::where('user_id', Auth::user()->id)->get();

        $sub_query = CmsPlugin::groupBy('vendor')->groupBy('package')->selectRaw('vendor, package, MAX(version) as last_version');
        $plugins = CmsPlugin::joinSub($sub_query, 'sub_query', function ($join) {
            $join->on('cms_plugins.vendor', '=', 'sub_query.vendor');
            $join->on('cms_plugins.package', '=', 'sub_query.package');
            $join->on('cms_plugins.version', '=', 'sub_query.last_version');
        })->get();

        return view('home', [
            'apps' => $apps,
            'plugins' => $plugins,
        ]);
    }

    public function profile()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('profile', [
            'user' => $user
        ]);
    }

    public function profileSave(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->fill($request->all());
        $saveResult = $user->save();
        if (!$request->expectsJson()) {
            return redirect()->route('profile');
        } else {
            return response()->json([
                'result' => $saveResult,
                'user' => $user->toArray()
            ]);
        }
    }
}
