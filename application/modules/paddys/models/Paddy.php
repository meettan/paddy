<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paddy extends CI_Model {

    public function f_get_particulars($table_name, $select=NULL, $where=NULL, $flag,$order=NULL,$condition=NULL) {
        
        if(isset($select)) {

            $this->db->select($select);

        }

        if(isset($where)) {

            $this->db->where($where);

        }

        if(isset($order) && isset($condition)) {


           $this->db->order_by($order, $condition);

        }

        $result		=	$this->db->get($table_name);

        if($flag == 1) {

            return $result->row();
            
        }else {

            return $result->result();

        }

    }
    public function f_district_orderby() {
        
            $this->db->select("*");
            $this->db->order_by('district_name', 'asc');
            $result = $this->db->get("md_district");
            return $result->result();

    }
    public function f_get_particulars_array($table_name, $select=NULL, $where=NULL) {
        
        if(isset($select)) {

            $this->db->select($select);

        }

        if(isset($where)) {

            $this->db->where($where);

        }

        $result		=	$this->db->get($table_name);
       
       
            return $result->result_array();

    }

    //For Where in Clause for employees
    public function f_get_particulars_in($table_name, $where_in=NULL, $where=NULL) {

        if(isset($where)){

            $this->db->where($where);

        }

        if(isset($where_in)){

            $this->db->where_in('sl_no', $where_in);

        }
        
        $result	=	$this->db->get($table_name);

        return $result->result();

    }

    public function f_get_distinct($table_name, $select=NULL, $where=NULL) {

        $this->db->distinct();

        if(isset($select)) {

            $this->db->select($select);

        }

        if(isset($where)) {

            $this->db->where($where);

        }

        $result		=	$this->db->get($table_name);

        return $result->result();
        
    }

    

    //For inserting row

    public function f_insert($table_name, $data_array) {

        $this->db->insert($table_name, $data_array);

        return $this->db->insert_id();

    }

    //For Inserting Multiple Row

    public function f_insert_multiple($table_name, $data_array){

        $this->db->insert_batch($table_name, $data_array);

        return;

    }

    //For Editing row

    public function f_edit($table_name, $data_array, $where) {

        $this->db->where($where);
        $this->db->update($table_name, $data_array);

        return;

    }

    //For Deliting row

    public function f_delete($table_name, $where) {

        $this->db->delete($table_name, $where);

        return;

    }
    // For Society Mill Relation

    public function f_get_soc_mil($brn_cd,$kms_id){
        $sql = $this->db->query("SELECT a.branch_id branch_id,a.soc_id soc_id,a.mill_id mill_id,
                                        a.distance distance,a.reg_no agreementno,a.target target,a.created_by created_by,a.modified_by modified_by,
                                        a.kms_id kms_id,b.soc_name soc_name,c.mill_name mill_name
                                 FROM md_soc_mill a,
                                 md_society b,md_mill c  
                                 where a.soc_id = b.sl_no
                                 and   a.mill_id = c.sl_no 
                                 and   a.branch_id = '$brn_cd'
                                 and   a.kms_id =  $kms_id");

       // $result		=	$this->db->get();

        return $sql->result();
    }
    public function f_get_connected_mills($soc_id){

        $this->db->select("*");
        $this->db->from("md_soc_mill");
        $this->db->join('md_society','md_society.sl_no = md_soc_mill.soc_id');
        $this->db->join('md_mill','md_mill.sl_no = md_soc_mill.mill_id');
        $this->db->where('md_soc_mill.soc_id',$soc_id);
        $this->db->where('md_soc_mill.branch_id',$this->session->userdata['loggedin']['branch_id']);
        $this->db->where('md_soc_mill.kms_id',$this->session->userdata['loggedin']['kms_id']);
        $result		=	$this->db->get();


        return $result->result();
    }

    public function f_get_order_placed($soc_id,$mill_id){

        $this->db->select_sum('paddy_qty');   
        $this->db->from("td_work_order");
        $this->db->where('td_work_order.soc_id',$soc_id);
        $this->db->where('td_work_order.mill_id',$mill_id);
        $this->db->where('td_work_order.branch_id',$this->session->userdata['loggedin']['branch_id']);
        $this->db->where('td_work_order.kms_year',$this->session->userdata['loggedin']['kms_id']);
        $result		=	$this->db->get();
        return $result->row();

    }
    //For Report
    public function f_mill_count($from_date, $to_date){

        $sql = "SELECT `t`.`dist`, `m`.`district_name`, SUM(t.count) count FROM `md_district` `m`, (SELECT dist, `soc_id`, count(DISTINCT mill_id) count FROM td_received WHERE trans_dt BETWEEN '$from_date' AND '$to_date' GROUP BY dist, soc_id) t WHERE `m`.`district_code` = `t`.`dist`  GROUP BY `t`.`dist`";

        $result =   $this->db->query($sql);

        return $result->result();

    }

    //District Wise Report
    public function f_get_distwise($from_date, $to_date){

        $data_array = array();

        $sql = "SELECT DISTINCT soc_id, dist FROM  td_received
                                             WHERE trans_dt BETWEEN '$from_date' AND '$to_date'";

        $result = $this->db->query($sql);

       $select = array("soc_id", "dist");
        
        if($result->row()){

            foreach($result->result() as $row){

                unset($sql);

                $sql = "SELECT soc_id, 
                               mill_id, 
                               dist,
                               SUM(camp_no) camp_no, 
                               SUM(farmer_no) farmer_no, 
                               SUM(progressive) progressive, 
                               SUM(delivared_to_mill) delivared_to_mill, 
                               SUM(resultant_cmr) resultant_cmr, 
                               SUM(cmr_offered) cmr_offered, 
                               SUM(do_isseue) do_isseue, 
                               SUM(cmr_delivered) cmr_delivered FROM `td_transaction` 
                                                                WHERE soc_id = '$row->soc_id'
                                                                AND trans_dt BETWEEN '$from_date' AND '$to_date' GROUP BY soc_id, mill_id, dist";
                
                $tempResult = $this->db->query($sql);      
                
                array_push($data_array, $tempResult->result());

            }

        }

        return $data_array;
        
    }

    //Group of Districts
    public function f_get_dist_group_count($from_date, $to_date) {

        $sql = "SELECT a.dist, sum(mill) count FROM (SELECT dist, 
                                                            soc_id, 
                                                            mill_id, 
                                                            COUNT(DISTINCT mill_id) mill FROM `td_transaction` 
                                                                                     WHERE trans_dt BETWEEN '$from_date' AND '$to_date'
                                                                                     GROUP BY dist, soc_id, mill_id) a 
                                         GROUP BY a.dist";


        $result =   $this->db->query($sql);

        return $result->result();
        
    }
    

    //Block Wise Report

    public function f_get_blockwise($from_date, $to_date){

        $data_array = array();

        $sql = "SELECT DISTINCT soc_id, block FROM td_transaction
                                         WHERE trans_dt BETWEEN '$from_date' AND '$to_date'";

        $result = $this->db->query($sql);

       $select = array("soc_id", "block");
        
        if($result->row()){

            foreach($result->result() as $row){

                unset($sql);

                $sql = "SELECT soc_id, 
                               mill_id, 
                               block,
                               SUM(camp_no) camp_no, 
                               SUM(farmer_no) farmer_no, 
                               SUM(progressive) progressive, 
                               SUM(delivared_to_mill) delivared_to_mill, 
                               SUM(resultant_cmr) resultant_cmr, 
                               SUM(cmr_offered) cmr_offered, 
                               SUM(do_isseue) do_isseue, 
                               SUM(cmr_delivered) cmr_delivered FROM `td_transaction` 
                                                                WHERE soc_id = '$row->soc_id'
                                                                AND trans_dt BETWEEN '$from_date' AND '$to_date' GROUP BY soc_id, mill_id, block";
                
                $tempResult = $this->db->query($sql);      
                
                array_push($data_array, $tempResult->result());

            }

        }

        return $data_array;
        
    }

    public function f_get_block_group_count($from_date, $to_date) {

        $sql = "SELECT a.block, sum(mill) count FROM (SELECT block, 
                                                            soc_id, 
                                                            mill_id, 
                                                            COUNT(DISTINCT mill_id) mill FROM `td_transaction` 
                                                                                     WHERE trans_dt BETWEEN '$from_date' AND '$to_date'
                                                                                     GROUP BY block, soc_id, mill_id) a 
                                         GROUP BY a.block";


        $result =   $this->db->query($sql);

        return $result->result();
        
    }

    public function f_get_paddy_dtls($soc_id, $mill_id){

        $data_array['resultant'] =
        $data_array['offered'] =
        $data_array['isseued'] =
        $data_array['delivery'] = array();

        $where = array(

            'soc_id'    => $soc_id,

            'mill_id = "'.$mill_id.'" GROUP BY soc_id, mill_id' => NULL


        );

        $select = array(

            'soc_id', 'mill_id', 
            'ifnull(SUM(resultant_cmr), 0) resultant',
            'ifnull(SUM(tot_offered), 0) offered',
            'ifnull(SUM(sp), 0) offered_sp',
            'ifnull(SUM(cp), 0) offered_cp',
            'ifnull(SUM(fci), 0) offered_fci'

        );

        //CMR resultant and offer
        $result = $this->f_get_particulars('td_cmr_offered', $select, $where, 1);
        
        unset($select);

        $select = array(
            
            'soc_id', 'mill_id',
            'ifnull(SUM(tot_doisseued), 0) isseued',
            'ifnull(SUM(sp), 0) isseued_sp',
            'ifnull(SUM(cp), 0) isseued_cp',
            'ifnull(SUM(fci), 0) isseued_fci'
        
        );
        //CMR do isseued
        $result1 = $this->f_get_particulars('td_do_isseued', $select, $where, 1);

        unset($select);

        $select =   array(
            
            'soc_id', 'mill_id', 
            'ifnull(SUM(tot_delivery), 0) delivery',
            'ifnull(SUM(sp), 0) delivery_sp',
            'ifnull(SUM(cp), 0) delivery_cp',
            'ifnull(SUM(fci), 0) delivery_fci'
        );

        //CMR delivery
        $result2 = $this->f_get_particulars('td_cmr_delivery', $select, $where, 1);

        $data_array['resultant']    = (isset($result)? $result->resultant:0);
        $data_array['offered']      = (isset($result)? $result->offered:0);
        $data_array['offered_sp']   = (isset($result)? $result->offered_sp : 0);
        $data_array['offered_cp']   = (isset($result)? $result->offered_cp : 0);
        $data_array['offered_fci']  = (isset($result)? $result->offered_fci: 0);
        
        $data_array['isseued']      = (isset($result1)? $result1->isseued:0);
        $data_array['isseued_sp']   = (isset($result1)? $result1->isseued_sp : 0);
        $data_array['isseued_cp']   = (isset($result1)? $result1->isseued_cp : 0);
        $data_array['isseued_fci']  = (isset($result1)? $result1->isseued_fci: 0);
        
        $data_array['delivery']     = (isset($result2)? $result2->delivery:0);
        $data_array['delivery_sp']  = (isset($result2)? $result2->delivery_sp : 0);
        $data_array['delivery_cp']  = (isset($result2)? $result2->delivery_cp : 0);
        $data_array['delivery_fci'] = (isset($result2)? $result2->delivery_fci: 0);

        
        return $data_array;
    }

    //Payment Details
    public function f_get_payments($kms_id,$br_id){

        $sql = "SELECT DISTINCT t.pmt_bill_no,s.soc_name,m.mill_name,t.trans_dt,t.ho_status,t.dist,t.kms_id,t.ben_bill_no,t.ho_bill_number
                FROM td_payment_bill t, md_society s,md_mill m
                WHERE t.soc_id = s.sl_no 
                and   t.mill_id = m.sl_no
                and   t.kms_id = '$kms_id'
                and   t.dist     = '$br_id'";

        $result = $this->db->query($sql);     
        
        return $result->result();
        
    }
    public function get_order_no($kms_id,$branch_id){

              $sql="select ifnull(max(order_no),0) + 1 order_no
                       from td_work_order where kms_year = '$kms_id' AND branch_id= '$branch_id'";

            $result = $this->db->query($sql);     
        
            return $result->row();

    }

    //Only One Payment
    public function f_get_payment($pmt_bill_no){

        $sql = "SELECT DISTINCT t.pmt_bill_no, t.wqsc,t.paddy_butta, t.dist, t.soc_id, t.mill_id, m.block, t.pool_type,
                                t.tot_paddy, t.tot_cmr, t.trans_dt, t.rice_type,t.pay_mode,t.bank_id,t.ref_no,t.ho_status,t.mandi_board,t.mandi_board_addr,t.transport_agency_name,t.transport_agency_addr
                FROM td_payment_bill t, 
                     md_society m
                WHERE t.pmt_bill_no = $pmt_bill_no
                AND   t.soc_id = m.sl_no";

        $result = $this->db->query($sql);     
        
        return $result->row();
        
    }

    //Payment Details
    public function f_payment($pmt_bill_no){

        $sql = "SELECT DISTINCT t.pmt_bill_no, t.kms_year, md.district_name, ms.soc_name, mm.mill_name, ms.block,
                                t.tot_paddy, t.tot_cmr, t.trans_dt, t.rice_type, t.extra_delivery
                FROM td_payment_bill t, 
                     md_society ms,
                     md_mill mm,
                     md_district md
                WHERE t.pmt_bill_no = (SELECT DISTINCT pmt_bill_no FROM td_payment_bill WHERE ben_bill_no = $pmt_bill_no)
                AND   t.soc_id = ms.sl_no
                AND   t.mill_id = mm.sl_no
                AND   t.dist = md.district_code";

        $result = $this->db->query($sql);     
        
        return $result->row();
        
    }

    //Documents Maintenance
    public function f_doc_maintenance($bill_no, $poolType, $kms_year){

        $sql = "SELECT `m`.`sl_no`, `m`.`documents`, ifnull(`t`.`status`, 0) status
                FROM `md_documents` `m` LEFT JOIN (SELECT `doc_id`, `status` FROM `td_doc_maintenance` 
                WHERE `bill_no` = '$bill_no' AND `pool_type` = '$poolType' AND `kms_year` = '$kms_year') t ON `m`.`sl_no` = `t`.`doc_id` ORDER BY `m`.`sl_no`";

        $result = $this->db->query($sql);

        return $result->result();

    }

    //Paid Details
    public function f_get_paids($paid_id){

        $sql = "SELECT t.payment_dt, t.paid_no, t.total_payble, t.amount,
                       t.trans_type, t.chq_no, t.chq_dt, t.bank, t.pool_type
                
                FROM td_paid_dtls t
                                        
                WHERE t.paid_no = $paid_id";

        $result = $this->db->query($sql);

        return $result->row();
        
    }

    //Get Guidelines  Details Which are included in particular society
    public function getguidelineDtls($socId, $branch_id){
        $sql = "SELECT g.sl_no, g.guide_lines, ifnull(s.soc_mill_id, 0) checkId
                FROM md_fs_guide_lines g LEFT JOIN md_fs_soc_mill s
                ON g.sl_no = s.guide_lines_id
                WHERE
                s.soc_mill_identifiers= 'S'
                AND s.branch_id = $branch_id
                AND s.soc_mill_id = $socId";
             
        return $this->db->query($sql)->result();        
    }

    //Checking a particular Bill No for a particular pool type is present or not
    public function f_check_bill_no($billArray, $poolType, $kms){

        $this->db->distinct();
        $this->db->select('bill_no');
        $this->db->where('kms_yr', $kms);
        $this->db->where('pool_type', $poolType);
        $this->db->where_in('bill_no', explode(',', $billArray));
        $result = $this->db->get('td_bill');

        return $result->result();
    }



    //Payble Bill No(s)
    public function f_payble_bill_no($billArray, $poolType, $kms){

        $sql = "SELECT DISTINCT tb.`ben_bill_no` as `bill_no` 
                FROM `td_payment_bill` tb, td_bill t
                WHERE tb.ben_bill_no = t.bill_no
                AND tb.`kms_year` = '$kms' 
                AND t.`pool_type` = '$poolType' 
                AND tb.`ben_bill_no` IN ($billArray)";

        $result = $this->db->query($sql);

        return $result->result();
    }

    //All Billing amount
    public function f_allBillAmount($bills, $poolType, $kms){
        
        $billsArray = explode(',', $bills);
        $sum = 0.00;

        for($i = 0; $i < count($billsArray); $i++){

            $sql = "SELECT (tot_msp
                            +
                            market_fee
                            +
                            mandi_chrg
                            +
                            transportation1
                            +
                            transportation2
                            +
                            transportation3
                            +
                            driage
                            +
                            comm_soc
                            +
                            comm_mill
                            +
                            cgst_milling
                            +
                            sgst_milling
                            +
                            admin_chrg
                            +
                            transportation_cmr1
                            +
                            gunny_usege
                            +
                            cgst_gunny
                            +
                            sgst_gunny
                            -
                            butta_cut
                            -
                            gunny_cut) tot FROM td_bill
                WHERE kms_yr = '$kms'
                AND pool_type = '$poolType'
                AND bill_no = $billsArray[$i]";

            $data = $this->db->query($sql);

            if($data->num_rows() > 0)
                $sum += $data->row()->tot;

            unset($data);

        }

        return $sum;
    }

    //Check Bill No present in the table  bill_no
    public function f_exsists($table_name, $billArray, $poolType, $kms){
        $this->db->select('bill_no');
        $this->db->where('kms_year', $kms);
        $this->db->where('pool_type', $poolType);
        $this->db->where_in('bill_no', explode(',', $billArray));
        return $this->db->get($table_name)->result();
        
    }

    //Total Receivable for a particular pool type
    public function f_getReceivable($billNos,$kms){
        $sql = "SELECT tr.received_no, tr.receivable_amt
                FROM `td_received_bill_dtls` tb, `td_payment_received` tr
                WHERE tb.received_no = tr.received_no
                AND tb.kms_year = '$kms'
                AND tb.pool_type = '".$this->input->get('pool_type')."'
                AND tb.bill_no IN ($billNos)
                GROUP BY tr.received_no
                ORDER BY tr.received_no DESC LIMIT 0,1";

        $data = $this->db->query($sql);
        
        if($data->num_rows() > 0){
            return $data->row();
        }
        else{
            return false;
        }
            
    }

    //All Procurement between two dates
    public function f_get_procurements(){

        $sql = "SELECT t1.*, t2.farmer_no FROM 
                (SELECT `d`.`district_name`,
                `m`.`soc_name`, t.soc_id, SUM(t.no_of_camp) no_of_camp, 
                SUM(t.no_of_farmer) no_of_farmer, 
                SUM(t.paddy_qty) paddy_qty 
                FROM `td_collections` `t`, `md_district` `d`, `md_society` `m`
                WHERE `t`.`dist` = `d`.`district_code` 
                AND `t`.`soc_id` = `m`.`sl_no`
                AND t.trans_dt 
                BETWEEN '".$this->input->post('from_date')."' 
                AND '".$this->input->post('to_date')."' GROUP BY `d`.`district_name`, `m`.`soc_name`) t1,
                (SELECT soc_id, SUM(farmer_no) farmer_no FROM
                td_reg_farmer 
                WHERE trans_dt 
                BETWEEN '".$this->input->post('from_date')."' 
                AND '".$this->input->post('to_date')."' 
                GROUP BY soc_id) t2 
                WHERE t1.soc_id = t2.soc_id ORDER BY t1.district_name";
    
        return $this->db->query($sql)->result();
    }


    public function f_get_collection($brn_cd,$kms_yr){
       
       $sql = "select a.soc_name soc_name,
                      b.soc_id soc_id,
                      b.trans_dt trans_dt,
                      b.bulk_trans_id,
                      b.forward_bulk_trans_id forward_bulk_trans_id,  
                      sum(b.quantity)tot_qty,
                      sum(b.amount)tot_amt,
                      b.status status,
                      b.forwarded_by forwarded_by,
                      b.chq_status chq_status
                from   md_society a ,td_collections b
                where  a.sl_no      = b.soc_id
                and    b.branch_id  = $brn_cd
               
                and    b.kms_id     = $kms_yr
                group by a.soc_name,
                         b.soc_id,
                         b.bulk_trans_id,
                         b.forward_bulk_trans_id,
                         b.trans_dt,
                         b.status,
                         b.forwarded_by,
                         b.chq_status
                order by b.trans_dt,b.bulk_trans_id
                ";
        
        $data = $this->db->query($sql);
       
        return $data->result();

    }

     public function getneft($brn_cd,$kms_yr){
       
       $sql = "select a.soc_name soc_name,
                      b.soc_id soc_id,
                      b.trans_dt trans_dt,
                      b.bulk_trans_id,
                      b.forward_bulk_trans_id forward_bulk_trans_id,  
                      sum(b.quantity)tot_qty,
                      sum(b.amount)tot_amt,
                      b.status status,
                      b.forwarded_by forwarded_by,
                      b.chq_status chq_status
                from   md_society a ,td_collections b
                where  a.sl_no      = b.soc_id
                and    b.branch_id  = $brn_cd
                and    b.book_no    = '0'
                and    b.status     = '1'
                and    b.kms_id     = $kms_yr
                group by a.soc_name,
                         b.soc_id,
                         b.bulk_trans_id,
                         b.forward_bulk_trans_id,
                         b.trans_dt,
                         b.status,
                         b.forwarded_by,
                         b.chq_status
                order by b.trans_dt,b.bulk_trans_id";
        
        $data = $this->db->query($sql);
       
        return $data->result();

    }


    public function f_get_reissuecollection($brn_cd,$kms_yr){
       
       $sql = "select a.soc_name soc_name,
                      b.soc_id soc_id,
                      b.trans_dt trans_dt,
                      b.bulk_trans_id bulk_trans_id, 
                      sum(b.quantity)tot_qty,
                      sum(b.amount)tot_amt,
                      b.status status,
                      b.chq_status chq_status,
                      b.bank_sl_no bank_sl_no,
                      c.bank_id bank_id
                from   md_society a ,td_collections b,md_paddy_bank c
                where  a.sl_no      = b.soc_id
                and    b.bank_sl_no = c.sl_no
                and    b.branch_id  = $brn_cd
                and    b.book_no != '0'
                and    b.kms_id     = $kms_yr
                group by a.soc_name,
                         b.soc_id,
                         b.bulk_trans_id,
                         b.trans_dt,
                         b.status,
                         b.chq_status,
                         b.bank_sl_no
                order by b.trans_dt,b.bulk_trans_id
                ";
        
        $data = $this->db->query($sql);
       
        return $data->result();

    }

    public function f_failneft($brn_cd,$kms_yr){
       
       $sql = "select b.soc_id soc_id,
                      b.trans_dt trans_dt,
                      b.bulk_trans_id bulk_trans_id, 
                      sum(b.quantity)tot_qty,
                      sum(b.amount)tot_amt,
                      b.status status,b.dwn_flag dwn_flag,
                      b.bank_sl_no bank_sl_no,
                      c.bank_id bank_id
                from   td_collections b,md_paddy_bank c
              
                where  b.bank_sl_no = c.sl_no
                and    b.branch_id = '$brn_cd'
                and    b.kms_id = '$kms_yr'
                and    b.chq_status = 'R'
                /*and    b.book_no    = '0'*/
                and    b.trans_type = 'N'
                group by b.soc_id,
                         b.bulk_trans_id,
                         b.trans_dt,
                         b.status,
                         b.dwn_flag,
                         b.bank_sl_no
                order by b.trans_dt
                ";
        
        $data = $this->db->query($sql);
       
        return $data->result();

    }

    public function f_failnefts($brn_cd,$kms_yr){
       
       $sql = "select b.soc_id soc_id,
                      b.trans_dt trans_dt,
                      b.bulk_trans_id bulk_trans_id,
                      b.forward_bulk_trans_id forward_bulk_trans_id,
                      b.modified_by modified_by,
                      b.modified_dt modified_dt, 
                      sum(b.quantity)tot_qty,
                      sum(b.amount)tot_amt,
                      b.status status,b.chq_status chq_status,b.forwarded_by forwarded_by,
                      b.bank_sl_no bank_sl_no,
                      c.bank_id bank_id
                from   td_collections b,md_paddy_bank c
              
                where  b.bank_sl_no = c.sl_no
                and    b.branch_id = '$brn_cd'
                and    b.kms_id = '$kms_yr'
                and    b.chq_status = 'R'
                /*and    b.book_no    = '0'*/
                and    b.trans_type = 'N'
                group by b.soc_id,
                         b.bulk_trans_id,
                         b.forward_bulk_trans_id,
                         b.modified_by,
                         b.modified_dt,
                         b.trans_dt,
                         b.status,
                         b.chq_status,
                         b.forwarded_by,
                         b.bank_sl_no
                order by b.trans_dt
                ";
        
        $data = $this->db->query($sql);
       
        return $data->result();

    }
    
    
    public function f_newcheque_issue($brn_cd,$kms_yr){
       
       $sql = "select issue_dt,bank_id
                from   td_reissue_chq
                where  branch_id = $brn_cd
                and    kms_id = $kms_yr
                group by issue_dt,bank_id
                order by issue_dt
                ";
        
        $data = $this->db->query($sql);
       
        return $data->result();

    }
    public function f_get_return_cheque($brn_cd,$kms_yr){
       
       $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.trans_dt trans_dt,b.bulk_trans_id bulk_trans_id, sum(b.quantity)tot_qty,sum(b.amount)tot_amt,b.certificate_1 certificate_1,b.certificate_2 certificate_2,
                 b.certificate_3 certificate_3,b.status status,b.bank_sl_no bank_sl_no,b.chq_status chq_status,c.bank_id bank_id
                from   md_society a ,td_collections b,md_paddy_bank c
                where  a.sl_no = b.soc_id
                and     b.bank_sl_no = c.sl_no
                and    b.branch_id = $brn_cd
                and    b.kms_id = $kms_yr
                and    b.chq_status = 'R'
                group by a.soc_name,b.soc_id,b.bulk_trans_id,b.trans_dt,b.chq_status,b.certificate_1,b.certificate_2,b.certificate_3,b.status,b.bank_sl_no
                order by b.trans_dt,b.bulk_trans_id
                ";
        
        $data = $this->db->query($sql);
       
        return $data->result();

    }
    public function f_getreturncheque($kms_yr){
       
       $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.reg_no reg_no,b.trans_dt trans_dt,b.bulk_trans_id bulk_trans_id, sum(b.quantity)tot_qty,sum(b.amount)tot_amt,d.chq_no chq_no,e.district_name district_name,
                b.status status,b.bank_sl_no bank_sl_no,b.chq_status chq_status,c.bank_id bank_id
                from   md_society a ,td_collections b,md_paddy_bank c,td_paddy_return_chq d,md_district e
                
                where  b.trans_dt = d.trans_dt
                and    b.trans_id = d.trans_id
                and    b.bulk_trans_id = d.bulk_trans_id
                and    b.branch_id = e.district_code
                and    a.sl_no = b.soc_id
                and    b.bank_sl_no = c.sl_no
                and    b.kms_id = $kms_yr
                and    b.chq_status = 'R'
                group by a.soc_name,b.soc_id,b.bulk_trans_id,b.trans_dt,b.chq_status,b.status,b.reg_no,b.bank_sl_no,d.chq_no,e.district_name
                order by b.trans_dt,b.bulk_trans_id
                ";
        
        $data = $this->db->query($sql);
       
        return $data->result();

    }
    public function f_get_collection_checker($brn_cd,$kms_yr){
       
        $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.trans_dt trans_dt,b.status status, 
        sum(b.quantity)tot_qty,sum(b.amount)tot_amt,b.certificate_1 certificate_1,b.certificate_2 certificate_2,
        b.certificate_3 certificate_3,b.ho_status ho_status,c.bank_id bank_id
                 from   md_society a ,td_collections b,md_paddy_bank c
                 where  a.sl_no = b.soc_id
                 and    b.bank_sl_no = c.sl_no
                 and    b.branch_id = $brn_cd
                 and    b.kms_id = $kms_yr
                 and    b.certificate_1 = 'Y'
                 and    b.certificate_2 = 'Y'
                 and    b.ho_status != '1' 
                 and    b.status    = '1'
                 group by a.soc_name,b.soc_id,b.status,b.trans_dt,b.certificate_1,b.certificate_2,b.certificate_3,b.status,c.bank_id,b.ho_status
                 order by b.trans_dt ASC
                 ";
         
         $data = $this->db->query($sql);
        
         return $data->result();
 
     }
     public function f_forwarded_coll_checker($brn_cd,$kms_yr){
       
        $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.trans_dt trans_dt,b.status status, 
        sum(b.quantity)tot_qty,sum(b.amount)tot_amt,b.certificate_1 certificate_1,b.certificate_2 certificate_2,
        b.certificate_3 certificate_3,b.ho_status ho_status,c.bank_id bank_id
                 from   md_society a ,td_collections b,md_paddy_bank c
                 where  a.sl_no = b.soc_id
                 and    b.bank_sl_no = c.sl_no
                 and    b.branch_id = $brn_cd
                 and    b.kms_id = $kms_yr
                 and    b.certificate_1 = 'Y'
                 and    b.certificate_2 = 'Y'
                 and    b.ho_status = '1'
                 group by a.soc_name,b.soc_id,b.status,b.trans_dt,b.certificate_1,b.certificate_2,b.certificate_3,b.status,c.bank_id,b.ho_status
                 order by b.trans_dt ASC
                 ";
         
         $data = $this->db->query($sql);
        
         return $data->result();
 
     }

     public function f_get_collection_dwn($kms_yr,$bnk_id,$trans_type){
       
        $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.trans_dt trans_dt,b.branch_id branch_id,b.bulk_trans_id bulk_trans_id, 
        sum(b.quantity)tot_qty,sum(b.amount)tot_amt,b.certificate_1 certificate_1,b.certificate_2 certificate_2,
        b.certificate_3 certificate_3,b.status,b.ho_status ho_status,b.chq_status chq_status,c.bank_id bank_id
                 from   md_society a ,td_collections b,md_paddy_bank c
                 where  a.sl_no = b.soc_id
                 and    b.bank_sl_no = c.sl_no
                 and    b.kms_id = $kms_yr
                 and    b.trans_type = '$trans_type'
                 and    b.book_no    = '0'
                 and    b.certificate_1 = 'Y'
                 and    b.certificate_2 = 'Y'
                 and    b.status = '1'
            
                 and    b.dwn_flag = '0'
                 and    b.bank_sl_no = '$bnk_id'
                 group by a.soc_name,b.soc_id,b.bulk_trans_id,b.trans_dt,b.chq_status,b.certificate_1,b.certificate_2,b.certificate_3,b.branch_id,b.status,b.chq_status,c.bank_id,b.ho_status
                 order by b.trans_dt,b.bulk_trans_id
                 ";
         
         $data = $this->db->query($sql);

       
         return $data->result();
 
     }
     public function f_get_collreissue_dwn($kms_yr,$bnk_id,$trans_type){
       
        $sql = "select b.branch_id,
        sum(b.quantity)tot_qty,sum(b.amount)tot_amt,c.bank_id bank_id
                 from   md_society a ,td_collections b,md_paddy_bank c
                 where  a.sl_no = b.soc_id
                 and    b.bank_sl_no = c.sl_no
                 and    b.kms_id = '$kms_yr'
                 and    b.trans_type = '$trans_type'
                 and    b.book_no != '0'
                 and    b.certificate_1 = 'Y'
                 and    b.certificate_2 = 'Y'
                 and    b.status = '1'
            
                 and    b.dwn_flag = '0'
                 and    b.bank_sl_no = '$bnk_id'
                 group by b.branch_id,c.bank_id
                
                 ";
         
         $data = $this->db->query($sql);

       
         return $data->result();
 
     }

     public function f_get_coll_branch_dwn($kms_yr,$bnk_id,$branch_id){
       
        $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.trans_dt trans_dt,b.bulk_trans_id bulk_trans_id, 
        sum(b.quantity)tot_qty,sum(b.amount)tot_amt,b.certificate_1 certificate_1,b.certificate_2 certificate_2,
        b.certificate_3 certificate_3,b.status,b.ho_status ho_status,b.chq_status chq_status,c.bank_id bank_id
                 from   md_society a ,td_collections b,md_paddy_bank c
                 where  a.sl_no = b.soc_id
                 and    b.bank_sl_no = c.sl_no
                 and    b.kms_id = $kms_yr
                 and    b.certificate_1 = 'Y'
                 and    b.certificate_2 = 'Y'
                 and    b.status = '1'
                 and    b.ho_status = '1'
                 and    b.dwn_flag = '0'
                 and    b.bank_sl_no = '$bnk_id'
                 and    b.branch_id = '$branch_id'
                 group by a.soc_name,b.soc_id,b.bulk_trans_id,b.trans_dt,b.chq_status,b.certificate_1,b.certificate_2,b.certificate_3,b.status,b.chq_status,c.bank_id,b.ho_status
                 order by b.trans_dt,b.bulk_trans_id
                 ";
         
         $data = $this->db->query($sql);
        
         return $data->result();
 
     }
     public function f_ifsccode($trans_dt,$bulk_trans_id,$soc_id){
         $kms_id=$this->session->userdata['loggedin']['kms_id'];
         $sql = "Select ifsc_code 
            from td_collections
             where kms_id = $kms_id and soc_id = '$soc_id' and trans_dt = '$trans_dt' and bulk_trans_id = '$bulk_trans_id'";

        $data = $this->db->query($sql);
        return $data->result();
     }
     public function f_regno_amt($trans_dt,$bulk_trans_id,$soc_id){
         $kms_id=$this->session->userdata['loggedin']['kms_id'];
         $sql = "Select reg_no,quantity 
            from td_collections
             where kms_id = $kms_id and soc_id = '$soc_id' and trans_dt = '$trans_dt' and bulk_trans_id = '$bulk_trans_id'";

        $data = $this->db->query($sql);
        return $data->result();
     }
     public function f_transcheck($trans_dt,$bulk_trans_id,$soc_id){
         $kms_id=$this->session->userdata['loggedin']['kms_id'];
         $sql = "Select * from td_collections
             where kms_id = $kms_id and soc_id = '$soc_id' and trans_dt = '$trans_dt' and bulk_trans_id = '$bulk_trans_id' and trans_id='0' " ;

        $data = $this->db->query($sql);
        return $data->num_rows();
     }
    
    public function f_farmer_detail_cheque($soc_id,$trans_dt,$bulk_trans_id){

        $kms_id=$this->session->userdata['loggedin']['kms_id'];

         $sql = "Select a.trans_dt trans_dt,a.trans_id trans_id,a.reg_no reg_no,b.farm_name farm_name,b.epic_no epic_no,b.mobile_number mobile_number,e.acc_no acc_no,e.trans_code trans_code,e.bank_id bank_id,c.soc_name soc_name,a.acc_no faccount,a.ifsc_code fifsc,
            e.short_code short_code, e.micr_code micr_code, e.ifs ifs, a.amount amount,a.quantity quantity, a.cheque_no cheque_no, a.cheque_date cheque_dt ,a.soc_id soc_id,a.branch_id dist_code,a.bulk_trans_id bulk_id
            from td_collections a, td_farmer_reg b ,md_society c, md_district d,md_paddy_bank e
            where a.reg_no = b.reg_no 
            and   a.soc_id = c.sl_no
            and   a.status = '1'
            and   a.branch_id = d.district_code
            and   a.bank_sl_no = e.sl_no
            and a.kms_id = $kms_id and a.soc_id = '$soc_id' and a.trans_dt = '$trans_dt' and a.bulk_trans_id = $bulk_trans_id and a.dwn_flag = '0' ";
   

        $data = $this->db->query($sql);
       
        return $data->result();
    }
   /// Code after Chnaging md_paddy_bank table  On 09/11/2020/  By Lokesh Kumar Jha //
    public function f_collection_details_icici_2019($soc_id,$trans_dt,$forward_bulk_trans_id){

        $kms_id=$this->session->userdata['loggedin']['kms_id'];

        $sql ="Select a.trans_dt trans_dt,a.forward_trans_id forward_trans_id,a.reg_no reg_no,a.book_no book_no,b.farm_name farm_name,e.acc_no acc_no,e.bank_id bank_id,a.acc_no faccount,a.ifsc_code fifsc, e.ifs ifs, a.amount amount,a.soc_id soc_id,a.branch_id dist_code,a.forward_bulk_trans_id bulk_id
            from td_collections a, td_farmer_reg b ,md_paddy_bank e
            where a.reg_no = b.reg_no 
            and a.bank_sl_no = e.sl_no
            and a.kms_id = $kms_id 
            and a.soc_id = '$soc_id' 
            and a.trans_dt = '$trans_dt' 
            and a.forward_bulk_trans_id = '$forward_bulk_trans_id' 
            and a.dwn_flag = '0' ";

        $data = $this->db->query($sql);
       
        return $data->result();
    }

     /// Code after Chnaging md_paddy_bank table  On 09/11/2020/  By Lokesh Kumar Jha //
    public function f_collection_details_icici($soc_id,$trans_dt,$forward_bulk_trans_id){

        $kms_id=$this->session->userdata['loggedin']['kms_id'];

        $sql ="Select a.trans_dt trans_dt,a.forward_trans_id forward_trans_id,a.reg_no reg_no,a.book_no book_no,a.farmer_name farm_name,e.acc_no acc_no,e.bank_id bank_id,a.acc_no faccount,a.ifsc_code fifsc, e.ifs ifs, a.amount amount,a.soc_id soc_id,a.branch_id dist_code,a.forward_bulk_trans_id bulk_id
            from td_collections a, md_paddy_bank e
          
            where a.bank_sl_no = e.sl_no
            and a.kms_id = $kms_id 
            and a.soc_id = '$soc_id' 
            and a.trans_dt = '$trans_dt' 
            and a.forward_bulk_trans_id = '$forward_bulk_trans_id'
            and a.status   = '0' 
            and a.dwn_flag = '0' ";

        $data = $this->db->query($sql);
       
        return $data->result();
    }
    public function f_farmer_reissue_cheque($branch_id,$bank_sl_no){

        $kms_id=$this->session->userdata['loggedin']['kms_id'];

         $sql = "Select a.trans_dt trans_dt,a.trans_id trans_id,a.reg_no reg_no,b.farm_name farm_name,b.epic_no epic_no,b.mobile_number mobile_number,e.acc_no acc_no,e.trans_code trans_code,e.bank_id bank_id,c.soc_name soc_name,a.acc_no faccount,a.ifsc_code fifsc,
            e.short_code short_code, e.micr_code micr_code, e.ifs ifs, a.amount amount,a.quantity quantity, a.cheque_no cheque_no, a.cheque_date cheque_dt ,a.soc_id soc_id,a.branch_id dist_code,a.bulk_trans_id bulk_id
            from td_collections a, td_farmer_reg b ,md_society c, md_district d,md_paddy_bank e
            where a.reg_no = b.reg_no 
            and   a.soc_id = c.sl_no
            and   a.status = '1'
            and   a.branch_id = d.district_code
            and   a.bank_sl_no = e.sl_no
            and a.kms_id = $kms_id and a.branch_id = '$branch_id' and a.bank_sl_no = $bank_sl_no and a.book_no != '0' and a.dwn_flag = '0' ";
   

        $data = $this->db->query($sql);
       
        return $data->result();
    }
    public function f_farmdet_new_cheque($issue_dt,$bank_id){

        $kms_id=$this->session->userdata['loggedin']['kms_id'];
        $branch_id=$this->session->userdata['loggedin']['branch_id'];

         $sql = "Select a.trans_dt trans_dt,a.trans_id trans_id,a.reg_no reg_no,b.farm_name farm_name,b.epic_no epic_no,b.mobile_number mobile_number,e.acc_no acc_no,e.trans_code trans_code,e.bank_id bank_id,c.soc_name soc_name,b.account_no faccount,b.ifsc_code fifsc,
            e.short_code short_code, e.micr_code micr_code, e.ifs ifs, a.amount amount,a.quantity quantity, a.cheque_no cheque_no, a.cheque_date cheque_dt ,a.soc_id soc_id,a.branch_id dist_code
            from td_collections a, td_farmer_reg b ,md_society c, md_district d,md_paddy_bank e,td_reissue_chq f
            where a.reg_no = b.reg_no 
            and   a.soc_id = c.sl_no
            and   a.branch_id = d.district_code
            and   a.bank_sl_no = e.sl_no
            and   a.cheque_no = f.old_chq_no
            and   a.branch_id = $branch_id
            and f.kms_id = $kms_id and f.bank_id = '$bank_id' and f.issue_dt = '$issue_dt' and f.branch_id = '$branch_id'";
   

        $data = $this->db->query($sql);
       
        return $data->result();
    }
    public function f_farmer_bank_detail($soc_id,$trans_dt,$bulk_trans_id){

        $kms_id=$this->session->userdata['loggedin']['kms_id'];

         $sql = "Select a.soc_id soc_id,a.branch_id branch_id, b.bank_id bank_id,c.soc_name from td_collections a,md_paddy_bank b,md_society c
                where a.bank_sl_no = b.sl_no
                and   a.soc_id = c.society_code
                and a.kms_id = $kms_id and a.soc_id = '$soc_id' and a.trans_dt = '$trans_dt' and a.bulk_trans_id = $bulk_trans_id and a.dwn_flag = '0' ";
   

        $data = $this->db->query($sql);
       
        return $data->row();
    }

    public function f_debit_bank_detail($branch_id,$bank_id){

        $kms_id=$this->session->userdata['loggedin']['kms_id'];

         $sql = "Select * from md_paddy_bank_branch where kms_id = $kms_id and dist_id = '$branch_id' and bank_id = '$bank_id' ";
   

        $data = $this->db->query($sql);
       
        return $data->row();
    }
    public function f_farmer_dwn_flag($soc_id,$trans_dt,$bulk_trans_id){

        $kms_id=$this->session->userdata['loggedin']['kms_id'];
        $sql = "UPDATE td_collections SET dwn_flag='1'  WHERE kms_id = $kms_id and soc_id = '$soc_id' and trans_dt = '$trans_dt' and bulk_trans_id = $bulk_trans_id";
        $data = $this->db->query($sql);
        return $data;
    }
    public function f_farmerreissue_dwn_flag($branch_id,$bank_id){

        $kms_id=$this->session->userdata['loggedin']['kms_id'];
        $sql = "UPDATE td_collections SET dwn_flag='1'  WHERE kms_id = $kms_id and branch_id = '$branch_id' and book_no != '0' and bank_sl_no = $bank_id";
        $data = $this->db->query($sql);
        return $data;
    }
    public function get_transaction_type($soc_id,$trans_dt,$bulk_trans_id,$chq_status){

        $kms_id = $this->session->userdata['loggedin']['kms_id'];
        $sql="select trans_type from td_collections WHERE kms_id = '$kms_id' and soc_id = '$soc_id' and trans_dt = '$trans_dt' and bulk_trans_id = '$bulk_trans_id' and chq_status = '$chq_status' ";
        $data =$this->db->query($sql)->row();
        return $data->trans_type;
    }

    public function update_download_status($soc_id,$trans_dt,$bulk_trans_id){

        $result=$this->db->query("UPDATE `td_collections` SET `chq_status`='I'
            WHERE soc_id   ='$soc_id'
            and   trans_dt ='$trans_dt'
            and   bulk_trans_id ='$bulk_trans_id' ");

    }

    public function get_approve_status($soc_id,$kms_id){

        $sql="select count(*) count_status from td_work_order where soc_id = '$soc_id' and approval_status = 'U' and kms_year = '$kms_id'";
        $data = $this->db->query($sql);
        return $data->row();
    }
    public function check_workorder($soc_id,$kms_id){

        $sql="select count(*) counts from td_work_order where soc_id = '$soc_id' and kms_year = '$kms_id'";
        $data = $this->db->query($sql);
        return $data->row();
    }
    public function f_update_condition($certificate_1,$certificate_2,$trans_dt,$bulk_trans_id,$soc_id){

        $sql="UPDATE `td_collections` SET `certificate_1` = '$certificate_1',`certificate_2`='$certificate_2' WHERE trans_dt = '$trans_dt' AND `bulk_trans_id` = $bulk_trans_id AND `soc_id` = $soc_id";
        $this->db->query($sql);
    }
    public function f_forward_paddycollection($trans_dt,$bulk_trans_id,$soc_id,$forwarded_by,$forwarded_dt){

        $sql="UPDATE `td_collections` SET `status` = '1',forwarded_by ='$forwarded_by',forwarded_dt ='$forwarded_dt' WHERE trans_dt = '$trans_dt' AND `bulk_trans_id` = $bulk_trans_id AND `soc_id` = $soc_id";
        $this->db->query($sql);
    }
    public function f_forward_return_paddycollection($trans_dt,$bulk_trans_id,$soc_id,$forwarded_by,$forwarded_dt){

        $sql="UPDATE `td_collections` SET `status` = '1',chq_status ='U',forwarded_by ='$forwarded_by',forwarded_dt ='$forwarded_dt' WHERE trans_dt = '$trans_dt' AND `bulk_trans_id` = $bulk_trans_id AND `soc_id` = $soc_id";
        $this->db->query($sql);
    }
    public function f_forward_reissue_paddycollection($trans_dt,$bulk_trans_id,$soc_id){

        $sql="UPDATE `td_collections` SET `status` = '1' WHERE trans_dt = '$trans_dt' AND `bulk_trans_id` = $bulk_trans_id AND `soc_id` = $soc_id";
        $this->db->query($sql);
    }
    public function f_forward_neft($trans_dt,$bulk_trans_id,$soc_id){

        $sql="UPDATE `td_collections` SET `status` = '1',`chq_status` = 'U' WHERE trans_dt = '$trans_dt' AND `bulk_trans_id` = $bulk_trans_id AND `soc_id` = $soc_id";
        $this->db->query($sql);
    }
    public function f_forward_nefts($trans_dt,$bulk_trans_id,$soc_id){

        $sql="UPDATE `td_collections` SET `status` = '1',`chq_status` = 'U' WHERE trans_dt = '$trans_dt' AND `bulk_trans_id` = $bulk_trans_id AND `soc_id` = $soc_id";
        $this->db->query($sql);
    }
    public function f_forwardho_paddycollection($trans_dt,$soc_id){

        $sql="UPDATE `td_collections` SET `ho_status` = '1', WHERE trans_dt = '$trans_dt' AND `ho_status` != '1' AND `soc_id` = $soc_id";
        $this->db->query($sql);
    }
    public function f_checker_update($certificate_3,$certificate_5,$trans_dt,$soc_id){

       
       $sql="UPDATE `td_collections` SET `certificate_3` = '$certificate_3',`certificate_5` = '$certificate_5' WHERE trans_dt = '$trans_dt' AND `ho_status` != '1' AND `soc_id` = $soc_id";
       $this->db->query($sql);

    }
    public function f_get_uploaded_paddy_transaction_data($reg_no){

         $sql ="select max(procurement_dt) procurement_dt,ifnull(sum(quantity),0) quantity
                                from   td_paddy_transaction
                                where  reg_no = '$reg_no' ";

          $data = $this->db->query($sql);
          return $data->row();
    }
    public function f_get_farmer_paddy_procured($reg_no,$kms_id){

         $sql ="select ifnull(sum(quantity),0) quantity 
                               from   td_collections
                               where  reg_no = '$reg_no'
                               and    kms_id = '$kms_id'";
                                     
         $data = $this->db->query($sql)->row();
        
         return $data->quantity;
   }
   public function f_get_total_row($table,$kms_id){
    $sql ="select ifnull(count(*),0) cnt FROM $table where kms_id = '$kms_id'";
    return  $data = $this->db->query($sql)->row();

   }

   public function f_get_row_districtwise($table,$kms_id){
    $sql ="select ifnull(count(*),0) cnt,branch_id FROM $table where kms_id = '$kms_id' group by branch_id";
    return  $data = $this->db->query($sql)->result();

   }
   public function f_get_total_without_kms_id($table){
    $sql ="select ifnull(count(*),0) cnt FROM $table";
    return  $data = $this->db->query($sql)->row();

   }

   public function f_get_mill_district_wise($table){

    $sql ="select ifnull(count(*),0) cnt,branch_id FROM $table group by branch_id";
    return  $data = $this->db->query($sql)->result();

   }

   public function f_get_total_cheque_uploaded($kms_id){
    $sql ="select dist_id,ifnull(count(*),0) trans FROM td_reconciliation_yes group by dist_id";
    return  $data = $this->db->query($sql)->result();

   }

   public function get_farmer_detail_by_regno($reg_no,$kms_id){

    $sql = "select a.*,b.block_name,c.district_name from td_farmer_reg a,md_block b,md_district c 
              where  a.block = b.blockcode
              and    a.dist  = c.district_code
              and    a.reg_no= '$reg_no' 
              and    a.kms_id = '$kms_id' ";

    return  $data = $this->db->query($sql)->row();

   }
   public function get_farmer_detail_by_name($farm_name,$kms_id){

    $sql = "select a.*,b.block_name,c.district_name from td_farmer_reg a,md_block b,md_district c 
              where  a.block = b.blockcode
              and    a.dist  = c.district_code
              and    a.farm_name LIKE '%$farm_name%'
              and    a.kms_id = '$kms_id' ";

    return  $data = $this->db->query($sql)->result();

   }

   public function get_farmer_procurement_detail($reg_no,$kms_id){

     $sql = "select * from td_collections where reg_no= '$reg_no' and kms_id = '$kms_id' ";
    return  $data = $this->db->query($sql)->result();

   }
   public function get_society_detail_code($society_code,$kms_id){

    $sql = "select a.*,b.block_name,c.district_name from md_society a,md_block b,md_district c 
              where  a.block = b.blockcode
              and    a.dist  = c.district_code
              and    a.society_code = '$society_code' 
             ";

     return  $data = $this->db->query($sql)->row();

   }
   public function get_soc_dtls_byname($soc_name,$kms_id){

    $sql = "select a.*,b.block_name,c.district_name from md_society a,md_block b,md_district c 
              where  a.block = b.blockcode
              and    a.dist  = c.district_code
              and    a.soc_name LIKE '%$soc_name%' ";

     return  $data = $this->db->query($sql)->result();

   }
   public function get_mill_dtls_byname($mill_name,$kms_id){

    $sql = "select a.*,b.block_name,c.district_name from md_mill a,md_block b,md_district c 
              where  a.block = b.blockcode
              and    a.dist  = c.district_code
              and    a.mill_name LIKE '%$mill_name%' ";

     return  $data = $this->db->query($sql)->result();

   }
   public function f_get_cheque($cheque_no,$kms_id){


        $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.reg_no reg_no,b.trans_dt trans_dt,b.cheque_no cheque_no,b.bulk_trans_id bulk_trans_id, sum(b.quantity)tot_qty,sum(b.amount)tot_amt,e.district_name district_name,
                b.status status,b.bank_sl_no bank_sl_no,b.chq_status chq_status,c.bank_id bank_id
                from   md_society a ,td_collections b,md_paddy_bank c,md_district e
                
                where  a.sl_no = b.soc_id              
                and    b.branch_id = e.district_code
                and    b.bank_sl_no = c.sl_no
                and    b.cheque_no = $cheque_no
                and    b.kms_id = $kms_id
                group by a.soc_name,b.soc_id,b.bulk_trans_id,b.trans_dt,b.chq_status,b.status,b.reg_no,b.bank_sl_no,e.district_name
                order by b.trans_dt,b.bulk_trans_id
                ";
        
        $data = $this->db->query($sql);
       
        return $data->result();
    }

    public function get_cheque($cheque_no,$kms_id){
             $branch_id = $this->session->userdata['loggedin']['branch_id'];

        $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.reg_no reg_no,b.trans_dt trans_dt,b.trans_id trans_id,b.bulk_trans_id bulk_trans_id,b.chq_status chq_status,b.cheque_no cheque_no,b.cheque_date cheque_date,b.quantity tot_qty,b.amount tot_amt,b.bank_sl_no bank_sl_no,c.bank_id bank_id,d.farm_name farm_name,d.account_no account_no,d.ifsc_code ifsc_code
        
                from   md_society a ,td_collections b,md_paddy_bank c,td_farmer_reg d
                
                where  a.sl_no = b.soc_id              
                and    b.bank_sl_no = c.sl_no
                and    b.reg_no = d.reg_no
                and    b.cheque_no = '$cheque_no'
                and    b.kms_id = $kms_id
                and    b.branch_id = '$branch_id' ";
        
        $data = $this->db->query($sql);
       
        return $data->result();
    }
    public function get_neft($kms_id,$soc_name){
             $branch_id = $this->session->userdata['loggedin']['branch_id'];

        $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.reg_no reg_no,b.trans_dt trans_dt,b.trans_id trans_id,b.bulk_trans_id bulk_trans_id,b.quantity tot_qty,b.amount tot_amt,b.bank_sl_no bank_sl_no
        
                from   md_society a,td_collections b                  
                where  a.sl_no = b.soc_id
                and    b.kms_id      = '$kms_id'
                and    b.soc_id      = '$soc_name'
                and    b.chq_status  = 'R'
                and    b.branch_id   = '$branch_id' ";
        
        $data = $this->db->query($sql);
       
        return $data->result();
    }
    public function get_chequedtls($soc_id,$trans_dt,$trans_id,$bulk_trans_id,$kms_id){
             $branch_id = $this->session->userdata['loggedin']['branch_id'];

        $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.reg_no reg_no,b.book_no book_no,b.trans_dt trans_dt,b.trans_id trans_id,b.bulk_trans_id bulk_trans_id,b.chq_status chq_status,b.cheque_no cheque_no,b.cheque_date cheque_date,b.quantity tot_qty,b.amount tot_amt,b.bank_sl_no bank_sl_no,c.bank_id bank_id,d.farm_name farm_name,d.account_no account_no,d.ifsc_code ifsc_code
        
                from   md_society a ,td_collections b,md_paddy_bank c,td_farmer_reg d
                
                where  a.sl_no = b.soc_id              
                and    b.bank_sl_no = c.sl_no
                and    b.reg_no = d.reg_no
                and    b.soc_id = '$soc_id'
                and    b.trans_dt = '$trans_dt'
                and    b.trans_id = $trans_id
                and    b.bulk_trans_id = $bulk_trans_id
                and    b.kms_id = $kms_id
                and    b.branch_id = $branch_id";
        
           $data = $this->db->query($sql);
           return $data->row();
    }
    public function get_neftdtls($soc_id,$trans_dt,$trans_id,$bulk_trans_id,$kms_id){
             $branch_id = $this->session->userdata['loggedin']['branch_id'];

        $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.reg_no reg_no,b.trans_dt trans_dt,b.trans_id trans_id,b.bulk_trans_id bulk_trans_id,b.chq_status chq_status,b.cheque_no cheque_no,b.cheque_date cheque_date,b.quantity tot_qty,b.amount tot_amt,b.bank_sl_no bank_sl_no,c.bank_id bank_id
        
                from   md_society a ,td_collections b,md_paddy_bank c
                where  a.sl_no = b.soc_id              
                and    b.bank_sl_no = c.sl_no
                and    b.soc_id = '$soc_id'
                and    b.trans_dt = '$trans_dt'
                and    b.trans_id = $trans_id
                and    b.bulk_trans_id = $bulk_trans_id
                and    b.kms_id = $kms_id
                and    b.branch_id = $branch_id";
        
           $data = $this->db->query($sql);
           return $data->row();
    }

    public function bank_id($sl_no){
         $sql="select bank_id from md_paddy_bank where sl_no='$sl_no'";
         $data =$this->db->query($sql)->row();

         return $data->bank_id;
    }
    public function coll_received($soc_id,$trans_dt,$bulk_trans_id){
       
        $sql = "select trans_dt,soc_id,mill_id,sum(quantity) quantity
                 from   td_collections
                 where soc_id = '$soc_id'
                 and  trans_dt = '$trans_dt'
                 and  bulk_trans_id = '$bulk_trans_id'
                 group by soc_id,trans_dt,mill_id";
         
         $data = $this->db->query($sql);
        
         return $data->row();
 
     }

    public function coll_forward_2019($soc_id,$trans_dt,$bulk_trans_id){
       
        $sql =  "select a.trans_dt,a.reg_no,a.forward_bulk_trans_id,a.amount,a.forward_trans_id,a.ifsc_code,
                 a.acc_no,a.book_no,a.bank_sl_no,b.farm_name,b.address,b.pin_no,b.mobile_number,b.email,c.bank_name
                 from  td_collections a,td_farmer_reg b,md_paddy_bank c
                 where a.reg_no         = b.reg_no
                 and   a.bank_sl_no     = c.sl_no
                 and   a.soc_id         = '$soc_id'
                 and   a.trans_dt       = '$trans_dt'
                 and   a.bulk_trans_id  = '$bulk_trans_id'";
         
         $data = $this->db->query($sql);
        
         return $data->result();
 
    }

     public function coll_forward($soc_id,$trans_dt,$bulk_trans_id){
       
        $sql =  "select a.trans_dt,a.reg_no,a.forward_bulk_trans_id,a.amount,a.forward_trans_id,a.ifsc_code,
                 a.acc_no,a.book_no,a.bank_sl_no,a.farmer_name,c.bank_name
                 from  td_collections a,md_paddy_bank c
               
                 where   a.bank_sl_no     = c.sl_no
                 and   a.soc_id         = '$soc_id'
                 and   a.trans_dt       = '$trans_dt'
                 and   a.bulk_trans_id  = '$bulk_trans_id'";
         
         $data = $this->db->query($sql);
        
         return $data->result();
 
    }
    //// ********** Code Written For Getting Bank Detail for Forwading Data to Bank For Payemnt on 12/11/2020  **************** ///

    public function bank_detail_for_forward($soc_id,$trans_dt,$bulk_trans_id){
       
        $sql =  "select bank_sl_no from  td_collections
                 where soc_id         = '$soc_id'
                 and   trans_dt       = '$trans_dt'
                 and   bulk_trans_id  = '$bulk_trans_id' ";
         
        $data = $this->db->query($sql);
        
        return $data->row()->bank_sl_no;
 
    }

    public function checkparticular($wqsc_no,$account_type){


        $sql="SELECT count(b.account_type) as cnt FROM td_fund_requisition a,td_fund_requisition_dtls b
                               where a.req_no = b.req_no
                               and   a.wqsc_no = '$wqsc_no'
                               and   b.account_type = '$account_type'";
        $data  = $this->db->query($sql)->row();

        return $data;


   }

    public function get_file($kms_id,$branch_id,$soc_id){
        
        $sql="SELECT distinct forward_bulk_trans_id FROM `td_collections` where kms_id = '$kms_id' 
        and branch_id  = '$branch_id'
        and soc_id     = '$soc_id'
        and bulk_trans_id !='' ";

        $data  = $this->db->query($sql)->result();

        return $data;

   }

    public function get_soc_id_by_trans_no($trans_no){
        
        $sql   = "SELECT soc_id FROM `td_received` where trans_no = '$trans_no' ";

        $data  = $this->db->query($sql)->row();

        return $data->soc_id;

   }

    public function get_payment_detail($kms_id,$forward_trans_id){
        
        $sql="SELECT distinct t.payment_run_date,t.value_date, t.utr_no, t.bank_ref_no,t.cr_acc_no,t.amount, t.status_code,t.status_description,b.bank_name bank_name,t.created_dt
            FROM td_reverse_feed t,md_paddy_bank b
            WHERE t.bank_id = b.bank_id
            AND t.forward_trans_id = '$forward_trans_id'
            AND t.kms_id = '$kms_id'
            order by t.value_date
            ";

        $data  = $this->db->query($sql)->result();

        return $data;

   }

   public function deletetemp_table(){

      $sql   = "DELETE FROM td_received_temp";

      $query = $this->db->query($sql);
   }

   public function get_wqsc_dtls($brn,$kms){
       $sql = "select a.id id,
                      a.wqsc_no wqsc_no,
                      b.mill_name mill_name,
                      a.memo_no memo_no,
                      a.memo_dt memo_dt,
                      a.created_by created_by,
                      sum(c.quantity)quantity
               from td_wqsc a,md_mill b,td_wqsc_dtls c
               where a.mill_id = b.sl_no
               and   a.id = c.trans_id
               and   a.branch_id = $brn
               and   a.kms_id    = $kms
               group by a.id,
               a.wqsc_no,
               b.mill_name,
               a.memo_no,
               a.memo_dt
               ";

       $query = $this->db->query($sql)->result();

       return $query;
       
   }

   public function get_transport_rate($bill_no,$kms_id,$dist){

    $sql = "SELECT * FROM `td_payment_bill_dtls` where account_type in (3,4,5,6,11) and kms_id = $kms_id and pmt_bill_no = $bill_no and dist =$dist ";

    $query = $this->db->query($sql)->result();

    return $query;

   }

   public function get_param_rate_exist_in_bills($bill_no,$kms_id,$dist,$account_type){

    $sql = "SELECT * FROM `td_payment_bill_dtls` where account_type = '$account_type' and kms_id = '$kms_id' and pmt_bill_no = '$bill_no' and dist ='$dist' ";

    $query = $this->db->query($sql)->row();

    return $query;

   }

   public function get_tsd_rate($charge_head,$effective_date){


     $sql  = "select tds_rate as tds,prop_tds_rate as prop_tds  from  md_tds_rate where  effective_date = (select max(effective_date) from   md_tds_rate
                         where  effective_date <= '$effective_date') and charge_head = '$charge_head' ";

    $query = $this->db->query($sql)->row();

     return $query;                   
   }



}
