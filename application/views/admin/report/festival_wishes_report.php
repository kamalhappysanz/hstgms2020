<?php $search_value = $this->session->userdata('search'); ?>

<div class="right_col" role="main">
    <div class="">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Festival wishes Report</h2>
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
                    <form method="post" action="<?= base_url() ?>report/festival_wishes_report" id="report_form">
                        <div class="col-md-12 col-sm-12" style="padding: 0px;">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2 col-sm-2">Select year <span class="required">*</span></label>
                                <div class="col-md-2 col-sm-4">
                                    <select class="form-control" name="f_year_id" id="year_id">
                                        <option value="">Select year</option>
                                        <?php foreach($res_year as $rows_year){ ?>
                                        <option value="<?php echo $rows_year->year_name; ?>"><?php echo $rows_year->year_name; ?></option>
                                        <?php  } ?>
                                    </select>

                                    <script>
                                        $("#year_id").val("<?php echo $f_year_id; ?>");
                                    </script>
                                </div>
                                <label class="col-form-label col-md-2 col-sm-2">Select festival <span class="required">*</span></label>
                                <div class="col-md-2 col-sm-4">
                                    <select class="form-control" name="f_religion_id" id="religion_id">
                                        <option value="">Select festival</option>
                                        <?php foreach($res_festival as $rows_festival){ ?>
                                        <option value="<?php echo $rows_festival->id; ?>"><?php echo $rows_festival->festival_name; ?></option>
                                        <?php  } ?>
                                    </select>
                                    <script>
                                        $("#religion_id").val("<?php echo $f_religion_id; ?>");
                                    </script>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2 col-sm-2">paguthi</label>
                                <div class="col-md-2 col-sm-4">
                                    <select class="form-control" name="f_paguthi" id="paguthi" onchange="get_paguthi(this);">
                                        <option value="">ALL</option>
                                        <?php foreach($paguthi as $rows){ ?>
                                        <option value="<?php echo $rows->id;?>"><?php echo $rows->paguthi_name;?></option>
                                        <?php } ?>
                                    </select>
                                    <script>
                                        $("#paguthi").val("<?php echo $f_paguthi; ?>");
                                    </script>
                                </div>
                                <label class="col-form-label col-md-2 col-sm-2">office</label>
                                <div class="col-md-2 col-sm-4">
                                    <select class="form-control" name="f_ward_id" id="office_id">
                                      <?php  $query="SELECT * FROM office WHERE status='ACTIVE' and paguthi_id='$f_paguthi' order by id desc";
                                       $result_of=$this->db->query($query);
                                       if($result_of->num_rows()==0){ ?>
                                       <option value=""></option>
                                       <?php 	}else{
                                       $res_office=$result_of->result();
                                       foreach($res_office as $rows_office){ ?>
                                         <option value="<?php echo $rows_office->id; ?>"><?php echo $rows_office->office_name; ?></option>
                                       <?php   }		}    ?>
                                    </select>
                                    <script>
                                        $("#office_id").val("<?php echo $f_ward_id; ?>");
                                    </script>
                                </div>
                                <div class="col-md-3 col-sm-2">
                                    <input type="submit" name="submit" class="btn btn-success" value="SEARCH" />
                                    <a href="<?php echo base_url(); ?>report/reset_search" class="btn btn-danger">clear</a>
                                    <a href="<?php echo base_url(); ?>report/get_festival_report_export" class="btn btn-export">Export</a>
                                </div>
                            </div>
                        </div>

                    </form>
                      <div class="ln_solid"></div>
                    <div class="col-md-12 col-sm-12" style="overflow-x: scroll;">
                        <div class="">
                            <div class="col-md-12 col-sm-12" style="padding: 0px;">
                                <div class="col-md-3 col-sm-3">
                                    <h2>Search Result</h2>
                                    Total records
                                    <?php echo $allcount; ?>
                                </div>
                                <div class="col-md-3 col-sm-3"></div>
                                <div class="col-md-6 col-sm-6" style="padding: 0px;"><?= $pagination; ?></div>
                            </div>
                            <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Festival name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Sent on</th>
                                </tr>
                                <?php
			$sno = $row+1;
			foreach($result as $data){ ?>
                                <tr>
                                    <td><?php echo $sno; ?></td>
                                    <td><?php echo $data['full_name']; ?></td>
                                    <td><?php echo $data['festival_name']; ?></td>
                                    <td><?php echo $data['mobile_no']; ?></td>
                                    <td><?php echo $data['address']; ?></td>
                                    <td><?php echo date("d-m-Y H:i", strtotime($data['sent_on'])); ?></td>
                                </tr>
                                <?php $sno++;	} ?>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12" style="padding: 0px;">
                        <div class="col-md-3 col-sm-3"></div>
                        <div class="col-md-3 col-sm-3"></div>
                        <?php if(!empty($result)){ ?>
                        <div class="col-md-6 col-sm-6" style="padding: 0px;"><?= $pagination; ?></div>
                        <?php	} ?>
                    </div>
                    <!-- Paginate -->
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
                $("#office_id").empty();

                if (stat == "success") {
                    var res = data.res;
                    var len = res.length;
                    $("#office_id").html('<option value="">ALL</option>');
                    for (i = 0; i < len; i++) {
                        $("<option>").val(res[i].id).text(res[i].office_name).appendTo("#office_id");
                    }
                } else {
                    $("#office_id").empty();
                }
            },
        });
    }
    $("#report_form").validate({
        // initialize the plugin
        rules: {
            f_year_id: { required: true },
            f_religion_id: { required: true },
        },
        messages: {
            f_year_id: { required: "Select From year" },
            f_religion_id: { required: "Select Festival" },
        },
    });
</script>
