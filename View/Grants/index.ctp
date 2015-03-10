<div class="container">
    <div class="row">
        <!--right-->
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">區域：</div>
                <div class="col-md-10"><?php
                    if (empty($foreignId)) {
                        $btnClass = 'btn-primary';
                    } else {
                        $btnClass = 'btn-default';
                    }
                    echo $this->Html->link('不分區', '/grants/index', array('class' => 'btn ' . $btnClass));
                    foreach ($areas AS $area) {
                        if ($foreignId == $area['Area']['id']) {
                            $btnClass = 'btn-primary';
                        } else {
                            $btnClass = 'btn-default';
                        }
                        echo $this->Html->link($area['Area']['name'], '/grants/index/Area/' . $area['Area']['id'], array('class' => 'btn ' . $btnClass));
                    }
                    ?></div>
            </div>
            <div class="row">
                <div class="col-md-2">搜尋：</div>
                <div class="col-md-6">
                    <?php
                    echo $this->Form->create('Grant', array(
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
                    ?>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">送出</button>
                        <button type="button" class="btn btn-default btn-reset-keyword">重設</button>
                    </div>

                    <?php
                    echo $this->Form->end();
                    ?>
                </div>
                <div class="col-md-1">排序：</div>
                <div class="col-md-3">
                    <div class="btn-group">
                        <?php
                        echo $this->Paginator->sort('Grant.year', '年度', array('url' => $url, 'class' => 'btn btn-default'));
                        echo $this->Paginator->sort('Grant.amount_suggested', '建議金額', array('url' => $url, 'class' => 'btn btn-default'));
                        echo $this->Paginator->sort('Grant.amount_approved', '核定金額', array('url' => $url, 'class' => 'btn btn-default'));
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
                            <div class="panel-heading"><h3><?php echo $this->Html->link($item['Grant']['title'], '/grants/view/' . $item['Grant']['id']); ?></h3></div>
                            <div class="panel-body">
                                年度：<?php echo $item['Grant']['year']; ?>
                                | 建議金額：<?php echo $item['Grant']['amount_suggested']; ?>
                                | 核定金額：<?php echo $item['Grant']['amount_approved']; ?>
                                <hr />
                                建議地點：<?php echo $item['Grant']['area']; ?>
                                <br />經費支用科目： <?php echo $item['Grant']['account']; ?>
                                <br />主辦機關： <?php echo $item['Grant']['department']; ?>
                                <br />招標方式： <?php echo $item['Grant']['type']; ?>
                                <br />得標廠商： <?php echo $item['Grant']['vendors']; ?>
                            </div>
                            <div class="panel-body">
                                提案人/單位： <?php echo $item['Grant']['parliamentarians']; ?>
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
        $(function () {
            $('input#GrantKeyword').click(function () {
                $(this).select();
            });
            $('button.btn-reset-keyword').click(function () {
                location.href = '<?php echo $this->Html->url('/grants'); ?>';
            });
            $('form#GrantIndexForm').submit(function() {
                var k = $('input#GrantKeyword').val();
                if(k !== '') {
                    location.href = '<?php echo $this->Html->url('/grants/index/k'); ?>/' + encodeURIComponent($('input#GrantKeyword').val());
                } else {
                    alert('請輸入要搜尋的文字');
                }
                return false;
            });
        });
    </script>
</div><!--/container-->