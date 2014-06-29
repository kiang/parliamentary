<div id="masthead">  
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1><?php echo $item['Parliamentarian']['name']; ?>
                    <p class="lead"><?php echo $item['Parliamentarian']['district']; ?></p>
                </h1>
            </div>
            <div class="col-md-7">
                <div class="well well-lg"> 
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="<?php echo $item['Parliamentarian']['image_url']; ?>" style="height: 200px;">
                        </div>
                        <div class="col-sm-8">
                            <ul>
                                <li>電話：<?php echo $item['Parliamentarian']['contacts_phone']; ?></li>
                                <li>傳真：<?php echo $item['Parliamentarian']['contacts_fax']; ?></li>
                                <li>信箱：<?php echo $item['Parliamentarian']['contacts_email']; ?></li>
                                <li>服務處：<?php echo $item['Parliamentarian']['contacts_address']; ?></li>
                                <li>政黨：<?php echo $item['Parliamentarian']['party']; ?></li>
                                <li>選區：<?php echo $item['Parliamentarian']['constituency']; ?></li>
                                <li>生日：<?php echo $item['Parliamentarian']['birth']; ?></li>
                                <li>性別：<?php echo $item['Parliamentarian']['gender']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div><!--/container-->
</div><!--/masthead-->

<div class="container">
    <div class="row">
        <!--left-->
        <div class="col-md-3" id="leftCol">
            <div class="success">政見</div><?php echo nl2br($item['Parliamentarian']['platform']); ?>
            <div class="success">經歷</div><?php echo nl2br($item['Parliamentarian']['experience']); ?>
            <div class="success">學歷</div><?php echo nl2br($item['Parliamentarian']['education']); ?>
        </div><!--/left-->

        <!--right-->
        <div class="col-md-9">
            <div class="btn-group">
                <?php
                $countAll = $item['Parliamentarian']['count_submits'] + $item['Parliamentarian']['count_petitions'];
                echo $this->Html->link("全部({$countAll})", array('action' => 'view', $item['Parliamentarian']['id'], 'all'), array(
                    'class' => 'btn ' . (($motionType === 'all') ? 'btn-primary' : 'btn-default'),
                ));
                echo $this->Html->link("提案({$item['Parliamentarian']['count_submits']})", array('action' => 'view', $item['Parliamentarian']['id'], 'requester'), array(
                    'class' => 'btn ' . (($motionType === 'requester') ? 'btn-primary' : 'btn-default'),
                ));
                echo $this->Html->link("連署({$item['Parliamentarian']['count_petitions']})", array('action' => 'view', $item['Parliamentarian']['id'], 'petition'), array(
                    'class' => 'btn ' . (($motionType === 'petition') ? 'btn-primary' : 'btn-default'),
                ));
                ?>
            </div>
            | 排序：
            <div class="btn-group">
                <?php
                echo $this->Paginator->sort('Motion.requested_date', '來文日期', array('url' => $url, 'class' => 'btn btn-default'));
                echo $this->Paginator->sort('Motion.result_date', '決議日期', array('url' => $url, 'class' => 'btn btn-default'));
                echo $this->Paginator->sort('Motion.posting_date', '發文日期', array('url' => $url, 'class' => 'btn btn-default'));
                ?>
            </div>
            <hr />
            <div class="paging"><?php echo $this->element('paginator'); ?></div>
            <?php
            foreach ($motions AS $motion) {
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3><?php echo $this->Html->link($motion['Motion']['summary'], '/motions/view/' . $motion['Motion']['id']); ?></h3></div>
                            <div class="panel-body">
                                來文日期：<?php echo $motion['Motion']['requested_date']; ?>
                                | 決議日期：<?php echo $motion['Motion']['result_date']; ?>
                                | 發文日期：<?php echo $motion['Motion']['posting_date']; ?>
                                <hr />
                                <?php echo nl2br($motion['Motion']['description']); ?>
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