	<div id="deleteUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Hapus Pengguna</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Apakah Anda yakin mau menghapus pengguna ini?</p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Tunda" id="btnCloseDelete">
						<input type="button" class="btn btn-danger" value="Hapus" id="btnDelete">
					</div>
					
					<input type="hidden" id="userDeleteId" />
				</form>
			</div>
		</div>
	</div>
	<script>
		//fungsi ini dijalankan ketika ikon delete ditekan
		$(document).on("click",".delete",function(event){
			key = $(this).attr("key"); //dapatkan id user
			
			setTimeout(function(){
				$("#userDeleteId").val(key);
				$("#deleteUserModal").show();
			}, 500);
		});	
	
		//fungsi ini dijalankan ketika tombol delete ditekan
		$("#btnDelete").click(function(){
			//kirim data ke server
			$.post( '<?php echo base_url(); ?>api/delete_user'
				, {
					id: $("#userDeleteId").val()
				} , function(data) {
					if(data.saved == 1){ //jika user berhasil dihapus
						alert(data.msg); //tampilkan pesan ke user
						location.reload(); //muat ulang halaman web
					}else{ //jika user tidak berhasil dihapus
						alert(data.msg); //tampilkan pesan ke user
					}
			   } , 'json'
			);	
			
			$("#btnCloseDelete").click();
		});
	</script>