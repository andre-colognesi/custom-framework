<?php $this->include('header') ?>

  <div class="container">
   <div class="row">
    <div class="col-sm-12">
    <h1>Criar Produto</h1>
    <hr>
    <br><br>
  
    </div>
   </div>
    <form action="salvar-produto" method="POST">
        <div class="row">
            <div class="col-sm-4">
                <label>Nome</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="col-sm-4">
                <label>Preço</label>
                <input type="text" class="form-control" name="price">
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
