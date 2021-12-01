<div class="section-clients py-5">
    <div class="content-clients">
        <h1>
            O que estão falando sobre o meu trabalho
        </h1>
        <div id="carrousel-clients" class="owl-carousel owl-theme owl-loaded carrousel-owl">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    <div class="owl-item px-2">
                        <div class="item-depoiment">
                            <div class="container">
                                <h3>
                                    Renata Santucci<br>
                                    Propagandista
                                </h3>
                                <p>
                                    Falar da Ana Paula é um privilégio! Uma profissional totalmente diferenciada que
                                    consegue escutar e compreender seus clientes.<br>
                                    Trazendo o empreendimento correto que
                                    sempre buscamos dentro do que foi conversado.<br>
                                    Ana Paula você é uma profissional (Sensacional)
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item px-2">
                        <div class="item-depoiment">
                            <h3>
                                Cylmara Lacerda Gontijo<br>
                                Psicóloga e Professora na PUC Poços
                            </h3>
                            <p>
                                Foi um prazer negociar com a Ana Paula, pessoa atenciosa, muito educada e gentil.<br>
                                Me passou todas as informações do imóvel com clareza e objetividade, foi também muito
                                paciente para esclarecer todas as minhas dúvidas.<br>
                                Com certeza vou continuar contando com seus serviços, excelente profissional.
                            </p>
                        </div>
                    </div>
                    <div class="owl-item px-2">
                        <div class="item-depoiment">
                            <h3>
                                Eliana Barbosa<br>
                                Aposentada
                            </h3>
                            <p>
                                Olá pessoal, estou falando sobre esta corretora de imóveis Ana Paula, que para mim
                                sempre
                                foi uma pessoa exemplar, atenciosa, prestativa e muitas outras qualidades quem nem tenho
                                como descrever.<br>
                                Comprei um imóvel a qual ela estava vendendo, fiquei muito feliz,
                                recomendo a Ana Paula para atender vocês que estão interessados.<br>
                                Atenciosamente Eliana.
                            </p>
                        </div>
                    </div>
                    <div class="owl-item px-2">
                        <div class="item-depoiment">
                            <h3>
                                Regina Cioffi<br>
                                Médica pediatra
                            </h3>
                            <p>
                                Conheci Ana Paula em uma oportunidade de investimento apresentado por ela em
                                2017.<br>
                                Qualidades que considero imprescindíveis encontrei nela durante a negociação.
                                Profissionalismo, conhecimento do negócio e do mercado imobiliário, persistência com
                                ética, flexibilidade com foco no "ganha- ganha".<br>
                                Além desses valores, tem o feeling de
                                entender as possibilidades de investimento do cliente, e apresenta alternativas para
                                a concretização do negócio. <br>
                                Acabei na verdade ganhando uma amiga
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js-util')
@parent
$('#carrousel-clients').owlCarousel({
loop: true,
autoplay: true,
autoplayHoverPause:true,
dots: false,
responsiveClass: true,
responsive:{
0:{
items:1,
nav: true
},
768:{
items:2,
nav: true
},
1200:{
items:3,
nav: true
}
}
});
@endsection
