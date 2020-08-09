<body onload="sembunyi()">
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
							<form class="form-horizontal" action="proses/catatan_perkembangan/<?php echo $form ?>" method="POST" enctype="multipart/form-data">
								<div class="card-header">
									<h5>Catatan Perkembangan</h5>
								</div>
								<div class="card-body">								
									<div class="form-group row">
										<div class="col-sm-12">
											<label for="fname" class="col-sm-3 text-left control-label col-form-label">1. Nama</label>
											<label for="fname" class="col-sm-1 text-right control-label col-form-label">:</label>
											<label for="fname" class="col-sm-7 text-left control-label col-form-label"> </label>
										</div>
										<div class="col-sm-12">
											<label for="fname" class="col-sm-3 text-left control-label col-form-label">2. Alamat</label>
											<label for="fname" class="col-sm-1 text-right control-label col-form-label">:</label>
											<label for="fname" class="col-sm-7 text-left control-label col-form-label"> </label>
										</div>
										<div class="col-sm-12">
											<label for="fname" class="col-sm-3 text-left control-label col-form-label">3. Tanggal</label>
											<label for="fname" class="col-sm-1 text-right control-label col-form-label">:</label>
											<label for="fname" class="col-sm-7 text-left control-label col-form-label">
												<?php
												function tgl_indo($tanggal){
													$bulan = array (
														1 =>   'Januari',
														'Februari',
														'Maret',
														'April',
														'Mei',
														'Juni',
														'Juli',
														'Agustus',
														'September',
														'Oktober',
														'November',
														'Desember'
													);
													$pecahkan = explode('-', $tanggal);					
													return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
												}

												echo tgl_indo(date('Y-m-d')); 
												?>
											</label>
										</div>
									</div>
									<div class="form-group row" style="margin-left: 1px;">
										<label for="fname" class="col-sm-3 text-left control-label col-form-label">4. Catatan Pemantauan </label>
										<label for="fname" class="col-sm-1 text-right control-label col-form-label">:</label>
										<div class="col-sm-8">
											<textarea class="form-control" <?php $read ?> value="<?php echo $tampil = ($row!='')? $row->nama_assesmen : "";?>" name="nama_assesmen" class="form-control" placeholder="">
											</textarea>
										</div>
									</div>
									<div class="form-group row" style="margin-left: 1px;">
										<label for="fname" class="col-sm-3 text-left control-label col-form-label">5. Catatan Pendampingan </label>
										<label for="fname" class="col-sm-1 text-right control-label col-form-label">:</label>
										<div class="col-sm-8">
											<textarea class="form-control" <?php $read ?> value="<?php echo $tampil = ($row!='')? $row->nama_assesmen : "";?>" name="nama_assesmen" class="form-control" placeholder="">
											</textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-6 text-left control-label col-form-label"><a href="proses/pertemuan_kelompok/add"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Sebelumnya</a></label>
										<label for="fname" class="col-sm-6 text-right control-label col-form-label"><a href="proses/catatan_pemantauan_pendamping/add"> Selanjutnya <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></label>
									</div>

									<div class="border-top" <?php echo $vis ?>>
										<div class="card-body">
											<button type="submit" name="simpan" value="draft" class="btn btn-primary"><i class="fa fa-save"></i> Simpan sebagai Draft</button>
											<button type="submit" name="simpan" value="selesai" class="btn btn-success"><i class="fa fa-save"></i> Simpan dan Selesai </button>
											<button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i> Batal</button>
										</div>
									</div>
								</form>
							</div>
						</div>				
					</div>
				</div>
			</div>
		</form>
		<?php 
	}elseif($set=='view'){
		?>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5>Data Laporan Rawat Jalan</h5>
					</div>
					<div class="card-body">
						<!-- <h5 class="card-title">Basic Datatable</h5> -->
						<div class="table-responsive">
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th>Nama Pegawai Input</th>
										<th>Instansi</th>
										<th>Nama laporan Rawat Jalan</th>
										<th>Tgl Daftar</th>
										<th>Status</th>											
										<th>Keterangan</th>
										<th width="10%">Aksi</th>											
									</tr>
								</thead>
								<tbody>
									<?php 
									$no=1;
									foreach ($dt_rawat_jalan_2->result() as $row) {
										echo "
										<tr>
										<td>$no</td>
										<td><a href='proses/catatan_perkembangan/detail?id=$row->id_staf'>$row->id</a></td>
										<td>$row->nama_lengkap</td>
										<td>$row->instansi</td>
										<td>$row->nama_assesmen</td>
										<td>$row->tgl_daftar</td>											
										<td>$row->status</td>
										<td>$row->pekerjaan</td>
										<td>"; ?>
										<a class='btn btn-info btn-sm' href='proses/catatan_perkembangan/edit?id=<?php echo $row->id_staf ?>'><i class='fa fa-edit'></i></a>
										<a class='btn btn-danger btn-sm' onclick="return confirm('Anda yakin?')" href='proses/catatan_perkembangan/delete?id=<?php echo $row->id_staf ?>'><i class='fa fa-trash'></i></a>
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
</body>

<script type="text/javascript">
	function ambil_kab(){  
		var id_provinsi  = $("#id_provinsi").val();   
		$.ajax({
			url : "<?php echo site_url('proses/catatan_perkembangan/ambil_kab')?>",
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
			url : "<?php echo site_url('proses/catatan_perkembangan/ambil_kec')?>",
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
			url : "<?php echo site_url('proses/catatan_perkembangan/ambil_kel')?>",
			type:"POST",
			data:"id_kecamatan="+id_kecamatan,
			cache:false,   
			success:function(msg){            
				$("#id_kelurahan").html(msg);                
			}
		})   
	}
	function sembunyi(){
		$("#tampil_sekolah").hide();
		$("#tampil_asn").hide();
		$("#tampil_jenis").hide();
	}
	function isi_pekerjaan(){  
		var pekerjaan  = $("#pekerjaan").val();   
		if(pekerjaan=='Lain-lain' || pekerjaan=='ASN'){
			$("#tampil_asn").show();
			$("#tampil_sekolah").hide();
		}else if(pekerjaan=='Pelajar/Mahasiswa'){
			$("#tampil_sekolah").show();
			$("#tampil_asn").hide();
		}else{
			sembunyi();
		}
	}
	function cek_jenis(){  
		var jenis_assesmen  = $("#jenis_assesmen").val();   
		if(jenis_assesmen=='Compulsory'){
			$("#tampil_jenis").show();						
		}else{
			$("#tampil_jenis").show();
		}
	}
</script>

