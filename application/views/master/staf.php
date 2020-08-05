<div class="page-wrapper">		
	<div class="page-breadcrumb">
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title"><?php echo $title ?></h4>
				<div class="ml-auto text-right">
					<nav aria-label="breadcrumb">
						<?php echo $bread ?>
					</nav>
				</div>
			</div>
		</div>
	</div>    
	<div class="container-fluid">
		<?php                       
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {                    
			?>                  
			<div class="alert alert-<?php echo $_SESSION['tipe'] ?> alert-dismissable">
				<strong><?php echo $_SESSION['pesan'] ?></strong>                    
			</div>
			<?php
		}
		$_SESSION['pesan'] = '';                        

		?>

		<?php 
		if($set=="insert"){
			if($mode == 'insert'){
				$read = "";
				$read2 = "";
				$form = "save";
				$vis  = "";
				$form_id = "";
				$row = "";
			}elseif($mode == 'detail'){
				$row  = $dt_staf->row();              
				$read = "readonly";
				$read2 = "disabled";
				$vis  = "style='display:none;'";
				$form = "save";              
				$form_id = "";
			}elseif($mode == 'edit'){
				$row  = $dt_staf->row();
				$read = "";
				$read2 = "";
				$form = "update";              
				$vis  = "";
				$form_id = "<input type='hidden' name='id' value='$row->id_staf'>";              
			}
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<a href="master/staf" class="btn btn-warning"><i class="fa fa-eye"></i> View</a>
						</div>
						<form class="form-horizontal" action="master/staf/<?php echo $form ?>" method="POST" enctype="multipart/form-data">
							<div class="card-body">								
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">NIK</label>
									<div class="col-sm-4">
										<?php echo $form_id ?>
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nik : "" ; ?>" name="nik" class="form-control" placeholder="NIK">
									</div>																		
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Nama Staf</label>
									<div class="col-sm-10">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_lengkap : "" ; ?>" name="nama_lengkap" class="form-control" placeholder="Nama Staf">
									</div>									
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jabatan</label>
									<div class="col-sm-4">
										<select name="id_jabatan" class="form-control" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>
											<?php                           
											foreach ($dt_jabatan->result() as $isi) {
												$id_jabatan = ($row!='') ? $row->id_jabatan : "";
												if($id_jabatan!='' && $id_jabatan==$isi->id_jabatan) $se = "selected";
													else $se="";												
												echo "<option $se value='$isi->id_jabatan'>$isi->jabatan</option>";
											}
											?>
										</select>
									</div>
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Departemen</label>
									<div class="col-sm-4">
										<select name="id_departemen" class="form-control" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>
											<?php                           
											foreach ($dt_departemen->result() as $isi) {
												$id_departemen = ($row!='') ? $row->id_departemen : "";
												if($id_departemen!='' && $id_departemen==$isi->id_departemen) $se = "selected";
													else $se="";												
												echo "<option $se value='$isi->id_departemen'>$isi->departemen</option>";
											}
											?>
										</select>
									</div>									
								</div>								
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Instansi</label>
									<div class="col-sm-4">
										<select name="id_instansi" class="form-control" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>
											<?php                           
											foreach ($dt_instansi->result() as $isi) {
												$id_instansi = ($row!='') ? $row->id_instansi : "";
												if($id_instansi!='' && $id_instansi==$isi->id_instansi) $se = "selected";
													else $se="";												
												echo "<option $se value='$isi->id_instansi'>$isi->instansi</option>";
											}
											?>
										</select>
									</div>																										
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Pendidikan Terakhir</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->pendidikan : "" ; ?>" name="pendidikan" class="form-control" placeholder="Pendidikan Terakhir">
									</div>
								</div>								
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Provinsi</label>
									<div class="col-sm-4">
										<select name="id_provinsi" id="id_provinsi" onchange="ambil_kab()" class="select2 form-control custom-select" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>
											<?php                           
											foreach ($dt_provinsi->result() as $isi) {
												$id_provinsi = ($row!='') ? $row->id_provinsi : "";
												if($id_provinsi!='' && $id_provinsi==$isi->id_provinsi) $se = "selected";
													else $se="";												
												echo "<option $se value='$isi->id_provinsi'>$isi->provinsi</option>";
											}
											?>
										</select>
									</div>																		
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Kabupaten</label>
									<div class="col-sm-4">										
										<select name="id_kabupaten" id="id_kabupaten" onchange="ambil_kec()" class="select2 form-control custom-select" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>
											<?php                           
											foreach ($dt_kabupaten->result() as $isi) {
												$id_kabupaten = ($row!='') ? $row->id_kabupaten : "";
												if($id_kabupaten!='' && $id_kabupaten==$isi->id_kabupaten) $se = "selected";
													else $se="";												
												echo "<option $se value='$isi->id_kabupaten'>$isi->kabupaten</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Kecamatan</label>
									<div class="col-sm-4">
										<select name="id_kecamatan" id="id_kecamatan" onchange="ambil_kel()" class="select2 form-control custom-select" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>
											<?php                           
											foreach ($dt_provinsi->result() as $isi) {
												$id_kecamatan = ($row!='') ? $row->id_kecamatan : "";
												if($id_kecamatan!='' && $id_kecamatan==$isi->id_kecamatan) $se = "selected";
													else $se="";												
												echo "<option $se value='$isi->id_kecamatan'>$isi->kecamatan</option>";
											}
											?>
										</select>
									</div>																		
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Kelurahan</label>
									<div class="col-sm-4">										
										<select name="id_kelurahan" id="id_kelurahan" class="select2 form-control custom-select" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>
											<?php                           
											foreach ($dt_kabupaten->result() as $isi) {
												$id_kelurahan = ($row!='') ? $row->id_kelurahan : "";
												if($id_kelurahan!='' && $id_kelurahan==$isi->id_kelurahan) $se = "selected";
													else $se="";												
												echo "<option $se value='$isi->id_kelurahan'>$isi->kelurahan</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="cono1" class="col-sm-2 text-right control-label col-form-label">Alamat Lengkap</label>
									<div class="col-sm-10">
										<textarea name="alamat" <?php echo $read ?> class="form-control"><?php echo $tampil = ($row!='') ? $row->alamat : "" ; ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="cono1" class="col-sm-2 text-right control-label col-form-label">Keterangan</label>
									<div class="col-sm-10">
										<textarea name="keterangan" <?php echo $read ?> class="form-control"><?php echo $tampil = ($row!='') ? $row->keterangan : "" ; ?></textarea>
									</div>
								</div>
							</div>
							<div class="border-top" <?php echo $vis ?>>
								<div class="card-body">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
									<button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i> Batal</button>
								</div>
							</div>
						</form>
					</div>
				</div>				
			</div>

			<?php 
		}elseif($set=='view'){
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<a href="master/staf/add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
						</div>
						<div class="card-body">
							<!-- <h5 class="card-title">Basic Datatable</h5> -->
							<div class="table-responsive">
								<table id="zero_config" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th>NIK</th>
											<th>Nama Staf</th>
											<th>Instansi</th>
											<th>Jabatan</th>
											<th>Departemen</th>											
											<th>Keterangan</th>
											<th width="10%">Aksi</th>											
										</tr>
									</thead>
									<tbody>
										<?php 
										$no=1;
										foreach ($dt_staf->result() as $row) {
											echo "
											<tr>
											<td>$no</td>
											<td><a href='master/staf/detail?id=$row->id_staf'>$row->nik</a></td>
											<td>$row->nama_lengkap</td>
											<td>$row->instansi</td>
											<td>$row->jabatan</td>
											<td>$row->departemen</td>											
											<td>$row->keterangan</td>
											<td>"; ?>
											<a class='btn btn-info btn-sm' href='master/staf/edit?id=<?php echo $row->id_staf ?>'><i class='fa fa-edit'></i></a>
											<a class='btn btn-danger btn-sm' onclick="return confirm('Anda yakin?')" href='master/staf/delete?id=<?php echo $row->id_staf ?>'><i class='fa fa-trash'></i></a>
										</td>
									</tr>
									<?php
									$no++;
								}
								?>
							</tbody>									
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php 
} 
?>
</div>
</div>

<script type="text/javascript">
function ambil_kab(){  
  var id_provinsi  = $("#id_provinsi").val();   
  $.ajax({
    url : "<?php echo site_url('master/staf/ambil_kab')?>",
    type:"POST",
    data:"id_provinsi="+id_provinsi,
    cache:false,   
    success:function(msg){            
      $("#id_kabupaten").html(msg);                
    }
  })   
}
function ambil_kec(){  
  var id_kabupaten  = $("#id_kabupaten").val();   
  $.ajax({
    url : "<?php echo site_url('master/staf/ambil_kec')?>",
    type:"POST",
    data:"id_kabupaten="+id_kabupaten,
    cache:false,   
    success:function(msg){            
      $("#id_kecamatan").html(msg);                
    }
  })   
}
function ambil_kel(){  
  var id_kecamatan  = $("#id_kecamatan").val();   
  $.ajax({
    url : "<?php echo site_url('master/staf/ambil_kel')?>",
    type:"POST",
    data:"id_kecamatan="+id_kecamatan,
    cache:false,   
    success:function(msg){            
      $("#id_kelurahan").html(msg);                
    }
  })   
}
</script>