<?php $this->include('header') ?>

  <div class="container">
   <div class="row">
    <div class="col-sm-12">
    <h1>Criar Vendedor</h1>
    <hr>
    <br><br>
    </div>
   </div>
    <form action="salvar-vendedor" method="POST">
        <div class="row">
            <div class="col-sm-4">
            <label>Nome</label>
                <input type="text" class="form-control" name="name">

            </div>
            <div class="col-sm-4">
                <label>Aniversario</label>
                <input type="date" class="form-control" name="birthday">
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
