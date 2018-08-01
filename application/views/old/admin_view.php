<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Atur Admin - Pendaftaran</title>
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
			<li class="nav-item active">
			  <a class="nav-link" href="<?php echo base_url(); ?>page/manage_admin">Atur Admin <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="<?php echo base_url(); ?>page/manage_ip_address">Atur IP Address Server</a>
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
						<h2>Atur <b>Admin</b></h2>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Username</th>                        
						<th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="list">
                </tbody>
            </table>
		</div>
    </div>
	
	<script>
		//fungsi ini untuk meminta data ke server
		function load_data(){
			$.post( '<?php echo base_url(); ?>Api/load_admin', {}, function(data) {
					data.forEach(function(item, index){ //dapatkan data per baris
						add_data_table(item.id, item.username); //lalu tampilkan data
					})
			   },
			   'json'
			);	
		}
		
		//fungsi ini untuk menampilkan data ke tabel
		function add_data_table(id, username){
							
			row_str = ''
			+' <tr id="tr-'+id+'">'
			+'	<td class="username">'+username+'</td>'
			+'	<td>'
			
			+'		<a href="#editAdminModal" class="edit" data-toggle="modal" key="'+id+'"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>'
			+'	</td>'
			+' </tr>';			
			$("#list").append(row_str); //tambahkan data ke tabel supaya ditampilkan
		}	
		
		$(document).ready(function(){ //ketika halaman web sudah dimuat seutuhnya
			load_data(); //tampilkan data dari server ke tabel
			
			$("#btn_logout").click(function(){ //ketika tombol logout diklik
				window.location = "<?php echo base_url(); ?>page/logout"; //ubah lokasi website ke halaman logout
			});			
			
		});
	</script>                               		                            