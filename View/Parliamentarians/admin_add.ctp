<div id="ParliamentariansAdminAdd">
    <?php
    $url = array();
    if (!empty($foreignId) && !empty($foreignModel)) {
        $url = array('action' => 'add', $foreignModel, $foreignId);
    } else {
        $url = array('action' => 'add');
        $foreignModel = '';
    }
    echo $this->Form->create('Parliamentarian', array('type' => 'file', 'url' => $url, 'class' => 'form-inline'));
    ?>
    <div class="addForm"><?php echo $this->Html->link(' ', array('action' => 'form', 0, $foreignModel)); ?></div>

    <?php
    echo $this->Form->end(__('Submit', true));
    ?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#ParliamentariansAdminAdd div.addForm a').each(function() {
                $(this).parent().load(this.href);
            });
        });
        //]]>
    </script>
</div>