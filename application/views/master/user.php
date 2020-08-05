<?php if(isset($_GET['id'])) echo "<body onload='cek_instansi()'"; ?>
<body>
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
				$row  = $dt_user->row();              
				$read = "readonly";
				$read2 = "disabled";
				$vis  = "style='display:none;'";
				$form = "save";              
				$form_id = "";
			}elseif($mode == 'edit'){
				$row  = $dt_user->row();
				$read = "";
				$read2 = "";
				$form = "update";              
				$vis  = "";
				$form_id = "<input type='hidden' name='id' value='$row->id_user'>";              
			}
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<a href="master/user" class="btn btn-warning"><i class="fa fa-eye"></i> View</a>
						</div>
						<form class="form-horizontal" action="master/user/<?php echo $form ?>" method="POST" enctype="multipart/form-data">
							<div class="card-body">								
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Username</label>
									<div class="col-sm-4">
										<?php echo $form_id ?>
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->username : "" ; ?>" name="username" class="form-control" placeholder="Username">
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Password</label>
									<div class="col-sm-4">										
										<input type="password" <?php echo $read ?> name="password" class="form-control" placeholder="Password">
									</div>									
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">ID Karyawan</label>
									<div class="col-sm-4">
										<select name="id_staf" id="id_staf" onchange="cek_instansi()" class="form-control" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>
											<?php                           
											foreach ($dt_staf->result() as $isi) {
												$id_staf = ($row!='') ? $row->id_staf : "";
												if($id_staf!='' && $id_staf==$isi->id_staf) $se = "selected";
												else $se="";												
												echo "<option $se value='$isi->id_staf'>$isi->nik | $isi->nama_lengkap</option>";
											}
											?>
										</select>
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Cabang</label>
									<div class="col-sm-4">
										<input type="text" disabled name="instansi" id="instansi" class="form-control" placeholder="Cabang">
									</div>									
								</div>								
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Departemen</label>
									<div class="col-sm-4">
										<input type="text" disabled name="departemen" id="departemen" class="form-control" placeholder="Departemen">
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jabatan</label>
									<div class="col-sm-4">
										<input type="text" disabled name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan">
									</div>									
								</div>
								<div class="form-group row">
									<label for="cono1" class="col-sm-2 text-right control-label col-form-label">Status</label>
									<div class="col-sm-4">
										<select name="status" class="form-control" <?php echo $read2 ?>>
											<option <?php if($row!='' AND $row->status==1) echo "selected" ?> value="1">Active</option>
											<option <?php if($row!='' AND $row->status==0) echo "selected" ?> value="0">Inactive</option>
										</select>
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
							<a href="master/user/add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
						</div>
						<div class="card-body">
							<!-- <h5 class="card-title">Basic Datatable</h5> -->
							<div class="table-responsive">
								<table id="zero_config" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th>ID User</th>											
											<th>Nama User</th>
											<th>Username</th>
											<th>Instansi</th>
											<th>Jabatan</th>
											<th>Departemen</th>
											<th>Status</th>
											<th width="10%">Aksi</th>											
										</tr>
									</thead>
									<tbody>
										<?php 
										$no=1;
										foreach ($dt_user->result() as $row) {
											echo "
											<tr>
											<td>$no</td>
											<td><a href='master/user/detail?id=$row->id_user'>$row->id_user</a></td>
											<td>$row->nama_lengkap</td>
											<td>$row->username</td>
											<td>$row->instansi</td>
											<td>$row->jabatan</td>
											<td>$row->departemen</td>
											<td>$row->status</td>
											<td>"; ?>
											<a class='btn btn-info btn-sm' href='master/user/edit?id=<?php echo $row->id_user ?>'><i class='fa fa-edit'></i></a>
											<a class='btn btn-danger btn-sm' onclick="return confirm('Anda yakin?')" href='master/user/delete?id=<?php echo $row->id_user ?>'><i class='fa fa-trash'></i></a>
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
	function cek_instansi(){  
		var id_staf  = $("#id_staf").val();   		
		$.ajax({
			url : "<?php echo site_url('master/user/ambil_staf')?>",
			type:"POST",
			data:"id_staf="+id_staf,
			cache:false,   
			success:function(msg){            
				data=msg.split("|");
				if(data[0]=="nihil"){
					$("#jabatan").val(data[1]);
					$("#departemen").val(data[2]);
					$("#instansi").val(data[2]);
				}else{
					alert("Data tidak ditemukan");
					$("#jabatan").val('');
					$("#departemen").val('');
					$("#instansi").val('');
				}
			}
		})   
	}	
</script>