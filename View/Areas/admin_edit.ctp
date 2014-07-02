<?php echo $this->Form->create('Area', array('type' => 'file')); ?>
<div class="Areas form">
    <fieldset>
        <legend>編輯區域</legend>
        <div class="control-group">
            <div class="control-group input-prepend span4">
                <label class="add-on">名稱</label>
                <?php
                echo $this->Form->input('Area.id');
                echo $this->Form->input('Area.name', array(
                    'type' => 'text',
                    'label' => false,
                    'div' => false,
                    'class' => 'span3',
                ));
                ?>
            </div>
            <div class="control-group input-prepend span4">
                <label class="add-on">類別</label>
                <?php
                echo $this->Form->input('Area.parent_id', array(
                    'type' => 'text',
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