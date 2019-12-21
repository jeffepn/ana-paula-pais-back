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
//Models
use App\Models\Immobile\ImageImmobile;

class ImmobileController extends Controller
{
    public function create(ImmobileService $immobileService)
    {
        return view('admin.immobiles.createimmobile', ['neighborhoods' => $immobileService->getAllNeighborhoodsSelectWithCity(), 'types' => SiteUtility::getTypesImmobile()]);
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
    public function edit(ImmobileService $immobileService, $slug)
    {
        $immobile = $immobileService->getWithSlug($slug);
        if ($immobile) {
            return view('admin.immobiles.editimmobile', ['immobile' => $immobile, 'neighborhoods' => $immobileService->getAllNeighborhoodsSelectWithCity(), 'types' => SiteUtility::getTypesImmobile()]);
        }
        return 'Imóvel não encontrado!!!';
    }
    public function update(Request $request, ImmobileService $immobileService)
    {
        $immobile = $immobileService->getWithSlug($request->slug);
        if (!$immobile) {
            return redirect()->back()->with('error', Util::error('SolicitationError'))->withInput($request->all());
        }
        $this->validate($request, $immobileService->getRules('edit', null), $immobileService->getMessages());

        // $immobile = $immobileService->create($request->all());
        ImageImmobile::where('immobile_id', $immobile->id)->delete();
        if ($immobile) {
            foreach ($request->image as $image) {
                $way = Upload::upload($image, time() . rand(1111, 9999), 'images/immobiles');
                if ($way) {
                    $immobileService->createImage($way, $immobile);
                }
            }
            return redirect()->back()->with('success', Util::success('EditImmobileSuccess'));
        }
        return redirect()->back()->with('error', Util::error('SolicitationError'))->withInput($request->all());
    }
}
