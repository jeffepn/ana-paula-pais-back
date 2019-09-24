<?php

namespace App\Http\Controllers;

use App\Utility\SiteUtility;
//Services
use Illuminate\Http\Request;
//Utilities
use App\Services\ImmobileService;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function prelaunch()
    {
        return view('pre-launch');
    }
    //Site
    public function home(ImmobileService $immobileService)
    {
        return view('home', ['immobileshighlights' => $immobileService->getOrderByVisits(6)]);
    }
    public function services()
    {
        return view('services');
    }
    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }
    public function sendcontact()
    {
        return redirect()->back();
    }

    public function newsletter()
    {
        return redirect()->back();
    }
    //Immobiles
    public function searchimmobiles(ImmobileService $immobileService)
    {
        if (!session()->has('search_immobile')) {
            SiteUtility::initializeSessionSearch();
        }
        $search = session('search_immobile');
        //return $search;
        //return $immobileService->getAllPerSearch($search);
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
        // return session('search_immobile');
        return redirect()->back();
    }
    public function immobile(ImmobileService $immobileService, $slug)
    {
        $immobile = $immobileService->getWithSlug($slug);
        return view('immobile', ['immobile' => $immobile, 'immobiles' => $immobileService->getOrderByVisits(3)]);
    }
}