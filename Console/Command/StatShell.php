<?php

class StatShell extends AppShell {

    public $uses = array('Parliamentarian');

    public function main() {
        $parliamentarians = $this->Parliamentarian->find('list');
        foreach ($parliamentarians AS $parliamentarianId => $parliamentarian) {
            $this->Parliamentarian->query("UPDATE parliamentarians SET count_submits = (SELECT COUNT(*) FROM motions_parliamentarians WHERE Parliamentarian_id = '{$parliamentarianId}' AND type = 'requester') WHERE id = '{$parliamentarianId}'");
            $this->Parliamentarian->query("UPDATE parliamentarians SET count_petitions = (SELECT COUNT(*) FROM motions_parliamentarians WHERE Parliamentarian_id = '{$parliamentarianId}' AND type = 'petition') WHERE id = '{$parliamentarianId}'");
        }
    }

}
