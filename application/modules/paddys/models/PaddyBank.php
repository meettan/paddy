<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaddyBank extends CI_Model {

    public function f_get_bank(){

        $sql = $this->db->query("select a.sl_no sl_no,a.bank_id bank_id,a.branch branch,
                                        a.ifs ifs,a.acc_no acc_no,a.short_code short_code,
                                        a.micr_code micr_code,a.trans_code trans_code
                                 from   md_paddy_bank a
                                 ");

        return $sql->result();
    }

    public function f_get_bank_dtls($bankId){

        $sql = $this->db->query("select a.sl_no sl_no,a.bank_id bank_id,a.branch branch,
                                        a.ifs ifs,a.acc_no acc_no,a.short_code short_code,
                                        a.micr_code micr_code,a.trans_code trans_code
                                 from   md_paddy_bank a
                                 where  a.sl_no = $bankId"
                                );

        return $sql->row();
    }


}
