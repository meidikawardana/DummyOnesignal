<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Atur Pengguna - Pendaftaran</title>
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
			<li class="nav-item active">
			  <a class="nav-link" href="<?php echo base_url(); ?>page/manage_user">Atur Pengguna <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="<?php echo base_url(); ?>page/manage_admin">Atur Admin</a>
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
                    <div class="col-sm-6">
						<h2>Atur <b>Pengguna</b></h2>
					</div>
					<div class="col-sm-6" id="btnAdd">
						<a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tambah Pengguna</span></a>					
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Kata Sandi Mula2</th>
						<th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="list">
                </tbody>
            </table>			
			<div class="table-title">
                <div class="row">				
					<div class="col-sm-12" id="btnAdd2">
						<a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tambah Pengguna</span></a>					
					</div>
                </div>
            </div>
		</div>
    </div>
	
	<script>
		//fungsi ini untuk meminta data ke server
		function load_data(){
			$.post( '<?php echo base_url(); ?>Api/load_user', {}, function(data) {
					data.forEach(function(item, index){ //untuk setiap baris data dari server
						add_data_table(item.id, item.username, item.name, item.pass_default); //tampilkan per baris					
					})
			   },
			   'json'
			);	
		}
		
		//fungsi ini untuk menampilkan per baris data ke tabel
		function add_data_table(id, username, name, pass_default){
							
			row_str = ''
			+' <tr id="tr-'+id+'">'
			+'	<td class="username">'+username+'</td>'
			+'	<td class="name">'+name+'</td>'
			+'	<td class="pass_default">'+pass_default+'</td>'				
			+'	<td>'
			
			+'		<a href="#editUserModal" class="edit" data-toggle="modal" key="'+id+'"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>'
			+'		<a href="#deleteUserModal" class="delete" data-toggle="modal" key="'+id+'"><i class="material-icons" data-toggle="tooltip" title="Hapus">&#xE872;</i></a>'
			+'	</td>'
			+' </tr>';			
			
			$("#list").append(row_str); //tambahkan baris data ke tampilan tabel
		}	
		
		$(document).ready(function(){  //ketika halaman web sudah dimuat seutuhnya
			//minta data ke server & tampilkan ke tabel
			load_data();
			
			$("#btn_logout").click(function(){ //ketika tombol logout diklik
				window.location = "<?php echo base_url(); ?>page/logout"; //ubah lokasi website ke halaman logout
			});			
			
			$("#btnAdd2").click(function(){	//ketika tombol "Tambah Pengguna" yang di bawah diklik			
				
				$("#btnAdd").click(); //klik tombol Tambah Pengguna yang di atas secara otomatis
			});
			
		});
	</script>                               		                            