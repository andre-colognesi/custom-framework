<?php $this->include('header') ?>

   <div class="row">
    <div class="col-sm-12">
    <h1>Criar Produto</h1>
    <hr>
    <br><br>
  
    </div>
   </div>
    <form action="salvar-produto" method="POST" enctype="multipart/form-data">
    <?= $this->getToken()?>
        <div class="row">
            <div class="col-sm-4">
                <label>Nome</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="col-sm-4">
                <label>Preço</label>
                <input type="text" class="form-control" name="price">
            </div>
            <div class="col-sm-3">
                <label>Foto</label>
                <input type="file" name="avatar">
            </div>
            <div class="col-sm-3">
                <label>Vendedor</label>
                <select class="form-control" name="salesman_id">
                    <?php
                            echo '<option value="">Selecione</option>';
                        foreach($salesmans as $sales){
                            echo '<option value="'.$sales->salesman_id.'">'.$sales->salesman_name.'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
            <br>
            <input type="submit" class="btn btn-success btn-block">
            </div>
        </div>
    </form>

    <?php  $this->include('footer'); ?>
