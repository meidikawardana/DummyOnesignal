	<div id="addUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">			
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Tambah Pengguna</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" required id="username"/>
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control" required id="name"/>
						</div>
						<div class="form-group">
							<label>Kata Sandi</label>
							<input type="password" class="form-control" required id="pass"/>
						</div>
					</div>
					<div class="modal-footer" id="modal-footer-add">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Tunda" id="btnCloseAdd">
						<input type="button" class="btn btn-success" value="Tambahkan" id="btnSave">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url() ?>js/md5.min.js"></script>
	<script>
		//fungsi ini dijalankan ketika tombol Tambahkan ditekan
		$("#btnSave").click(function(){
			
			msg = ""; //buat variabel untuk menampung pesan ke user

			//jika inputan username dikosongi
			if($("#username").val().toString().trim().length == 0){
				//tambahkan pesan ke user
				msg += "Mohon isi username pengguna\n";
			}
			
			//jika inputan nama dikosongi
			if($("#name").val().toString().trim().length == 0){
				//tambahkan pesan ke user
				msg += "Mohon isi nama pengguna\n";
			}
			
			//jika inputan password dikosongi
			if($("#pass").val().toString().trim().length == 0){
				//tambahkan pesan ke user
				msg += "Mohon isi kata sandi\n";
			}
			
			//jika inputan kata sandi panjangnya kurang dari 3
			if($("#pass").val().toString().trim().length < 3){
				//tambahkan pesan ke user
				msg += "Kata sandi minimal 3 huruf\n";
			}				
			
			if(msg != ""){ //jika pesan ke user tidak kosong
				alert(msg); //tampilkan pesan
				return; //hentikan fungsi sampai di sini
			}
			
			//simpan data ke server
			$.post( '<?php echo base_url(); ?>Api/add_user'
				, {
					username: $("#username").val()
					, name: $("#name").val()
					, pass: md5($("#pass").val())
					, pass_default: $("#pass").val()
				}
				, function(data) {
					if(data.saved == 1){ //jika data berhasil disimpan
						alert(data.msg); //tampilkan pesan ke user
						location.reload(); //muat ulang halaman web
					}else{ //jika data gagal disimpan
						alert(data.msg);  //tampilkan pesan ke user
					}
			   },
			   'json'
			);
		});
		
		$('#btnAdd').click(function(){
			$("#username").val("");
			$("#name").val("");			
			$("#pass").val("");
		});
	</script>