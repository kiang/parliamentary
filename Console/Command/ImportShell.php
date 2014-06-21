<?php

class ImportShell extends AppShell {

    public $uses = array('Parliamentarian');

    public function main() {
        $jsonFile = TMP . 'tnccp.json';
        if (!file_exists($jsonFile)) {
            file_put_contents($jsonFile, file_get_contents('https://github.com/kiang/tncc/raw/master/tnccp.json'));
        }
        $c = json_decode(file_get_contents($jsonFile), true);
        $parties = $this->Parliamentarian->Party->find('list', array(
            'fields' => array('name', 'id'),
        ));
        $parliamentarians = array();
        foreach ($c AS $p) {
            if (!isset($parties[$p['party']])) {
                $this->Parliamentarian->Party->create();
                $this->Parliamentarian->Party->save(array('Party' => array(
                        'name' => $p['party'],
                )));
                $parties[$p['party']] = $this->Parliamentarian->Party->getInsertID();
            }
            $pDb = $this->Parliamentarian->find('first', array(
                'conditions' => array(
                    'name' => $p['name'],
                    'district' => $p['district'],
                ),
            ));
            if (empty($pDb)) {
                $this->Parliamentarian->create();
                $this->Parliamentarian->save(array('Parliamentarian' => array(
                        'Party_id' => $parties[$p['party']],
                        'name' => $p['name'],
                        'district' => $p['district'],
                        'contacts_phone' => $p['contacts']['phone'],
                        'contacts_fax' => $p['contacts']['fax'],
                        'contacts_email' => $p['contacts']['email'],
                        'contacts_address' => $p['contacts']['address'],
                        'links_council' => $p['links']['council'],
                        'gender' => ($p['gender'] === '女性') ? 'F' : 'M',
                        'image_url' => $p['image'],
                        'experience' => implode("\n", $p['experience']),
                        'platform' => (is_array($p['platform'])) ? implode("\n", $p['platform']) : $p['platform'],
                        'birth' => date('Y-m-d', strtotime($p['birth'])),
                        'party' => $p['party'],
                        'constituency' => $p['constituency'],
                        'education' => implode("\n", $p['education']),
                        'group' => $p['group'],
                        'ad' => $p['ad'],
                )));
                $pDb = $this->Parliamentarian->read();
            }
            if (!isset($parliamentarians[$pDb['Parliamentarian']['district']])) {
                $parliamentarians[$pDb['Parliamentarian']['district']] = array();
            }
            $parliamentarians[$pDb['Parliamentarian']['district']][$pDb['Parliamentarian']['name']] = $pDb;
        }

        foreach (glob('/home/kiang/public_html/tncc/motions/*/*/*.json') AS $jsonMotionFile) {
            $jsonMotion = json_decode(file_get_contents($jsonMotionFile), true);
            $this->Parliamentarian->Motion->create();
            $this->Parliamentarian->Motion->save(array('Motion' => array(
                    'sequence' => $jsonMotion['議案屆次別'],
                    'type' => $jsonMotion['大會類別'],
                    'group_type' => $jsonMotion['審查會別'],
                    'number' => $jsonMotion['案號'],
                    'source' => $jsonMotion['提案類別'],
                    'requested_date' => $jsonMotion['來文日期'],
                    'requested_number' => $jsonMotion['來文字號'],
                    'requester' => is_array($jsonMotion['提案單位/人']) ? implode(",", $jsonMotion['提案單位/人']) : $jsonMotion['提案單位/人'],
                    'petition_people' => is_array($jsonMotion['連署人']) ? implode(",", $jsonMotion['連署人']) : $jsonMotion['連署人'],
                    'summary' => $jsonMotion['主旨'],
                    'description' => $jsonMotion['說明'],
                    'rules' => $jsonMotion['辦法'],
                    'comments' => $jsonMotion['審查意見'],
                    'result' => $jsonMotion['大會決議'],
                    'status' => $jsonMotion['辦理情形'],
                    'result_date' => $jsonMotion['決議日期'],
                    'posting_date' => $jsonMotion['發文日期'],
                    'posting_number' => $jsonMotion['發文字號'],
                    'attachments' => $jsonMotion['議會附件一'],
            )));
        }
    }

}
