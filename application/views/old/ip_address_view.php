<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Atur IP Address Android - Pendaftaran</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>css/index3.css">
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
			<li class="nav-item active">
			  <a class="nav-link" href="<?php echo base_url(); ?>page/manage_ip_address">Atur IP Address Android <span class="sr-only">(current)</span></a>
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
                    <div class="col-sm-12">
						<h2>Atur <b>IP Address Android</b></h2>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>IP Address</th>                        
						<th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="list">
                </tbody>
            </table>
		</div>
    </div>
	
	<?php
		echo $firebase_key_pendaftaran;
	?>
	
	<script>
		//minta data ip address ke server
		function load_data(){
			$.post( '<?php echo base_url(); ?>Api/load_ip_address', {}, function(data) {
					data.forEach(function(item, index){ //untuk setiap baris data
						add_data_table(item.id, item.ip_addr); //tampilkan data ke tabel
					})
			   },
			   'json'
			);	
		}
		
		//tampilkan data ke tabel
		function add_data_table(id, ip_addr){
							
			row_str = ''
			+' <tr id="tr-'+id+'">'
			+'	<td class="ip_addr">'+ip_addr+'</td>'
			+'	<td>'
			
			+'		<a href="#editIpAddressModal" class="edit" data-toggle="modal" key="'+id+'"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>'
			+'	</td>'
			+' </tr>';			
			$("#list").append(row_str); //tambahkan data ke tampilan tabel
			
			var aRef = database.ref('ip_address'); //dapatkan tabel ip_address dari firebase

			aRef.remove(); //hapus tabel ip_address di firebase
			
			aRef = database.ref('ip_address'); //buat tabel ip_address baru di firebase
			
			var newRef = aRef.push(); //buat 1 baris baru
			
			newRef.set({ //isi baris baru tersebut
				ip_addr : ip_addr //dengan ip address terbaru dari sini
				, key : newRef.key
			});
		}	
		
		$(document).ready(function(){   //ketika halaman web sudah dimuat seutuhnya
			//minta data dari server, lalu tampilkan ke tabel
			load_data();
			
			$("#btn_logout").click(function(){ //ketika tombol logout diklik
				window.location = "<?php echo base_url(); ?>page/logout"; //ubah lokasi website ke halaman logout
			});
		});
	</script>                               		                            