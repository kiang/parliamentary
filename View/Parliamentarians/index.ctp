<div class="container">
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <?php
    foreach ($items as $item) {
        ?>
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <img class="img-responsive" src="<?php echo $item['Parliamentarian']['image_url']; ?>" style="height: 200px;">
            </div>
            <div class="col-lg-10 col-md-10">
                <h3><?php echo $this->Html->link($item['Parliamentarian']['name'], '/parliamentarians/view/' . $item['Parliamentarian']['id']); ?></h3>
                <h4><?php echo $item['Parliamentarian']['district']; ?></h4>
                <ul>
                    <?php
                    foreach ($item['Motion'] AS $motion) {
                        ?><li><?php
                        echo substr($motion['Motion']['modified'], 0, 10) . ' ';
                            echo $this->Html->link($motion['Motion']['summary'], '/motions/view/' . $motion['Motion']['id']);
                            ?></li><?php
                    }
                    ?>

                </ul>
            </div>
        </div><hr />
        <?php
    }
    ?>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
</div>