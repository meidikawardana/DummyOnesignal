<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home - Pendaftaran</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>css/index3.css">
	<style>
		.data_img{
			max-width: 400px;
			max-height: 300px;
		}
		
		.align-top {
			position: absolute;
			top: 16px;
			left: 4px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	  <a class="navbar-brand" href="<?php echo base_url()."page/home"; ?>">Pendaftaran</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-expanded="true">
		<span class="navbar-toggler-icon"></span>
	  </button>

		<div class="collapse navbar-collapse" id="navbarColor01">
		  <ul class="navbar-nav mr-auto">		  
			<li class="nav-item">
			  <a class="nav-link" href="<?php echo base_url(); ?>page/manage_user">Atur Pengguna</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="<?php echo base_url(); ?>page/manage_admin">Atur Admin</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="<?php echo base_url(); ?>page/manage_ip_address">Atur IP Address Android</a>
			</li>			
		  </ul>
		  <form class="form-inline">
			<button class="btn btn-info my-2 my-sm-0" type="button" id="btn_logout">Logout</button>
		  </form>
		</div>	  
	</nav>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-7">
						<h2>Data <b>Pendaftaran</b></h2>
					</div>
					<div class="col-sm-5">
						<a href="javascript:void(0)" class="btn btn-success" id="download-all-excel"><i class="fa">&#xf1c3;</i> <span>Download Rekapan (Excel)</span></a>					
						&nbsp;<a href="#searchPendaftaranModal" class="btn btn-success" id="search" data-toggle="modal"><i class="material-icons">&#xe8b6;</i> <span>Cari</span></a>					
					</div>
                </div>
				<?php
					if($action == "search"){
				?>
					<div class="row" style="margin-top:12px;">
						<div class="col-sm-12" id="search_div">
						</div>
					</div>
				<?php } ?>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="min-width:130px">Nama</th>
                        <th>Data</th>                        
						<th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="list">
                </tbody>
            </table>			
			<div class="table-title">
                <div class="row">				
					<div class="col-sm-12" id="btnAdd2">
						<a href="javascript:void(0)" class="btn btn-success" id="download-all-excel2"><i class="fa">&#xf1c3;</i> <span>Download Rekapan (Excel)</span></a>					
						&nbsp;<a href="javascript:void(0)" class="btn btn-success" id="search2"><i class="material-icons">&#xe8b6;</i> <span>Cari</span></a>
					</div>
                </div>
            </div>
		</div>
    </div>
	
	<script>		
		//fungsi ini untuk meminta data ke server
		function load_data(){
			
			<?php if($action == "search"){ ?> //jika ada data yg sedang dicari user
						action = "/<?php echo $action; ?>"; //tampung aksi user
						obj = "/<?php echo $obj; ?>"; //tampung obyek yang dicari (misal nomor ktp atau nama)
						mode = "/<?php echo $mode; ?>"; //tampung mode pencarian (persis sama, diawali, diakhiri, dsb)
						query = "/"+encodeURIComponent("<?php echo $query; ?>"); //tampung kata yg dicari user
						
						obj_display = ""; //ini variabel untuk menampilkan obyek yg dicari user
						
						if(obj == "/identity"){ //jika obyek yg dicari user adalah identity
							obj_display = "KTP / NIK"; //tampilkan obyek sebagai KTP / NIK
						}else if(obj == "/name"){ //jika obyek yang dicari user adalah name
							obj_display = "Nama" //tampilkan obyek sebagai Nama
						}
						
						search_clause = ""; //ini variabel untuk menampilkan mode pencarian
						
						if(mode == "/exact"){ //jika mode adalah exact
							search_clause = "tepat seperti";
						}else if(mode == "/beginswith"){ //jika mode adalah beginswith
							search_clause = "diawali";
						}else if(mode == "/like"){ //jika mode adalah like
							search_clause = "mengandung karakter";
						}else if(mode == "/endswith"){ //jika mode adalah endswith
							search_clause = "diakhiri";
						}
						
						//tampilkan pesan ke user
						$("#search_div").html("hasil pencarian <b>"+obj_display+" "+search_clause+" <?php echo $query;?></b> adalah sebagai berikut. <span id='jumlah_pencarian'></span>");
			<?php }else{ ?> //jika user sedang tidak mencari data
			
						//kosongi semua variabel yang berkaitan dengan pencarian
						action = "";
						obj = "";
						mode = "";
						query = "";			
			<?php } ?>
			
			//minta data ke server
			$.post( '<?php echo base_url(); ?>Api/load_data'+action+obj+mode+query, {}, function(data) {
				
					count = 0; //variabel untuk menghitung jumlah baris data dari server
					data.forEach(function(item, index){ //untuk setiap baris data 
						add_data_table( //tampilkan data
							item.id, item.nama
							, item.nomor_identitas, item.tanggal_lahir, item.handphone, item.email
							, item.pekerjaan1, item.pekerjaan2, item.lokasi_pekerjaan, item.upah, item.kode_paket
							, item.bulan_iuran, item.sumber_pembayaran, item.foto_ktp, item.foto_tandatangan
						);
						count++; //hitung jumlah baris data						
					});
					
					//tampilkan jumlah baris data dari server
					$("#jumlah_pencarian").html("Jumlah ditemukan: "+count);
			   },
			   'json'
			);	
		}
		
		//tampilkan data ke tabel
		function add_data_table(
			id, nama
			, nomor_identitas, tanggal_lahir, handphone, email
			, pekerjaan1, pekerjaan2, lokasi_pekerjaan, upah, kode_paket
			, bulan_iuran, sumber_pembayaran, foto_ktp, foto_tandatangan
		){
							
			row_str = ''
			+' <tr id="tr-'+id+'" style="min-width:130px">'
			+'	<td class="nama" style="position:relative;"><div class="align-top">'+nama+'</div></td>'
			+'	<td class="data">'
					+'<table>'
						+'<tr>'	
							+'<td><b>Nomor Identitas</b></td>'
							+'<td>'+nomor_identitas+'</td>'
							+'<td><b>Tanggal Lahir</b></td>'
							+'<td>'+tanggal_lahir+'</td>'
						+'</tr>'	
						+'<tr>'
							+'<td><b>No. Hape</b></td>'
							+'<td>'+handphone+'</td>'
							+'<td><b>Email</b></td>'
							+'<td>'+email+'</td>'
						+'</tr>'
						+'<tr>'						
							+'<td><b>Pekerjaan 1</b></td>'
							+'<td>'+pekerjaan1+'</td>'
							+'<td><b>Pekerjaan 2</b></td>'
							+'<td>'+pekerjaan2+'</td>'											
						+'</tr>'
						+'<tr>'
							+'<td><b>Lokasi Pekerjaan</b></td>'
							+'<td>'+lokasi_pekerjaan+'</td>'
							+'<td><b>Upah</b></td>'
							+'<td>'+upah+'</td>'											
						+'</tr>'						
						+'<tr>'
							+'<td><b>Kode Paket</b></td>'
							+'<td>'+kode_paket+'</td>'
							+'<td><b>Bulan Iuran</b></td>'
							+'<td>'+bulan_iuran+'</td>'										
						+'</tr>'
						+'<tr>'
							+'<td><b>Sumber Pembayaran</b></td>'
							+'<td>'+sumber_pembayaran+'</td>'
							+'<td></td>'
							+'<td></td>'										
						+'</tr>'						
						+'<tr>'
							+'<td colspan="2"><img class="data_img" src="<?php echo base_url(); ?>'+foto_ktp+'"/></td>'							
							+'<td colspan="2"><img class="data_img" src="<?php echo base_url(); ?>'+foto_tandatangan+'"/></td>'
						+'</tr>'						
					+'</table>'
			+'  </td>'			
			+'	<td style="position:relative;">'
					+'<div class="align-top">'
			+'		<a href="javascript:void(0)" class="downloadPDF" data-toggle="modal" key="'+id+'" style="color:#F44336"><i class="fa" data-toggle="tooltip" title="Lihat PDF">&#xf1c1;</i></a>'			
			+'		<a href="javascript:void(0)" class="downloadExcel" data-toggle="modal" key="'+id+'" style="color:#048204"><i class="fa" data-toggle="tooltip" title="Download Excel">&#xf1c3;</i></a>'
					+'</div>'
			+'	</td>'
			+' </tr>';			
			$("#list").append(row_str); //tambahkan baris data ke tampilan tabel
		}	
		
		$(document).ready(function(){  //ketika halaman web sudah dimuat seutuhnya
			load_data();//tampilkan data dari server ke tabel
			
			$("#btn_logout").click(function(){ //ketika tombol logout diklik
				window.location = "<?php echo base_url(); ?>page/logout"; //ubah lokasi website ke halaman logout
			});			
			
			$(document).on("click",".downloadPDF",function() { //ketika ikon download PDF di suatu baris diklik
				id = $(this).attr("key"); //dapatkan id dokumen di baris tersebut
				window.open("<?php echo base_url(); ?>page/pdf/"+id); //lalu buka halaman web baru untuk menampilkan pdf
			});
		
			$(document).on("click",".downloadExcel",function() { //ketika ikon download excel di suatu baris diklik
				id = $(this).attr("key"); //dapatkan id dokumen di baris tersebut
				window.open("<?php echo base_url(); ?>page/download_excel/"+id); //lalu tampilkan dialog untuk menyimpan file excel
			});
			
			$("#download-all-excel").click(function(){ //ketika tombol download rekapan diklik
				window.open("<?php echo base_url(); ?>page/download_all_excel"); //tampilkan dialog untuk menyimpan file rekapan
			});
			
			$("#download-all-excel2").click(function(){ //ketika tombol download rekapan yang ada di bagian bawah diklik
				$("#download-all-excel").click(); //klik tombol download rekapan yang di atas secara otomatis
			});
			
			$("#search2").click(function(){ //ketika tombol pencarian yang dibawah diklik
				$("#search").click(); //klik tombol pencarian yang di atas secara otomatis
			});						
		});
	</script>                               		                            