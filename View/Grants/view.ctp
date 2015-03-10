<div id="masthead">  
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $item['Grant']['title']; ?></h1>
                <?php echo $this->Html->link('資料來源', 'http://www.tainan.gov.tw/tainan/Grants.asp?nsub=A6C400', array('class' => 'pull-right btn btn-default', 'target' => '_blank')); ?>
            </div>
        </div> 
    </div><!--/container-->
</div><!--/masthead-->

<div class="container">
    <div class="row">
        <!--left-->
        <div class="col-md-3" id="leftCol">
            <?php
            if (!empty($item['Parliamentarian'])) {
                echo '提案人：';
                foreach ($item['Parliamentarian'] AS $p) {
                    ?>
                    <div class="well well-lg"> 
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="<?php echo $p['image_url']; ?>" style="height: 100px;">
                            </div>
                            <div class="col-sm-8">
                                <ul>
                                    <li><?php echo $this->Html->link($p['name'], '/parliamentarians/view/' . $p['id']); ?></li>
                                    <li><?php echo $p['contacts_phone']; ?></li>
                                    <li><?php echo $p['district']; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div><!--/left-->

        <!--right-->
        <div class="col-md-9">
            <table class="table table-bordered">
                <tr>
                    <td class="col-md-2">年度</td>
                    <td class="col-md-10"><?php echo $item['Grant']['year']; ?></td>
                </tr>
                <tr>
                    <td>建議金額</td>
                    <td><?php echo $item['Grant']['amount_suggested']; ?></td>
                </tr>
                <tr>
                    <td>核定金額</td>
                    <td><?php echo $item['Grant']['amount_approved']; ?></td>
                </tr>
                <tr>
                    <td>建議地點</td>
                    <td><?php echo $item['Grant']['area']; ?></td>
                </tr>
                <tr>
                    <td>經費支用科目</td>
                    <td><?php echo $item['Grant']['account']; ?></td>
                </tr>
                <tr>
                    <td>主辦機關</td>
                    <td><?php echo $item['Grant']['department']; ?></td>
                </tr>
                <tr>
                    <td>招標方式</td>
                    <td><?php echo $item['Grant']['type']; ?></td>
                </tr>
                <tr>
                    <td>得標廠商</td>
                    <td><?php echo $item['Grant']['vendors']; ?></td>
                </tr>
                <tr>
                    <td>提案人</td>
                    <td><?php echo $item['Grant']['parliamentarians']; ?></td>
                </tr>
            </table>
        </div><!--/right-->
    </div><!--/row-->
</div><!--/container-->