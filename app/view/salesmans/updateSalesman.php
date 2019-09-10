<?php $this->include('header') ?>

   <div class="row">
    <div class="col-sm-12">
    <h1>Editar Vendedor <?=$sales['salesman_name']?></h1>
    <hr>
    <br><br>

    </div>
   </div>

    <form action="<?=getenv("URL") ?>vendedor/<?= $sales['salesman_id']?>/update" method="POST">
        <div class="row">
            <div class="col-sm-4">
                <label>Nome</label>
                <input type="text" class="form-control" name="name" value="<?=$sales['salesman_name']?>">
            </div>
            <div class="col-sm-4">
                <label>Aniversario</label>
                <input type="date" class="form-control" name="birthday" value="<?=$sales['birthday']?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
            <br>
            <input type="submit" class="btn btn-success btn-block" value="Salvar">
            </div>
        </div>
    </form>

    <?php  $this->include('footer'); ?>
