<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site\Newsletter;
use App\Services\PropertyService;
use App\Utility\SiteUtility;
use App\Jobs\Contact\ContactJob;
use App\Services\SearchService;
use App\Utility\MessageUtil;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Jeffpereira\RealEstate\Models\Property\Property;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function home()
    {
        return view('home', ['properties' => Property::take(6)->get()]);
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
        return redirect()
            ->back()
            ->with('successcontact', MessageUtil::success('ContactSuccess'));
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
        return redirect()
            ->back()
            ->with('successnewsletter', MessageUtil::success('NewsletterSuccess'));
    }

    public function searchProperties(
        PropertyService $propertyService,
        SearchService $searchService
    ) {
        if (!session()->has('search_property')) {
            SiteUtility::initializeSessionSearch();
        }
        $search = session('search_property');
        return view('properties-search', [
            'businesses' => $searchService->getBusinesses(),
            'neighborhoods' => $searchService->getNeighborhoods(),
            'types' => $searchService->getSubtypes(),
            'properties' => $propertyService->getAllPerSearch($search)
        ]);
    }
    public function searchPropertyCode(Request $request)
    {
        return redirect()->to('imovel/' . $request->code);
    }
    public function setSessionSearch(Request $request)
    {
        if (!session()->has('search_property')) {
            SiteUtility::initializeSessionSearch();
        }
        session()->put('search_property', [
            'business' => $request->business,
            'neighborhood' => $request->neighborhood,
            'type' => $request->type,
            'garage' => $request->garage,
            'dormitory' => $request->dormitory,
            'price_min' => $request->price_min,
            'price_max' => $request->price_max,
            'area_min' => $request->area_min,
            'area_max' => $request->area_max
        ]);
        return redirect()->to(route('property.search_properties'));
    }
    public function property(PropertyService $propertyService, $slug = null)
    {
        try {
            $property = Property::where(
                'code',
                Str::replaceFirst("AN-", "", Str::upper($slug))
            )
                ->whereActive(true)
                ->firstOrFail();
            return view('property', [
                'propertyChain' => $property,
                'properties' => $propertyService
                    ->getSimilarProperties($property, 3)
            ]);
        } catch (ModelNotFoundException $th) {
            return view('property', ['propertyChain' => null]);
        }
    }
}
