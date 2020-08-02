<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script>   

  $(document).ready(function() {
      $('#inputTglLahir').inputmask();

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
                  <span class="caption-subject">New Employee</span>
                </div>
                <div class="tools">
                  <a href="" class="collapse" data-original-title="" title=""></a>                  
                  <a href="" class="reload" data-original-title="" title=""></a>
                  <a href="" class="remove" data-original-title="" title=""></a>
								</div>
              </div>            
              <div class="portlet-body form" style="height:auto;">
                <form class="horizontal-form" role="form" action="<?php echo site_url('employee/employee_add');?>" method="post">
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
                          <input id="employee_id" name="employee_id" type="text" class="form-control" placeholder="Auto" readonly>                          
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputName" class="control-label">Nama Lengkap <span class="required" aria-required="true">*</span></label>                                             
                          <input id="inputName" name="employee_name" type="text" class="form-control" placeholder="Full Name">                          
                        </div>
                      </div>   
                      <div class="col-md-4">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="inputNipp" class="control-label">NIPP <span class="required" aria-required="true">*</span></label>                                               
                              <input name="employee_nip" type="text" class="form-control" placeholder="Nomor Induk Pegawai">                                                      
                            </div>
                          </div>                                                    
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="inputKtp" class="control-label">No. KTP <span class="required" aria-required="true">*</span></label>                          
                              <input name="employee_ktp" type="text" class="form-control" placeholder="Nomor KTP">                                                      
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                                             
                    <div class ="row">  
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputKtp" class="control-label">Tempat Lahir <span class="required" aria-required="true">*</span></label>
                          <input name="employee_tplahir" type="text" class="form-control" placeholder="Tempat Lahir">
                        </div>              
                      </div>   
                      <div class="col-md-4">     
                        <div class="form-group">                                                 
                          <label for="inputKtp" class="control-label">Tgl. Lahir <span class="required" aria-required="true">*</span></label>
                          <div class="input-icon right">
                            <i class="icon-user"></i>
                            <input id="inputTglLahir" name="employee_tglahir" type="text" class="form-control" data-inputmask="'alias': 'date'" placeholder="Tanggal Lahir">                            
                          </div>     
                        </div>                     
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputJK" class="control-label">Jenis Kelamin</label>                          
                          <select id="inputJK" name="employee_sex" class="select2_global form-control" data-placeholder="Pilih Status" tabindex="1">
                            <option value=""></option>
                            <option value="pria">Pria</option>
                            <option value="wanita">Wanita</option>
                          </select>
                        </div>                          
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">    
                        <div class="form-group ">
                          <label for="inputKtp" class="control-label">Alamat</label>                          
                          <textarea name="employee_alamat" class="form-control" rows="3" placeholder="Alamat Lengkap"></textarea>                         
                        </div>  
                      </div>                          
                    </div>
                    <div class="row">
                      <div class="col-md-4">    
                        <div class="form-group ">
                          <label for="inputAgama" class="control-label">Agama</label>                          
                          <select id="inputAgama" name="employee_agama" class="select2_global form-control" data-placeholder="Pilih Agama" tabindex="1">
                            <option value=""></option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen Protestan</option>
                            <option value="katolik">Kristen Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="buddha">Buddha</option>
                            <option value="konghucu">Konghucu</option>
                          </select>
                        </div>  
                      </div>    
                      <div class="col-md-4">    
                        <div class="form-group ">                         
                          <label for="inputPend" class="control-label">Pendidikan Terakhir</label>
                          <input name="employee_education" type="text" class="form-control" placeholder="SMA/ D3/ S1/ S2/ S3">
                        </div>  
                      </div>       
                      <div class="col-md-4">
                        <div class="form-group">                          
                          <label for="inputEmail" class="control-label">E-mail</label>
                          <div class="input-icon">
                            <i class="fa fa-envelope"></i>
                            <input name="employee_email" type="email" class="form-control">
                          </div>
                        </div> 
                      </div>                                    
                    </div>                    
                    <div class="row">
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputTelp" class="control-label">Telp.</label>
                          <input name="employee_telp" type="text" class="form-control">
                        </div>                          
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Status Perkawinan</label>
                          <div class="radio-list">
                            <label class="radio-inline">
                            <input type="radio" name="employee_status" id="optionsKawin1" value="single" checked> Lajang </label>
                            <label class="radio-inline">
                            <input type="radio" name="employee_status" id="optionsKawin2" value="married"> Menikah </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputAnak" class="control-label">Jumlah Anak</label>
                          <input name="employee_anak" type="text" class="form-control">
                        </div>                          
                      </div>
                    </div>                    
                    <h3 class="form-section">Status Info</h3>
                    <hr>
                    <div class="row">   
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iRegion" class="control-label">Region Kerja</label>
                          <?php echo form_dropdown('employee_region_id',$region,'','id ="iregion" class="select2_global form-control" data-placeholder="Pilih Region" style="width: 100%;"'); ?>
                        </div>                          
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iDivisi" class="control-label">Divisi</label>
                          <?php echo form_dropdown('employee_divisi_id',$divisi,'','id ="iDivisi" class="select2_global form-control" data-placeholder="Pilih Divisi" style="width: 100%;"'); ?>
                        </div>                          
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iJabatan" class="control-label">Jabatan</label>
                          <?php echo form_dropdown('employee_jabatan_id',$jabatan,'','id ="iJabatan" class="select2_global form-control" data-placeholder="Pilih Jabatan" style="width: 100%;"'); ?>
                        </div>                          
                      </div>
                    </div>
                    <div class="row">   
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iGolongan" class="control-label">Golongan</label>
                          <?php echo form_dropdown('employee_gol_id',$golongan,'','id ="iGolongan" class="select2_global form-control" data-placeholder="Pilih Golongan" style="width: 100%;"'); ?>
                        </div>                          
                      </div> 
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="iKontrak" class="control-label">Kontrak Kerja</label>
                          <select id="iKontrak" name="employee_kontrak" class="select2_global form-control" data-placeholder="Pilih Status" tabindex="1">
                            <option value=""></option>
                            <option value="permanent">Permanent</option>
                            <option value="kontrak">Kontrak</option>
                          </select>
                        </div>                          
                      </div>                                                                                    
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iShift" class="control-label">Shift Kerja</label>
                          <div class="radio-list">
                            <label class="radio-inline">
                            <input type="radio" name="employee_isshift" id="optionsShift1" value="0" checked> Non Shift </label>
                            <label class="radio-inline">
                            <input type="radio" name="employee_isshift" id="optionsShift2" value="1"> Shift </label>
                          </div>
                        </div> 
                      </div>
                    </div>
                    <div class="row">  
                     <div class="col-md-4">
                        <label for="iStart" class="control-label">Tanggal Masuk</label>                                             
                        <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                          <input id="iStart" type="text" class="form-control" name="employee_start" value="" readonly>
                          <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="iEnd" class="control-label">Tanggal Berakhir</label>                                             
                        <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                          <input id="iEnd" type="text" class="form-control" name="employee_end" value="" readonly>
                          <span class="input-group-btn">
                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                          </span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="iStatus" class="control-label">Status Kerja</label>
                          <select id="iStatus" name="employee_isactive" class="select2_global form-control" data-placeholder="Pilih Status" tabindex="1">
                            <option value=""></option>
                            <option value="0">Non Aktif</option>
                            <option value="1">Aktif</option>
                          </select>
                        </div>                          
                      </div>                       
                    </div>
                    <div class="row">  
                     <div class="col-md-4">
                        <label for="iPajak" class="control-label">Status Pajak</label>                                             
                        <select id="iStatus" name="employee_spajak" class="select2_global form-control" data-placeholder="Pilih Status" tabindex="1">
                          <option value=""></option>
                          <option value="1">TK/ 0</option>
                          <option value="2">TK/ 1</option>
                          <option value="3">TK/ 2</option>
                          <option value="4">TK/ 3</option>
                          <option value="5">K/ 0</option>
                          <option value="6">K/ 1</option>
                          <option value="7">K/ 2</option>
                          <option value="8">K/ 3</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label for="iEnd" class="control-label">No. NPWP</label>                                             
                        <input name="employee_npwp" type="text" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label for="iPajak" class="control-label">Nama Bank</label>                                             
                        <select id="iStatus" name="employee_bank" class="select2_global form-control" data-placeholder="Pilih Bank" tabindex="1">
                          <option value=""></option>
                          <option value="0">Bank DKI</option>
                          <option value="1">Bank Jabar</option>
                          <option value="2">Bank Mandiri</option>
                          <option value="3">Bank BNI</option>
                          <option value="4">Bank BRI</option>
                          <option value="5">Bank BCA</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label for="iRekening" class="control-label">No. Rekening</label>                                             
                        <input id="iRekening" type="text" class="form-control" name="employee_rek">
                      </div>
                    </div>
                  </div>
                  <div class="form-actions">                    
                    <button type="submit" class="btn green">Submit</button>
                    <a href="<?php echo site_url('employee'); ?>" class="btn default">Cancel</a>
                  </div>
							  </form>
              </div>
            </div>          
          <!-- End: TABLE PORTLET -->          
        </div>
      </div>
      <!-- END PAGE CONTENT-->       