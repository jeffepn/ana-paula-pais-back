<div class="section-immobile">
    @if(!$immobile)
    <div class="text-center">
        <h1 class="mt-5">Imóvel não encontrado, ou não se encontra mais disponível.</h1>
        <a href="{{url()->previous()}}" class="bt--se ft-secoundary-big px-5 py-1 col-auto">Voltar</a>
    </div>
    @else

    @endif
</div>

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
