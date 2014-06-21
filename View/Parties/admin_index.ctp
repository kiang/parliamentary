<?php
if (!isset($url)) {
    $url = array();
}
?>
<div id="PartiesAdminIndex">
    <h2><?php echo __('Parties', true); ?></h2>
    <div class="btn-group">
        <?php echo $this->Html->link(__('Add', true), array('action' => 'add'), array('class' => 'btn dialogControl')); ?>
    </div>
    <div><?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="PartiesAdminIndexTable">
        <thead>
            <tr>

                <th><?php echo $this->Paginator->sort('Party.name', 'Name', array('url' => $url)); ?></th>
                <th class="actions"><?php echo __('Action', true); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($items as $item) {
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr<?php echo $class; ?>>

                    <td><?php
                if ($item['Party']['name']) {

                    echo $item['Party']['name'];
                }
                    ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Party']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['Party']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['Party']['id']), null, __('Delete the item, sure?', true)); ?>
                    </td>
                </tr>
            <?php } // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="PartiesAdminIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#PartiesAdminIndexTable th a, #PartiesAdminIndex div.paging a').click(function() {
                $('#PartiesAdminIndex').parent().load(this.href);
                return false;
            });
    });
    //]]>
    </script>
</div>