<?php
if (!isset($url)) {
    $url = array();
}
?>
<div id="GrantsAdminIndex">
    <h2><?php echo __('Grants', true); ?></h2>
    <div class="btn-group">
        <?php echo $this->Html->link(__('Add', true), array('action' => 'add'), array('class' => 'btn dialogControl')); ?>
    </div>
    <div><?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="GrantsAdminIndexTable">
        <thead>
            <tr>
                <?php
                if (!empty($op)) {
                    echo '<th>&nbsp;</th>';
                }
                ?>
                <th><?php echo $this->Paginator->sort('Grant.sequence', 'Sequence', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Grant.source', 'Source', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Grant.requested_date', 'Requested Date', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Grant.requester', 'Requester', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Grant.petition_people', 'Petition People', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Grant.summary', 'Summary', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Grant.comments', 'Comments', array('url' => $url)); ?></th>
                <th><?php echo __('Action', true); ?></th>
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
                    <?php
                    if (!empty($op)) {
                        echo '<td>';
                        $options = array('value' => $item['Grant']['id'], 'class' => 'habtmSet');
                        if ($item['option'] == 1) {
                            $options['checked'] = 'checked';
                        }
                        echo $this->Form->checkbox('Set.' . $item['Grant']['id'], $options);
                        echo '<div id="messageSet' . $item['Grant']['id'] . '"></div></td>';
                    }
                    ?>

                    <td><?php
                if ($item['Grant']['sequence']) {

                    echo $item['Grant']['sequence'];
                }
                    ?></td>
                    <td><?php
                if ($item['Grant']['source']) {
                    echo $item['Grant']['source'];
                }
                    ?></td>
                    <td><?php
                if ($item['Grant']['requested_date']) {
                    echo $item['Grant']['requested_date'];
                }
                    ?></td>
                    <td><?php
                if ($item['Grant']['requester']) {

                    echo $item['Grant']['requester'];
                }
                    ?></td>
                    <td><?php
                if ($item['Grant']['petition_people']) {

                    echo $item['Grant']['petition_people'];
                }
                    ?></td>
                    <td><?php
                if ($item['Grant']['summary']) {

                    echo $item['Grant']['summary'];
                }
                    ?></td>
                    <td><?php
                if ($item['Grant']['comments']) {
                    echo $item['Grant']['comments'];
                }
                    ?></td>
                    <td>
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Grant']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['Grant']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['Grant']['id']), null, __('Delete the item, sure?', true)); ?>
                    </td>
                </tr>
            <?php } // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="GrantsAdminIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#GrantsAdminIndexTable th a, #GrantsAdminIndex div.paging a').click(function() {
                $('#GrantsAdminIndex').parent().load(this.href);
                return false;
            });
<?php
if (!empty($op)) {
    $remoteUrl = $this->Html->url(array('action' => 'habtmSet', $foreignModel, $foreignId));
    ?>
                $('#GrantsAdminIndexTable input.habtmSet').click(function() {
                    var remoteUrl = '<?php echo $remoteUrl; ?>/' + this.value + '/';
                    if (this.checked == true) {
                        remoteUrl = remoteUrl + 'on';
                    } else {
                        remoteUrl = remoteUrl + 'off';
                    }
                    $('div#messageSet' + this.value) . load(remoteUrl);
                });
    <?php
}
?>
    });
    //]]>
    </script>
</div>