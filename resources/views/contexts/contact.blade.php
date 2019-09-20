<div>
</div>
<section class="section-contact py-5 my-0">
    <div class="content-default-with-back">
    </div>
    <div class="content-default">
        <h1>Entre em contato conosco</h1>
        <p class="text-left">
            Tem alguma sugestão?<br>
            Ficou com dúvida em algum imóvel?<br>
            Entre em contato conosco, será um prazer em atênde-lo.<br>
            Ah, não esqueca de conferir nossas redes sociais, estão cheias de novidades...
        </p>
        <form class="form-contact" method="POST" action="{{url('contato')}}">
            @csrf
            <div class="row">
                <div class="my-2 px-1 col-6">
                    <input name="name" placeholder="Nome">
                </div>
                <div class="my-2 px-1 col-6">
                    <input name="phone" placeholder="Telefone">
                </div>
                <div class="my-2 px-1 col-12">
                    <input name="email" type="email" placeholder="Endereço de e-mail">
                </div>
                <div class="my-2 px-1 col-12">
                    <textarea name="message" id="" cols="30" rows="3" placeholder="Descreva sua dúvida"></textarea>
                </div>
                <div class="my-2 px-1 col-12 text-right">
                    <button class="btn bt--se ft-md px-5"> Enviar </button>
                </div>
            </div>
        </form>
    </div>
</section>
