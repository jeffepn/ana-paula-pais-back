<?php

namespace App\Http\Controllers\Immobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//Service
use App\Services\ImmobileService;
//Utilities
use JpUtilities\Utilities\Upload;
use App\Utility\SiteUtility;
use JpUtilities\Utilities\Util;

class ImmobileController extends Controller
{
    public function create(ImmobileService $immobileService)
    {
        return view('admin.immobiles.createimmobile', ['neighborhoods' => $immobileService->getAllNeighborhoodsSelect(), 'types' => SiteUtility::getTypesImmobile()]);
    }
    public function store(Request $request, ImmobileService $immobileService)
    {

        $this->validate($request, $immobileService->getRules('create', null), $immobileService->getMessages());

        $immobile = $immobileService->create($request->all());
        if ($immobile) {
            foreach ($request->image as $image) {
                $way = Upload::upload($image, time() . rand(1111, 9999), 'images/immobiles');
                if ($way) {
                    $immobileService->createImage($way, $immobile);
                }
            }
            return redirect()->back()->with('success', Util::success('RegisterImmobileSuccess'));
        }
        return redirect()->back()->with('error', Util::error('SolicitationError'))->withInput($request->all());
    }
}