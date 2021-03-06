<div class="right_col" role="main">
    <div class="">
	<div class="clearfix"></div>
	<div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>constituent report</h2>
                    <a href="<?php echo base_url(); ?>report/get_constituent_report_export" class="btn btn-export pull-right">Export</a>
                    <div class="clearfix"></div>
                </div>
                <?php if($this->session->flashdata('msg')) { $message = $this->session->flashdata('msg');?>
                <div class="<?php echo $message['class'] ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong> <?php echo $message['status']; ?>! </strong>
                    <?php echo $message['message']; ?>
                </div>
                <?php  }  ?>
                <div class="x_content">
                    <form method="post" action="<?= base_url() ?>report/constituent_list">
                        <div class="col-md-12 col-sm-12" style="padding: 0px;">
                            <div class="form-group row">
                                <label class="col-form-label col-md-1 col-sm-3">paguthi</label>
                                <div class="col-md-3 col-sm-4">
                                    <select class="form-control" name="c_paguthi" id="paguthi" onchange="get_paguthi(this);">
                                        <option value="">ALL</option>
                                        <?php foreach($paguthi as $rows){ ?>
                                        <option value="<?php echo $rows->id;?>"><?php echo $rows->paguthi_name;?></option>
                                        <?php } ?>
                                    </select>
                                    <script>
                                        $("#paguthi").val("<?php echo $c_paguthi; ?>");
                                    </script>
                                </div>
                                <label class="col-form-label col-md-1 col-sm-3">offfice</label>
                                <div class="col-md-3 col-sm-4">
                                  <select class="form-control" name="c_ward_id" id="office_id">

                                    <option value="">ALL</option>
                                    <?php foreach($res_office as $rows_office){ ?>
                                       <option value="<?php echo $rows_office->id ?>"><?php echo $rows_office->office_name; ?></option>
                                   <?php } ?>
                                  </select>
                                  <script>
                                      $("#office_id").val("<?php echo $c_ward_id; ?>");
                                  </script>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-1 col-sm-3">&nbsp;</label>
                                <div class="col-md-6 col-sm-4" style="text-align:center;">
                                    <div class="form-group" style="margin-top: 10px;">
                                        <input class="" name="c_whatsapp_no" type="checkbox" value="1"
                                        <?php if($c_whatsapp_no=='1'){ echo "checked='checked'"; } ?>>&nbsp; Whatsapp no &nbsp; <input class="" name="c_mobile_no" type="checkbox" value="1"
                                        <?php if($c_mobile_no=='1'){ echo "checked='checked'"; } ?>>&nbsp; Phone No &nbsp;
                                        <input class="" name="c_email_id" type="checkbox" value="1"
                                        <?php if($c_email_id=='1'){ echo "checked='checked'"; } ?>>&nbsp; Email id &nbsp;
                                        <input class="" name="c_dob" type="checkbox" value="1"
                                        <?php if($c_dob=='1'){ echo "checked='checked'"; } ?>>&nbsp; DOB &nbsp;
                                        <input class="" name="c_voter_id" type="checkbox" value="1"
                                        <?php if($c_voter_id=='1'){ echo "checked='checked'"; } ?>>&nbsp; VOter id
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-2">
                                    <input class="btn btn-success" type="submit" name="submit" value="Search" />
                                    <a href="<?php echo base_url(); ?>report/reset_search" class="btn btn-danger">clear</a>

                                </div>
                            </div>
                        </div>
                    </form>
                      <div class="ln_solid"></div>
                    <div class="col-md-12 col-sm-12" style="overflow-x: scroll;">
                        <div class="col-md-12 col-sm-12" style="padding: 0px;">
                            <div class="col-md-3 col-sm-3">
                                <p style="margin-top:20px;">Total records : <?php echo $allcount; ?></p>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                            <div class="col-md-6 col-sm-6" style="padding: 0px;"><?= $pagination; ?></div>
                        </div>
                        <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                            <tr>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>Father name</th>
                                <th>Dob</th>
                                <th>Address</th>
                                <th>Phone</th>
                            </tr>
                            <?php
			$sno = $row+1;
			foreach($result as $data){ ?>
                            <tr>
                                <td><?php echo $sno; ?></td>
                                <td><?php echo $data['full_name']; ?></td>
                                <td><?php echo $data['father_husband_name']; ?></td>
                                <td><?php if($data['dob']=='0000-00-00'){ echo""; }else{echo date('d-m-Y', strtotime($data['dob'])); } ?></td>
                                <td><?php echo $data['door_no']; ?><br><?php echo $data['address']; ?><br><?php echo $data['pin_code']; ?></td>
                                <td><?php echo $data['mobile_no']; ?></td>
                            </tr>
                            <?php $sno++;	} ?>
                        </table>
                    </div>

                    <div class="col-md-12 col-sm-12" style="padding: 0px;">
                        <div class="col-md-3 col-sm-3"></div>
                        <div class="col-md-3 col-sm-3"></div>
                        <div class="col-md-6 col-sm-6" style="padding: 0px;"><?= $pagination; ?></div>
                    </div>
                    <!-- Paginate -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $("#reportmenu").addClass("active");
    $(".reportmenu").css("display", "block");
    function get_paguthi(sel) {
        var paguthi_id = sel.value;
        $.ajax({
            url: "<?php echo base_url(); ?>masters/get_active_office",
            method: "POST",
            data: { paguthi_id: paguthi_id },
            dataType: "JSON",
            cache: false,
            success: function (data) {
                var stat = data.status;
                // $("#office_id").empty();
                //
                // if (stat == "success") {
                //     var res = data.res;
                //     var len = res.length;
                //     $("#office_id").html('<option value="">ALL</option>');
                //     for (i = 0; i < len; i++) {
                //         $("<option>").val(res[i].id).text(res[i].office_name).appendTo("#office_id");
                //     }
                // } else {
                //     $("#office_id").empty();
                // }
            },
        });
    }
</script>
