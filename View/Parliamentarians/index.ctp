<div class="container">
    <div class="row">
        <?php
        if (empty($foreignId)) {
            $btnClass = 'btn-primary';
        } else {
            $btnClass = 'btn-default';
        }
        echo $this->Html->link('不分區', '/parliamentarians/index', array('class' => 'btn ' . $btnClass));
        foreach ($areas AS $area) {
            if ($foreignId == $area['Area']['id']) {
                $btnClass = 'btn-primary';
            } else {
                $btnClass = 'btn-default';
            }
            echo $this->Html->link($area['Area']['name'], '/parliamentarians/index/Area/' . $area['Area']['id'], array('class' => 'btn ' . $btnClass));
        }
        ?>
    </div>
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