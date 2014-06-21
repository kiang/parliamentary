<div id="ParliamentariansView">
    <h3><?php echo __('View Parliamentarians', true); ?></h3><hr />
    <div class="span12">
        <div class="span2">Parties</div>
        <div class="span9"><?php
if (empty($this->data['Party']['id'])) {
    echo '--';
} else {
    echo $this->Html->link($this->data['Party']['id'], array(
        'controller' => 'parties',
        'action' => 'view',
        $this->data['Party']['id']
    ));
}
?></div>

        <div class="span2">Name</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['name']) {

                echo $this->data['Parliamentarian']['name'];
            }
?>&nbsp;
        </div>
        <div class="span2">District</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['district']) {

                echo $this->data['Parliamentarian']['district'];
            }
?>&nbsp;
        </div>
        <div class="span2">Phone</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['contacts_phone']) {

                echo $this->data['Parliamentarian']['contacts_phone'];
            }
?>&nbsp;
        </div>
        <div class="span2">Fax</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['contacts_fax']) {

                echo $this->data['Parliamentarian']['contacts_fax'];
            }
?>&nbsp;
        </div>
        <div class="span2">Email</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['contacts_email']) {

                echo $this->data['Parliamentarian']['contacts_email'];
            }
?>&nbsp;
        </div>
        <div class="span2">Address</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['contacts_address']) {

                echo $this->data['Parliamentarian']['contacts_address'];
            }
?>&nbsp;
        </div>
        <div class="span2">Council Link</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['links_council']) {

                echo $this->data['Parliamentarian']['links_council'];
            }
?>&nbsp;
        </div>
        <div class="span2">Gender</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['gender']) {

                echo $this->data['Parliamentarian']['gender'];
            }
?>&nbsp;
        </div>
        <div class="span2">Image Url</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['image_url']) {

                echo $this->data['Parliamentarian']['image_url'];
            }
?>&nbsp;
        </div>
        <div class="span2">Experience</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['experience']) {

                echo $this->data['Parliamentarian']['experience'];
            }
?>&nbsp;
        </div>
        <div class="span2">Platform</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['platform']) {

                echo $this->data['Parliamentarian']['platform'];
            }
?>&nbsp;
        </div>
        <div class="span2">Birthday</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['birth']) {

                echo $this->data['Parliamentarian']['birth'];
            }
?>&nbsp;
        </div>
        <div class="span2">Party</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['party']) {

                echo $this->data['Parliamentarian']['party'];
            }
?>&nbsp;
        </div>
        <div class="span2">Constituency</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['constituency']) {

                echo $this->data['Parliamentarian']['constituency'];
            }
?>&nbsp;
        </div>
        <div class="span2">Education</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['education']) {

                echo $this->data['Parliamentarian']['education'];
            }
?>&nbsp;
        </div>
        <div class="span2">Group</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['group']) {

                echo $this->data['Parliamentarian']['group'];
            }
?>&nbsp;
        </div>
        <div class="span2">Ad</div>
        <div class="span9"><?php
            if ($this->data['Parliamentarian']['ad']) {

                echo $this->data['Parliamentarian']['ad'];
            }
?>&nbsp;
        </div>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Parliamentarians List', true), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('View Related Motions', true), array('controller' => 'motions', 'action' => 'index', 'Parliamentarian', $this->data['Parliamentarian']['id']), array('class' => 'ParliamentariansViewControl')); ?></li>
        </ul>
    </div>
    <div id="ParliamentariansViewPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('a.ParliamentariansViewControl').click(function() {
                $('#ParliamentariansViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>