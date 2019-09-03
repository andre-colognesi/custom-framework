<?php $this->include('header') ?>

  <div class="container">
   <div class="row">
    <div class="col-sm-12">
    <h1>Editar Produto <?=$prod['product_name']?></h1>
    <hr>
    <br><br>
  
    </div>
   </div>
    <form action="<?=getenv("URL") ?>/produto/<?= $prod['product_id']?>/update" method="POST">
        <div class="row">
            <div class="col-sm-4">
                <label>Nome</label>
                <input type="text" class="form-control" name="name" value="<?=$prod['product_name']?>">
            </div>
            <div class="col-sm-4">
                <label>Preço</label>
                <input type="text" class="form-control" name="price" value="<?=$prod['product_price']?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
            <br>
            <input type="submit" class="btn btn-success btn-block">
            </div>
        </div>
    </form>

   </div>
    <?php  $this->include('footer'); ?>
