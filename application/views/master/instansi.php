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
				$row  = $dt_instansi->row();              
				$read = "readonly";
				$read2 = "disabled";
				$vis  = "style='display:none;'";
				$form = "save";              
				$form_id = "";
			}elseif($mode == 'edit'){
				$row  = $dt_instansi->row();
				$read = "";
				$read2 = "";
				$form = "update";              
				$vis  = "";
				$form_id = "<input type='hidden' name='id' value='$row->id_instansi'>";              
			}
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<a href="master/instansi" class="btn btn-warning"><i class="fa fa-eye"></i> View</a>
						</div>
						<form class="form-horizontal" action="master/instansi/<?php echo $form ?>" method="POST" enctype="multipart/form-data">
							<div class="card-body">								
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Instansi</label>
									<div class="col-sm-10">
										<?php echo $form_id ?>
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->instansi : "" ; ?>" name="instansi" class="form-control" placeholder="Instansi">
									</div>									
								</div>	
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">PIC</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->pic : "" ; ?>" name="pic" class="form-control" placeholder="PIC">
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">No Telp</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->telp : "" ; ?>" name="telp" class="form-control" placeholder="No Telp">
									</div>									
								</div>	
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">GPS</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->gps : "" ; ?>" name="gps" class="form-control" placeholder="GPS">
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Email</label>
									<div class="col-sm-4">										
										<input type="email" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->email : "" ; ?>" name="email" class="form-control" placeholder="Email">
									</div>									
								</div>								
								<div class="form-group row">
									<label for="cono1" class="col-sm-2 text-right control-label col-form-label">Alamat</label>
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
								<div class="form-group row">									
									<label for="cono1" class="col-sm-2 text-right control-label col-form-label"></label>
									<div class="col-sm-10">										
										<div class="custom-control custom-checkbox mr-sm-2">
											<?php 
											$st="";
											if($row!=''){
												if($row->active == 1){
													$st = 'checked';
												}
											} 
											?>
											<input type="checkbox" value="1" <?php echo $read.$st ?> name="active"  class="custom-control-input" id="customControlAutosizing1">
											<label class="custom-control-label" for="customControlAutosizing1">Aktif</label>
										</div>										
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
							<a href="master/instansi/add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
						</div>
						<div class="card-body">
							<!-- <h5 class="card-title">Basic Datatable</h5> -->
							<div class="table-responsive">
								<table id="zero_config" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th>ID Instansi</th>
											<th>Instansi</th>
											<th>PIC</th>
											<th>Telp</th>
											<th>Email</th>
											<th>Alamat</th>
											<th>Keterangan</th>
											<th width="10%">Aksi</th>											
										</tr>
									</thead>
									<tbody>
										<?php 
										$no=1;
										foreach ($dt_instansi->result() as $row) {
											echo "
											<tr>
											<td>$no</td>
											<td><a href='master/instansi/detail?id=$row->id_instansi'>$row->id_instansi</a></td>
											<td>$row->instansi</td>
											<td>$row->pic</td>
											<td>$row->telp</td>
											<td>$row->email</td>
											<td>$row->alamat</td>
											<td>$row->keterangan</td>
											<td>"; ?>
											<a class='btn btn-info btn-sm' href='master/instansi/edit?id=<?php echo $row->id_instansi ?>'><i class='fa fa-edit'></i></a>
											<a class='btn btn-danger btn-sm' onclick="return confirm('Anda yakin?')" href='master/instansi/delete?id=<?php echo $row->id_instansi ?>'><i class='fa fa-trash'></i></a>
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