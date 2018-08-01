	<div id="editAdminModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">			
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Edit Admin</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" required id="username_edit"/>
						</div>	

						<div class="form-group">
							<label>Kata Sandi</label>
							<input type="password" class="form-control" required id="passEdit"/>
						</div>	
					</div>				
					<div class="modal-footer" id="modal-footer-edit">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Tunda" id="btnCloseEdit">
						<input type="button" class="btn btn-success" value="Edit" id="btnSaveEdit">
					</div>
					
					<input type="hidden" value="0" id="adminEditId"/>
				</form>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>js/md5.min.js"></script>
	<script>
		$(document).ready(function(){  //ketika halaman web sudah dimuat seutuhnya
			$("#btnSaveEdit").click(function(){ //menjalankan fungsi ketika tombol dengan id btnSaveEdit ditekan
				
				if($("#username_edit").val().trim() == ""){ //jika username belum diisi, tampilkan pesan error
					alert("Mohon isi username");
					return;
				}
				
				$.post( '<?php echo base_url(); ?>api/edit_admin' //kirim data ke server, dengan url ini.
					, {
						id: $("#adminEditId").val() //kirim parameter ke server, dari nilai inputan id adminEditId (tipe inputan hidden)
						, username: $("#username_edit").val() //kirim parameter username ke server, dari nilai inputan id username_edit (tipe inputan teks)
						, pass: md5($("#passEdit").val()) //kirim pass username ke server, dari nilai inputan id passEdit (tipe inputan password). password dienkripsi menggunakan md5
					} , function(data) {
						if(data.saved == 1){
							alert(data.msg); //tampilkan pesan dari server
							location.reload();//muat ulang halaman web ini.
						}else{
							alert(data.msg); //tampilkan pesan dari server
						}
				   } , 'json'
				);	
			});
			
			$(document).on("click",".edit",function(event){ //ketika elemen (link, tombol, dsb) dengan class "edit" ditekan, jalankan fungsi ini
				
				admin_id = $(this).attr("key"); //dapatkan admin_id dari attribut key
				
				username = $("#tr-"+admin_id+" > .username").html(); //dapatkan username dari tabel
				name = $("#tr-"+admin_id+" > .name").html(); //dapatkan name dari tabel
				
				setTimeout(function(){
					
					$("#adminEditId").val(admin_id); //set inputan id adminEditId (tipe hidden)
					$("#username_edit").val(username); //set inputan id username_edit (tipe teks);
								
				}, 500);
			});
		});
	</script>