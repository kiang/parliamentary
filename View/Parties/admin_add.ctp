<div id="PartiesAdminAdd">
    <?php echo $this->Form->create('Party', array('type' => 'file')); ?>
    <div class="addForm"><?php echo $this->Html->link(' ', array('action' => 'form')); ?></div>

    <?php
    echo $this->Form->end(__('Submit', true));
    ?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#PartiesAdminAdd div.addForm a').each(function() {
                $(this).parent().load(this.href);
            });
        });
        //]]>
    </script>
</div>