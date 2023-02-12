<?php

namespace App\Http\Controllers;

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
}
