<?php

namespace App\Http\Controllers;

use App\CmsApplication;
use App\CmsPlugin;
use App\Library\PluginSystem\PluginScheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use ZipArchive;

class CmsPluginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $filter_value = $request->query('value');

        $sub_query = CmsPlugin::groupBy('vendor')->groupBy('package')->selectRaw('vendor, package, MAX(version) as last_version');
        $plugins_query = CmsPlugin::joinSub($sub_query, 'sub_query', function ($join) {
            $join->on('cms_plugins.vendor', '=', 'sub_query.vendor');
            $join->on('cms_plugins.package', '=', 'sub_query.package');
            $join->on('cms_plugins.version', '=', 'sub_query.last_version');
        });

        if ($filter && $filter_value) {
            $plugins_query->where([
                "cms_plugins.$filter" => $filter_value
            ]);
        }

        $plugins = $plugins_query->get();

        return view('cms_plugin.index', [
            'plugins' => $plugins,
            'filter' => $filter,
            'filter_value' => $filter_value,
        ]);
    }

    public function download(CmsPlugin $cmsPlugin)
    {
        return Storage::disk('public')->download("plugins/{$cmsPlugin->vendor}/{$cmsPlugin->package}/{$cmsPlugin->version}/{$cmsPlugin->package}.zip");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        return view('cms_plugin.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('file')->getMimeType() == 'application/zip') {
            $zip = new ZipArchive();
            $path = $request->file('file')->store('temp/plugins');
//            $file_path_prefix = env('APP_ENV') == 'testing' ? '' : 'app';
            $file_path_prefix = 'app';
            if (env('APP_ENV') == 'testing') {
                $file_path_prefix = 'framework'.DIRECTORY_SEPARATOR.'testing'.DIRECTORY_SEPARATOR.'disks'.DIRECTORY_SEPARATOR.'local';
            }
            $file_path = storage_path($file_path_prefix . DIRECTORY_SEPARATOR . $path);
            if ($zip->open($file_path) === true && $zip->getFromName('start.plugin.json') !== false) {
                $scheme = new PluginScheme($zip->getFromName('start.plugin.json'));
                $scheme->package = explode('.', $request->file('file')->getClientOriginalName())[0];
                $scheme->vendor = $request->user()->vendor_name;
                $zip->close();
                Storage::delete($path);

                $saved = false;
                $errorMessage = '';
                $sameRecordExists = CmsPlugin::where([
                    ['vendor', $scheme->vendor],
                    ['package', $scheme->package],
                    ['version', $scheme->version],
                ])->count() > 0;
                if ($scheme->validate() && !$sameRecordExists) {
                    $fileName = $request->file('file')->getClientOriginalName();
                    $path = $request->file('file')->storeAs("public/plugins/{$scheme->vendor}/{$scheme->package}/{$scheme->version}", $fileName);
                    if ($path === false) {
                        //TODO add logging
                    } else {
                        $plugin = new CmsPlugin();
                        $plugin->vendor = $scheme->vendor;
                        $plugin->package = $scheme->package;
                        $plugin->version = $scheme->version;
                        $saved = $plugin->save();
                    }
                } else {
                   if ($sameRecordExists) {
                       $errorMessage = 'Такая версия плагина уже существует';
                   }
                   if (!$scheme->validate()) {
                       $errorMessage = 'Схема плагина имеет ошибки';
                   }
                }
                return collect([
                    'scheme' => $scheme,
                    'valid' => $scheme->validate(),
                    'package' => $scheme->package,
                    'vendor' => $scheme->vendor,
                    'version' => $scheme->version,
                    'components' => $scheme->components,
                    'saved' => $saved,
                    'errorMessage' => $errorMessage,
                ])->toJson();
            } else {
                return collect([
                    'result' => false,
                    'message'=> 'can\'t open zip archive',
                    'path' => $path,
                ])->toJson();
            }
            Storage::delete($path);
        } else {
            return collect([
                'result' => false,
                'message'=> 'wrong mime type',
                'mime' => $request->file('file')->getMimeType(),
            ])->toJson();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CmsPlugin  $cmsPlugin
     * @return \Illuminate\Http\Response
     */
    public function show(CmsPlugin $cmsPlugin)
    {
        $apps = CmsApplication::where('user_id', Auth::user()->id)->get();
        return view('cms_plugin.show', [
            'plugin' => $cmsPlugin,
            'apps' => $apps,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CmsPlugin $cmsPlugin
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(CmsPlugin $cmsPlugin)
    {
        $cmsPlugin->delete();
        return redirect()->route('cms-plugins.index');
    }

    public function getPluginLatestVersion(Request $request)
    {
        $vendor = $request->input('vendor');
        $package = $request->input('package');

        $sub_query = CmsPlugin::groupBy('vendor')->groupBy('package')->selectRaw('vendor, package, MAX(version) as last_version');
        $plugin = CmsPlugin::joinSub($sub_query, 'sub_query', function ($join) {
            $join->on('cms_plugins.vendor', '=', 'sub_query.vendor');
            $join->on('cms_plugins.package', '=', 'sub_query.package');
            $join->on('cms_plugins.version', '=', 'sub_query.last_version');
        })->where([
            ['cms_plugins.vendor', $vendor],
            ['cms_plugins.package', $package],
        ])->first();

        $version = null;
        if ($plugin) {
            $version = $plugin->version;
        }
        return collect([
            'version' => $version,
        ])->toJson();
    }
}
