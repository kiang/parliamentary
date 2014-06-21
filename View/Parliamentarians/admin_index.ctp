<?php
if (!isset($url)) {
    $url = array();
}

if (!empty($foreignId) && !empty($foreignModel)) {
    $url = array($foreignModel, $foreignId);
}
?>
<div id="ParliamentariansAdminIndex">
    <h2><?php echo __('Parliamentarians', true); ?></h2>
    <div class="btn-group">
        <?php echo $this->Html->link(__('Add', true), array_merge($url, array('action' => 'add')), array('class' => 'btn dialogControl')); ?>
    </div>
    <div><?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="ParliamentariansAdminIndexTable">
        <thead>
            <tr>
                <?php
                if (!empty($op)) {
                    echo '<th>&nbsp;</th>';
                }
                ?>
                <?php if (empty($scope['Parliamentarian.Party_id'])): ?>
                    <th><?php echo $this->Paginator->sort('Parliamentarian.Party_id', 'Party', array('url' => $url)); ?></th>
                <?php endif; ?>

                <th><?php echo $this->Paginator->sort('Parliamentarian.name', 'Name', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.district', 'District', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.contacts_phone', 'Phone', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.contacts_email', 'Email', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.gender', 'Gender', array('url' => $url)); ?></th>
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
                        $options = array('value' => $item['Parliamentarian']['id'], 'class' => 'habtmSet');
                        if ($item['option'] == 1) {
                            $options['checked'] = 'checked';
                        }
                        echo $this->Form->checkbox('Set.' . $item['Parliamentarian']['id'], $options);
                        echo '<div id="messageSet' . $item['Parliamentarian']['id'] . '"></div></td>';
                    }
                    ?>
                    <?php if (empty($scope['Parliamentarian.Party_id'])): ?>
                        <td><?php
                            if ($item['Parliamentarian']['party']) {

                                echo $item['Parliamentarian']['party'];
                            }
                            ?></td>

                    <?php endif; ?>

                    <td><?php
                        echo $this->Html->link($item['Parliamentarian']['name'], $item['Parliamentarian']['links_council'], array('target' => '_blank'));
                        ?></td>
                    <td><?php
                        if ($item['Parliamentarian']['district']) {

                            echo $item['Parliamentarian']['district'];
                        }
                        ?></td>
                    <td><?php
                        if ($item['Parliamentarian']['contacts_phone']) {

                            echo $item['Parliamentarian']['contacts_phone'];
                        }
                        ?></td>
                    <td><?php
                        if (!empty($item['Parliamentarian']['contacts_email'])) {
                            echo $this->Html->link($item['Parliamentarian']['contacts_email'], 'mailto:' . $item['Parliamentarian']['contacts_email']);
                        }
                        ?></td>
                    <td><?php
                        if ($item['Parliamentarian']['gender']) {

                            echo $item['Parliamentarian']['gender'];
                        }
                        ?></td>
                    <td>
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Parliamentarian']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['Parliamentarian']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['Parliamentarian']['id']), null, __('Delete the item, sure?', true)); ?>
                    </td>
                </tr>
            <?php } // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="ParliamentariansAdminIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#ParliamentariansAdminIndexTable th a, #ParliamentariansAdminIndex div.paging a').click(function() {
                $('#ParliamentariansAdminIndex').parent().load(this.href);
                return false;
            });
<?php
if (!empty($op)) {
    $remoteUrl = $this->Html->url(array('action' => 'habtmSet', $foreignModel, $foreignId));
    ?>
                $('#ParliamentariansAdminIndexTable input.habtmSet').click(function() {
                    var remoteUrl = '<?php echo $remoteUrl; ?>/' + this.value + '/';
                    if (this.checked == true) {
                        remoteUrl = remoteUrl + 'on';
                    } else {
                        remoteUrl = remoteUrl + 'off';
                    }
                    $('div#messageSet' + this.value).load(remoteUrl);
                });
    <?php
}
?>
        });
        //]]>
    </script>
</div>