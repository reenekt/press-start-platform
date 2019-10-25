<?php

namespace App\Http\Controllers;

use App\CmsApplication;
use App\CmsPlugin;
use App\Http\Resources\CmsPluginCollection;
use App\Library\PluginSystem\PluginScheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use ZipArchive;

class CmsPluginApiController extends Controller
{
    public function indexJson(Request $request)
    {
        $filter_vendor = $request->query('vendor');
        $filter_package = $request->query('package');
        $page = $request->query('page');
        $perPage = $request->query('perPage', 10);

        $sub_query = CmsPlugin::groupBy('vendor')->groupBy('package')->selectRaw('vendor, package, MAX(version) as last_version');
        $plugins_query = CmsPlugin::joinSub($sub_query, 'sub_query', function ($join) {
            $join->on('cms_plugins.vendor', '=', 'sub_query.vendor');
            $join->on('cms_plugins.package', '=', 'sub_query.package');
            $join->on('cms_plugins.version', '=', 'sub_query.last_version');
        });

        if ($filter_vendor) {
            $plugins_query->where([
                ["cms_plugins.vendor", 'like', "%{$filter_vendor}%"]
            ]);
        }
        if ($filter_package) {
            $plugins_query->where([
                ["cms_plugins.package", 'like', "%{$filter_package}%"]
            ]);
        }

//        $pluginsTotal = $plugins_query->count();
        if ($perPage != -1) {
            $plugins = $plugins_query->paginate($perPage);
        } else {
            $plugins = $plugins_query->paginate(1000);
        }

        return new CmsPluginCollection($plugins);
    }
}
