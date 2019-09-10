<?php $this->include('header') ?>

  
  <div class="row">
    <div class="col-sm-12">
    <h1>Vendedores</h1>
    <br>
    </div>
    <div class="col-sm-3">
      <a class="btn btn-primary btn-block" href="criar-vendedor">Criar</a>
    </div>
    </div>
    <br>

    <table class="table table-lg table-hover">
      <tr>
          <th>ID.</th>
          <th>Nome</th>
          <th></th>
      </tr>
      <?php
     
        foreach($vendedores as $v){
          echo '<tr>'; 
          echo '<td>'.$v->salesman_id.'</td>';
          echo '<td>'.$v->salesman_name.'</td>';
          ?>
           <td class=""><a class="btn btn-sm  btn-danger text-light"  onclick="document.getElementById('excluir-<?=$v->salesman_id?>').submit()">Excluir</a>
             <a class="btn btn-info btn-sm text-light" href="vendedor/<?=$v->salesman_id?>/editar">Editar</a>
             <a class="btn btn-sm btn-success" href="vendedor/<?= $v->salesman_id?>/visualizar">Visualizar</a>
           </td>
          <?php
          echo '</tr>';
          ?>
          <form style="display:none" id="excluir-<?=$v->salesman_id?>" action="vendedor/<?= $v->salesman_id?>/excluir" method="POST">
          </form>
        <?php
        }
      ?>
    </table>

        
    <?php  $this->include('footer'); ?>
