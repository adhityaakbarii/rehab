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
				$row  = $dt_jabatan->row();              
				$read = "readonly";
				$read2 = "disabled";
				$vis  = "style='display:none;'";
				$form = "save";              
				$form_id = "";
			}elseif($mode == 'edit'){
				$row  = $dt_jabatan->row();
				$read = "";
				$read2 = "";
				$form = "update";              
				$vis  = "";
				$form_id = "<input type='hidden' name='id' value='$row->id_jabatan'>";              
			}
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<a href="master/jabatan" class="btn btn-warning"><i class="fa fa-eye"></i> View</a>
						</div>
						<form class="form-horizontal" action="master/jabatan/<?php echo $form ?>" method="POST" enctype="multipart/form-data">
							<div class="card-body">								
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jabatan</label>
									<div class="col-sm-4">
										<?php echo $form_id ?>
										<input type="text" autocomplete="off" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->jabatan : "" ; ?>" name="jabatan" class="form-control" placeholder="Jabatan">
									</div>									
								
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Bertanggung Jawab Kepada</label>
									<div class="col-sm-4">
										<select name="tanggung_jawab" class="form-control" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>
											<?php                           
											foreach ($dt_tanggung_jawab->result() as $isi) {
												$tanggung_jawab = ($row!='') ? $row->tanggung_jawab : "";
												if($tanggung_jawab!='' && $tanggung_jawab==$isi->id_jabatan) $se = "selected";
												else $se="";												
												echo "<option $se value='$isi->id_jabatan'>$isi->jabatan</option>";
											}
											?>
										</select>
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
							<a href="master/jabatan/add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
						</div>
						<div class="card-body">
							<!-- <h5 class="card-title">Basic Datatable</h5> -->
							<div class="table-responsive">
								<table id="zero_config" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th>ID Jabatan</th>
											<th>Jabatan</th>
											<th>Bertanggung Jawab Kepada</th>											
											<th>Keterangan</th>
											<th width="10%">Aksi</th>											
										</tr>
									</thead>
									<tbody>
										<?php 
										$no=1;
										foreach ($dt_jabatan->result() as $row) {
											$tanggung_jawab = "";
											if($row->tanggung_jawab!=""){
												$cek = $this->m_admin->getByID("rh_jabatan","id_jabatan",$row->tanggung_jawab);
												$tanggung_jawab = ($cek->num_rows() > 0) ? $cek->row()->jabatan : "" ;											
											}

											echo "
											<tr>
											<td>$no</td>
											<td><a href='master/jabatan/detail?id=$row->id_jabatan'>$row->id_jabatan</a></td>
											<td>$row->jabatan</td>
											<td>$tanggung_jawab</td>											
											<td>$row->keterangan</td>
											<td>"; ?>
											<a class='btn btn-info btn-sm' href='master/jabatan/edit?id=<?php echo $row->id_jabatan ?>'><i class='fa fa-edit'></i></a>
											<a class='btn btn-danger btn-sm' onclick="return confirm('Anda yakin?')" href='master/jabatan/delete?id=<?php echo $row->id_jabatan ?>'><i class='fa fa-trash'></i></a>
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