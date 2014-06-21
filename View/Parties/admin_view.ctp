<div id="PartiesAdminView">
    <h3><?php echo __('View Parties', true); ?></h3><hr />
    <div class="col-sm-12">

        <div class="col-sm-2">Name</div>
        <div class="col-sm-9">&nbsp;<?php
            if ($this->data['Party']['name']) {

                echo $this->data['Party']['name'];
            }
?>&nbsp;
        </div>
    </div>
    <hr />
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Party.id')), null, __('Delete the item, sure?', true)); ?></li>
            <li><?php echo $this->Html->link(__('Parties List', true), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('View Related Parliamentarians', true), array('controller' => 'parliamentarians', 'action' => 'index', 'Party', $this->data['Party']['id']), array('class' => 'PartiesAdminViewControl')); ?></li>
        </ul>
    </div>
    <div id="PartiesAdminViewPanel"></div>
<?php
echo $this->Html->scriptBlock('

');
?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('a.PartiesAdminViewControl').click(function() {
                $('#PartiesAdminViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>