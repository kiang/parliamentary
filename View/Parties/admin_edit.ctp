<div id="PartiesAdminEdit">
    <?php echo $this->Form->create('Party', array('type' => 'file', 'class' => 'form-inline')); ?>
    <div class="editForm"><?php echo $this->Html->link(' ', array('action' => 'form', $id)); ?></div>
    <?php
    echo $this->Form->end(__('Submit', true));
    ?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#PartiesAdminEdit div.editForm a').each(function() {
                $(this).parent().load(this.href);
            });
        });
        //]]>
    </script>
</div>