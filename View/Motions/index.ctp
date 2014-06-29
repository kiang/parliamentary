<div class="container">
    <div class="row">
        <!--right-->
        <div class="col-md-12">
            排序：
            <div class="btn-group">
                <?php
                echo $this->Paginator->sort('Motion.requested_date', '來文日期', array('url' => $url, 'class' => 'btn btn-default'));
                echo $this->Paginator->sort('Motion.result_date', '決議日期', array('url' => $url, 'class' => 'btn btn-default'));
                echo $this->Paginator->sort('Motion.posting_date', '發文日期', array('url' => $url, 'class' => 'btn btn-default'));
                ?>
            </div>
            <div class="paging"><?php echo $this->element('paginator'); ?></div>
            <?php
            foreach ($items AS $item) {
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3><?php echo $this->Html->link($item['Motion']['summary'], '/motions/view/' . $item['Motion']['id']); ?></h3></div>
                            <div class="panel-body">
                                來文日期：<?php echo $item['Motion']['requested_date']; ?>
                                | 決議日期：<?php echo $item['Motion']['result_date']; ?>
                                | 發文日期：<?php echo $item['Motion']['posting_date']; ?>
                                <hr />
                                <?php echo nl2br($item['Motion']['description']); ?></div>
                            <div class="panel-body">
                                提案人/單位： <?php echo $item['Motion']['requester']; ?>
                                <?php
                                if(!empty($item['Motion']['petition_people'])) {
                                    echo '/ 連署人： ' . $item['Motion']['petition_people'];
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="paging"><?php echo $this->element('paginator'); ?></div>
        </div><!--/right-->
    </div><!--/row-->
</div><!--/container-->