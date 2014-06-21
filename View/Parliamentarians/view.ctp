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
            <div class="paging"><?php echo $this->element('paginator'); ?></div>
            <?php
            foreach ($motions AS $motion) {
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3><?php echo $this->Html->link($motion['Motion']['summary'], '/motions/view/' . $motion['Motion']['id']); ?></h3></div>
                            <div class="panel-body"><?php echo nl2br($motion['Motion']['description']); ?></div>
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