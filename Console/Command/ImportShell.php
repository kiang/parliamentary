<?php

class ImportShell extends AppShell {

    public $uses = array('Parliamentarian');

    public function main() {
        $jsonFile = TMP . 'tnccp2.json';
        if (!file_exists($jsonFile)) {
            file_put_contents($jsonFile, file_get_contents('https://github.com/kiang/tncc/raw/master/tnccp2/tnccp2.json'));
        }
        $c = json_decode(file_get_contents($jsonFile), true);
        $parties = $this->Parliamentarian->Party->find('list', array(
            'fields' => array('name', 'id'),
        ));
        $parliamentarians = array();
        foreach ($c AS $p) {
            $contact = array();
            foreach ($p['each_terms'][0]['contact_details'] AS $line) {
                $contact[$line['label']] = $line['value'];
            }
            if (!isset($parties[$p['each_terms'][0]['party']])) {
                $this->Parliamentarian->Party->create();
                $this->Parliamentarian->Party->save(array('Party' => array(
                        'name' => $p['each_terms'][0]['party'],
                )));
                $parties[$p['each_terms'][0]['party']] = $this->Parliamentarian->Party->getInsertID();
            }
            $pDb = $this->Parliamentarian->find('first', array(
                'conditions' => array(
                    'name' => $p['name'],
                    'district' => $p['each_terms'][0]['district'],
                    'ad' => '2',
                ),
            ));
            if (empty($pDb)) {
                $this->Parliamentarian->create();
                $this->Parliamentarian->save(array('Parliamentarian' => array(
                        'Party_id' => $parties[$p['each_terms'][0]['party']],
                        'name' => $p['name'],
                        'district' => $p['each_terms'][0]['district'],
                        'contacts_phone' => isset($contact['電話']) ? $contact['電話'] : '',
                        'contacts_fax' => isset($contact['傳真']) ? $contact['傳真'] : '',
                        'contacts_email' => isset($contact['電子信箱']) ? $contact['電子信箱'] : '',
                        'contacts_address' => isset($contact['通訊處']) ? $contact['通訊處'] : '',
                        'links_council' => $p['each_terms'][0]['links'][0]['url'],
                        'gender' => ($p['each_terms'][0]['gender'] === '女性') ? 'F' : 'M',
                        'image_url' => $p['each_terms'][0]['image'],
                        'experience' => implode("\n", $p['each_terms'][0]['experience']),
                        'platform' => (is_array($p['each_terms'][0]['platform'])) ? implode("\n", $p['each_terms'][0]['platform']) : $p['each_terms'][0]['platform'],
                        'birth' => date('Y-m-d', strtotime($p['birth'])),
                        'party' => $p['each_terms'][0]['party'],
                        'constituency' => $p['each_terms'][0]['constituency'],
                        'education' => implode("\n", $p['each_terms'][0]['education']),
                        'ad' => '2',
                        'count_submits' => 0,
                        'count_petitions' => 0,
                )));
                $pDb = $this->Parliamentarian->read();
            }
            if (!isset($parliamentarians[$pDb['Parliamentarian']['district']])) {
                $parliamentarians[$pDb['Parliamentarian']['district']] = array();
            }
            $parliamentarians[$pDb['Parliamentarian']['district']][$pDb['Parliamentarian']['name']] = $pDb;
        }
        
        print_r($parliamentarians);

        return;

        $jsonMotionFiles = array();

        foreach (glob('/home/kiang/public_html/tncc/motions/*/*/*.json') AS $jsonMotionFile) {
            $jsonMotionFiles[] = $jsonMotionFile;
        }

        foreach (glob('/home/kiang/public_html/tncc/motions/misc/*.json') AS $jsonMotionFile) {
            $jsonMotionFiles[] = $jsonMotionFile;
        }

        foreach ($jsonMotionFiles AS $jsonMotionFile) {
            $jsonMotion = json_decode(file_get_contents($jsonMotionFile), true);
            $motionId = substr($jsonMotionFile, -41, 36);
            if ($this->Parliamentarian->Motion->find('count', array(
                        'conditions' => array('id' => $motionId),
                    )) === 0) {
                $this->Parliamentarian->Motion->create();
            } else {
                $this->Parliamentarian->Motion->id = $motionId;
            }
            $this->Parliamentarian->Motion->save(array('Motion' => array(
                    'id' => substr($jsonMotionFile, -41, 36),
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
