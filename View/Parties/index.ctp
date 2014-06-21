<div id="PartiesIndex">
    <h2><?php echo __('Parties', true); ?></h2>
    <div class="clear actions">
        <ul>
        </ul>
    </div>
    <p>
        <?php
        $url = array();

        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></p>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="PartiesIndexTable">
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
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Party']['id']), array('class' => 'PartiesIndexControl')); ?>
                    </td>
                </tr>
            <?php }; // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="PartiesIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#PartiesIndexTable th a, div.paging a, a.PartiesIndexControl').click(function() {
                $('#PartiesIndex').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>