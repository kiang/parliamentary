<div id="PartiesView">
    <h3><?php echo __('View Parties', true); ?></h3><hr />
    <div class="span12">

        <div class="span2">Name</div>
        <div class="span9"><?php
            if ($this->data['Party']['name']) {

                echo $this->data['Party']['name'];
            }
?>&nbsp;
        </div>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Parties List', true), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('View Related Parliamentarians', true), array('controller' => 'parliamentarians', 'action' => 'index', 'Party', $this->data['Party']['id']), array('class' => 'PartiesViewControl')); ?></li>
        </ul>
    </div>
    <div id="PartiesViewPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('a.PartiesViewControl').click(function() {
                $('#PartiesViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>