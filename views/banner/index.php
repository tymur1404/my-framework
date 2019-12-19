<div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Banner </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <section >
                <div class="flexslider">
                    <ul class="slides">
                        <?php foreach($params as $value){?>
                        <li>
                            <img src="/web/images/banner/<?= $value['img']?>"/>
                            <p class="flex-caption"><?= $value['name']?></p>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</div>

