<footer class="footer mt-auto py-3">
    <div class="background-footer"></div>
    <div class="px-md-5 content-footer">
        <div class="row">
            <div class="col-4">
                <p>Aqui será o footer.</p>
            </div>
            <div class="col-4">
            </div>
            <div class="col-4">
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
    </div>
</footer>