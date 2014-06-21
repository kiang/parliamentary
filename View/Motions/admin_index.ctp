<?php
if (!isset($url)) {
    $url = array();
}
?>
<div id="MotionsAdminIndex">
    <h2><?php echo __('Motions', true); ?></h2>
    <div class="btn-group">
        <?php echo $this->Html->link(__('Add', true), array('action' => 'add'), array('class' => 'btn dialogControl')); ?>
    </div>
    <div><?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="MotionsAdminIndexTable">
        <thead>
            <tr>
                <?php
                if (!empty($op)) {
                    echo '<th>&nbsp;</th>';
                }
                ?>
                <th><?php echo $this->Paginator->sort('Motion.sequence', 'Sequence', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Motion.source', 'Source', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Motion.requested_date', 'Requested Date', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Motion.requester', 'Requester', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Motion.petition_people', 'Petition People', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Motion.summary', 'Summary', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Motion.comments', 'Comments', array('url' => $url)); ?></th>
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
                        $options = array('value' => $item['Motion']['id'], 'class' => 'habtmSet');
                        if ($item['option'] == 1) {
                            $options['checked'] = 'checked';
                        }
                        echo $this->Form->checkbox('Set.' . $item['Motion']['id'], $options);
                        echo '<div id="messageSet' . $item['Motion']['id'] . '"></div></td>';
                    }
                    ?>

                    <td><?php
                if ($item['Motion']['sequence']) {

                    echo $item['Motion']['sequence'];
                }
                    ?></td>
                    <td><?php
                if ($item['Motion']['source']) {
                    echo $item['Motion']['source'];
                }
                    ?></td>
                    <td><?php
                if ($item['Motion']['requested_date']) {
                    echo $item['Motion']['requested_date'];
                }
                    ?></td>
                    <td><?php
                if ($item['Motion']['requester']) {

                    echo $item['Motion']['requester'];
                }
                    ?></td>
                    <td><?php
                if ($item['Motion']['petition_people']) {

                    echo $item['Motion']['petition_people'];
                }
                    ?></td>
                    <td><?php
                if ($item['Motion']['summary']) {

                    echo $item['Motion']['summary'];
                }
                    ?></td>
                    <td><?php
                if ($item['Motion']['comments']) {
                    echo $item['Motion']['comments'];
                }
                    ?></td>
                    <td>
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Motion']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['Motion']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['Motion']['id']), null, __('Delete the item, sure?', true)); ?>
                    </td>
                </tr>
            <?php } // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="MotionsAdminIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#MotionsAdminIndexTable th a, #MotionsAdminIndex div.paging a').click(function() {
                $('#MotionsAdminIndex').parent().load(this.href);
                return false;
            });
<?php
if (!empty($op)) {
    $remoteUrl = $this->Html->url(array('action' => 'habtmSet', $foreignModel, $foreignId));
    ?>
                $('#MotionsAdminIndexTable input.habtmSet').click(function() {
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