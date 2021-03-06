<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\plan;
use Illuminate\Http\Request;

class SiteController extends Controller
{
  public function index()
  { 
    $plans = plan::with('details')->orderBy('price', 'ASC')->get(); // ordenar pelo plano
    //$plans = plan::with('details')->get();

      return view('site.pages.home.index', compact('plans'));
  }

  public function plan($url)
  {
    //$plan = plan::where('url', $url)->first()

    if(!$plan = plan::where('url', $url)->first()) {
      return redirect()-back();
    }

    session()->put('plan', $plan); // cria uma sessão com o plano selecionado

    return redirect()->route('register'); //redereciona para a view de register com o plano selecionado

  }
}
