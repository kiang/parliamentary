<div id="GrantsAdminAdd">
    <?php echo $this->Form->create('Grant', array('type' => 'file')); ?>
    <div class="addForm"><?php echo $this->Html->link(' ', array('action' => 'form')); ?></div>

    <?php
    echo $this->Form->end(__('Submit', true));
    ?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#GrantsAdminAdd div.addForm a').each(function() {
                $(this).parent().load(this.href);
            });
        });
        //]]>
    </script>
</div>