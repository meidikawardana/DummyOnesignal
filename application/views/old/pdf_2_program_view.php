<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Formulir Pendaftaran Program BPJS Ketenagakerjaan TK Mandiri / BPU</title>
		<style>
			body{
				font-family: Arial, Helvetica, sans-serif;	
				font-size:large;
			}			
		</style>
	</head>
	<body>
		<h2 style="text-align:center">Formulir Pendaftaran Program BPJS Ketenagakerjaan TK Mandiri / BPU</h2>
		<p>
			Pekerja Bukan Penerima Upah adalah pekerja yang melakukan kegiatan atau usaha ekonomi secara mandiri untuk memperoleh penghasilan dari kegiatan atau usahanya tersebut		
		</p>
		
		<table>
			<tr>
				<td>Nama</td>
				<td>:&nbsp;</td>
				<td colspan="3"><?php echo $doc->nama; ?></td>				
			</tr>
			<tr>
				<td>No. KTP / NIK</td>
				<td>:&nbsp;</td>
				<td colspan="3"><?php echo $doc->nomor_identitas; ?></td>				
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:&nbsp;</td>
				<td colspan="3"><?php echo $doc->tanggal_lahir; ?></td>				
			</tr>
			<tr>
				<td>Dasar Penghasilan</td>
				<td>:&nbsp;</td>
				<td colspan="3">Rp <?php echo $doc->upah_display; ?></td>				
			</tr>
			<tr>
				<td>Pekerjaan 1</td>
				<td>:&nbsp;</td>
				<td colspan="3"><?php echo $doc->pekerjaan1; ?></td>				
			</tr>
			<tr>
				<td>Pekerjaan 2</td>
				<td>:&nbsp;</td>
				<td colspan="3"><?php echo $doc->pekerjaan2; ?></td>				
			</tr>
			<tr>
				<td valign="top">Lokasi Pekerjaan</td>
				<td valign="top">:&nbsp;</td>
				<td colspan="3">Provinsi <?php echo $doc->provinsi; ?>&nbsp;&nbsp;&nbsp;Kota/Kabupaten <?php echo $doc->lokasi_pekerjaan; ?>
				</td>
			</tr>
			<tr>
				<td>No. Handphone</td>
				<td>:&nbsp;</td>
				<td colspan="3"><?php echo $doc->handphone; ?></td>	
			</tr>
			<tr>
				<td>Email</td>
				<td>:&nbsp;</td>
				<td colspan="3"><?php echo $doc->email; ?></td>	
			</tr>
			<tr>
				<td>Program yang diikuti</td>
				<td>:&nbsp;</td>
				<td colspan="3"><?php echo $doc->kode_paket; ?></td>	
			</tr>
			<tr>
				<td valign="top">Rincian Pembayaran</td>
				<td valign="top">:&nbsp;</td>
				<td colspan="3">
					<table>
						<tr>
							<td>JKM</td>
							<td>=&nbsp;</td>
							<td>Rp <?php echo $doc->jkm; ?> (fix) </td>
						</tr>
						<tr>
							<td>JKK</td>
							<td>=&nbsp;</td>
							<td>Rp <?php echo $doc->upah_display; ?> * 1% = Rp <?php echo $doc->jkk; ?></td>
						</tr>						
					</table>
				</td>	
			</tr>
			<tr>
				<td>Masa Kepesertaan</td>
				<td>:&nbsp;</td>
				<td colspan="3"><?php echo $doc->bulan_iuran; ?> Bulan</td>	
			</tr>			
			<tr>				
				<td>Total Pembayaran</td>
				<td>:&nbsp;</td>
				<td colspan="3">(JKM + JKK) * Masa Kepesertaan  = Rp <?php echo $doc->total; ?></td>	
			</tr>
			<tr>
				<td>Sumber Pembayaran</td>
				<td>:&nbsp;</td>
				<td colspan="3"><?php echo $doc->sumber_pembayaran; ?></td>	
			</tr>
		</table>
	
		<p>
			Bahwa demi melindungi diri saya, maka dengan ini saya mengajukan permohonan untuk mendaftarkan diri dalam perlindungan program Bukan Penerima Upah (BPU) BPJS Ketenagakerjaan Kendari. * (tanda tangan calon peserta)		
		</p>
				
		<table style="width:100%;background-color:white;">
			<tr>
				<td>
					<table>
						<tr>
							<td>
								<img src="<?php echo base_url(). $doc->foto_ktp; ?>" style="width:300px;"/>
							</td>
						</tr>
					</table>
				</td>			
				<td style="text-align:right;">					
					<table style="width:100%;">
						<tr>
							<td>Tanda Tangan</td>
						</tr>
						<tr>
							<td style="margin-bottom:15px;">
								<div style="width: 150px;overflow: hidden;background-color:white;display:inline-block;">
									<img src="<?php echo base_url(). $doc->foto_tandatangan; ?>" style="width: 154px;margin: -2px -2px -8px -2px;"/>	
								</div><br/>
								(&nbsp;<?php echo $doc->nama; ?>&nbsp;)
							</td>							
						</tr>						
					</table>					
				</td>
			</tr>
			<tr>
			</tr>
		</table>
	</body>
</html>