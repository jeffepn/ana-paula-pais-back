<?php
                $arrayuser = ['Administrador'=>'Administrador','Usuário'=>'Usuário'];
                $data =[
                    ['id'=>1,'slug'=>'slug1','name'=>'José De Paula','age'=>rand(18,40),'type_user'=>array_rand($arrayuser),'created_at'=>'2019-08-11'],
                    ['id'=>2,'slug'=>'slug2','name'=>'Fernanda de Melo','age'=>rand(18,40),'type_user'=>array_rand($arrayuser),'created_at'=>'2019-08-12'],
                    ['id'=>3,'slug'=>'slug3','name'=>'Carlos Augusto','age'=>rand(18,40),'type_user'=>array_rand($arrayuser),'created_at'=>'2019-08-13'],
                    ['id'=>4,'slug'=>'slug4','name'=>'Carla Silva','age'=>rand(18,40),'type_user'=>array_rand($arrayuser),'created_at'=>'2019-08-14'],
                    ['id'=>5,'slug'=>'slug5','name'=>'Maria Beatriz','age'=>rand(18,40),'type_user'=>array_rand($arrayuser),'created_at'=>'2019-08-15'],
                ];
                $indices =
                [
                    ['element'=>'type_user','type'=>'text','label'=>'Tipo de Usuário'],
                    ['element'=>'name','type'=>'text','label'=>'Nome'],
                    ['element'=>'age','type'=>'text','label'=>'Idade'],
                    ['element'=>'created_at','type'=>'date','label'=>'Data de criação'],
                    ['type'=>'button','label'=>'Ações',
                        'buttons'=>[
                            ['type'=>'button','text'=>'<i class="material-icons mr-1">delete</i>Excluir',
                            'classes'=>'bt--pr--sm open-modal-delete','attributes'=>' data-slug=button-delete data-toggle=modal data-target=#modal-delete ',
                            'url'=>['attribute'=>'data-url','value'=>url('/'),'itensurl' => [['prefix'=>'/editar/','element'=>'id'],['prefix'=>'/aux/','element'=>'slug']]]],
                            ['type'=>'link','text'=>'<i class="material-icons mr-1">edit</i>Editar','classes'=>'bt--th--sm','url'=>url('/'),'itensurl' => [['prefix'=>'/registrar/','element'=>'id'],['prefix'=>'/aux/','element'=>'slug']],'attributes'=>'data-slug=button-edit'],                            
                        ]
                    ]
                ];
?>

<thead>
    <th>Tipo de Usuário</th>
    <th>Nome</th>
    <th>Idade</th>
    <th>Data de criação</th>
    <th data-priority="1">Ações</th>
</thead>
<tbody>
    @foreach($data as $item)
    <tr>
        <td>{{$item['type_user']}}</td>
        <td>{{$item['name']}}</td>
        <td>{{$item['age']}}</td>
        <td>{{JpUtilities\Utilities\Util::toView($item['created_at'])}}</td>
        <td>
            <a class="bt--pr--sm" href="#">Editar</a>
            <button type="button" class="bt--th--sm open-modal-delete">Excluir</button>
        </td>
    </tr>
    @endforeach
</tbody>