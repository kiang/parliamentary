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
                    <th><?php echo $this->Paginator->sort('Parliamentarian.Party_id', 'Parties', array('url' => $url)); ?></th>
                <?php endif; ?>

                <th><?php echo $this->Paginator->sort('Parliamentarian.name', 'Name', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.district', 'District', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.contacts_phone', 'Phone', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.contacts_fax', 'Fax', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.contacts_email', 'Email', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.contacts_address', 'Address', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.links_council', 'Council Link', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.gender', 'Gender', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.image_url', 'Image Url', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.experience', 'Experience', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.platform', 'Platform', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.birth', 'Birthday', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.party', 'Party', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.constituency', 'Constituency', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.education', 'Education', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.group', 'Group', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Parliamentarian.ad', 'Ad', array('url' => $url)); ?></th>
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
                if (empty($item['Party']['id'])) {
                    echo '--';
                } else {
                    echo $this->Html->link($item['Party']['id'], array(
                        'controller' => 'parties',
                        'action' => 'view',
                        $item['Party']['id']
                    ));
                }
                        ?></td>
                    <?php endif; ?>

                    <td><?php
                if ($item['Parliamentarian']['name']) {

                    echo $item['Parliamentarian']['name'];
                }
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
                if ($item['Parliamentarian']['contacts_fax']) {

                    echo $item['Parliamentarian']['contacts_fax'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['contacts_email']) {

                    echo $item['Parliamentarian']['contacts_email'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['contacts_address']) {

                    echo $item['Parliamentarian']['contacts_address'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['links_council']) {

                    echo $item['Parliamentarian']['links_council'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['gender']) {

                    echo $item['Parliamentarian']['gender'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['image_url']) {

                    echo $item['Parliamentarian']['image_url'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['experience']) {

                    echo $item['Parliamentarian']['experience'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['platform']) {

                    echo $item['Parliamentarian']['platform'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['birth']) {

                    echo $item['Parliamentarian']['birth'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['party']) {

                    echo $item['Parliamentarian']['party'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['constituency']) {

                    echo $item['Parliamentarian']['constituency'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['education']) {

                    echo $item['Parliamentarian']['education'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['group']) {

                    echo $item['Parliamentarian']['group'];
                }
                    ?></td>
                    <td><?php
                if ($item['Parliamentarian']['ad']) {

                    echo $item['Parliamentarian']['ad'];
                }
                    ?></td>
                    <td class="actions">
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
                    $('div#messageSet' + this.value) . load(remoteUrl);
                });
    <?php
}
?>
    });
    //]]>
    </script>
</div>