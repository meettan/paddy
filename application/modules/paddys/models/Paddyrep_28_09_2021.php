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
    public function f_get_soc_ho($brn,$kms){
        $soc = $this->db->query("select a.society_code society_code,
                                        a.soc_name soc_name,
                                        a.block blockcode,
                                        b.block_name block_name
                                from md_society a,md_block b
                                where   a.block = b.blockcode
                                and     a.branch_id = $brn
                                and     a.society_code in (select distinct soc_id
                                                           from td_collections
                                                           where branch_id = $brn 
                                                           and   kms_id    = $kms)");

        return $soc->result();
    }

    /**Retrieve society name  */
    public function f_get_soc_name_dtls($soc_id){
        $soc = $this->db->query("select *
                                from md_society 
                                where   society_code = $soc_id");
        return $soc->row();
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

    /*public function f_get_reg_farm_ho($brn,$frmdt,$todt,$kms_id){

        $reg  = $this->db->query("select soc_id,count(reg_no) reg_farm
                                  from   td_farmer_reg
                                  where  branch_id = $brn
                                  and    kms_id    = $kms_id  
                                  group by soc_id
                                  order by soc_id");

        return $reg->result();
    }*/
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
                                          count(distinct trans_dt)camp,sum(amount)amount
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
        $collc = $this->db->query("select soc_id,sum(amount) amount_clr,count(reg_no) farm_rcvd
                                   from   td_collections
                                   where  branch_id = $brn  
                                   and    chq_status in ('C','S')
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by soc_id
                                   order by soc_id");
        return $collc->result();
    }

/**Remaining farmer no. */
public function f_getunpaid_farmer($brn,$frmdt,$todt){
    $collc = $this->db->query("select soc_id,sum(amount) amount_clr,count(reg_no) unpaid_farm_rcvd
                               from   td_collections
                               where  branch_id = $brn  
                               and    chq_status not in ('C','S')
                               and    trans_dt between '$frmdt' and '$todt'
                               group by soc_id
                               order by soc_id");
    return $collc->result();
}

/**Remaining farmer no. */
public function f_getunpaid_farmer_dist($frmdt,$todt){
    $collc = $this->db->query("select branch_id,sum(amount) amount_clr,count(reg_no) unpaid_farm_rcvd
                               from   td_collections
                               where  trans_dt between '$frmdt' and '$todt'
                               and    chq_status not in ('C','S') 
                               group by branch_id
                               order by branch_id");
    return $collc->result();
}

/**Districtwise amount of chq cleared beween a date range in given district */
    public function f_getdistamt_clr($frmdt,$todt){
        $collc = $this->db->query("select branch_id,sum(amount) amount_clr,count(reg_no) farm_rcvd
                                   from   td_collections
                                   where  chq_status in('C','S')
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

/**Societywise re-issue cheque */
public function f_getamt_reissue_new($brn,$frmdt,$todt,$kms_id){

      $collc = $this->db->query("SELECT soc_id,
                                        count(reg_no)reissue_no,
                                        sum(amount) amt_ressiue
                                 FROM   td_collections
                                 where  branch_id = $brn
                                 and    Date(forwarded_dt) between '$frmdt' and '$todt'
                                 and    CAST(book_no AS UNSIGNED) > 0
                                 and    kms_id = $kms_id
                                 and    status = '1'
                                 group by soc_id");
    return $collc->result();
}

/**Districtwise re-issue cheque */    
    public function f_getdisamt_reissue($frmdt,$todt,$kms_id){      
          $collc = $this->db->query("SELECT branch_id,
                                            count(reg_no)reissue_no,
                                            sum(amount) amt_ressiue
                                    FROM   td_collections
                                    where  Date(forwarded_dt) between '$frmdt' and '$todt'
                                    and    CAST(book_no AS UNSIGNED) > 0
                                    and    kms_id = $kms_id
                                    and    status = '1'
                                    group by branch_id");

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

        $cmr = $this->db->query("select soc_id,ifnull(sum(resultant_cmr),0)resultant
                                   from   td_cmr_offered
                                   where  branch_id = $brn
                                   and    trans_dt between '$frmdt' and '$todt'
                                   group by soc_id
                                   order by soc_id");
        return $cmr->result();
    }
/**Districtwise resultant CMR and CMR offered between a period*/    
     public function f_getdistcmr($frmdt,$todt,$kms){
        $cmr = $this->db->query("select branch_id,sum(resultant_cmr)resultant,sum(cmr_offered_now) offered
                                   from td_cmr_offered                            
                                   where trans_dt between '$frmdt' and '$todt'
                                   and   kms_year = $kms   
                                   group by branch_id");
        return $cmr->result();
    }

    public function f_get_offer($brn,$frmdt,$todt,$block_id){

      $offer = $this->db->query("select soc_id,rice_type,sum(cmr_offered_now) offered
                                 from   td_cmr_offered
                                 where  branch_id = '$brn'
                                 and    block_id  = '$block_id'
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

    public function f_get_delv_ho($brn,$frmdt,$todt,$kms_id){

      $offer = $this->db->query("select soc_id,cmr_type,sum(sp) sp,sum(cp) cp,sum(fci) fci
                                 from   td_cmr_delivery
                                 where  branch_id = $brn
                                 and    delivery_dt between '$frmdt' and '$todt'
                                 and    kms_year = $kms_id
                                 group by soc_id,cmr_type
                                 order by soc_id");
      return $offer->result();
    }

/**Districtwise total CMR delivered by each district in SP,CP & FCI */
    public function f_getdistdelv($frmdt,$todt,$kms){
      $offer = $this->db->query("select branch_id,sum(sp)sp,sum(cp)cp,sum(fci) fci
                                 from   td_cmr_delivery
                                 where  trans_dt between '$frmdt' and '$todt'
                                 and    kms_year = $kms
                                 group by branch_id");
      return $offer->result();
    }


    ////
    public function f_delivery_gap($frmdt,$todt,$kms){
        $delivery_gap = $this->db->query("select branch_id,sum(resultant)resultant,sum(offered_now)offered_now,
                                          sum(offered_now) - (sum(sp) + sum(cp) + sum(fci)) as offer_gap,
                                          sum(resultant)-(sum(sp) + sum(cp) + sum(fci)) as gap_delivery
                                        from(
                                                SELECT branch_id,0 sp,0 cp,0 fci,sum(resultant_cmr)resultant,sum(cmr_offered_now)offered_now FROM td_cmr_offered
                                                where kms_year = $kms
                                                and   trans_dt between '$frmdt' and '$todt'
                                                group by branch_id
                                                union
                                                SELECT branch_id,sum(sp)sp,sum(cp)cp,sum(fci)fci,0 resultant,0 offered_now FROM td_cmr_delivery
                                                where kms_year = $kms
                                                and   trans_dt between '$frmdt' and '$todt'
                                                group by branch_id)a
                                                group by branch_id"
                                            );
        return $delivery_gap->result();
    }
    

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
    
    public function f_get_remain($brn,$frmdt,$todt,$block_id,$kms_id){
        
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
                                            where  delivery_dt between '$frmdt' and '$todt'
                                            and    kms_year = $kms_id
                                            and    branch_id = $brn
                                            and    block = $block_id
                                            group by soc_id)a
                                    group by soc_id
                                    order by soc_id");
                                    
        return $remain->result();
    }
    
    
    public function f_get_remain_ho($brn,$frmdt,$todt,$kms_id){
        
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
                                            where  delivery_dt between '$frmdt' and '$todt'
                                            and    kms_year = $kms_id
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

    public function f_get_mill_ho($brn,$kms){
        $soc = $this->db->query("select a.sl_no mill_id,
                                        a.mill_name mill_name,
                                        a.block blockcode,
                                        b.block_name block_name
                                from    md_mill a,md_block b
                                where   a.block = b.blockcode
                                and     a.branch_id = $brn
                                and     a.sl_no in (select distinct mill_id
                                                           from td_received
                                                           where dist        = $brn 
                                                           and   kms_year    = $kms)");

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

    public function f_get_mill_delv($brn,$frmdt,$todt,$kms_id){

      $offer = $this->db->query("select mill_id,cmr_type,sum(sp) sp,sum(cp) cp,sum(fci) fci
                                 from   td_cmr_delivery
                                 where  branch_id = $brn
                                 and    delivery_dt between '$frmdt' and '$todt'
                                 and    kms_year = $kms_id
                                 group by mill_id,cmr_type
                                 order by mill_id");
      return $offer->result();
    }
    
   public function f_get_mil_do($brn,$frmdt,$todt,$kms_id){

      $offer = $this->db->query("select mill_id,rice_type,sum(sp) sp,sum(cp) cp,sum(fci) fci
                                 from   td_do_isseued
                                 where  branch_id = $brn
                                 and    kms_year  = $kms_id
                                 and    trans_dt between '$frmdt' and '$todt'
                                 group by mill_id,rice_type
                                 order by mill_id");
      return $offer->result();
    }
    
    
    public function f_get_mill_remain($brn,$frmdt,$todt,$kms_id){

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
                                            where  delivery_dt between '$frmdt' and '$todt'
                                            and    kms_year = $kms_id
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
                                        a.farmer_name farmer_name,
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
            group by a.branch_id";
               
      $data = $this->db->query($sql);     

      return  $data->result();
    }
////and   b.trans_dt > trn_dt
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

  //NEFT Return case KMS ID 19-20
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
                                    AND    b.txn_status    in ('NackBySFMS','Returned','Rejected')");
                                    
    return $neft->result();
}

 //NEFT Return case KMS ID 20-21
 public function f_get_ret_neft($brn,$from_dt,$to_dt){
    $neft = $this->db->query("select a.branch_id branch_id,
                                     a.trans_dt  procurement_dt,
                                     b.payment_run_date payment_dt,
                                     a.soc_id,
                                     c.soc_name soc_name,
                                     a.reg_no,
                                     a.farmer_name benf_name, 
                                     a.ifsc_code ifsc,
                                     a.acc_no benf_ac_no,
                                     a.amount amount,
                                     b.status_description return_remarks
                              from td_collections a,td_reverse_feed b, md_society c
                              where a.forward_trans_id = b.forward_trans_id
                              and   a.soc_id           = c.society_code
                              and   a.chq_status       In ('R','L')
                              and   b.status_code      != 'SUCCESS'
                              and   a.branch_id        = $brn
                              and   a.trans_dt         between '$from_dt' and '$to_dt' ");
                                    
    return $neft->result();
}


//Districtwise procurement 
    public function f_get_dist_proc($from_dt,$to_dt){

        $proc   =   $this->db->query("SELECT a.branch_id branch_id,
                                            b.branch_name branch_name,
                                            count(distinct a.soc_id)soc_no,
                                            count(a.reg_no)farm_no,
                                            sum(a.quantity)qty,
                                            sum(a.amount)amt 
                                    from td_collections a,md_branch b
                                    where a.branch_id = b.id
                                    and   a.trans_dt between '$from_dt' and '$to_dt' 
                                    group by a.branch_id 
                                    order by a.branch_id");

        return $proc->result();
    }

    public function f_get_cmr_dist($frmdt,$todt){            //Districtwise Resultant CMR

        $cmr = $this->db->query("select branch_id,sum(resultant_cmr)resultant
                                   from   td_cmr_offered
                                   where  trans_dt between '$frmdt' and '$todt'  
                                   group by branch_id
                                   order by branch_id");
        return $cmr->result();
    }   

    public function f_get_offer_dist($frmdt,$todt){      //Districtwise Rice Typewise offer       

        $offer = $this->db->query("select branch_id,rice_type,sum(cmr_offered_now) offered
                                   from   td_cmr_offered
                                   where  trans_dt between '$frmdt' and '$todt'  
                                   group by branch_id,rice_type
                                   order by branch_id");
        return $offer->result();
    }

    public function f_get_delv_dist($frmdt,$todt,$kms_id){     //Districtwise Rice Typewise Delivery

        $offer = $this->db->query("select branch_id,cmr_type,sum(sp) sp,sum(cp) cp,sum(fci) fci
                                   from   td_cmr_delivery
                                   where  delivery_dt between '$frmdt' and '$todt'
                                   and    kms_year = $kms_id
                                   group by branch_id,cmr_type
                                   order by branch_id");
        return $offer->result();
      }

    public function f_get_remain_dist($frmdt,$todt,$kms_id){      //Districtwise remaining CMR to be delivered
    
    $remain = $this->db->query("select branch_id,sum(offer),sum(delv),sum(offer) - sum(delv)remain
                                from (
                                        select branch_id,sum(cmr_offered_now)offer,0 delv
                                        from   td_cmr_offered
                                        where  trans_dt between '$frmdt' and '$todt'
                                        group by branch_id
                                        union
                                        select branch_id,0 offer,sum(sp) + sum(cp) + sum(fci)delv
                                        from   td_cmr_delivery
                                        where  delivery_dt between '$frmdt' and '$todt'
                                        and    kms_year = $kms_id
                                        group by branch_id)a
                                group by branch_id
                                order by branch_id");
                                
        return $remain->result();
    }
    
    //Districtwise payment 
    public function f_get_dist_pay($from_dt,$to_dt){
        $pay   =   $this->db->query("SELECT branch_id,sum(amount)clr_amt 
                                     FROM td_collections
                                     where trans_dt between '$from_dt' and '$to_dt'
                                     and   chq_status in ('C','S')
                                     group by branch_id");

        return $pay->result();
    }

    //Districtwise pending payment 
    public function f_get_pending_pay($from_dt,$to_dt){
        $pay   =   $this->db->query("select branch_id,sum(tot_amt) -sum(clr_amt) 'pending'
                                     from (
                                        SELECT branch_id,sum(amount)tot_amt,0 clr_amt
                                        FROM td_collections
                                        where trans_dt between '$from_dt' and '$to_dt'
                                        group by branch_id
                                        union
                                        SELECT branch_id,0 tot_amt,sum(amount)clr_amt
                                        FROM td_collections
                                        where trans_dt between '$from_dt' and '$to_dt'
                                        and   chq_status in ('C','S')
                                        group by branch_id)a
                                        group by branch_id");

        return $pay->result();
    }

    //Districtwise total paddy total cmr for incidental payment
    public function f_get_tot_paddy_cmr($from_dt,$to_dt){

        $proc   =   $this->db->query("SELECT a.dist branch_id,
                                             b.branch_name branch_name,
                                             sum(a.tot_paddy)qty,
                                             sum(a.tot_cmr)cmr 
                                    from td_payment_bill a,md_branch b
                                    where a.dist = b.id
                                    and   a.trans_dt between '$from_dt' and '$to_dt' 
                                    group by a.dist,b.branch_name 
                                    order by a.dist");

        return $proc->result();
    }

    public function f_get_tot_soc_comm($from_dt,$to_dt){

        $proc   =   $this->db->query("SELECT branch_id,
                                             sum(tot_amt)soc_comm,
                                             sum(tds_amt)tds_amt
                                      from  td_society_commision
                                      where trans_dt between '$from_dt' and '$to_dt'
                                      group by branch_id  
                                      order by branch_id");

        return $proc->result();
    }

    public function f_get_tot_mill_comm($from_dt,$to_dt){

        $proc   =   $this->db->query("SELECT dist branch_id,
                                             account_type,
                                             sum(total_amt)mill_comm
                                      from  td_payment_bill_dtls
                                      where trans_dt between '$from_dt' and '$to_dt'
                                      group by dist,account_type  
                                      order by dist,account_type");

        return $proc->result();
    }

    public function f_get_tot_incidental($from_dt,$to_dt){

        $proc   =   $this->db->query("SELECT dist branch_id,
                                             sum(total_amt)tot_amt,
                                             sum(tds_amt)tds_amt,
                                             sum(sgst_amt)sgst_amt,
                                             sum(cgst_amt)cgst_amt,
                                             sum(payble_amt)net_amt
                                      from  td_payment_bill_dtls
                                      where trans_dt between '$from_dt' and '$to_dt'
                                      group by dist  
                                      order by dist");

        return $proc->result();
    }

    //Societywise total paddy for incidental payment
    public function f_get_tot_paddy_cmr_soc($from_dt,$to_dt,$brn_id){

        $proc   =   $this->db->query("SELECT a.soc_id,
                                             b.soc_name,
                                             sum(a.tot_paddy)qty,
                                             sum(a.tot_cmr)cmr 
                                    from td_payment_bill a,md_society b
                                    where a.soc_id = b.society_code
                                    and   a.trans_dt between '$from_dt' and '$to_dt' 
                                    and   a.dist   = $brn_id
                                    group by a.soc_id,soc_name
                                    order by a.soc_id");

        return $proc->result();
    }

    public function f_get_comm_soc($from_dt,$to_dt,$brn_id){

        $proc   =   $this->db->query("SELECT soc_id,
                                             sum(tot_amt)soc_comm,
                                             sum(tds_amt)tds_amt,
                                             (sum(tot_amt) - sum(tds_amt))paid_amt
                                      from  td_society_commision
                                      where trans_dt between '$from_dt' and '$to_dt'
                                      and   branch_id = $brn_id
                                      group by soc_id  
                                      order by soc_id");

        return $proc->result();
    }

    //Millwisewise total paddy total cmr for incidental payment
    public function f_get_tot_paddy_cmr_mill($from_dt,$to_dt,$brn_id){

        $proc   =   $this->db->query("SELECT a.mill_id,
                                             b.mill_name,
                                             sum(a.tot_paddy)qty,
                                             sum(a.tot_cmr)cmr 
                                    from td_payment_bill a,md_mill b
                                    where a.mill_id = b.mill_code
                                    and   a.trans_dt between '$from_dt' and '$to_dt' 
                                    and   a.dist   = $brn_id
                                    group by a.mill_id,b.mill_name 
                                    order by a.dist");

        return $proc->result();
    }


    public function f_get_mill_comm($from_dt,$to_dt,$brn_id){

        $proc   =   $this->db->query("SELECT a.mill_id,
                                             b.account_type,
                                             sum(b.total_amt)mill_comm
                                      from   td_payment_bill a,td_payment_bill_dtls b
                                      where  a.trans_dt  = b.trans_dt 
                                      and    a.pmt_bill_no = b.pmt_bill_no
                                      and    b.trans_dt between '$from_dt' and '$to_dt'
                                      and    b.dist = $brn_id
                                      group by a.mill_id,b.account_type  
                                      order by a.mill_id,b.account_type");

        return $proc->result();
    }

    public function f_get_tot_incidental_brn($from_dt,$to_dt,$brn_id){

        $proc   =   $this->db->query("SELECT a.mill_id,
                                             sum(b.total_amt)tot_amt,
                                             sum(b.tds_amt)tds_amt,
                                             sum(b.sgst_amt)sgst_amt,
                                             sum(b.cgst_amt)cgst_amt,
                                             sum(b.payble_amt)net_amt
                                      from  td_payment_bill a,td_payment_bill_dtls b
                                      where  a.trans_dt  = b.trans_dt 
                                      and    a.pmt_bill_no = b.pmt_bill_no
                                      and    b.trans_dt between '$from_dt' and '$to_dt'
                                      and    b.dist = $brn_id
                                      group by a.mill_id  
                                      order by a.mill_id");

        return $proc->result();
    }

    public function f_get_paddy_despatch($from_dt,$to_dt,$brn_id){

        $despatch   =   $this->db->query("SELECT a.branch_id,
                                                 b.soc_name,
                                                 c.mill_name,
                                                 sum(a.paddy_qty)paddy_qty
                                         FROM td_received a,
                                              md_society b,
                                              md_mill c
                                         where a.soc_id = b.society_code
                                         and   a.mill_id = c.mill_code
                                         and   a.trans_dt between '$from_dt' and '$to_dt'
                                         and   a.branch_id = '$brn_id'
                                         group by a.branch_id,b.soc_name,c.mill_name");

        return $despatch->result();
    }

    public function f_get_payment_date($branch_id,$kms_id,$from_dt,$to_dt,$bank){
        $payment_dt = $this->db->query("select soc_name,trans_dt,max(payment_run_date)payment_run_date,bulk_trans_id,
                                        forward_bulk_trans_id,sum(tot_qty)tot_qty,sum(tot_amt)tot_amt,book_no
                                        from(select a.soc_name soc_name,b.soc_id soc_id,b.trans_dt trans_dt,
                                                max(c.payment_run_date)payment_run_date,b.forward_trans_id,
                                                b.bulk_trans_id,b.forward_bulk_trans_id forward_bulk_trans_id,  
                                                b.quantity tot_qty,b.amount tot_amt,b.book_no,b.chq_status chq_status
                                                from   md_society a,td_collections b,td_reverse_feed c
                                                where  a.sl_no      = b.soc_id
                                                and    b.forward_trans_id = c.forward_trans_id
                                                and    b.branch_id  = '$branch_id'
                                                and    b.kms_id     = '$kms_id'
                                                and    b.chq_status = 'S'
                                                and    b.trans_dt between '$from_dt' and '$to_dt'
                                                and    b.bank_sl_no    = '$bank'
                                                group by a.soc_name,
                                                        b.soc_id ,
                                                        b.trans_dt ,
                                                        b.forward_trans_id,
                                                        b.bulk_trans_id,
                                                        b.forward_bulk_trans_id,  
                                                        b.quantity,
                                                        b.amount,
                                                        b.book_no,
                                                        b.chq_status
                                            )d
                                        group by soc_name,
                                                trans_dt,
                                                bulk_trans_id,
                                                forward_bulk_trans_id,
                                                book_no
                                        order by trans_dt,bulk_trans_id,book_no;");

        return $payment_dt->result();
    }

}
?>