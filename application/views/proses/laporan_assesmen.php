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
							<form class="form-horizontal" action="proses/laporan_assesmen/<?php echo $form ?>" method="POST" enctype="multipart/form-data">
								<div class="card-header">
									<h5>Laporan Hasil Assesmen</h5>
								</div>
								<div class="card-body">								
									<div class="form-group row">
										<label for="fname" class="col-sm-10 text-left control-label col-form-label">Informasi Klien</label>	
										<div class="col-sm-12">
											<label for="fname" class="col-sm-3 text-left control-label col-form-label">Nama</label>
											<label for="fname" class="col-sm-6 text-left control-label col-form-label">:</label>
										</div>
										<div class="col-sm-12">
											<label for="fname" class="col-sm-3 text-left control-label col-form-label">Alamat</label>
											<label for="fname" class="col-sm-6 text-left control-label col-form-label">:</label>
										</div>
										<div class="col-sm-12">
											<label for="fname" class="col-sm-3 text-left control-label col-form-label">Tanggal Assesmen</label>
											<label for="fname" class="col-sm-6 text-left control-label col-form-label">:</label>
										</div>
										<div class="col-sm-12">
											<label for="fname" class="col-sm-3 text-left control-label col-form-label">Nomor Rekam Fisik</label>
											<label for="fname" class="col-sm-6 text-left control-label col-form-label">:</label>
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-10 text-left control-label col-form-label">1. Pemeriksaan Fisik</label>
										<label for="fname" class="col-sm-3 text-left control-label col-form-label">Tekanan Darah</label>
										<div class="col-sm-3">	
											<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="Tekanan Darah">
										</div>
										<label for="fname" class="col-sm-3 text-left control-label col-form-label">Nadi</label>
										<div class="col-sm-3">
											<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="Nadi">
										</div>
									</div>	
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-left control-label col-form-label">Pernapasan (RR)</label>
										<div class="col-sm-3">	
											<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="Pernapasan (RR)">
										</div>
										<label for="fname" class="col-sm-3 text-left control-label col-form-label">Suhu (Celcius)</label>
										<div class="col-sm-3">
											<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="Suhu (Celcius)">
										</div>
									</div>
									<div class="form-group row">	
										<label for="fname" class="col-sm-12 text-left control-label col-form-label">2. Pemeriksaan Sistemik</label>
										<div class="col-sm-12">
											<table class="table table-hover table-bordered text-center">
												<thead>
													<tr>
														<th>Sistem pencernaan</th>
														<th>Sistem jantung dan pembuluh darah</th>
														<th>Sistem pernapasan</th>
														<th>Sistem saraf pusat</th>
														<th>THT dan kulit</th>
														<th>Keterangan</th>
													</tr>
												</thead>
												<tr>
													<td>
														<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
													</td>
													<td>
														<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
													</td>													
													<td>
														<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
													</td>	
													<td>
														<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
													</td>	
													<td>
														<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
													</td>	
													<td>
														<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
													</td>	
												</tr>
											</table>
										</div>
									</div>										
									<div class="form-group row">
										<div class="col-sm-12">
											<table class="table table-hover table-bordered text-center">
												<tr>
													<td rowspan="8">3.Hasil Urinalysis</td>
													<td>Jenis Zat</td>
													<td>Positif</td>
													<td>Negatif</td>
												</tr>
												<tr>	
													<td>Benzodiazepin</td>
													<td>
														<input type="radio" name="jenis_zat"
														<?php if (isset($jenis_zat) && $jenis_zat=="positif") echo "checked";?>
														value="positif">

													</td>
													<td>
														<input type="radio" name="jenis_zat"
														<?php if (isset($jenis_zat) && $jenis_zat=="negatif") echo "checked";?>
														value="negatif">
													</td>
												</tr>
												<tr>
													<td>Kanabis</td>
													<td>
														<input type="radio" name="jenis_zat1"
														<?php if (isset($jenis_zat1) && $jenis_zat1=="positif") echo "checked";?>
														value="positif">
													</td>
													<td>
														<input type="radio" name="jenis_zat1"
														<?php if (isset($jenis_zat1) && $jenis_zat1=="negatif") echo "checked";?>
														value="negatif">
													</td>
												</tr>
												<tr>
													<td>Opiat</td>
													<td>
														<input type="radio" name="jenis_zat2"
														<?php if (isset($jenis_zat2) && $jenis_zat2=="positif") echo "checked";?>
														value="positif">
													</td>
													<td>
														<input type="radio" name="jenis_zat2"
														<?php if (isset($jenis_zat2) && $jenis_zat2=="negatif") echo "checked";?>
														value="negatif">
													</td>
												</tr>
												<tr>
													<td>Amfetamin</td>
													<td>
														<input type="radio" name="jenis_zat3"
														<?php if (isset($jenis_zat3) && $jenis_zat3=="positif") echo "checked";?>
														value="positif">
													</td>
													<td>
														<input type="radio" name="jenis_zat3"
														<?php if (isset($jenis_zat3) && $jenis_zat3=="negatif") echo "checked";?>
														value="negatif">
													</td>
												</tr>
												<tr>
													<td>Kokain</td>
													<td>
														<input type="radio" name="jenis_zat4"
														<?php if (isset($jenis_zat4) && $jenis_zat4=="positif") echo "checked";?>
														value="positif">
													</td>
													<td>
														<input type="radio" name="jenis_zat4"
														<?php if (isset($jenis_zat4) && $jenis_zat4=="negatif") echo "checked";?>
														value="negatif">
													</td>
												</tr>
												<tr>
													<td>Amfetamin</td>
													<td>
														<input type="radio" name="jenis_zat5"
														<?php if (isset($jenis_zat5) && $jenis_zat5=="positif") echo "checked";?>
														value="positif">
													</td>
													<td>
														<input type="radio" name="jenis_zat5"
														<?php if (isset($jenis_zat5) && $jenis_zat5=="negatif") echo "checked";?>
														value="negatif">
													</td>
												</tr>
												<tr>
													<td>Alkohol</td>
													<td>
														<input type="radio" name="jenis_zat6"
														<?php if (isset($jenis_zat6) && $jenis_zat6=="positif") echo "checked";?>
														value="positif">
													</td>
													<td>
														<input type="radio" name="jenis_zat6"
														<?php if (isset($jenis_zat6) && $jenis_zat6=="negatif") echo "checked";?>
														value="negatif">
													</td>
												</tr>
											</table>	
										</div>
									</div>
									<div class="form-group row">	
										<label for="fname" class="col-sm-12 text-left control-label col-form-label">4. Kesimpulan</label>
										<div class="col-sm-12">
											<table class="table table-hover table-bordered">
												<thead>
													<tr align="center">
														<th class="col-sm-9">Masalah</th>
														<th>Skala Masalah</th>
													</tr>
												</thead>
												<tr>
													<td>Medis</td>
													<td>
														<select class="form-control">
															<option>- Pilih -</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
															<option value="10">10</option>
														</select>
													</td>	
												</tr>
												<tr>
													<td>Pekerjaan / Dukungan</td>
													<td>
														<select class="form-control">
															<option>- Pilih -</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
															<option value="10">10</option>
														</select>
													</td>	
												</tr>
												<tr>
													<td>Napza</td>
													<td>
														<select class="form-control">
															<option>- Pilih -</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
															<option value="10">10</option>
														</select>
													</td>	
												</tr>
												<tr>
													<td>Legal</td>
													<td>
														<select class="form-control">
															<option>- Pilih -</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
															<option value="10">10</option>
														</select>
													</td>	
												</tr>
												<tr>
													<td>Keluarga / Sosial</td>
													<td>
														<select class="form-control">
															<option>- Pilih -</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
															<option value="10">10</option>
														</select>
													</td>	
												</tr>
												<tr>
													<td>Psikatris</td>
													<td>
														<select class="form-control">
															<option>- Pilih -</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
															<option value="10">10</option>
														</select>
													</td>	
												</tr>
											</table>
											<label for="fname" class="col-sm-12 text-left control-label col-form-label">(Catatan: Skala 1 s/d 10 dimana skala 1 berarti tidak ada masalah dan skala 10 sangat berasalah)</label>
										</div>									
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-10 text-left control-label col-form-label">5.Diagnosa Kerja</label>
										<label for="fname" class="col-sm-5 text-left control-label col-form-label" style="margin-left: 10px;">Klien Memenuhi Kriteria Diagnosis Napza</label>
										<div class="col-sm-6">
											<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-left control-label col-form-label" style="margin-left: 10px;">Diagnosis Lainnya</label>
										<div class="col-sm-8">
											<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-10 text-left control-label col-form-label">6. Rencana Terapi dan Rehabilitas</label>
										<label for="fname" class="col-sm-3 text-left control-label col-form-label" style="margin-left: 10px;">Resume Masalah</label>
										<div class="col-sm-8">
											<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-5 text-left control-label col-form-label" style="margin-left: 10px;">Rencana Tindak Lanjut</label>
										<div class="col-sm-6">
											<select name="id_staf" class="select2 form-control custom-select col-sm-6" <?php echo $read2 ?>>
												<option value=''>- pilih -</option>		
												<option value='Rawat Jalan'>Rawat Jalan</option>
												<option value='Rawat Inap'>Rawat Inap</option>	
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-5 text-left control-label col-form-label" style="margin-left: 10px;">Fasilitas rujukan tim asesmen</label>
										<div class="col-sm-6">
											<select name="id_staf" class="select2 form-control custom-select col-sm-6" <?php echo $read2 ?>>
												<option value=''>- pilih -</option>		
												<option value='BNN'>BNN</option>
												<option value='RSJ'>RSJ</option>
												<option value='Al-Janah'>Al-Janah</option>
												<option value='Sahabat'>Sahabat</option>
												<option value='Kanti Sehati'>Kanti Sehati</option>	
											</select>
										</div>
									</div>
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


		<?php 
	}elseif($set=='view'){
		?>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5>Data laporan_assesmen</h5>
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
										<th>Nama laporan_assesmen</th>
										<th>Tgl Daftar</th>
										<th>Status</th>											
										<th>Keterangan</th>
										<th width="10%">Aksi</th>											
									</tr>
								</thead>
								<tbody>
									<?php 
									$no=1;
									foreach ($dt_laporan_assesmen->result() as $row) {
										echo "
										<tr>
										<td>$no</td>
										<td><a href='proses/assesmen/detail?id=$row->id_staf'>$row->id</a></td>
										<td>$row->nama_lengkap</td>
										<td>$row->instansi</td>
										<td>$row->nama_assesmen</td>
										<td>$row->tgl_daftar</td>											
										<td>$row->status</td>
										<td>$row->pekerjaan</td>
										<td>"; ?>
										<a class='btn btn-info btn-sm' href='proses/assesmen/edit?id=<?php echo $row->id_staf ?>'><i class='fa fa-edit'></i></a>
										<a class='btn btn-danger btn-sm' onclick="return confirm('Anda yakin?')" href='proses/assesmen/delete?id=<?php echo $row->id_staf ?>'><i class='fa fa-trash'></i></a>
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
			url : "<?php echo site_url('proses/assesmen/ambil_kab')?>",
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
			url : "<?php echo site_url('proses/assesmen/ambil_kec')?>",
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
			url : "<?php echo site_url('proses/assesmen/ambil_kel')?>",
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

