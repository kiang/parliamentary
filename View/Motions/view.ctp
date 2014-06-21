<div id="masthead">  
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $item['Motion']['summary']; ?></h1>
            </div>
        </div> 
    </div><!--/container-->
</div><!--/masthead-->

<div class="container">
    <div class="row">
        <!--left-->
        <div class="col-md-3" id="leftCol">
            <?php
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
            ?>
        </div><!--/left-->

        <!--right-->
        <div class="col-md-9">
            <table class="table table-bordered">
                <tr>
                    <td class="col-md-2">議案屆次別</td>
                    <td class="col-md-10"><?php echo $item['Motion']['sequence']; ?></td>
                </tr>
                <tr>
                    <td>大會類別</td>
                    <td><?php echo $item['Motion']['type']; ?></td>
                </tr>
                <tr>
                    <td>審查會別</td>
                    <td><?php echo $item['Motion']['group_type']; ?></td>
                </tr>
                <tr>
                    <td>案號</td>
                    <td><?php echo $item['Motion']['number']; ?></td>
                </tr>
                <tr>
                    <td>提案類別</td>
                    <td><?php echo $item['Motion']['source']; ?></td>
                </tr>
                <tr>
                    <td>來文日期</td>
                    <td><?php echo $item['Motion']['requested_date']; ?></td>
                </tr>
                <tr>
                    <td>來文字號</td>
                    <td><?php echo $item['Motion']['requested_number']; ?></td>
                </tr>
                <tr>
                    <td>提案單位/人</td>
                    <td><?php echo $item['Motion']['requester']; ?></td>
                </tr>
                <tr>
                    <td>連署人</td>
                    <td><?php echo $item['Motion']['petition_people']; ?></td>
                </tr>
                <tr>
                    <td>主旨</td>
                    <td><?php echo $item['Motion']['summary']; ?></td>
                </tr>
                <tr>
                    <td>說明</td>
                    <td><?php echo nl2br($item['Motion']['description']); ?></td>
                </tr>
                <tr>
                    <td>辦法</td>
                    <td><?php echo $item['Motion']['rules']; ?></td>
                </tr>
                <tr>
                    <td>審查意見</td>
                    <td><?php echo $item['Motion']['comments']; ?></td>
                </tr>
                <tr>
                    <td>大會決議</td>
                    <td><?php echo $item['Motion']['result']; ?></td>
                </tr>
                <tr>
                    <td>辦理情形</td>
                    <td><?php echo nl2br($item['Motion']['status']); ?></td>
                </tr>
                <tr>
                    <td>決議日期</td>
                    <td><?php echo $item['Motion']['result_date']; ?></td>
                </tr>
                <tr>
                    <td>發文日期</td>
                    <td><?php echo $item['Motion']['posting_date']; ?></td>
                </tr>
                <tr>
                    <td>發文字號</td>
                    <td><?php echo $item['Motion']['posting_number']; ?></td>
                </tr>
                <tr>
                    <td>議會附件</td>
                    <td><?php echo $item['Motion']['attachments']; ?></td>
                </tr>
            </table>
        </div><!--/right-->
    </div><!--/row-->
</div><!--/container-->