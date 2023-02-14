<?php

namespace App\Http\Controllers;

use DOMDocument;
use App\Models\Bidding;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function index()
    {
        $biddings = Bidding::paginate(20);
        return view('home', compact('biddings'));
    }

    public function refresh()
    {
        Artisan::call('bidding:parse');
        return redirect(route('home'));
    }

    public function show(Bidding $bidding)
    {
        if (is_null($bidding->details)) {
            libxml_use_internal_errors(true);
            $dom = new DOMDocument;
            $dom->loadHTMLFile("https://etp.kartoteka.ru/trade/view/purchase/general.html?id={$bidding->external_id}");
            $info = $dom->getElementById('info');
            $bidding->update([
                'details' => $dom->saveHtml($info->childNodes->item(1))
            ]);
        }
        return view('show', compact('bidding'));
    }
}
