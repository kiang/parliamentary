<div id="MotionsAdminAdd">
    <?php echo $this->Form->create('Motion', array('type' => 'file')); ?>
    <div class="addForm"><?php echo $this->Html->link(' ', array('action' => 'form')); ?></div>

    <?php
    echo $this->Form->end(__('Submit', true));
    ?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#MotionsAdminAdd div.addForm a').each(function() {
                $(this).parent().load(this.href);
            });
        });
        //]]>
    </script>
</div>