<?php ?>

<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/campanha.css'>
<br/>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form id="selLog" method="POST" >
                <div class="col-lg-8">
                    <div class="col-lg-3">Período de:
                        <input class="form-control" name="ddd"  type=text />
                        
                    </div>
                    <div class="col-lg-3">Até:
                        <input class="form-control" name="tel" type=text  />
                    </div>
                    <br>
                    <div class="col-lg-3">
                        <input class="form-control btn-info" type="submit" value="Incluir">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br/>
    <br/>
    <div class="title2">
        <?php echo $viewData['title2']; ?>
    </div>
</div>
