<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Models
use App\Models\Site\Newsletter;
//Services
use App\Services\ImmobileService;
//Utilities
use App\Utility\SiteUtility;
use JpUtilities\Utilities\Util;
//Job
use App\Jobs\Contact\ContactJob;

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
    public function teste(ImmobileService $immobileService)
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
            case 'blue-park':
                //return redirect()->to('/');
                return view('enterprises.blue-park-vital');
                break;
            case 'unique':
                //  return redirect()->to('/');
                return view('enterprises.unique-vital');
                break;
            case 'chateau-de-versailles':
                //return redirect()->to('/');
                return view('enterprises.chateau-vital');
                break;
            case 'easy':
                //   return redirect()->to('/');
                return view('enterprises.easy-vital');
                break;
            case 'green-park':
                //  return redirect()->to('/');
                return view('enterprises.green-park-vital');
                break;
            case 'lumiere':
                // return redirect()->to('/');
                return view('enterprises.lumiere-vital');
                break;
            case 'zeuz':
                return view('enterprises.zeuz-vogo');
                break;
            case 'meditterraneum':
                return view('enterprises.meditterraneum-elos');
                break;
            case 'sorano':
                return view('enterprises.sorano-elos');
                break;
            default:
                return view('errors.404');
                break;
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
        return redirect()->back()->with('successcontact', Util::success('ContactSuccess'));
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
        return redirect()->back()->with('successnewsletter', Util::success('NewsletterSuccess'));
    }
    //Immobiles
    public function searchimmobiles(ImmobileService $immobileService)
    {
        if (!session()->has('search_immobile')) {
            SiteUtility::initializeSessionSearch();
        }
        $search = session('search_immobile');
        return view('immobiles-search', ['bussiness' => SiteUtility::getBussiness(), 'neighborhoods' => $immobileService->getAllNeighborhoodsSelectWithCity(), 'types' => SiteUtility::getTypesImmobile(), 'immobiles' => $immobileService->getAllPerSearch($search)]);
    }
    public function searchimmobilecode(Request $request)
    {
        return redirect()->to('imovel/' . $request->code);
    }
    public function setsessionsearch(Request $request)
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
    public function immobile(ImmobileService $immobileService, $slug = null)
    {
        $immobile = $immobileService->getWithSlug($slug);
        if (!$immobile) {
            return view('immobile', ['immobile' => null]);
        }
        $immobileService->registerVisit($immobile->id, request()->ip());
        return view('immobile', ['immobilechain' => $immobile, 'immobiles' => $immobileService->getSimilarImmobiles($immobile, 3)]);
    }


    //Generator

    public function searchimmobilesrent(ImmobileService $immobileService)
    {
        SiteUtility::initializeSessionSearch();
        return view('immobiles-search', ['bussiness' => SiteUtility::getBussiness(), 'neighborhoods' => $immobileService->getallNeighborhoodsSelect(), 'types' => SiteUtility::getTypesImmobile(), 'immobiles' => $immobileService->getAllRent()]);
    }

    public function searchimmobilessale(ImmobileService $immobileService)
    {
        SiteUtility::initializeSessionSearch();
        return view('immobiles-search', ['bussiness' => SiteUtility::getBussiness(), 'neighborhoods' => $immobileService->getallNeighborhoodsSelect(), 'types' => SiteUtility::getTypesImmobile(), 'immobiles' => $immobileService->getAllSale()]);
    }
}