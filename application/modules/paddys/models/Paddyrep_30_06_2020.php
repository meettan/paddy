<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paddyrep extends CI_Model{
/**Retrieve all societies for a given district and block */
    public function f_get_soc($brn,$block_id){
        $soc = $this->db->query("select a.society_code society_code,
                                        a.soc_name soc_name,
                                        a.block blockcode,
                                        b.block_name block_name
                                from md_society a,md_block b
                                where   a.block = b.blockcode
                                and     a.block = $block_id
                                and     a.branch_id = $brn");

        return $soc->result();
    }
    /**Retrieve all societies and block for a given district */
    public function f_get_soc_ho($brn){
        $soc = $this->db->query("select a.society_code society_code,
                                        a.soc_name soc_name,
                                        a.block blockcode,
                                        b.block_name block_name
                                from md_society a,md_block b
                                where   a.block = b.blockcode
                                and     a.branch_id = $brn");

        return $soc->result();
    }

    public function f_get_reg_farm($brn,$frmdt,$todt,$block_id){

        $reg  = $this->db->query("select soc_id,count(reg_no) reg_farm
                                  from   td_farmer_reg
                                  where  branch_id = $brn
                                  and    block     = $block_id
                                  group by soc_id
                                  order by soc_id");

        return $reg->result();
    }

    public function f_get_reg_farm_ho($brn,$frmdt,$todt){

        $reg  = $this->db->query("select soc_id,count(reg_no) reg_farm
                                  from   td_farmer_reg
                                  where  branch_id = $brn
                                
                                  group by soc_id
                                  order by soc_id");

        return $reg->result();
    }
 /**No. of farmers registered in a district */   
    public function f_getregfarm($kms_id){
        $reg  = $this->db->query("select dist,count(reg_no)reg_farm
                                  from   td_farmer_reg
                                  where  kms_id = $kms_id
                                  group by dist
                                  order by dist");

        return $reg->result();
    }

    public function f_get_collc($brn,$frmdt,$todt,$block_id){

        $collc = $this->db->query("select soc_id,sum(quantity)quantity,count(reg_no) farm_ben,
                                          max(camp_no)camp,sum(amount)amount
                                   from   td_collections
                                   where  branch_id = $brn
                                   and    block_id  = $block_id
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by soc_id
                                   order by soc_id");
        return $collc->result();
    }
/** Retrieve societywise total paddy procured quantity ,total no.of farmer sold paddy,and total amount of chq issued
 * within a date range in given district*/    
    public function f_get_collc_ho($brn,$frmdt,$todt){
        $collc = $this->db->query("select soc_id,sum(quantity)quantity,count(reg_no) farm_ben,
                                          max(camp_no)camp,sum(amount)amount
                                   from   td_collections
                                   where  branch_id = $brn
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by soc_id
                                   order by soc_id");
        return $collc->result();
    }

/** Retrieve districtwise total paddy procured quantity ,total no.of farmer sold paddy,and total amount of chq issued
 * within a date range in given district*/    
    public function f_getresale($frmdt,$todt){
        $collc = $this->db->query("select branch_id,sum(quantity)quantity,count(reg_no) farm_ben,
                                          sum(amount)amount,count(distinct soc_id)soc_no
                                   from   td_collections                  
                                   where  trans_dt between '$frmdt' and '$todt'
                                   group by branch_id
                                   order by branch_id");
        return $collc->result();
    }
   
/**Societywise amount of chq cleared beween a date range in given district */
    public function f_getamt_clr($brn,$frmdt,$todt){
        $collc = $this->db->query("select soc_id,sum(amount) amount_clr
                                   from   td_collections
                                   where  branch_id = $brn  
                                   and    chq_status = 'C'
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by soc_id
                                   order by soc_id");
        return $collc->result();
    }

/**Districtwise amount of chq cleared beween a date range in given district */
    public function f_getdistamt_clr($frmdt,$todt){
        $collc = $this->db->query("select branch_id,sum(amount) amount_clr
                                   from   td_collections
                                   where  chq_status = 'C'
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by branch_id
                                   order by branch_id");
        return $collc->result();
    }
/**Societywise re-issue cheque */
    public function f_getamt_reissue($brn,$frmdt,$todt){

        /*$collc = $this->db->query("select soc_id,count(cheque_no) chequ,
                                      sum(amount) amounr
                                   from   td_collections
                                   where  branch_id = $brn  
                                   and    chq_status = 'I'
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by soc_id
                                   order by soc_id");*/

          $collc = $this->db->query("SELECT b.soc_id soc_id,
                                            count(a.reg_no)chequ,
                                            sum(a.amt) amounr
                                     FROM  td_reissue_chq a,
    	                                     td_collections b
                                     where  a.old_chq_no = b.cheque_no 
                                     and    a.branch_id  = b.branch_id
                                     and    a.branch_id = $brn
                                     and    a.issue_dt between '$frmdt' and '$todt'
                                     group by b.soc_id");
        return $collc->result();
    }
/**Districtwise re-issue cheque */    
    public function f_getdisamt_reissue($frmdt,$todt){

        /*$collc = $this->db->query("select branch_id,count(cheque_no) chequ,
                                      sum(amount) amounr
                                   from   td_collections
                                   where  chq_status = 'I'
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by branch_id
                                   ");*/
          $collc = $this->db->query("SELECT b.branch_id branch_id,
                                            count(a.reg_no)chequ,
                                            sum(a.amt) amounr
                                    FROM  td_reissue_chq a,
                                          td_collections b
                                    where  a.old_chq_no = b.cheque_no 
                                    and    a.branch_id  = b.branch_id
                                    and    a.issue_dt between '$frmdt' and '$todt'
                                    group by b.branch_id");

        return $collc->result();
    }

     public function f_get_cmr($brn,$frmdt,$todt,$block_id){

        $cmr = $this->db->query("select soc_id,sum(resultant_cmr)resultant
                                   from   td_cmr_offered
                                   where  branch_id = $brn
                                   and    block_id  = $block_id
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by soc_id
                                   order by soc_id");
        return $cmr->result();
    }
   
     public function f_get_cmr_ho($brn,$frmdt,$todt){

        $cmr = $this->db->query("select soc_id,sum(resultant_cmr)resultant
                                   from   td_cmr_offered
                                   where  branch_id = $brn
                                  
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by soc_id
                                   order by soc_id");
        return $cmr->result();
    }
/**Districtwise resultant CMR and CMR offered between a period*/    
     public function f_getdistcmr($frmdt,$todt){
        $cmr = $this->db->query("select branch_id,sum(resultant_cmr)resultant,sum(cmr_offered_now) offered
                                   from   td_cmr_offered                            
                                   where    trans_dt between '$frmdt' and '$todt'
                                   group by branch_id");
        return $cmr->result();
    }

    public function f_get_offer($brn,$frmdt,$todt,$block_id){

      $offer = $this->db->query("select soc_id,rice_type,sum(cmr_offered_now) offered
                                 from   td_cmr_offered
                                 where  branch_id = $brn
                                 and    block_id  = $block_id
                                 and    trans_dt between '$frmdt' and '$todt'
                                 group by soc_id,rice_type
                                 order by soc_id");
      return $offer->result();
    }

    public function f_get_offer_ho($brn,$frmdt,$todt){

      $offer = $this->db->query("select soc_id,rice_type,sum(cmr_offered_now) offered
                                 from   td_cmr_offered
                                 where  branch_id = $brn
                             
                                 and    trans_dt between '$frmdt' and '$todt'
                                 group by soc_id,rice_type
                                 order by soc_id");
      return $offer->result();
    }
    /*public function f_getdistoffer($frmdt,$todt){

      $offer = $this->db->query("select branch_id,rice_type,sum(cmr_offered_now) offered
                                 from   td_cmr_offered                             
                                 where    trans_dt between '$frmdt' and '$todt'
                                 group by branch_id,rice_type");
      return $offer->result();
    }*/

    public function f_get_delv($brn,$frmdt,$todt,$block_id){

      $offer = $this->db->query("select soc_id,cmr_type,sum(sp) sp,sum(cp) cp,sum(fci) fci
                                 from   td_cmr_delivery
                                 where  branch_id = $brn
                                 and    block     = $block_id 
                                 and    trans_dt between '$frmdt' and '$todt'
                                 group by soc_id,cmr_type
                                 order by soc_id");
      return $offer->result();
    }

    public function f_get_delv_ho($brn,$frmdt,$todt){

      $offer = $this->db->query("select soc_id,cmr_type,sum(sp) sp,sum(cp) cp,sum(fci) fci
                                 from   td_cmr_delivery
                                 where  branch_id = $brn
                                
                                 and    trans_dt between '$frmdt' and '$todt'
                                 group by soc_id,cmr_type
                                 order by soc_id");
      return $offer->result();
    }

/**Districtwise total CMR delivered by each district in SP,CP & FCI */
    public function f_getdistdelv($frmdt,$todt){
      $offer = $this->db->query("select branch_id,sum(sp) sp,sum(cp) cp,sum(fci) fci
                                 from   td_cmr_delivery
                                 where    trans_dt between '$frmdt' and '$todt'
                                 group by branch_id");
      return $offer->result();
    }


    ////

    /*public function f_get_remain($brn,$frmdt,$todt,$block_id){

      $remain = $this->db->query("select a.soc_id soc_id,sum(a.cmr_offered_now) - sum(b.sp+b.cp+b.fci)remain
                                 from   td_cmr_offered a,td_cmr_delivery b
                                 where  a.soc_id = b.soc_id
                                 and    a.branch_id = $brn
                                 and    a.block_id  = $block_id
                                 and    b.block     = $block_id 
                                 and    a.trans_dt between '$frmdt' and '$todt'
                                 group by a.soc_id
                                 order by a.soc_id");
      return $remain->result();
    }*/
    
    public function f_get_remain($brn,$frmdt,$todt,$block_id){
        
        $remain = $this->db->query("select soc_id,sum(offer),sum(delv),sum(offer) - sum(delv)remain
                                    from (
                                            select soc_id,sum(cmr_offered_now)offer,0 delv
                                            from   td_cmr_offered
                                            where  trans_dt between '$frmdt' and '$todt'
                                            and    branch_id = $brn
                                            and    block_id =  $block_id
                                            group by soc_id
                                            union
                                            select soc_id,0 offer,sum(sp) + sum(cp) + sum(fci)delv
                                            from   td_cmr_delivery
                                            where  trans_dt between '$frmdt' and '$todt'
                                            and    branch_id = $brn
                                            and    block = $block_id
                                            group by soc_id)a
                                    group by soc_id
                                    order by soc_id");
                                    
        return $remain->result();
    }
    
    
     /*public function f_get_remain_ho($brn,$frmdt,$todt){

      $remain = $this->db->query("select a.soc_id soc_id,sum(a.cmr_offered_now) - sum(b.sp+b.cp+b.fci)remain
                                 from   td_cmr_offered a,td_cmr_delivery b
                                 where  a.soc_id = b.soc_id
                                 and    a.branch_id = $brn
                              
                               
                                 and    a.trans_dt between '$frmdt' and '$todt'
                                 group by a.soc_id
                                 order by a.soc_id");
      return $remain->result();
    }*/
    
    public function f_get_remain_ho($brn,$frmdt,$todt){
        
        $remain = $this->db->query("select soc_id,sum(offer),sum(delv),sum(offer) - sum(delv)remain
                                    from (
                                            select soc_id,sum(cmr_offered_now)offer,0 delv
                                            from   td_cmr_offered
                                            where  trans_dt between '$frmdt' and '$todt'
                                            and    branch_id = $brn
                                            group by soc_id
                                            union
                                            select soc_id,0 offer,sum(sp) + sum(cp) + sum(fci)delv
                                            from   td_cmr_delivery
                                            where  trans_dt between '$frmdt' and '$todt'
                                            and    branch_id = $brn
                                            group by soc_id)a
                                    group by soc_id
                                    order by soc_id");
                                    
        return $remain->result();
    }
    
    
    
    
    ///////

    public function f_tot_reg_farm($brn,$kms,$frmdt,$todt){

        $totFarm  = $this->db->query("select count(reg_no)reg_farm
                                  from   td_farmer_reg
                                  where  branch_id = $brn
                                  and    kms_id    = $kms");

        return $totFarm->result();
    }


    public function f_get_mill($brn,$block_id){
        $soc = $this->db->query("select a.sl_no mill_id,
                                        a.mill_name mill_name,
                                        a.block blockcode,
                                        b.block_name block_name
                                from md_mill a,md_block b
                                where   a.block = b.blockcode
                                and     a.block = $block_id
                                and     a.branch_id = $brn");

        return $soc->result();
    }
    public function f_get_mill_ho($brn){
        $soc = $this->db->query("select a.sl_no mill_id,
                                        a.mill_name mill_name,
                                        a.block blockcode,
                                        b.block_name block_name
                                from md_mill a,md_block b
                                where   a.block = b.blockcode
                            
                                and     a.branch_id = $brn");

        return $soc->result();
    }
    public function f_get_mil_collc($brn,$frmdt,$todt){

        $collc = $this->db->query("select mill_id,sum(paddy_qty) quantity
                                   from   td_received
                                   where  branch_id = $brn
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by mill_id
                                   order by mill_id");
        return $collc->result();
    }

    public function f_get_mill_offer($brn,$frmdt,$todt){

      $offer = $this->db->query("select mill_id,rice_type,sum(cmr_offered_now) offered
                                 from   td_cmr_offered
                                 where  branch_id = $brn
                                 and    trans_dt between '$frmdt' and '$todt'
                                 group by mill_id,rice_type
                                 order by mill_id");
      return $offer->result();
    }

    public function f_get_mill_delv($brn,$frmdt,$todt){

      $offer = $this->db->query("select mill_id,cmr_type,sum(sp) sp,sum(cp) cp,sum(fci) fci
                                 from   td_cmr_delivery
                                 where  branch_id = $brn
                                 and    trans_dt between '$frmdt' and '$todt'
                                 group by mill_id,cmr_type
                                 order by mill_id");
      return $offer->result();
    }
    
    public function f_get_mil_do($brn,$frmdt,$todt){

      $offer = $this->db->query("select mill_id,rice_type,sum(sp) sp,sum(cp) cp,sum(fci) fci
                                 from   td_do_isseued
                                 where  branch_id = $brn
                                 and    trans_dt between '$frmdt' and '$todt'
                                 group by mill_id,rice_type
                                 order by mill_id");
      return $offer->result();
    }
    
    
    public function f_get_mill_remain($brn,$frmdt,$todt){

      /*$remain = $this->db->query("select a.mill_id mill_id,sum(a.cmr_offered_now) - sum(b.sp+b.cp+b.fci) remain
                                 from   td_cmr_offered a,td_cmr_delivery b
                                 where  a.soc_id = b.soc_id
                                 and    a.branch_id = $brn
                                 and    a.trans_dt between '$frmdt' and '$todt'
                                 group by a.mill_id
                                 order by a.mill_id");*/
                                 
      $remain = $this->db->query("select mill_id,sum(offer),sum(delv),sum(offer) - sum(delv)remain
                                    from (
                                            select mill_id,sum(cmr_offered_now)offer,0 delv
                                            from   td_cmr_offered
                                            where  trans_dt between '$frmdt' and '$todt'
                                            and    branch_id = $brn
                                            group by mill_id
                                            union
                                            select mill_id,0 offer,sum(sp) + sum(cp) + sum(fci)delv
                                            from   td_cmr_delivery
                                            where  trans_dt between '$frmdt' and '$todt'
                                            and    branch_id = $brn
                                            group by mill_id)a
                                    group by mill_id
                                    order by mill_id");
                                 
      return $remain->result();
    }
    
    
    
    public function f_get_mill_cmr($brn,$frmdt,$todt){

        $cmr = $this->db->query("select mill_id,sum(resultant_cmr)resultant
                                   from   td_cmr_offered
                                   where  branch_id = $brn
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by mill_id
                                   order by mill_id");
        return $cmr->result();
    }
    public function f_get_cheque_detail($brn,$bnk,$frmdt,$todt){

        $cmr = $this->db->query("select a.trans_dt trans_dt,
                                    a.reg_no reg_no,
                                    a.bank_sl_no bank_sl_no,
                                    a.quantity quantity,
                                    a.amount amount,
                                    a.cheque_date cheque_date,
                                    a.cheque_no cheque_no,
                                    a.chq_status chq_status,
                                    a.chq_clg_dt,
                                    b.soc_name soc_name
                               from   td_collections a,
                                      md_society b
                                 where  a.soc_id = b.society_code
                                 and    a.branch_id = $brn
                                 and    a.bank_sl_no = $bnk
                                 and    a.trans_dt between '$frmdt' and '$todt'
                                 order by a.trans_dt");

        return $cmr->result();

    }

    public function f_get_neft_detail($brn,$bnk,$frmdt,$todt,$soc_id){

        $cmr = $this->db->query("select a.trans_dt trans_dt,
                                    a.reg_no reg_no,
                                    a.bank_sl_no bank_sl_no,
                                    a.quantity quantity,
                                    a.amount amount,
                                    a.cheque_date cheque_date,
                                    a.cheque_no cheque_no,
                                    a.chq_status chq_status,
                                    a.dwn_flag dwn_flag,
                                    a.chq_clg_dt,
                                    b.soc_name soc_name
                               from   td_collections a,
                                      md_society b
                                 where  a.soc_id = b.society_code
                                 and    a.branch_id   = $brn
                                 and    a.bank_sl_no  = $bnk
                                 and    a.soc_id      = $soc_id
                                 and    a.trans_type  = 'N'
                                 and    a.trans_dt between '$frmdt' and '$todt'
                                 order by a.trans_dt");

        return $cmr->result();

    }

    public function f_get_returncheque($brn,$frmdt,$todt){


        $sql = "select a.soc_name soc_name,b.soc_id soc_id,b.reg_no reg_no,b.trans_dt trans_dt,b.bulk_trans_id bulk_trans_id, sum(b.quantity)tot_qty,sum(b.amount)tot_amt,d.chq_no chq_no,e.district_name district_name,
                b.status status,b.bank_sl_no bank_sl_no,b.chq_status chq_status,c.bank_id bank_id
                from   md_society a ,td_collections b,md_paddy_bank c,td_paddy_return_chq d,md_district e
                
                where  b.trans_dt = d.trans_dt
                and    b.trans_id = d.trans_id
                and    b.bulk_trans_id = d.bulk_trans_id
                and    b.branch_id = e.district_code
                and    a.sl_no = b.soc_id
                and    b.bank_sl_no = c.sl_no
                and    d.branch_id = $brn
                and    d.trans_dt between '$frmdt' and '$todt'
                group by a.soc_name,b.soc_id,b.bulk_trans_id,b.trans_dt,b.chq_status,b.status,b.reg_no,b.bank_sl_no,d.chq_no,e.district_name
                order by b.trans_dt,b.bulk_trans_id
                ";
        
        $data = $this->db->query($sql);
       
        return $data->result();
    }

    /*public function f_societypaddy_proc($kms_id,$branch_id){

    $sql ="select soc_id FROM td_collections where kms_id='$kms_id' and branch_id='$branch_id' group by soc_id";

   

    return  $data = $this->db->query($sql)->num_rows();

   }*/

    public function f_get_resale_no($from_dt,$to_dt){

      $sql ="select a.branch_id,count(a.reg_no)reslno,sum(b.quantity)*0.1 qty,sum(b.amount)amt
            from(
              select branch_id,reg_no,min(trans_dt)trn_dt
                  from   td_collections         
                  where  trans_dt between '$from_dt' and '$to_dt'
                  group by branch_id,reg_no
                  having count(reg_no) > 1)a,
              td_collections b
            where a.reg_no = b.reg_no
            and   b.trans_dt > trn_dt
            group by a.branch_id";
               
      $data = $this->db->query($sql);     

      return  $data->result();
    }

    public function f_get_datewise_delivery($brn_id,$from_dt,$to_dt){
        $sql = "select delivery_dt,sum(sp) + sum(cp) state,sum(fci)central
                from   td_cmr_delivery
                where  branch_id = $brn_id
                and    delivery_dt between '$from_dt' and '$to_dt'
                group by delivery_dt
                order by delivery_dt";

        $data = $this->db->query($sql);

        return  $data->result();
    }

  public function f_getp_receive($soc_id,$mill_id,$kms_id){
       $sql="select max(trans_dt) trans_dt,ifnull(sum(paddy_qty),0) as received_qty 
             from td_received where soc_id='$soc_id' and  mill_id ='$mill_id' and kms_year='$kms_id' ";
        $data = $this->db->query($sql);

        return  $data->row();
  }  
  public function f_getp_colle($soc_id,$mill_id,$kms_id){

     $sql="select max(trans_dt) trans_dt,max(trans_type) trans_type from td_collections where soc_id='$soc_id' and  mill_id ='$mill_id' and kms_id='$kms_id' ";
        $data = $this->db->query($sql);

        return  $data->row();
  }
  public function f_getp_offer($soc_id,$mill_id,$kms_id){

        $sql="select ifnull(sum(cmr_offered_now),0) as cmr_offered_now,ifnull(sum(milled),0) as milled,max(rice_type) rice_type
             from td_cmr_offered where soc_id='$soc_id' and  mill_id ='$mill_id' and kms_year='$kms_id' ";
        $data = $this->db->query($sql);

        return  $data->row();
  }
  public function f_getp_deliver($soc_id,$mill_id,$kms_id){

        $sql="select ifnull(sum(tot_delivery),0) as tot_delivery,ifnull(sum(cmr_yet_to_be_delivery_as_do_number),0) as cmr_yet_to_be_delivery_as_do_number 
             from td_cmr_delivery where soc_id='$soc_id' and  mill_id ='$mill_id' and kms_year='$kms_id' ";
        $data = $this->db->query($sql);

        return  $data->row();
  }

  public function f_get_neft_ret($brn,$from_dt,$to_dt){
    $neft = $this->db->query("select a.dist_id branch_id,
                                    a.trans_dt procurement_dt,
                                    a.value_dt payment_dt,
                                    c.soc_name soc_name,
                                    a.reg_no,
                                    b.benf_ac_name benf_name,
                                    b.benf_branch ifsc,
                                    b.benf_ac_no,
                                    a.trans_description return_remarks,
                                    a.amount amount
                                    FROM   td_reconciliation_yes a,
                                           td_neft_reconciliation b ,
                                           md_society c
                                    WHERE  a.reference_no  = b.transaction_ref
                                    AND    substr(b.remarks,1,instr(b.remarks,'-')-1)= c.society_code
                                    AND    a.dist_id       = $brn
                                    AND    a.value_dt      between '$from_dt' and '$to_dt'
                                    AND    a.trans_type    = 'N'
                                    AND    b.txn_status    in ('NackBySFMS','Returned')");
                                    
    return $neft->result();
}


 

}
?>