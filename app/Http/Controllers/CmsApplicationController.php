<?php

namespace App\Http\Controllers;

use App\CmsApplication;
use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client as HttpClient;

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
        // region Проверка ключа приложния
        $url = $request->input('url');
        $url = rtrim($url,"/");
        $client = new HttpClient();
        $response = $client->post( $url . '/api/platform-connect', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'key' => $request->input('app_key')
            ]
        ]);
        if ($response->getStatusCode() !== 200) {
            $validator = Validator::make([
                'app_key' => ''
            ], [
                'app_key' => [
                    function ($attribute, $value, $fail) {
                        $fail(__('Не удается проверить правильность ключа'));
                    },
                ]
            ]);
            $validator->validate();
            $validator->errors()->add('app_key', 'Не удается проверить правильность ключа');
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $key_check_result = json_decode($response->getBody()->getContents(), true);
        if ($key_check_result['result'] != true)
        {
            $validator = Validator::make([
                'app_key' => ''
            ], [
                'app_key' => [
                    function ($attribute, $value, $fail) {
                        $fail(__('Неверный ключ CMS'));
                    },
                ]
            ]);
            $validator->validate();
            $validator->errors()->add('app_key', 'Неверный ключ CMS');
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        // endregion

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
            'app_key' => [
                'required',
                'string',
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
