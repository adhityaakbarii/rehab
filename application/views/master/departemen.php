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
				$row  = $dt_departemen->row();              
				$read = "readonly";
				$read2 = "disabled";
				$vis  = "style='display:none;'";
				$form = "save";              
				$form_id = "";
			}elseif($mode == 'edit'){
				$row  = $dt_departemen->row();
				$read = "";
				$read2 = "";
				$form = "update";              
				$vis  = "";
				$form_id = "<input type='hidden' name='id' value='$row->id_departemen'>";              
			}
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<a href="master/departemen" class="btn btn-warning"><i class="fa fa-eye"></i> View</a>
						</div>
						<form class="form-horizontal" action="master/departemen/<?php echo $form ?>" method="POST" enctype="multipart/form-data">
							<div class="card-body">								
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Departemen</label>
									<div class="col-sm-4">
										<?php echo $form_id ?>
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->departemen : "" ; ?>" name="departemen" class="form-control" placeholder="Departemen">
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
							<a href="master/departemen/add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
						</div>
						<div class="card-body">
							<!-- <h5 class="card-title">Basic Datatable</h5> -->
							<div class="table-responsive">
								<table id="zero_config" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th>ID Departemen</th>
											<th>Departemen</th>
											<th>Keterangan</th>
											<th width="10%">Aksi</th>											
										</tr>
									</thead>
									<tbody>
										<?php 
										$no=1;
										foreach ($dt_departemen->result() as $row) {
											echo "
											<tr>
											<td>$no</td>
											<td><a href='master/departemen/detail?id=$row->id_departemen'>$row->id_departemen</a></td>
											<td>$row->departemen</td>
											<td>$row->keterangan</td>
											<td>"; ?>
											<a class='btn btn-info btn-sm' href='master/departemen/edit?id=<?php echo $row->id_departemen ?>'><i class='fa fa-edit'></i></a>
											<a class='btn btn-danger btn-sm' onclick="return confirm('Anda yakin?')" href='master/departemen/delete?id=<?php echo $row->id_departemen ?>'><i class='fa fa-trash'></i></a>
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