<?php $this->include('header') ?>

   <div class="row">
    <div class="col-sm-12">
    <h1>Produtos</h1>
    <br>
    </div>
    <div class="col-sm-2">
      <a class="btn btn-primary btn-block" href="criar-produto">Criar</a>
    </div>
    </div>
    <br>
    <form method="GET" class="px-2 py-3  rounded bg-light" action="buscar-produtos">
    <div class="row">
    <?= $this->getToken()?>
       <div class="col-sm-1">
          <label>ID.</label>
          <input type="text" class="form-control" name="id">
       </div>
       <div class="col-sm-2">
          <label>Nome</label>
          <input type="text" class="form-control" name="name">
       </div>
       </div>
       <br>
       <div class="row">
       
        <div class="col-sm-2">
          <input type="submit" class="btn btn-success btn-block" value="Buscar">
        </div>
       </div>
    </form>
    <br>
    <table class="table table-lg table-hover">
      <tr>
          <th>ID.</th>
          <th>Produto</th>
          <th>Preço</th>
          <th></th>
      </tr>
      
      <?php
    //  var_dump($this);
      echo '<pre>';
      //var_dump($produto);
      echo '</pre>';  
      foreach($produto as $p){
  
          if(empty($p->product_id)){
            echo 'Nada';
            break;
          }
          echo '<tr>'; 
          echo '<td>'.$p->product_id.'</td>';
          echo '<td>'.$p->product_name.'</td>';
          echo '<td>'.$p->product_price.'</td>';
          ?>
           <td class=""><a class="btn btn-danger text-light"  onclick="document.getElementById('excluir-<?=$p->product_id?>').submit()">Excluir</a>
             <a class="btn btn-info text-light" href="produto/<?=$p->product_id?>/editar">Editar</a>
           </td>
          <?php
          echo '</tr>';
          ?>
          <form style="display:none" id="excluir-<?=$p->product_id?>" action="produto/<?= $p->product_id?>/excluir" method="POST">
          </form>
        <?php
        }
      ?>
    </table>

    <?= $this->paginate($produto)?>
    <?php  $this->include('footer'); ?>
