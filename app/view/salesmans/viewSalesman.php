<?php $this->include('header') ?>

   <div class="row">
    <div class="col-sm-12">
    <h1>Editar Vendedor <?=$sales['salesman_name']?></h1>
    <hr>
    <br><br>

    </div>
   </div>
        <div class="row">
            <div class="col-sm-4">
                <label>Nome</label>
                <h4><?=$sales['salesman_name']?></h4>
            </div>
            <div class="col-sm-4">
                <label>Aniversario</label>
                <h4><?=$sales['birthday']?></h4>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3 custom-list">
                <label>Produtos Vendidos</label>
                <?php
                    foreach($child as $c){
                        ?>
                            <li class=""><a href="<?=getenv("URL")."produto/".$c->product_id."/editar"?>"><?= $c->product_name?></a></li>
                        <?php
                    }
                ?>
            </div>
        </div>

x    <?php  $this->include('footer'); ?>
