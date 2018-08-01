<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Pendaftaran</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin">
      <img class="mb-4" src="<?php echo base_url(); ?>images/email_logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Mohon Login</h1>
      <label for="inputName" class="sr-only">Nama</label>
      <input type="text" id="inputName" name="name" class="form-control" placeholder="Email address" required="" autofocus="" style="margin-bottom:5px !important;">
      <label for="inputPassword" class="sr-only">Kata Sandi</label>
      <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required="">
      <button class="btn btn-lg btn-primary btn-block" type="button" id="btn_login">Login</button>
      <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
    </form>
  
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url(); ?>js/md5.min.js"></script>
	<script>
		$(document).ready(function(){    //ketika halaman web sudah dimuat seutuhnya
			
			 //fungsi ini dijalankan ketika tombol login ditekan
			$("#btn_login").click(function(){
				
				if($("#inputName").val().trim() == ""){ //jika inputan nama kosong
					//tampilkan pesan ke user
					alert("Mohon isi nama");
				}
								
				if($("#inputPassword").val().trim() == ""){ //jika inputan password kosong
					//tampilkan pesan ke user
					alert("Mohon isi kata sandi");
				}				
				
				//kirim data login ke server
				$.post( '<?php echo base_url(); ?>api/login'
					, {
						name: $("#inputName").val() //kirim data nama yang diinput user
						, pass: md5($("#inputPassword").val())  //enkripsi password yang diinput user dengan metode md5
					}
					, function(data) {
						if(data.isExists == 1){ //jika user ada
							window.location = "<?php echo base_url(); ?>page/home"; //ubah lokasi website ke halaman utama
						}else{
							alert("Maaf, login gagal. Username / password salah");
						}
				   },
				   'json'
				);				
			});
		});
	</script>
</body></html>