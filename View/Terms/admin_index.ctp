<?php
if (!isset($url)) {
    $url = array();
}
?>
<div id="TermsAdminIndex">
    <h2><?php echo __('Terms', true); ?></h2>
    <div class="btn-group">
        <?php echo $this->Html->link(__('Add', true), array('action' => 'add'), array('class' => 'btn dialogControl')); ?>
    </div>
    <div><?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="TermsAdminIndexTable">
        <thead>
            <tr>

                <th><?php echo $this->Paginator->sort('Term.name', 'Name', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Term.is_active', 'Active?', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Term.count', 'Count', array('url' => $url)); ?></th>
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

                    <td><?php echo $item['Term']['name']; ?></td>
                    <td><?php echo $item['Term']['is_active']; ?></td>
                    <td><?php echo $item['Term']['count']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['Term']['id']), array('class' => 'dialogControl')); ?>
                        <?php
                        if (!empty($item['Term']['is_active'])) {
                            echo $this->Html->link('停用', array('action' => 'index', $item['Term']['id'], '0'));
                        } else {
                            echo $this->Html->link('啟用', array('action' => 'index', $item['Term']['id'], '1'));
                        }
                        ?>
                        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['Term']['id']), null, __('Delete the item, sure?', true)); ?>
                    </td>
                </tr>
            <?php } // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="TermsAdminIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#TermsAdminIndexTable th a, #TermsAdminIndex div.paging a').click(function() {
                $('#TermsAdminIndex').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>