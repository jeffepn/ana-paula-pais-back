<div class="row">
    <div class="col-md-8 my-2 px-2">
        <div class="cd--one">
            <div class="cd-header">
                <h1>Perfil Usário</h1>
            </div>
            <div class="m-1">
                <h1>Editar perfil</h1>
                <p class=" font-primary--medium c-success">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Tenetur
                    vel et ipsam? Alias inventore aspernatur sit illo temporibus esse, saepe necessitatibus. Hic fuga
                    eveniet alias officiis voluptatibus omnis iure mollitia?
                </p>
                <hr>
                @include('parts.generateform',['form'=>view('context.parts.form')->render()])
            </div>
        </div>
    </div>
    <div class="col-md-4 my-2 px-2">
        <div class="cd--one">
            <div class=" cd-image">
                <img src="{{url('imageslaraveladmin/utilities/user2.png')}}">
            </div>
            <h6 class="mt-2"> ADMINISTRADOR </h6>
            <h5> José Alencar </h5>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas sit quidem neque modi alias ipsa sed
                natus quasi minus corrupti harum fuga eveniet, suscipit quas rerum sequi mollitia unde asperiores.
            </p>
        </div>
    </div>
</div>