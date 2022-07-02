<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShorturlRequest;
use App\Models\Shorturl;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    public function index()
    {
        $results = Shorturl::all();

        return Inertia::render('Welcome', [
            'results' => $results
        ]);
    }

    public function create()
    {
        return Inertia::render('Create');
    }

    public function store(ShorturlRequest $request)
    {
        $data = [
            'client' => [
                'clientId' => 'yourcompanyname',
                'clientVersion' => '1.5.2',
            ],
            'threatInfo' =>  [
                'threatTypes' => [
                    0 => 'MALWARE',
                    1 => 'SOCIAL_ENGINEERING',
                ],
                'platformTypes' => [
                    0 => 'WINDOWS',
                ],
                'threatEntryTypes' => [
                    0 => 'URL'
                ],
                'threatEntries' => [
                    0 => [
                        'url' => $request->post('url'),
                    ]
                ],
            ],
        ];
        // dd(config('services.google.api_key'), config('services.google.safe_browsing.client_id'), $request->all());

        $response = Http::post('https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . config('services.google.api_key'), $data);

        if($response->status() == 200):
            $result = Shorturl::create([
                'url' => $request->post('url'),
            ]);

            $result->hash = DB::table('shorturls')
                        ->whereRaw('"hash" NOT IN (SELECT hash FROM shorturls WHERE hash IS NOT NULL)')
                        ->selectRaw('lpad(conv(floor(rand()*pow(36,8)), 10, 36), 6, 0) AS hash')
                        ->first()
                        ->hash;

            $result->update();

            return redirect()->route('home')->with('flash', [
                'type' => 'success',
                'message' => 'URL sucessfully created!'
            ]);
        else:
            return redirect()->route('create')->with('flash', [
                'type' => 'error',
                'message' => 'URL not safe!'
            ]);
        endif;
    }

    public function checkHash($hash)
    {
        $result = Shorturl::where('hash', $hash)->firstOrFail();

        if(str_contains(url()->previous(), $hash)):
            return redirect()->away($result->url);
        else:
            return response('', 409)
                ->header('X-Inertia-Location', $result->url);
        endif;
    }
}
