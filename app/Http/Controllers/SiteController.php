<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Services
use App\Services\ImmobileService;
//Utilities
use App\Utility\SiteUtility;

class SiteController extends Controller
{
    public function prelaunch()
    {
        return view('pre-launch');
    }
    public function home()
    {
        return view('home');
    }
    public function searchimmobiles(ImmobileService $immobileService)
    {
        if (!session()->has('search_immobile')) {
            SiteUtility::initializeSessionSearch();
        }
        $search = session('search_immobile');
        //return $search;
        return view('immobiles-search', ['bussiness' => SiteUtility::getBussiness(), 'neighborhoods' => $immobileService->getallNeighborhoodsSelect(), 'types' => SiteUtility::getTypesImmobile(), 'immobiles' => $immobileService->getAllPerSearch($search)]);
    }
    public function setsessionsearch(Request $request)
    {
        //return $request->all();
        if (!session()->has('search_immobile')) {
            SiteUtility::initializeSessionSearch();
        }
        session()->put('search_immobile', [
            'bussiness' => $request->bussiness,
            'neighborhood' => $request->neighborhood,
            'type' => $request->type,
            'garage' => $request->garage,
            'dormitory' => $request->dormitory,
            'price_min' => $request->price_min,
            'price_max' => $request->price_max,
            'area_min' => $request->area_min,
            'area_max' => $request->area_max
        ]);
        //return session('search_immobile');
        return redirect()->to('busca-de-imoveis');
    }
    public function immobile(ImmobileService $immobileService, $slug)
    {
        $immobile = $immobileService->getWithSlug($slug);
        return view('immobile', ['immobile' => $immobile]);
    }
}