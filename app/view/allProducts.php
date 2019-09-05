<?php $this->include('header') ?>

  <div class="container">
   <div class="row">
    <div class="col-sm-12">
    <h1>Produtos</h1>
    <br>
    </div>
    <div class="col-sm-3">
      <a class="btn btn-primary btn-block" href="criar-produto">Criar</a>
    </div>
    </div>
    <br>

    <table class="table table-sm table-hover">
      <tr>
          <th>ID.</th>
          <th>Produto</th>
          <th>Preço</th>
          <th></th>
      </tr>
      <?php
        foreach($produto as $p){
          echo '<tr>'; 
          echo '<td>'.$p->product_id.'</td>';
          echo '<td>'.$p->product_name.'</td>';
          echo '<td>'.$p->product_price.'</td>';
          ?>
           <td class=""><a class="btn btn-sm  btn-danger text-light"  onclick="document.getElementById('excluir-<?=$p->product_id?>').submit()">Excluir</a>
             <a class="btn btn-info btn-sm text-light" href="produto/<?=$p->product_id?>/editar">Editar</a>
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
   </div>
    <?php  $this->include('footer'); ?>
