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
							<form class="form-horizontal" action="proses/pasca_rehabilitas/<?php echo $form ?>" method="POST" enctype="multipart/form-data">
								<div class="card-header">
									<h5>A. Data Petugas Pendaftar Klien</h5>
								</div>
								<div class="card-body">								
									<div class="form-group row">									
										<label for="fname" class="col-sm-2 text-right control-label col-form-label">Instansi</label>
										<div class="col-sm-4">
											<?php echo $form_id ?>
											<select></select>ect name="id_instansi" class="select2 form-control custom-select" <?php echo $read2 ?>>
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
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">NIK/Nama Petugas</label>
									<div class="col-sm-10">
										<select name="id_staf" class="select2 form-control custom-select" <?php echo $read2 ?>>
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
								</div>
							</div>

							<div class="card-header">
								<h5>B. Data Pengenal Klien</h5>
							</div>
							<div class="card-body">						
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Nama Klien</label>
									<div class="col-sm-10">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->nama_pasca_rehabilitas : "" ; ?>" name="nama_pasca_rehabilitas" class="form-control" placeholder="Nama Klien">
									</div>									
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Alias</label>
									<div class="col-sm-10">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->alias : "" ; ?>" name="alias" class="form-control" placeholder="Alias">
									</div>									
								</div>		
								<div class="form-group row">									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Kewarganegaraan</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->kewarganegaraan : "" ; ?>" name="kewarganegaraan" class="form-control" placeholder="Kewarganegaraan">										
									</div>		
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jenis Pasca Rehabilitas</label>
									<div class="col-sm-4">
										<select onclick="cek_jenis()" id="jenis_pasca_rehabilitas" name="jenis_pasca_rehabilitas" class="form-control" <?php echo $read2 ?>>
											<option <?php if($row!='' && $row->jenis_pasca_rehabilitas=="") echo "selected" ?> value=''>- pilih -</option>
											<option <?php if($row!='' && $row->jenis_pasca_rehabilitas=="Compulsory") echo "selected" ?> >Compulsory</option>
											<option <?php if($row!='' && $row->jenis_pasca_rehabilitas=="Voluntary") echo "selected" ?> >Voluntary</option>												
										</select>
									</div>								
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jenis ID</label>
									<div class="col-sm-4">
										<select name="jenis_id" class="form-control" <?php echo $read2 ?>>
											<option <?php if($row!='' && $row->jenis_id=="") echo "selected" ?> value=''>- pilih -</option>
											<option <?php if($row!='' && $row->jenis_id=="KTP") echo "selected" ?> >KTP</option>
											<option <?php if($row!='' && $row->jenis_id=="SIM") echo "selected" ?> >SIM</option>
											<option <?php if($row!='' && $row->jenis_id=="Paspor") echo "selected" ?> >Paspor</option>
											<option <?php if($row!='' && $row->jenis_id=="Lain-lain") echo "selected" ?> >Lain-lain</option>
										</select>
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">No Identitas</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->no_id : "" ; ?>" name="no_id" class="form-control" placeholder="No Identitas">										
									</div>										
								</div>
							</div>

							<div class="card-header">
								<h5>C. Alamat & Nomor Kontak</h5>
							</div>
							<div class="card-body">						
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Alamat Lengkap</label>
									<div class="col-sm-10">																				
									</div>									
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jalan</label>
									<div class="col-sm-10">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->jalan : "" ; ?>" name="jalan" class="form-control" placeholder="Jalan">
									</div>									
								</div>		
								<div class="form-group row">									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">No Rumah</label>
									<div class="col-sm-2">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->no_rumah : "" ; ?>" name="no_rumah" class="form-control" placeholder="No Rumah">										
									</div>										
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">RT</label>
									<div class="col-sm-2">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->rt : "" ; ?>" name="rt" class="form-control" placeholder="RT">										
									</div>										
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">RW</label>
									<div class="col-sm-2">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->rw : "" ; ?>" name="rw" class="form-control" placeholder="RW">										
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
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">No Telp</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->no_telp : "" ; ?>" name="no_telp" class="form-control" placeholder="No Telp">
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">No HP</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->no_hp : "" ; ?>" name="no_hp" class="form-control" placeholder="No HP">
									</div>									
								</div>
							</div>

							<div class="card-header">
								<h5>D. Data Biografis</h5>
							</div>
							<div class="card-body">						
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Tempat Lahir</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->tempat_lahir : "" ; ?>" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Tgl Lahir</label>
									<div class="col-sm-4">										
										<input type="text" id="datepicker-autoclose2" autocomplete="off" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->tgl_lahir : "" ; ?>" name="tgl_lahir" class="form-control" placeholder="Tgl Lahir">
									</div>									
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Umur</label>
									<div class="col-sm-4">										
										<input type="number" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->umur : "" ; ?>" name="umur" class="form-control" placeholder="Umur (Tahun)">
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Agama</label>
									<div class="col-sm-4">
										<select name="agama" class="form-control" <?php echo $read2 ?>>
											<option <?php if($row!='' && $row->agama=="") echo "selected" ?> value=''>- pilih -</option>
											<option <?php if($row!='' && $row->agama=="Islam") echo "selected" ?> >Islam</option>
											<option <?php if($row!='' && $row->agama=="Hindu") echo "selected" ?> >Hindu</option>
											<option <?php if($row!='' && $row->agama=="Buddha") echo "selected" ?> >Buddha</option>
											<option <?php if($row!='' && $row->agama=="Kristen") echo "selected" ?> >Kristen</option>
											<option <?php if($row!='' && $row->agama=="Protestan") echo "selected" ?> >Protestan</option>
											<option <?php if($row!='' && $row->agama=="Kong Hu Chu") echo "selected" ?> >Kong Hu Chu</option>
										</select>
									</div>									
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Suku</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->suku : "" ; ?>" name="suku" class="form-control" placeholder="Suku">
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Status Pernikahan</label>
									<div class="col-sm-4">
										<select name="status_menikah" class="form-control" <?php echo $read2 ?>>
											<option <?php if($row!='' && $row->status_menikah=="") echo "selected" ?> value=''>- pilih -</option>
											<option <?php if($row!='' && $row->status_menikah=="Belum Menikah") echo "selected" ?> >Belum Menikah</option>
											<option <?php if($row!='' && $row->status_menikah=="Sudah Menikah") echo "selected" ?> >Sudah Menikah</option>
											<option <?php if($row!='' && $row->status_menikah=="Duda/Janda") echo "selected" ?> >Duda/Janda</option>											
										</select>
									</div>									
								</div>		
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Pendidikan Terakhir</label>
									<div class="col-sm-4">
										<select name="pendidikan_terakhir" class="form-control" <?php echo $read2 ?>>
											<option <?php if($row!='' && $row->pendidikan_terakhir=="") echo "selected" ?> value=''>- pilih -</option>
											<option <?php if($row!='' && $row->pendidikan_terakhir=="Tidak Sekolah") echo "selected" ?> >Tidak Sekolah</option>
											<option <?php if($row!='' && $row->pendidikan_terakhir=="SD") echo "selected" ?> >SD</option>
											<option <?php if($row!='' && $row->pendidikan_terakhir=="SMP") echo "selected" ?> >SMP</option>
											<option <?php if($row!='' && $row->pendidikan_terakhir=="SMA") echo "selected" ?> >SMA</option>
											<option <?php if($row!='' && $row->pendidikan_terakhir=="SMK") echo "selected" ?> >SMK</option>
											<option <?php if($row!='' && $row->pendidikan_terakhir=="D3") echo "selected" ?> >D3</option>
											<option <?php if($row!='' && $row->pendidikan_terakhir=="S1") echo "selected" ?> >S1</option>
											<option <?php if($row!='' && $row->pendidikan_terakhir=="S2") echo "selected" ?> >S2</option>
											<option <?php if($row!='' && $row->pendidikan_terakhir=="S3") echo "selected" ?> >S3</option>
										</select>
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Pekerjaan</label>
									<div class="col-sm-4">
										<select id="pekerjaan" onclick="isi_pekerjaan()" name="pekerjaan" class="form-control" <?php echo $read2 ?>>
											<option <?php if($row!='' && $row->pekerjaan=="") echo "selected" ?> value=''>- pilih -</option>
											<option <?php if($row!='' && $row->pekerjaan=="Tidak Bekerja") echo "selected" ?> >Tidak Bekerja</option>
											<option <?php if($row!='' && $row->pekerjaan=="Pelajar/Mahasiswa") echo "selected" ?> >Pelajar/Mahasiswa</option>
											<option <?php if($row!='' && $row->pekerjaan=="Karyawan Swasta") echo "selected" ?> >Karyawan Swasta</option>
											<option <?php if($row!='' && $row->pekerjaan=="ASN") echo "selected" ?> >ASN</option>
											<option <?php if($row!='' && $row->pekerjaan=="Lain-lain") echo "selected" ?> >Lain-lain</option>											
										</select>
									</div>	
								</div>

								<span id="tampil_sekolah">
									<div class="form-group row">								
										<label for="fname" class="col-sm-2 text-right control-label col-form-label">Status Sekolah</label>
										<div class="col-sm-4">
											<select name="status_sekolah" class="form-control" <?php echo $read2 ?>>
												<option <?php if($row!='' && $row->status_sekolah=="") echo "selected" ?> value=''>- pilih -</option>
												<option <?php if($row!='' && $row->status_sekolah=="Tidak Sekolah") echo "selected" ?> >Tidak Sekolah</option>
												<option <?php if($row!='' && $row->status_sekolah=="SD") echo "selected" ?> >SD</option>
												<option <?php if($row!='' && $row->status_sekolah=="SMP") echo "selected" ?> >SMP</option>
												<option <?php if($row!='' && $row->status_sekolah=="SMA") echo "selected" ?> >SMA</option>
												<option <?php if($row!='' && $row->status_sekolah=="SMK") echo "selected" ?> >SMK</option>
												<option <?php if($row!='' && $row->status_sekolah=="D3") echo "selected" ?> >D3</option>
												<option <?php if($row!='' && $row->status_sekolah=="S1") echo "selected" ?> >S1</option>
												<option <?php if($row!='' && $row->status_sekolah=="S2") echo "selected" ?> >S2</option>
												<option <?php if($row!='' && $row->status_sekolah=="S3") echo "selected" ?> >S3</option>
											</select>
										</div>
									</div>
								</span>

								<span id="tampil_asn">
									<div class="form-group row">								
										<label for="fname" class="col-sm-2 text-right control-label col-form-label">Penempatan atau Jenis Pekerjaan</label>
										<div class="col-sm-10">
											<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->pekerjaan_lain : "" ; ?>" name="pekerjaan_lain" class="form-control" placeholder="Penempatan atau Jenis Pekerjaan">																					
										</div>
									</div>
								</span>


								<div class="form-group row">									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Pola Pekerjaan</label>
									<div class="col-sm-10">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->pola_pekerjaan : "" ; ?>" name="pola_pekerjaan" class="form-control" placeholder="Pola Pekerjaan">										
									</div>										
								</div>
							</div>							

							<div class="card-header">
								<h5>E. Data Biologis</h5>
							</div>
							<div class="card-body">						
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Tampak Diri</label>
									<div class="col-sm-10">																				
									</div>									
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Tampak Sisi Kiri</label>
									<div class="col-sm-2">																				
										<input type="file" <?php echo $read ?>  name="file_foto_kiri" class="form-control">										
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Tampak Sisi Depan</label>
									<div class="col-sm-2">																				
										<input type="file" <?php echo $read ?>  name="file_foto_depan" class="form-control">										
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Tampak Sisi Kanan</label>
									<div class="col-sm-2">																				
										<input type="file" <?php echo $read ?>  name="file_foto_kanan" class="form-control">										
									</div>									
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Rekam Sidik Jari</label>
									<div class="col-sm-10">																				
									</div>									
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Tangan Kiri</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_tangan_kiri" class="form-control">										
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Tangan Kanan</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_tangan_kanan" class="form-control">										
									</div>							
								</div>		
								<div class="form-group row">								
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Ibu Jari Kiri</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_ibu_kiri" class="form-control">										
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Ibu Jari Kanan</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_ibu_kanan" class="form-control">										
									</div>									
								</div>
								<div class="form-group row">								
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jari Telunjuk Kiri</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_telunjuk_kiri" class="form-control">										
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jari Telunjuk Kanan</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_telunjuk_kanan" class="form-control">										
									</div>									
								</div>
								<div class="form-group row">								
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jari Tengah Kiri</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_tengah_kiri" class="form-control">										
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jari Tengah Kanan</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_tengah_kanan" class="form-control">										
									</div>									
								</div>
								<div class="form-group row">								
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jari Manis Kiri</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_manis_kiri" class="form-control">										
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jari Manis Kanan</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_manis_kanan" class="form-control">										
									</div>									
								</div>
								<div class="form-group row">								
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jari Kelingking Kiri</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_kelingking_kiri" class="form-control">										
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jari Kelingking Kanan</label>
									<div class="col-sm-4">																				
										<input type="file" <?php echo $read ?>  name="file_kelingking_kanan" class="form-control">										
									</div>									
								</div>

								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Tinggi Badan (cm)</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->tinggi_badan : "" ; ?>" name="tinggi_badan" class="form-control" placeholder="TInggi Badan (cm)">
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Berat Badan (kg)</label>
									<div class="col-sm-4">										
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->berat_badan : "" ; ?>" name="berat_badan" class="form-control" placeholder="Berat Badan (kg)">
									</div>									
								</div>
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jenis Kelamin</label>
									<div class="col-sm-4">										
										<select name="jenis_kelamin" class="form-control" <?php echo $read2 ?>>
											<option <?php if($row!='' && $row->jenis_kelamin=="") echo "selected" ?> value=''>- pilih -</option>
											<option <?php if($row!='' && $row->jenis_kelamin=="Laki-laki") echo "selected" ?> >Laki-laki</option>
											<option <?php if($row!='' && $row->jenis_kelamin=="Perempuan") echo "selected" ?> >Perempuan</option>											
										</select>
									</div>									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Berat Badan (kg)</label>
									<div class="col-sm-4">										
										<select name="gol_darah" class="form-control" <?php echo $read2 ?>>
											<option <?php if($row!='' && $row->gol_darah=="") echo "selected" ?> value=''>- pilih -</option>
											<option <?php if($row!='' && $row->gol_darah=="A") echo "selected" ?> >A</option>
											<option <?php if($row!='' && $row->gol_darah=="B") echo "selected" ?> >B</option>											
											<option <?php if($row!='' && $row->gol_darah=="AB") echo "selected" ?> >AB</option>											
											<option <?php if($row!='' && $row->gol_darah=="O") echo "selected" ?> >O</option>											
										</select>
									</div>									
								</div>		
								<div class="form-group row">									
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Ciri-ciri Khusus</label>
									<div class="col-sm-10">										
										<textarea name="ciri_khusus" <?php echo $read ?> class="form-control"><?php echo $tampil = ($row!='') ? $row->ciri_khusus : "" ; ?></textarea>
									</div>										
								</div>								
							</div>

							<div class="card-header">
								<h5>F. Data Penemuan</h5>
							</div>
							<div class="card-body">						
								<div class="form-group row">
									<table class="table table-bordered">
										<thead>
											<tr bgcolor='yellow'>
												<th colspan="2"><b>Hasil Tes Urin</th>
													<th width="10%" align="center"><b>Positif</th>
														<th><b>Barang Bukti yang Ditemukan</th>
														</tr>
													</thead>
													<tbody>											
														<tr>
															<td rowspan="6"><b>Jenis Zat</td>
																<td>AMP</td>
																<th width="10%" align="center">
																	<input name='cek_amp' type="checkbox">
																</td>																								
																<td rowspan="6">
																	<textarea rows="15" name="barang_bukti" <?php echo $read ?> class="form-control"><?php echo $tampil = ($row!='') ? $row->barang_bukti : "" ; ?></textarea>																										
																</td>
															</tr>
															<tr>
																<td>BZO</td>
																<th width="10%" align="center">
																	<input type="checkbox" name="cek_bzo">
																</td>												
															</tr>
															<tr>
																<td>COC</td>
																<th width="10%" align="center">
																	<input type="checkbox" name="cek_coc">
																</td>												
															</tr>
															<tr>
																<td>MET</td>
																<th width="10%" align="center">
																	<input type="checkbox" name="cek_met">
																</td>												
															</tr>
															<tr>
																<td>MOP</td>
																<th width="10%" align="center">
																	<input type="checkbox" name="cek_mop">
																</td>												
															</tr>
															<tr>
																<td>THC</td>
																<th width="10%" align="center">
																	<input type="checkbox" name="cek_thc">
																</td>												
															</tr>
														</tbody>
													</table>
												</div>
												<div class="form-group row">
													<label for="fname" class="col-sm-2 text-right control-label col-form-label">Asal Zat</label>
													<div class="col-sm-10">										
														<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->asal_zat : "" ; ?>" name="asal_zat" class="form-control" placeholder="Asal Zat">
													</div>									
												</div>
												<div class="form-group row">
													<label for="fname" class="col-sm-2 text-right control-label col-form-label">Pernah Menjalankan rehabilitasi?</label>
													<div class="col-sm-4">										
														<select class="form-control" name="pernah_rehab">
															<option <?php if($row!='' && $row->pernah_rehab=="") echo "selected" ?> value="">- pilih -</option>	
															<option <?php if($row!='' && $row->pernah_rehab=="Ya") echo "selected" ?>>Ya</option>
															<option <?php if($row!='' && $row->pernah_rehab=="Tidak") echo "selected" ?>>Tidak</option>
														</select>
													</div>									
													<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jenis Terapi</label>
													<div class="col-sm-4">										
														<select class="form-control" name="jenis_terapi">
															<option <?php if($row!='' && $row->jenis_terapi=="") echo "selected" ?> value="">- pilih -</option>	
															<option <?php if($row!='' && $row->jenis_terapi=="Rawat Jalan") echo "selected" ?>>Rawat Jalan</option>
															<option <?php if($row!='' && $row->jenis_terapi=="Rawat Inap") echo "selected" ?>>Rawat Inap</option>
														</select>
													</div>									
												</div>
												<div class="form-group row">
													<label for="fname" class="col-sm-2 text-right control-label col-form-label">Fasilitas Rehabilitasi</label>
													<div class="col-sm-10">										
														<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->fasilitas_rehabilitasi : "" ; ?>" name="fasilitas_rehabilitasi" class="form-control" placeholder="Fasilitas Rehabilitasi">
													</div>									
												</div>								
											</div>

											<div class="card-header">
												<h5>G. Data Pendukung</h5>
											</div>
											<div class="card-body">						
												<div class="form-group row">
													<label for="fname" class="col-sm-2 text-right control-label col-form-label">Dokumen Pendukung</label>
													<div class="col-sm-10">										
														<input type="file" <?php echo $read ?>  name="dokumen" class="form-control">
													</div>									
												</div>								
											</div>

											<span id="tampil_jenis">
												<div class="card-header">
													<h5>H. Data Penangkapan</h5>
												</div>
												<div class="card-body">						
													<div class="form-group row">
														<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jenis Penangkapan</label>
														<div class="col-sm-4">										
															<select class="form-control" name="jenis_penangkapan">
																<option <?php if($row!='' && $row->jenis_penangkapan=="") echo "selected" ?> value="">- pilih -</option>	
																<option <?php if($row!='' && $row->jenis_penangkapan=="DPO") echo "selected" ?>>DPO</option>
																<option <?php if($row!='' && $row->jenis_penangkapan=="TO") echo "selected" ?>>TO</option>
																<option <?php if($row!='' && $row->jenis_penangkapan=="Razia") echo "selected" ?>>Razia</option>
																<option <?php if($row!='' && $row->jenis_penangkapan=="Lain-lain") echo "selected" ?>>Lain-lain</option>
															</select>
														</div>									
													</div>								
													<div class="form-group row">
														<label for="fname" class="col-sm-2 text-right control-label col-form-label">Tempat Penangkapan</label>
														<div class="col-sm-10">										
															<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->tempat_penangkapan : "" ; ?>" name="tempat_penangkapan" class="form-control" placeholder="Tempat Penangkapan">																
														</div>									
													</div>
													<div class="form-group row">
														<label for="fname" class="col-sm-2 text-right control-label col-form-label">Waktu Penangkapan</label>
														<div class="col-sm-4">										
															<input id="datepicker-autoclose" type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->tgl_penangkapan : "" ; ?>" name="tgl_penangkapan" class="form-control" placeholder="Tgl Penangkapan">																
														</div>									
														<label for="fname" class="col-sm-2 text-right control-label col-form-label">Jam</label>
														<div class="col-sm-4">										
															<input type="time" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->jam_penangkapan : "" ; ?>" name="jam_penangkapan" class="form-control" placeholder="Jam Penangkapan">																
														</div>									
													</div>								
													<div class="form-group row">
														<label for="fname" class="col-sm-2 text-right control-label col-form-label">Modus Operandi Penyalahgunaan</label>
														<div class="col-sm-10">										
															<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->modus_operandi : "" ; ?>" name="modus_operandi" class="form-control" placeholder="Modus Operandi Penyalahgunaan">																
														</div>									
													</div>
												</div>													
											</span>										

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
									<h5>Data Pasca Rehabilitas</h5>
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
													<th>Nama Pasca Rehabilitas</th>
													<th>Tgl Daftar</th>
													<th>Status</th>											
													<th>Keterangan</th>
													<th width="10%">Aksi</th>											
												</tr>
											</thead>
											<tbody>
												<?php 
												$no=1;
												foreach ($dt_pasca_rehabilitas->result() as $row) {
													echo "
													<tr>
													<td>$no</td>
													<td><a href='proses/pasca_rehabilitas/detail?id=$row->id_staf'>$row->id</a></td>
													<td>$row->nama_lengkap</td>
													<td>$row->instansi</td>
													<td>$row->nama_pasca_rehabilitas</td>
													<td>$row->tgl_daftar</td>											
													<td>$row->status</td>
													<td>$row->pekerjaan</td>
													<td>"; ?>
													<a class='btn btn-info btn-sm' href='proses/pasca_rehabilitas/edit?id=<?php echo $row->id_staf ?>'><i class='fa fa-edit'></i></a>
													<a class='btn btn-danger btn-sm' onclick="return confirm('Anda yakin?')" href='proses/pasca_rehabilitas/delete?id=<?php echo $row->id_staf ?>'><i class='fa fa-trash'></i></a>
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
			url : "<?php echo site_url('proses/pasca_rehabilitas/ambil_kab')?>",
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
			url : "<?php echo site_url('proses/pasca_rehabilitas/ambil_kec')?>",
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
			url : "<?php echo site_url('proses/pasca_rehabilitas/ambil_kel')?>",
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
		var jenis_pasca_rehabilitas  = $("#jenis_pasca_rehabilitas").val();   
		if(jenis_pasca_rehabilitas=='Compulsory'){
			$("#tampil_jenis").show();						
		}else{
			$("#tampil_jenis").show();
		}
	}
</script>

