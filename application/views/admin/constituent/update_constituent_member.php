<div  class="right_col" role="main" style="height:100vh;">
   <div class="">
      <div class="col-md-12 col-sm-12 ">
         <form class="form-horizontal form-label-left" id="master_form" action="<?php  echo base_url(); ?>constituent/update_constituent_member" method="post" enctype="multipart/form-data">
         <div class="x_panel">
            <div class="x_title">
               <h2>Update Constituency information</h2>
               <div class="clearfix"></div>
            </div>
            <?php if($this->session->flashdata('msg')) {
              $message = $this->session->flashdata('msg');?>
              <div class="<?php echo $message['class'] ?> alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert">&times;</button>
                 <strong> <?php echo $message['status']; ?>! </strong>  <?php echo $message['message']; ?>
             </div>
            <?php  }  ?>
            <?php foreach($res as $rows){}
              $paguthi_id=$rows->paguthi_id;
              $ward_id=$rows->ward_id;
              $booth_id=$rows->booth_id;
               ?>

            <div class="x_content">
                  <div class="form-group row ">
                     <label class="control-label col-md-2 col-sm-3 ">Constituency <span class="required">*</span></label>
                     <div class="col-md-4 col-sm-9 ">
                       <select class="form-control" name="constituency_id" id="constituency_id">
                         <?php foreach($res_constituency as $rows_constituency){ ?>

                        <?php } ?>
                         <option value="<?php echo $rows_constituency->id ?>"><?php echo $rows_constituency->constituency_name; ?></option>

                       </select>
                     </div>
                     <label class="control-label col-md-2 col-sm-3 ">Paguthi <span class="required">*</span></label>
                     <div class="col-md-4 col-sm-9 ">
                       <select class="form-control" name="paguthi_id" id="paguthi_id" onchange="get_paguthi();">
                         <?php foreach($res_paguthi as $rows_paguthi){ ?>
                            <option value="<?php echo $rows_paguthi->id ?>"><?php echo $rows_paguthi->paguthi_name; ?></option>
                        <?php } ?>


                       </select>
                       <script>$('#paguthi_id').val('<?php echo $paguthi_id; ?>');</script>
                     </div>
                   </div>
                   <div class="form-group row ">
                      <label class="control-label col-md-2 col-sm-3 ">ward <span class="required">*</span></label>
                      <div class="col-md-4 col-sm-9 ">
                          <select class="form-control" name="ward_id" id="ward_id" onchange="get_booth(this);">
                            <?php $query="SELECT * FROM ward WHERE status='ACTIVE' and paguthi_id='$paguthi_id' order by id desc";
                            $result=$this->db->query($query);
                            if($result->num_rows()==0){ ?>
                            <option value=""></option>
                            <?php 	}else{
                            $res_ward=$result->result();
                            foreach($res_ward as $rows_ward){ ?>
                              <option value="<?php echo $rows_ward->id; ?>"><?php echo $rows_ward->ward_name; ?></option>
                            <?php   }		}    ?>
                        </select>
                     <script>$('#ward_id').val('<?php echo $ward_id; ?>');</script>
                      </div>
                      <label class="control-label col-md-2 col-sm-3 ">booth <span class="required">*</span></label>
                      <div class="col-md-4 col-sm-9 ">
                        <select class="form-control" name="booth_id" id="booth_id" onchange="get_booth_address(this);">

                          <?php $query_b="SELECT * FROM booth where ward_id='$ward_id' and status='ACTIVE' order by id desc";
                          $resultb=$this->db->query($query_b);
                          if($resultb->num_rows()==0){ ?>
                          <option value=""></option>
                          <?php 	}else{
                          $res_booth=$resultb->result();
                          foreach($res_booth as $rows_booth){ ?>
                            <option value="<?php echo $rows_booth->id; ?>"><?php echo $rows_booth->booth_name; ?></option>
                          <?php   }		}    ?>

                        </select>
                        <script>$('#booth_id').val('<?php echo $booth_id; ?>');</script>
                      </div>
                    </div>
                    <div class="form-group row ">
                       <label class="control-label col-md-2 col-sm-3 ">booth address <span class="required">*</span></label>
                       <div class="col-md-4 col-sm-9 ">
                         <?php $query_b="SELECT * FROM booth where id='$booth_id' and status='ACTIVE' order by id desc";
                         $resultb=$this->db->query($query_b);
                         if($resultb->num_rows()==0){ ?>
                        <textarea class="form-control" name="booth_address" id="booth_address" readonly></textarea>
                         <?php 	}else{
                         $res_booth=$resultb->result();
                         foreach($res_booth as $rows_booth){ ?>
                           <textarea class="form-control" name="booth_address" id="booth_address" readonly><?php echo $rows_booth->booth_address; ?></textarea>
                         <?php   }		}    ?>


                       </div>
                       <label class="control-label col-md-2 col-sm-3 ">Party member</label>
                       <div class="col-md-4 col-sm-9 ">
                          <p>
                            YES:
                            <input type="radio" class="flat" name="party_member_status" id="party_member_y" value="Y" <?php echo ($rows->party_member_status=='Y') ? 'checked="checked"':'';?>> NO:
                            <input type="radio" class="flat" name="party_member_status" id="party_member_n" value="N" <?php echo ($rows->party_member_status=='N') ? 'checked="checked"':'';?>>
                         </p>

                       </div>
                     </div>

                     <div class="form-group row ">
                        <label class="control-label col-md-2 col-sm-3 ">Vote type</label>
                        <div class="col-md-4 col-sm-9 ">
                          <select class="form-control" name="vote_type" id="vote_type">
                            <option value="MyVOTE">MY VOTE</option>
                            <option value="OTHERVOTE">OTHER VOTE</option>
                          </select>
                          <script>$('#vote_type').val('<?php echo $rows->vote_type; ?>');</script>
                        </div>
                        <label class="control-label col-md-2 col-sm-3 ">Serial no <span class="required">*</span></label>
                        <div class="col-md-4 col-sm-9 ">
                          <input type="text" name="serial_no" id="serial_no" class="form-control" value="<?php echo $rows->serial_no; ?>">
                        </div>

                      </div>
            </div>
         </div>

         <div class="x_panel">
            <div class="x_title">
               <h2>personal information</h2>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
                  <div class="form-group row ">
                     <label class="control-label col-md-2 col-sm-3 ">FULL name <span class="required">*</span></label>
                     <div class="col-md-4 col-sm-9 ">
                       <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo $rows->full_name; ?>">
                     </div>
                     <label class="control-label col-md-2 col-sm-3 ">Father or husband <br> name <span class="required">*</span></label>
                     <div class="col-md-4 col-sm-9 ">
                       <input type="text" name="father_husband_name" id="father_husband_name" class="form-control" value="<?php echo $rows->father_husband_name; ?>">
                     </div>
                  </div>
                  <div class="form-group row ">
                     <label class="control-label col-md-2 col-sm-3 ">Gaurdian name</label>
                     <div class="col-md-4 col-sm-9 ">
                       <input type="text" name="guardian_name" id="guardian_name" class="form-control" value="<?php echo $rows->guardian_name; ?>">
                     </div>
                     <label class="control-label col-md-2 col-sm-3 ">EMAIL ID</label>
                     <div class="col-md-4 col-sm-9 ">
                       <input type="text" name="email_id" id="email_id" class="form-control" value="<?php echo $rows->email_id; ?>">
                     </div>
                  </div>
                  <div class="form-group row ">
                     <label class="control-label col-md-2 col-sm-3 ">Mobile no <span class="required">*</span></label>
                     <div class="col-md-4 col-sm-9 ">
                       <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="<?php echo $rows->mobile_no; ?>">
                     </div>
                     <label class="control-label col-md-2 col-sm-3 ">Whatsapp no</label>
                     <div class="col-md-4 col-sm-9 ">
                       <input type="text" name="whatsapp_no" id="whatsapp_no" class="form-control" value="<?php echo $rows->whatsapp_no; ?>">
                     </div>
                  </div>
                  <div class="form-group row ">
                     <label class="control-label col-md-2 col-sm-3 ">DOB <span class="required">*</span></label>
                     <div class="col-md-4 col-sm-9 ">
                       <input type="text" name="dob" id="dob" class="form-control" value="<?php echo $rows->dob; ?>">
                     </div>
                     <label class="control-label col-md-2 col-sm-3 ">Door no <span class="required">*</span></label>
                     <div class="col-md-4 col-sm-9 ">
                       <input type="text" name="door_no" id="door_no" class="form-control" value="<?php echo $rows->door_no; ?>">
                       <input type="hidden" name="constituent_id" id="constituent_id" class="form-control" value="<?php echo base64_encode($rows->id*98765); ?>">
                     </div>
                  </div>
                  <div class="form-group row ">
                    <label class="control-label col-md-2 col-sm-3 ">pincode <span class="required">*</span></label>
                    <div class="col-md-4 col-sm-9 ">
                      <input type="text" name="pin_code" id="pin_code" class="form-control" value="<?php echo $rows->pin_code; ?>">
                    </div>
                     <label class="control-label col-md-2 col-sm-3 ">address <span class="required">*</span></label>
                     <div class="col-md-4 col-sm-9 ">
                       <textarea name="address" id="address" class="form-control"><?php echo $rows->address; ?></textarea>
                     </div>

                  </div>
                  <div class="form-group row ">
                     <label class="control-label col-md-2 col-sm-3 ">Religion</label>
                     <div class="col-md-4 col-sm-9 ">
                       <select class="form-control" name="religion_id" id="religion_id">
                  <?php foreach($res_religion as $rows_religion){ ?>
                     <option value="<?php echo $rows_religion->id; ?>"><?php echo $rows_religion->religion_name; ?></option>
                <?php  } ?>

                       </select>
                       <script>$('#religion_id').val('<?php echo $rows->religion_id; ?>');</script>
                     </div>
                     <label class="control-label col-md-2 col-sm-3 ">Gender</label>
                     <div class="col-md-4 col-sm-9 ">
                       <select class="form-control" name="gender" id="gender">
                         <option value="M">Male</option>
                         <option value="F">Female</option>
                       </select>
                       <script>$('#gender').val('<?php echo $rows->gender; ?>');</script>
                        </div>

                   </div>
                    <div class="form-group row ">
                         <label class="control-label col-md-2 col-sm-3 ">Voter id status</label>
                       <div class="col-md-4 col-sm-9 ">
                          <p>
                            YES:
                            <input type="radio" class="flat" name="voter_id_status" id="voter_id_statu_y" value="Y" <?php echo ($rows->voter_id_status=='Y') ? 'checked="checked"':'';?>> NO:
                            <input type="radio" class="flat" name="voter_id_status" id="voter_id_status_n" value="N" <?php echo ($rows->voter_id_status=='N') ? 'checked="checked"':'';?>>
                         </p>
                       </div>
                        <label class="control-label col-md-2 col-sm-3 voter_id_box">Voter id no</label>
                       <div class="col-md-4 col-sm-9 voter_id_box">
                        <input type="text" name="voter_id_no" id="voter_id_no" class="form-control" value="<?php echo $rows->voter_id_no; ?>">
                       </div>
                     </div>
                     <div class="form-group row ">
                          <label class="control-label col-md-2 col-sm-3 ">aadhaar status <span class="required">*</span></label>
                        <div class="col-md-4 col-sm-9 ">
                           <p>
                             YES:
                             <input type="radio" class="flat" name="aadhaar_status" id="aadhaar_status_y" value="Y" <?php echo ($rows->aadhaar_status=='Y') ? 'checked="checked"':'';?>> NO:
                             <input type="radio" class="flat" name="aadhaar_status" id="aadhaar_status_n" value="N" <?php echo ($rows->aadhaar_status=='N') ? 'checked="checked"':'';?>>
                          </p>
                        </div>

                        <label class="control-label col-md-2 col-sm-3 aadhaar_box">aadhaar no</label>
                       <div class="col-md-4 col-sm-9 aadhaar_box">
                        <input type="text" name="aadhaar_no" id="aadhaar_no" class="form-control" value="<?php echo $rows->aadhaar_no; ?>">
                       </div>

                      </div>
                      <div class="form-group row ">

                          <label class="control-label col-md-2 col-sm-3 ">Profile image</label>
                         <div class="col-md-4 col-sm-9 ">
                          <input type="file" name="profile_pic" id="profile_pic" class="form-control">
                            <input type="hidden" name="old_profile_pic" id="old_profile_pic" class="form-control" value="<?php echo $rows->profile_pic; ?>">
                         </div>
                         <label class="control-label col-md-2 col-sm-3 ">current image</label>
                        <div class="col-md-4 col-sm-9 ">
                         <img src="<?php echo base_url(); ?>assets/constituent/<?php echo $rows->profile_pic; ?>" style="width:150px;">
                        </div>
                       </div>
                       <div class="form-group row ">

                          <label class="control-label col-md-2 col-sm-3 ">status</label>
                          <div class="col-md-4 col-sm-9 ">
                            <select class="form-control" name="status" id="status">
                              <option value="ACTIVE">ACTIVE</option>
                              <option value="INACTIVE">INACTIVE</option>
                            </select>
                            <script>$('#status').val('<?php echo $rows->status; ?>');</script>
                             </div>

                        </div>


            </div>
         </div>

         <div class="x_panel" class="interaction_div">

            <div class="x_content">
                <div class="form-group">
                 <div class="col-md-9 col-sm-9  offset-md-3">
                    <button type="submit" class="btn btn-success">Update</button>
                 </div>
              </div>
            </div>
         </div>



         </form>
      </div>
   </div>
</div>
<style>
.mb_20{
  margin-bottom: 20px;
}
</style>
<?php if($rows->aadhaar_status=='N'){ ?>
<style>
.aadhaar_box{
  display: none;
}
</style>
<?php } ?>
<?php if($rows->voter_id_status=='N'){ ?>
<style>
.voter_id_box{
  display: none;
}
</style>
<?php } ?>

<script type="text/javascript">
   $('#constiituent_menu').addClass('active');
   $('.constiituent_menu').css('display','block');
   $('#create_constituent_menu').addClass('active');

   $('#dob').datetimepicker({
         format: 'DD-MM-YYYY',
         viewMode: 'years'
   });


function get_paguthi(){
      var paguthi_id=$('#paguthi_id').val();

    $.ajax({
		url:'<?php echo base_url(); ?>masters/get_active_ward',
		method:"POST",
		data:{paguthi_id:paguthi_id},
		dataType: "JSON",
		cache: false,
		success:function(data)
		{
		   var stat=data.status;
		   $("#ward_id").empty();
		   if(stat=="success"){
		   var res=data.res;
		   var len=res.length;
        $('#ward_id').html('<option value="">-SELECT ward --</option>');
		   for (i = 0; i < len; i++) {
		   $('<option>').val(res[i].id).text(res[i].ward_name).appendTo('#ward_id');
		   }

		   }else{
		   $("#ward_id").empty();
        $("#booth_id").empty();
         $("#booth_address").empty();
		   }
		}
	});
}

function get_booth(sel){
  var ward_id=sel.value;
  $.ajax({
		url:'<?php echo base_url(); ?>masters/get_active_booth',
		method:"POST",
		data:{ward_id:ward_id},
		dataType: "JSON",
		cache: false,
		success:function(data)
		{
		   var stat=data.status;
		   $("#booth_id").empty();
		   if(stat=="success"){

		   var res=data.res;
		   var len=res.length;
       $('#booth_id').html('<option value="">-SELECT BOOTH --</option>');
		   for (i = 0; i < len; i++) {
		   $('<option>').val(res[i].id).text(res[i].booth_name).appendTo('#booth_id');
		   }

		   }else{
		   $("#booth_id").empty();
        $("#booth_address").empty();
		   }
		}
	});
}

function get_booth_address(sel){
  var booth_id=sel.value;
  $.ajax({
    url:'<?php echo base_url(); ?>masters/get_booth_address',
    method:"POST",
    data:{booth_id:booth_id},
    dataType: "JSON",
    cache: false,
    success:function(data)
    {
       var stat=data.status;
       $("#booth_address").empty();
       if(stat=="success"){
       var res=data.res;
       var len=res.length;
       for (i = 0; i < len; i++) {
        $('#booth_address').text(res[i].booth_address);
      }
       }else{
       $("#booth_address").empty();
       }
    }
  });
}

$('input[name=voter_id_status]').click(function(){
  if(this.value == 'Y'){
    $('.voter_id_box').show();
  }else{
    $('.voter_id_box').hide();
  }
});
$('input[name=aadhaar_status]').click(function(){
  if(this.value == 'Y'){
    $('.aadhaar_box').show();
  }else{
    $('.aadhaar_box').hide();
  }
});
  $('.interaction_div').hide();
$('input[name=interaction_section]').click(function(){
  if(this.value == 'Y'){
    $('.interaction_div').show();
  }else{
    $('.interaction_div').hide();
  }
});

   $('#master_form').validate({
        rules: {
          paguthi_id:{required:true },
          ward_id:{required:true },
          booth_id:{required:true },
          full_name:{required:true },
          father_husband_name:{required:true },
          mobile_no:{required:true,minlength:10,maxlength:10  },
          whatsapp_no:{required:true,minlength:10,maxlength:10  },
          dob:{required:true },
          door_no:{required:true },
          address:{required:true },
          pin_code:{required:true },
          email_id:{required:true,email:true },
          serial_no:{required:true,
            remote: {
                      url: "<?php echo base_url(); ?>constituent/checkserialnoexist/<?php echo $rows->id; ?>",
                      type: "post"
                   }
                  },
            voter_id_no:{required:true,
              remote: {
                        url: "<?php echo base_url(); ?>constituent/checkvoter_id_noexist/<?php echo $rows->id; ?>",
                        type: "post"
                     }
                },
            aadhaar_no:{required:true,maxlength:12,
              remote: {
                        url: "<?php echo base_url(); ?>constituent/checkaadhaar_noexist/<?php echo $rows->id; ?>",
                        type: "post"
                     }
                    },
            profile_pic:{required:false }
        },
        messages: {
          paguthi_id:{required:"select paguthi" },
          ward_id:{required:"select ward" },
          booth_id:{required:"select booth" },
          full_name:{required:"enter full name" },
          father_husband_name:{required:"Enter father or husband name" },
          mobile_no:{required:"enter mobile number" },
          whatsapp_no:{required:"enter whatsapp no" },
          dob:{required:"select date of birth" },
          door_no:{required:"enter door no" },
          address:{required:"enter address" },
          pin_code:{required:"enter pincode" },
          email_id:{required:"enter email id" },
          serial_no:{required:"enter serial no",remote:"serial no already exist" },
          voter_id_no:{required:"enter voter id"},
            voter_id_no: { required:"enter the voter id",remote:"voter id no  already exist"},
            aadhaar_no: { required:"enter the aadhaar no",remote:"aadhaar no  already exist"},
            profile_pic:{required:"select profile image" },
            }
    });

</script>