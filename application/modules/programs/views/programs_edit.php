<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
<script>   

  $(document).ready(function() {

      $('.select2_global').select2({ allowClear: true });
      $('.date-picker').datepicker({ autoclose: true });
       
  });

</script>

<style>
textarea {
  resize: vertical;
}
</style>

      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
        <div class="col-md-12 col-sm-12">

          <!-- Begin: TABLE PORTLET -->                
            <div class="portlet box green">
              <div class="portlet-title">
                <div class="caption">
                  <i class="icon-settings"></i>
                  <span class="caption-subject">Edit Employee</span>
                </div>
                <div class="tools">
                  <a href="" class="collapse" data-original-title="" title=""></a>                  
                  <a href="" class="reload" data-original-title="" title=""></a>
                  <a href="" class="remove" data-original-title="" title=""></a>
								</div>
              </div>            
              <div class="portlet-body form" style="height:auto;">
                <form class="horizontal-form" role="form" action="<?php echo site_url('employee/employee_modify');?>" method="post">
                  <?php if ( isset($result) ) 
                        {
                            foreach ($result as $row) 
                            {
                  ?>
                  <div class="form-body">
                    <h3 class="form-section">Personal Info</h3>
                    <hr>
                    <div class ="row">
                      <div class="col-md-4">  
                        <div class="form-group">                      
                          <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 150px; height: 100px;">
                              <img src="<?php echo base_url('assets/images/no_image.png') ?>" alt="" style="display:block">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 100px;"></div>                            
                            <div>
                              <span class="btn default btn-file">
                                <span class="fileinput-new">Select image </span>
                                <span class="fileinput-exists">Change </span>
                                <input type="file">
                              </span>
                              <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput">Remove </a>
                            </div>
                          </div>                      
                        </div>   
                      </div>  
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputId" class="control-label">ID</label>                                              
                          <input id="employee_id" name="employee_id" type="text" class="form-control" placeholder="Auto" value="<?php echo $row->employee_id; ?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputName" class="control-label">Nama Lengkap <span class="required" aria-required="true">*</span></label>                                             
                          <input id="inputName" name="employee_name" type="text" class="form-control" placeholder="Full Name" value="<?php echo $row->employee_name; ?>"> 
                        </div>
                      </div>   
                      <div class="col-md-4">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="inputNipp" class="control-label">NIPP <span class="required" aria-required="true">*</span></label>                                               
                              <input name="employee_nip" type="text" class="form-control" placeholder="Nomor Induk Pegawai" value="<?php echo $row->employee_nip; ?>">
                            </div>
                          </div>                                                    
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="inputKtp" class="control-label">No. KTP <span class="required" aria-required="true">*</span></label>                          
                              <input name="employee_ktp" type="text" class="form-control" placeholder="Nomor KTP" value="<?php echo $row->employee_ktp; ?>">                                                      
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                                             
                    <div class ="row">  
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputKtp" class="control-label">Tempat Lahir <span class="required" aria-required="true">*</span></label>
                          <input id='employee' name="employee_tplahir" type="text" class="form-control" placeholder="Tempat Lahir" value="<?php echo $row->employee_tplahir; ?>">
                        </div>              
                      </div>   
                      <div class="col-md-4">     
                        <div class="form-group">                                                 
                          <label for="inputKtp" class="control-label">Tgl. Lahir <span class="required" aria-required="true">*</span></label>
                          <div class="input-icon right">
                            <i class="icon-user"></i>
                            <input id="inputTglLahir" name="employee_tglahir" type="text" class="form-control" data-inputmask="'alias': 'date'" 
                              placeholder="Tanggal Lahir" value="<?php $tglahir = strtotime($row->employee_tglahir); echo date('d/m/Y', $tglahir); ?>">
                          </div>     
                        </div>                     
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputJK" class="control-label">Jenis Kelamin</label>
                          <?php echo form_dropdown('employee_sex',$sex,$row->employee_sex,'id ="inputJK" class="select2_global form-control" data-placeholder="Pilih Status" style="width: 100%;"'); ?>
                        </div>                          
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">    
                        <div class="form-group ">
                          <label for="inputKtp" class="control-label">Alamat</label>                          
                          <textarea name="employee_alamat" class="form-control" rows="3" placeholder="Alamat Lengkap"><?php echo $row->employee_alamat; ?></textarea>
                        </div>  
                      </div>                          
                    </div>
                    <div class="row">
                      <div class="col-md-4">    
                        <div class="form-group ">
                          <label for="inputAgama" class="control-label">Agama</label>                          
                          <?php echo form_dropdown('employee_agama',$agama,$row->employee_agama,'id ="inputAgama" class="select2_global form-control" data-placeholder="Pilih Agama" style="width: 100%;"'); ?>
                        </div>  
                      </div>    
                      <div class="col-md-4">    
                        <div class="form-group ">                         
                          <label for="inputPend" class="control-label">Pendidikan Terakhir</label>
                          <input name="employee_education" type="text" class="form-control" placeholder="SMA/ D3/ S1/ S2/ S3" value="<?php echo $row->employee_education; ?>">
                        </div>  
                      </div>       
                      <div class="col-md-4">
                        <div class="form-group">                          
                          <label for="inputEmail" class="control-label">E-mail</label>
                          <div class="input-icon">
                            <i class="fa fa-envelope"></i>
                            <input name="employee_email" type="email" class="form-control" value="<?php echo $row->employee_email; ?>">
                          </div>
                        </div> 
                      </div>                                    
                    </div>                    
                    <div class="row">
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputTelp" class="control-label">Telp.</label>
                          <input name="employee_telp" type="text" class="form-control" value="<?php echo $row->employee_telp; ?>">
                        </div>                          
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Status Perkawinan</label>                                              
                          <div class="radio-list">
                            <label class="radio-inline">
                            <input type="radio" name="employee_status" value="single" <?php echo $row->employee_status === 'single' ? 'checked' : ''; ?> > Lajang </label>
                            <label class="radio-inline">
                            <input type="radio" name="employee_status" value="married" <?php echo $row->employee_status === 'married' ? 'checked' : ''; ?>> Menikah </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputAnak" class="control-label">Jumlah Anak</label>
                          <input name="employee_anak" type="text" class="form-control" value="<?php echo $row->employee_anak; ?>">
                        </div>                          
                      </div>
                    </div>                    
                    <h3 class="form-section">Status Info</h3>
                    <hr>
                    <div class="row">   
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iRegion" class="control-label">Region Kerja</label>
                          <?php echo form_dropdown('employee_region_id',$region, $row->employee_region_id,'id ="iregion" class="select2_global form-control" data-placeholder="Pilih Region" style="width: 100%;"'); ?>
                        </div>                          
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iDivisi" class="control-label">Divisi</label>
                          <?php echo form_dropdown('employee_divisi_id',$divisi, $row->employee_divisi_id,'id ="iDivisi" class="select2_global form-control" data-placeholder="Pilih Divisi" style="width: 100%;"'); ?>
                        </div>                          
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iJabatan" class="control-label">Jabatan</label>
                          <?php echo form_dropdown('employee_jabatan_id',$jabatan, $row->employee_jabatan_id,'id ="iJabatan" class="select2_global form-control" data-placeholder="Pilih Jabatan" style="width: 100%;"'); ?>
                        </div>                          
                      </div>
                    </div>
                    <div class="row">   
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iGolongan" class="control-label">Golongan</label>
                          <?php echo form_dropdown('employee_gol_id',$golongan, $row->employee_gol_id,'id ="iGolongan" class="select2_global form-control" data-placeholder="Pilih Golongan" style="width: 100%;"'); ?>
                        </div>                          
                      </div> 
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="iKontrak" class="control-label">Kontrak Kerja</label>                          
                          <?php echo form_dropdown('employee_kontrak', array('' => '', 'permanent' => 'Permanent', 'kontrak' => 'Kontrak'), $row->employee_kontrak, 'id ="iKontrak" class="select2_global form-control" data-placeholder="Pilih Kontrak" style="width: 100%;"'); ?>
                        </div>                          
                      </div>                                                                                    
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iShift" class="control-label">Shift Kerja</label>
                          <div class="radio-list">
                            <label class="radio-inline">
                            <input type="radio" name="employee_isshift" value="0" <?php echo (!$row->employee_isshift) ? 'checked' : ''; ?> > Non Shift </label>
                            <label class="radio-inline">
                            <input type="radio" name="employee_isshift" value="1" <?php echo ($row->employee_isshift) ? 'checked' : ''; ?> > Shift </label>
                          </div>
                        </div> 
                      </div>
                    </div>
                    <div class="row">  
                     <div class="col-md-4">
                        <label for="iStart" class="control-label">Tanggal Masuk</label>                                             
                        <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                          <input id="iStart" type="text" class="form-control" name="employee_start" value="<?php echo $row->employee_start; ?>" readonly>
                          <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="iEnd" class="control-label">Tanggal Berakhir</label>                                             
                        <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                          <input id="iEnd" type="text" class="form-control" name="employee_end" value="<?php echo $row->employee_end; ?>" readonly>
                          <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iStatus" class="control-label">Status Kerja</label>                          
                          <?php echo form_dropdown('employee_isactive', array('' => '', '0' => 'Non Aktif', '1' => 'Aktif'), $row->employee_isactive, 'id ="iStatus" class="select2_global form-control" data-placeholder="Pilih Status" style="width: 100%;"'); ?>
                        </div>                          
                      </div>                       
                    </div>
                    <div class="row">  
                     <div class="col-md-4">
                        <label for="iPajak" class="control-label">Status Pajak</label>                                             
                        <?php echo form_dropdown('employee_spajak', $spajak, $row->employee_spajak, 'id ="iPajak" class="select2_global form-control" data-placeholder="Pilih Status" style="width: 100%;"'); ?>
                      </div>
                      <div class="col-md-4">
                        <label for="iEnd" class="control-label">No. NPWP</label>                                             
                        <input name="employee_npwp" type="text" class="form-control" value="<?php echo $row->employee_npwp; ?>">
                      </div>
                      <div class="col-md-4">
                        <label for="iBank" class="control-label">Nama Bank</label>                                             
                        <?php echo form_dropdown('employee_bank', $bank, $row->employee_bank, 'id ="iBank" class="select2_global form-control" data-placeholder="Pilih Bank" style="width: 100%;"'); ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label for="iRekening" class="control-label">No. Rekening</label>                                             
                        <input id="iRekening" type="text" class="form-control" name="employee_rek" value="<?php echo $row->employee_rek; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-actions">                    
                    <button type="submit" class="btn green">Submit</button>
                    <a href="<?php echo site_url('employee'); ?>" class="btn default">Cancel</a>
                  </div>
                  <?php }} ?>
							  </form>
              </div>
            </div>          
          <!-- End: TABLE PORTLET -->          
        </div>
      </div>
      <!-- END PAGE CONTENT-->       