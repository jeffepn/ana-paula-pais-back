<footer class="footer mt-auto py-3">
    <div class="background-footer"></div>
    <div class="ps-md-2 px-lg-5 content-footer">
        <div class="row">
            <div class="col-md-3 mb-3 col-lg-4">
                <img width="40%" class="mx-auto d-block" src="{{url('images/site/logobig.png')}}"
                    alt="Ana Paula Pais Imóveis">
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 mb-3">
                <h4>Contatos</h4>
                <div class="social-network">
                    <a class="text-white" href="#"><i class="fab fa-facebook-square"></i></a>
                    <a class="text-white" href="#"><i class="fab fa-instagram"></i></a>
                </div>
                <a href="#" class="d-flex align-items-center text-white ft-primary">
                    <i class="mdil mdil-email mdil-24px mr-2"></i>
                    contato@anapaulapais.com.br
                </a>
                <a href="#" class="d-flex align-items-center text-white ft-primary">
                    <i class="mdil mdil-phone mdil-24px mr-2"></i>
                    (35) 99733-3777
                </a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                <h4>Newsletter</h4>
                <p>
                    Quer ficar por dentro de nossas novidades?<br>
                    Assine agora nossa Newsletter.
                </p>
                <form action="" method="POST">
                    <div class="form-group">
                        <input name="name" class="form-control" placeholder="Nome">
                        <p class="text-danger">{{$errors->first('name')}}</p>
                    </div>
                    <div class="form-group">
                        <input name="email" class="form-control" placeholder="Endereço de E-mail">
                        <p class="text-danger">{{$errors->first('email')}}</p>
                    </div>
                    <button class="btn bt--se w-100"> Enviar </button>
                </form>
            </div>
        </div>
        <p class="text-center">© Copyright 2019</p>
    </div>
</footer>