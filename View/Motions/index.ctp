<div class="container">
    <div class="row">
        <!--right-->
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">提案人區域：</div>
                <div class="col-md-10"><?php
                    if (empty($foreignId)) {
                        $btnClass = 'btn-primary';
                    } else {
                        $btnClass = 'btn-default';
                    }
                    echo $this->Html->link('不分區', '/motions/index', array('class' => 'btn ' . $btnClass));
                    foreach ($areas AS $area) {
                        if ($foreignId == $area['Area']['id']) {
                            $btnClass = 'btn-primary';
                        } else {
                            $btnClass = 'btn-default';
                        }
                        echo $this->Html->link($area['Area']['name'], '/motions/index/Area/' . $area['Area']['id'], array('class' => 'btn ' . $btnClass));
                    }
                    ?></div>
            </div>
            <div class="row">
                <div class="col-md-2">搜尋：</div>
                <div class="col-md-6">
                    <?php
                    echo $this->Form->create('Motion', array(
                        'url' => $url,
                        'class' => 'form-inline',
                    ));
                    echo $this->Form->input('keyword', array(
                        'type' => 'text',
                        'value' => $keyword,
                        'label' => false,
                        'div' => 'form-group',
                        'class' => 'form-control',
                    ));
                    ?><button type="submit" class="btn btn-default">送出</button><?php
                    echo $this->Form->end();
                    ?>
                </div>
                <div class="col-md-1">排序：</div>
                <div class="col-md-3">
                    <div class="btn-group">
                        <?php
                        echo $this->Paginator->sort('Motion.requested_date', '來文日期', array('url' => $url, 'class' => 'btn btn-default'));
                        echo $this->Paginator->sort('Motion.result_date', '決議日期', array('url' => $url, 'class' => 'btn btn-default'));
                        echo $this->Paginator->sort('Motion.posting_date', '發文日期', array('url' => $url, 'class' => 'btn btn-default'));
                        ?>
                    </div>
                </div>
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
                                if (!empty($item['Motion']['petition_people'])) {
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
    <script>
        $(function() {
            $('input#MotionKeyword').click(function() {
                $(this).select();
            });
        });
    </script>
</div><!--/container-->