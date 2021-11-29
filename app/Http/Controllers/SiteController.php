<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Models
use App\Models\Site\Newsletter;
//Services
use App\Services\PropertyService;
//Utilities
use App\Utility\SiteUtility;
use JpUtilities\Utilities\Util;
//Job
use App\Jobs\Contact\ContactJob;
use App\Utility\MessageUtil;

class SiteController extends Controller
{
    public function prelaunch()
    {
        return view('pre-launch');
    }
    //Site
    public function home(PropertyService $propertyService)
    {
        return view('home', ['properties' => $propertyService->getOrderByVisits(6)]);
    }
    public function teste(PropertyService $propertyService)
    {
        // return date('H:i:s');
        return view('teste');
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

    public function enterprise($slug)
    {
        switch ($slug) {
            case 'reserva111':
                return view('enterprises.reserva111-vital');
            case 'blue-park':
                return view('enterprises.blue-park-vital');
            case 'unique':
                return view('enterprises.unique-vital');
            case 'chateau-de-versailles':
                return view('enterprises.chateau-vital');
            case 'easy':
                return view('enterprises.easy-vital');
            case 'green-park':
                return view('enterprises.green-park-vital');
            case 'lumiere':
                return view('enterprises.lumiere-vital');
            case 'zeuz':
                return view('enterprises.zeuz-vogo');
            case 'meditterraneum':
                return view('enterprises.meditterraneum-elos');
            case 'sorano':
                return view('enterprises.sorano-elos');
            default:
                return view('errors.404');
        }
    }
    public function blue()
    {
        return view('enterprises.blue-park-vital');
    }
    public function chateau()
    {
        return view('enterprises.chateau-vital');
    }
    public function easy()
    {
        return view('enterprises.easy-vital');
    }
    public function green()
    {
        return view('enterprises.green-park-vital');
    }
    public function lumiere()
    {
        return view('enterprises.lumiere-vital');
    }
    public function unique()
    {
        return view('enterprises.unique-vital');
    }

    public function enterprises()
    {
        return view('enterprises.enterprises');
    }
    public function sendcontact(Request $request)
    {
        $validator = validator()->make(
            $request->all(),
            [
                'name' => 'required|max:50',
                'email' => 'required|email|max:300',
                'phone' => 'max:20',
                'message' => 'required|max:300',
            ],
            [
                'max' => 'Limite o campo a :max caracteres.',
                'name.required' => 'Como podemos te chamar',
                'name.max' => 'Que nome grande hein... Limite ele a 50 caracteres.',
                'email.email' => 'Formato de e-mail inválido.',
                'email.required' => 'Precisamos saber seu e-mail, para que possamos entrar em contato.',
                'message.required' => 'Descreva em poucas palavras: sua dúvida, mensagem ou sugestão.'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'contact');
        }
        ContactJob::dispatch($request->all());
        return redirect()->back()->with('successcontact', MessageUtil::success('ContactSuccess'));
    }

    public function newsletter(Request $request)
    {
        $validator = validator()->make(
            $request->all(),
            [
                'name' => 'required|max:50',
                'email' => 'required|email|unique:newsletters|max:300'
            ],
            [
                'max' => 'Limite o campo a :max caracteres.',
                'name.required' => 'Como podemos te chamar',
                'name.max' => 'Que nome grande hein... Limite ele a 50 caracteres.',
                'email.unique' => 'Você já está cadastrado em nossa Newsletter.',
                'email.email' => 'Formato de e-mail inválido.',
                'email.required' => 'Precisamos saber seu e-mail, para que possamos enviar nossos boletos informativos.'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'newsletter');
        }
        Newsletter::create($request->all());
        return redirect()->back()->with('successnewsletter', MessageUtil::success('NewsletterSuccess'));
    }
    //Immobiles
    public function searchProperties(PropertyService $propertyService)
    {
        if (!session()->has('search_immobile')) {
            SiteUtility::initializeSessionSearch();
        }
        $search = session('search_immobile');
        return view('properties-search', [
            'bussiness' => SiteUtility::getBussiness(),
            'neighborhoods' => $propertyService->getAllNeighborhoodsSelectWithCity(),
            'types' => SiteUtility::getTypesImmobile(),
            'properties' => $propertyService->getAllPerSearch($search)
        ]);
    }
    public function searchPropertyCode(Request $request)
    {
        return redirect()->to('imovel/' . $request->code);
    }
    public function setSessionSearch(Request $request)
    {
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
        return redirect()->back();
    }
    public function property(PropertyService $propertyService, $slug = null)
    {
        $property = $propertyService->getWithSlug($slug);
        if (!$property) {
            return view('property', ['propertyChain' => null]);
        }
        // $propertyService->registerVisit($property->id, request()->ip());
        return view('property', ['propertyChain' => $property, 'properties' => $propertyService->getSimilarImmobiles($property, 3)]);
    }


    //Generator

    public function searchPropertiesRent(PropertyService $propertyService)
    {
        SiteUtility::initializeSessionSearch();
        return view('properties-search', ['bussiness' => SiteUtility::getBussiness(), 'neighborhoods' => $propertyService->getallNeighborhoodsSelect(), 'types' => SiteUtility::getTypesImmobile(), 'properties' => $propertyService->getAllRent()]);
    }

    public function searchPropertiesSale(PropertyService $propertyService)
    {
        SiteUtility::initializeSessionSearch();
        return view('properties-search', ['bussiness' => SiteUtility::getBussiness(), 'neighborhoods' => $propertyService->getallNeighborhoodsSelect(), 'types' => SiteUtility::getTypesImmobile(), 'properties' => $propertyService->getAllSale()]);
    }
}
