@include('parts.search')
<section class="section-view-all-immobiles">
    <div class="row">
        <div class="col-12">
            @if($immobiles->isEmpty())
            <h3>Nenhum imóvel encontrado</h3>
            @else
            <h3>{{$immobiles->total()}} imóveis encontrado(s)</h3>
            @endif
        </div>
        @foreach($immobiles as $immobile)
        @include('contexts.view-immobile-default',['immobileview'=>$immobile])
        @endforeach
        <div class="col-12">
            {{-- {{$immobiles->links()}} --}}
        </div>
    </div>
</section>
@section('js-util')
@parent
$('.selectpicker').selectpicker();

$('.carrousel-owl').owlCarousel({
loop: true,
autoplay: true,
autoplayHoverPause:true,
dots: false,
responsiveClass: true,
responsive:{
0:{
items:1,
nav: true
}
}
});
@endsection
