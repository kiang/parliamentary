<?php echo $this->Form->create('Area', array('url' => array('action' => 'add', $parentId))); ?>
<div class="Areas form">
    <fieldset>
        <legend>新增區域</legend>
        <div class="control-group">
            <div class="control-group input-prepend span4">
                <label class="add-on">名稱</label>
                <?php
                echo $this->Form->input('Area.name', array(
                    'type' => 'textarea',
                    'label' => false,
                    'div' => false,
                    'class' => 'span3',
                ));
                ?>
            </div>
        </div>
    </fieldset>
</div>
<?php echo $this->Form->end('送出'); ?>