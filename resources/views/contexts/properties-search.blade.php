@include('parts.search')
<section class="section-view-all-properties">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if($properties->isEmpty())
                <h3>Nenhum imóvel encontrado</h3>
                @else
                <h3>{{$properties->total()}} imóveis encontrado(s)</h3>
                @endif
            </div>
            @each('contexts.view-property-default', $properties, 'propertyView')
            <div class="col-12">
                {{$properties->links()}}
            </div>
        </div>
    </div>
</section>
