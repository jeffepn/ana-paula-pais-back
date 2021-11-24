<div class="row">
    <div class="col-12 my-2 px-0">
        <div class=" cd--two">
            <div class="cd-header">
                <h1> Tabela de usuários </h1>
            </div>
            <div class="m-1 mt-4">
                @include('laraveladmin::parts.generatetable',['datatable'=>['idtable'=>'list'],'lastindice'=>4,'table'=>view('laraveladmin::default.parts.table')->render()])
            </div>
        </div>
    </div>
</div>
@section('js-util')
@parent
$('body').on('click', '.open-modal-delete', function () {
var myThis = this;
$('.modal-defautl-title').html('Excluir Conteúdo');
$('.modal-defautl-content').html('Deseja realmente excluir o item?');
$('#button-delete-modal').attr('href', myThis.getAttribute('data-url'));
$('#modal-delete').modal();
});
@stop