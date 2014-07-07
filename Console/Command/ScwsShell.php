<?php

class ScwsShell extends AppShell {

    public $uses = array('Parliamentarian');

    public function main() {

        $motions = $this->Parliamentarian->Motion->find('all');
        $terms = $this->Parliamentarian->Motion->Term->find('all');
        $terms = Set::combine($terms, '{n}.Term.name', '{n}.Term');
        $motionsCount = count($motions);
        $motionsCurrent = 0;

        foreach ($motions AS $motion) {
            ++$motionsCurrent;
            $this->out("processing motion {$motionsCurrent} / {$motionsCount}");
            $cws = scws_new();
            $cws->set_charset('utf8');

            $cws->set_ignore(true);
            $cws->send_text(implode(',', array(
                $motion['Motion']['summary'],
                $motion['Motion']['description'],
                $motion['Motion']['status'],
            )));

            $list = $cws->get_words('~v');
            foreach ($list as $tmp) {
                if (strlen($tmp['word']) > 3) {
                    if (!isset($terms[$tmp['word']])) {
                        $this->Parliamentarian->Motion->Term->create();
                        if ($this->Parliamentarian->Motion->Term->save(array('Term' => array(
                                        'name' => $tmp['word'],
                                        'count' => 0,
                            )))) {
                            $terms[$tmp['word']] = array(
                                'id' => $this->Parliamentarian->Motion->Term->getInsertID(),
                                'name' => $tmp['word'],
                                'count' => 0,
                            );
                        }
                    }
                    $this->Parliamentarian->Motion->MotionsTerm->create();
                    if ($this->Parliamentarian->Motion->MotionsTerm->save(array('MotionsTerm' => array(
                                    'Motion_id' => $motion['Motion']['id'],
                                    'Term_id' => $terms[$tmp['word']]['id'],
                        )))) {
                        ++$terms[$tmp['word']]['count'];
                    }
                }
            }
        }

        foreach ($terms AS $term) {
            $this->Parliamentarian->Motion->Term->id = $term['id'];
            $this->Parliamentarian->Motion->Term->save(array('Term' => array(
                    'count' => $term['count'],
            )));
        }

        return;



        foreach (glob('/home/kiang/public_html/tncc/download/*.txt') AS $file) {
            $cws = scws_new();
            $cws->set_charset('utf8');
            $cws->set_dict(ini_get('scws.default.fpath') . '/dict_cht.utf8.xdb');

            $cws->set_ignore(true);
            $cws->send_text(file_get_contents($file));

            while ($res = $cws->get_result()) {
                foreach ($res as $tmp) {
                    echo "{$tmp['word']}\t";
                }
            }
            echo "\n\n";
        }

        foreach (glob('/home/kiang/public_html/tncc/download/*.txt') AS $file) {
            $cws = scws_new();
            $cws->set_charset('utf8');
            $cws->set_dict(ini_get('scws.default.fpath') . '/dict_cht.utf8.xdb');

            $cws->set_ignore(true);
            $cws->send_text(file_get_contents($file));

            $list = $cws->get_tops(100, '~v');

            foreach ($list as $tmp) {
                echo "{$tmp['word']}\t";
            }
            echo "\n\n";
        }
    }

}
