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
							<form class="form-horizontal" action="proses/assesmen/<?php echo $form ?>" method="POST" enctype="multipart/form-data">
								<div class="card-header">
									<h5>Laporan Assesmen</h5>
								</div>
								<div class="card-body">								
									<div class="form-group row">									
										<label for="fname" class="col-sm-10 text-left control-label col-form-label">1. Riwayat rawat inap yang tidak terkait dengan masalah narkotika</label>
										<div class="col-sm-12">
											<table class="table table-striped table-bordered">
												<tr>
													<th>Jenis Penyakit</th>
													<th>Dirawat Tahun</th>
													<th>Masa Perawatan</th>
												</tr>
												<tr>
													<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="Jenis Penyakit"></td>
													<td>
														<select class="form-control">
															<option>- Pilih -</option>
														</select>
													</td>
													<td>
														<select class="form-control">
															<option>- Pilih -</option>
														</select>
													</td>
												</tr>
											</table>
										</select>
									</div>										
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-3 text-left control-label col-form-label">2. Riwayat Penyakit Kronis</label></br>
									<div class="col-sm-9">
										<select name="id_staf" class="select2 form-control custom-select col-sm-7" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>											
										</select>
									</div>
								</div>
								<div class="form-group row">			
									<label for="fname" class="col-sm-3 text-right control-label col-form-label">Jelaskan (Jika "Ya")</label>
									<div class="col-sm-9">
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
									</div>																		
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-3 text-left control-label col-form-label">3. Terapis yang sedang dijalankan</label></br>
									<div class="col-sm-9">
										<select name="id_staf" class="select2 form-control custom-select col-sm-7" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>											
										</select>
									</div>
								</div>
								<div class="form-group row">			
									<label for="fname" class="col-sm-3 text-right control-label col-form-label">Jelaskan (Jika "Ya")</label>
									<div class="col-sm-9">
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
									</div>																		
								</div>
								<div class="form-group row">									
									<label for="fname" class="col-sm-10 text-left control-label col-form-label">4. Status kesehatan</label>
									<div class="col-sm-12">
										<table class="table table-hover table-bordered">
											<thead>
												<tr>
													<th>Status kesehatan</th>
													<th>Pernah dites</th>
													<th>Hasil tes</th>
													<th>Tanggal</th>
												</tr>
											</thead>
											<tr>
												<td>HIV/AIDS</td>
												<td>
													<select class="form-control">
														<option>- Pilih -</option>
													</select>
												</td>
												<td>
													<select class="form-control">
														<option>- Pilih -</option>
													</select>
												</td>
												<td><input type="date" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											</tr>
											<tr>
												<td>Hepatitis B</td>
												<td>
													<select class="form-control">
														<option>- Pilih -</option>
													</select>
												</td>
												<td>
													<select class="form-control">
														<option>- Pilih -</option>
													</select>
												</td>
												<td><input type="date" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											</tr>
											<tr>
												<td>Hepatitis C</td>
												<td>
													<select class="form-control">
														<option>- Pilih -</option>
													</select>
												</td>
												<td>
													<select class="form-control">
														<option>- Pilih -</option>
													</select>
												</td>
												<td><input type="date" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											</tr>
										</table>
									</select>
								</div>										
							</div>
							<div class="form-group row">									
								<label for="fname" class="col-sm-10 text-left control-label col-form-label">5.Jenis Narkoba Yang Digunakan Dan Cara Penggunaan:</label>
								<div class="col-sm-12">
									<table class="table table-hover table-bordered">
										<tr align="center">
											<th rowspan="2" colspan="2" width="450">Jenis Napza</th>
											<th colspan="2">30 Hari Terakhir</th>
											<th colspan="2">Seumur Hidup</th>
										</tr>	
										<tr>
											<th>Ya/Tidak</th>
											<th>Cara</th>	
											<th>Ya/Tidak</th>
											<th>Cara</th>	
										</tr>
										<tr>
											<td width="50"></td>
											<td width="450">Alkohol</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="50"></td>
											<td width="450">Heroin</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="50"></td>
											<td width="450">Metadon/Buprenorfin</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="50"></td>
											<td width="450">Opiat lain/Analgesik</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="50"></td>
											<td width="450">Barbiturat</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="50"></td>
											<td width="450">Sedatif/Hipnotik</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="50"></td>
											<td width="450">Kokain</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="50"></td>
											<td width="450">Amfetamin</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="50"></td>
											<td width="450">Kanabis/Ganja</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="50"></td>
											<td width="450">Halusinogen</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="50"></td>
											<td width="450">Inhalan</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="form-group row">
								<label for="fname" class="col-sm-4 text-left control-label col-form-label">6. Jenis zat utama yang disalahgunakan</label>
								<div class="col-sm-8">
									<select name="id_staf" class="select2 form-control custom-select col-sm-8" <?php echo $read2 ?>>
										<option value=''>- pilih -</option>											
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="fname" class="col-sm-4 text-left control-label col-form-label">7. Pernah ngalami overdosis?</label></br>
								<div class="col-sm-8">
									<select name="id_staf" class="select2 form-control custom-select col-sm-7" <?php echo $read2 ?>>
										<option value=''>- pilih -</option>											
									</select>
								</div>
							</div>
							<div class="form-group row">			
								<label for="fname" class="col-sm-4 text-right control-label col-form-label">Jelaskan (Jika "Ya")</label>
								<div class="col-sm-8">
									<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">
								</div>																		
							</div>
							<div class="form-group row">
								<label for="fname" class="col-sm-4 text-right control-label col-form-label">Cara Penanggulangan</label>
								<div class="col-sm-8">
									<select name="id_staf" class="select2 form-control custom-select col-sm-9" <?php echo $read2 ?>>
										<option value=''>- pilih -</option>											
									</select>
								</div>
							</div>
							<div class="form-group row">									
								<label for="fname" class="col-sm-10 text-left control-label col-form-label">8.Berapa kali dalam hidup anda ditangkap dan dituntut dengan hal berikut?</label>
								<div class="col-sm-12">
									<table class="table table-hover table-bordered">
										<thead>
											<tr>
												<th width="350">Jenis</th>
												<th>Pengalaman</th>
												<th>Berapa Kali</th>
												<th>Hukuman</th>
											</tr>
										</thead>
										<tr>
											<td>Mencuri di toko/vandalisme</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Bebas bersyarat/masa percobaan</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Masalah narkoba</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Pemalsuan</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Penyerangan bersenajta</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Pembobolan dan Pencurian</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Perampokan</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Penyerangan</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Pembakaran Rumah</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Perkosaan</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Pembunuhan</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Pelacuran</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Melecehkan Pengadil</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
										<tr>
											<td>Dan lain-lain</td>
											<td>
												<select class="form-control">
													<option>- Pilih -</option>
												</select>
											</td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
											<td><input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder=""></td>
										</tr>
									</table>
								</select>
							</div>										
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-6 text-left control-label col-form-label">9. Dalam situasi seperti apakah anda tinggal 3 tahun belakangan ini?</label>
							<div class="col-sm-6">
								<select name="id_staf" class="select2 form-control custom-select col-sm-6" <?php echo $read2 ?>>
									<option value=''>- pilih -</option>											
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-6 text-left control-label col-form-label">10.Apakah anda hidup dengan seseorang  yang mempunyai masalah penyalahgunaan zat sekarang ini?</label>
							<div class="col-sm-6">
								<select name="id_staf" class="select2 form-control custom-select col-sm-6" <?php echo $read2 ?>>
									<option value=''>- pilih -</option>											
								</select>
							</div>
						</div>
						<div class="form-group row">									
							<label for="fname" class="col-sm-3 text-left control-label col-form-label">Siapakah mereka?</label>
							<div class="col-sm-9">
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<td>Saudara kandung / saudara tiri</td>
											<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										</tr>
										<tr>
											<td>Ayah / Ibu</td>
											<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										</tr>
										<tr>
											<td>Pasangan</td>
											<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										</tr>
										<tr>
											<td>Paman / Tante</td>
											<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										</tr>
										<tr>
											<td>Paman / Tante</td>
											<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										</tr>
										<tr>
											<td>Lain-lainnya:</td>
											<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										</tr>
									</thead>
								</table>
							</div>
						</div>
						<div class="form-group row">									
							<label for="fname" class="col-sm-10 text-left control-label col-form-label">11. Apakah anda memiliki konflik serius dalam berhubungan dengan:</label>
							<div class="col-sm-12">
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<td></td>
											<td>30 hari terakhir</td>
											<td>Seumur hidup</td>
										</tr>
									</thead>
									<tr>
										<td>Ayah</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td>Ibu</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td>Adik / Kakak</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td>Pasangan</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td>Anak-anak</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td>Keluarga Lain ( Jelaskan: <input width="60px" type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_assesmen : "" ; ?>" name="nama_assesmen" class="form-control" placeholder="">)</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td>Teman akrab</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td>Tetangga</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td>Teman sekerja</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td align="center"><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="form-group row">									
							<label for="fname" class="col-sm-10 text-left control-label col-form-label">12.Apakah anda pernah mengalami hal-hal berikut ini:</label>
							<div class="col-sm-12">
								<table class="table table-hover table-bordered">
									<tr align="center">
										<th rowspan="2" colspan="2" width="450"></th>
										<th colspan="2">Bukan karena napza</th>
										<th colspan="2">Karena napza</th>
									</tr>	
									<tr>
										<th>30 hari terakhir</th>
										<th>Seumur hidup</th>	
										<th>30 hari terakhir</th>
										<th>Seumur hidup</th>	
									</tr>
									<tr>
										<td width="50"></td>
										<td width="450">Mengalami  depresi  serius  (kesedihan,  putus  asa, kehilangan semangat, susah konsentrasi)</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td width="50"></td>
										<td width="450">Mengalami  rasa  cemas  serius/ketegangan,  gelisah, merasa khawatir berlebihan?</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td width="50"></td>
										<td width="450">Mengalami   halusinasi (melihat   atau   mendengar sesuatu yang tidak ada obyeknya)</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td width="50"></td>
										<td width="450">Mengalami   kesulitan   meningat   atau   focus   pada sesuatu</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td width="50"></td>
										<td width="450">Mengalami   kesukaran   mengontrol   perilaku   kasar, termasuk kemarahan atau kekerasan</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td width="50"></td>
										<td width="450">Mengalami pikiran serius untuk bunuh diri?</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td width="50"></td>
										<td width="450">Berusaha untuk bunuh diri?</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
									<tr>
										<td width="50"></td>
										<td width="450">Menerima pengobatan dari psikater?</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
										<td><input name='cek_amp' type="checkbox"> Ya <input name='cek_amp' type="checkbox"> Tidak</td>
									</tr>
								</table>
							</div>
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

