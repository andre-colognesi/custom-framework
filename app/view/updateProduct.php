<?php $this->include('header') ?>

   <div class="row">
    <div class="col-sm-12">
    <h1>Editar Produto <?=$prod['product_name']?></h1>
    <hr>
    <br><br>
  
    </div>
   </div>
    <form action="<?=getenv("URL") ?>produto/<?= $prod['product_id']?>/update" method="POST">
        <div class="row">
            <div class="col-sm-4">
                <label>Nome</label>
                <input type="text" class="form-control" name="name" value="<?=$prod['product_name']?>">
            </div>
            <div class="col-sm-4">
                <label>Preço</label>
                <input type="text" class="form-control" name="price" value="<?=$prod['product_price']?>">
            </div>
            <div class="col-sm-3">
                <label>Vendedor</label>
                <select class="form-control" name="salesman_id">
                    <option value="">Selecione</option>
                    <?php
                        foreach($salesmans as $sales){
                            ?>
                            <option value="<?=$sales->salesman_id?>"
                                <?php
                                    if($sales->salesman_id == $prod['salesman_id']){
                                        echo ' selected';
                                    }
                                ?>
                            ><?=$sales->salesman_name?></option>
                            <?php                               
                        }
                    ?>
                </select>
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
