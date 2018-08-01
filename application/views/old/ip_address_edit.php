	<div id="editIpAddressModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">			
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Edit IP Address Server</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>IP Address Server</label>
							<input type="text" class="form-control" required id="ip_address_edit"/>
						</div>
					</div>				
					<div class="modal-footer" id="modal-footer-edit">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Tunda" id="btnCloseEdit">
						<input type="button" class="btn btn-success" value="Edit" id="btnSaveEdit">
					</div>
					
					<input type="hidden" value="0" id="ipAddressEditId"/>
				</form>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>js/md5.min.js"></script>
	<script>
		$(document).ready(function(){   //ketika halaman web sudah dimuat seutuhnya
		
			//fungsi ini dijalankan ketika tombol Edit diklik
			$("#btnSaveEdit").click(function(){
				
				if($("#ip_address_edit").val().trim() == ""){ //jika inputan ip address dikosongi
					
					//tampilkan pesan ke user
					alert("Mohon isi IP Address Server");
					return;
				}
				
				//menyimpan data ip address ke server
				$.post( '<?php echo base_url(); ?>api/edit_ip_address'
					, {
						id: $("#ipAddressEditId").val()
						, ip_addr: $("#ip_address_edit").val()
					} , function(data) {
						if(data.saved == 1){ //jika ip address sukses disimpan di server
							//tampilkan pesan ke user
							alert(data.msg);
							//muat ulang halaman web
							location.reload();
						}else{ //jika gagal menyimpan ip address
							//tampilkan pesan ke user
							alert(data.msg);
						}
				   } , 'json'
				);	
			});
			
			//fungsi ini dijalankan ketika ikon edit diklik
			$(document).on("click",".edit",function(event){
				
				ip_address_id = $(this).attr("key"); //dapatkan id ip address
				
				ip_address = $("#tr-"+ip_address_id+" > .ip_addr").html(); //dapatkan ip address saat ini
				
				setTimeout(function(){
					
					$("#ipAddressEditId").val(ip_address_id);
					$("#ip_address_edit").val(ip_address);					
								
				}, 500);
			});
		});
	</script>