<?php

namespace App\Http\Controllers\Admin;

use App\Models\Immobile\Immobile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JpUtilities\Utilities\Util;
use App\Http\Requests\ImmobileRequest;
use App\Models\Address\Neighborhood;
use JpUtilities\Utilities\Upload;
use App\Utility\SiteUtility;

class ImmobilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.realstate.index", ["immobiles" => Immobile::latest()->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.realstate.create", [
            "neighborhoods" => Neighborhood::all(),
            "types" => SiteUtility::getTypesImmobile()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ImmobileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImmobileRequest $request)
    {
        if ($immobile = Immobile::create($request->all())) {
            foreach ($request->image as $image) {
                $way = Upload::upload($image, time() . rand(1111, 9999), 'images/immobiles');
                if ($way)
                    $immobile->images()->create(['way' => $way, 'alt' => SiteUtility::getTypesImmobile()[$immobile->type] . ' ' . $immobile->neighborhood->name . ' , ' . $immobile->neighborhood->city->name . ' - Imóveis Ana Paula Pais']);
            }
            return redirect()->back()->with('success', Util::success('RegisterImmobileSuccess'))->with("url", url("imovel/" . $immobile->slug));
        }
        return redirect()->back()->with('error', Util::error('SolicitationError'))->withInput($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Immobile\Immobile  $immobile
     * @return \Illuminate\Http\Response
     */
    public function show(Immobile $immobile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Immobile\Immobile  $immobile
     * @return \Illuminate\Http\Response
     */
    public function edit(Immobile $immobile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Immobile\Immobile  $immobile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Immobile $immobile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Immobile\Immobile  $immobile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Immobile $immobile)
    {
        //
    }
}
