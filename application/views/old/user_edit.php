	<div id="editUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">			
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Edit Pengguna</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" required id="username_edit"/>
						</div>					
						<div class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control" required id="name_edit"/>
						</div>							
					</div>				
					<div class="modal-footer" id="modal-footer-edit">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Tunda" id="btnCloseEdit">
						<input type="button" class="btn btn-success" value="Edit" id="btnSaveEdit">
					</div>
					
					<input type="hidden" value="0" id="userEditId"/>
				</form>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){  //ketika halaman web sudah dimuat seutuhnya
			//fungsi ini dijalankan ketika tombl Edit ditekan
			$("#btnSaveEdit").click(function(){
				
				if($("#username_edit").val().trim() == ""){ //jika inputan username dikosongi
					//tampilkan pesan ke user
					alert("Mohon isi username");
					return;
				}
				
				if($("#name_edit").val().trim() == ""){ //jika inputan nama dikosongi
					//tampilkan pesan ke user
					alert("Mohon isi nama");
					return;
				}
				
				//kirim data ke server
				$.post( '<?php echo base_url(); ?>api/edit_user'
					, {
						id: $("#userEditId").val()
						, username: $("#username_edit").val()
						, name: $("#name_edit").val()
					} , function(data) {
						if(data.saved == 1){ //jika data berhasil diedit
							alert(data.msg); //tampilkan pesan ke user
							location.reload(); //muat ulang halaman web
						}else{ //jika data tidak berhasil diedit
							alert(data.msg); //tampilkan pesan ke user
						}
				   } , 'json'
				);	
			});
			
			//fungsi ini dijalankan ketika ikon edit ditekan
			$(document).on("click",".edit",function(event){
				
				user_id = $(this).attr("key"); //dapatkan id pengguna
				
				username = $("#tr-"+user_id+" > .username").html(); //dapatkan username
				name = $("#tr-"+user_id+" > .name").html(); //dapatkan nama pengguna
				
				setTimeout(function(){
					
					$("#userEditId").val(user_id);
					$("#username_edit").val(username);
					$("#name_edit").val(name);
								
				}, 500);
			});
		});
	</script>