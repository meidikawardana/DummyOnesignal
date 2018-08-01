	<div id="searchPendaftaranModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">			
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Cari Data</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Yang Dicari</label>
							<select type="text" class="form-control" required id="objSearch">
								<option value="identity">KTP / NIK</option>
								<option value="name">Nama</option>
							</select>
						</div>	

						<div class="form-group">							
							<select type="text" class="form-control" required id="modeSearch">
								<option value="exact">Tepat seperti</option>
								<option value="beginswith">Diawali</option>
								<option value="like">Mengandung karakter</option>
								<option value="endswith">Diakhiri</option>
							</select>
						</div>
						
						<div class="form-group">
							<label>Kata / Penggalan Kata</label>
							<input type="text" class="form-control" required id="querySearch"/>
						</div>						
					</div>				
					<div class="modal-footer" id="modal-footer-search">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Tunda" id="btnCloseSearch">
						<input type="button" class="btn btn-success" value="Cari" id="btnDoSearch">
					</div>
									
				</form>
			</div>
		</div>
	</div>	
	<script>
		$(document).ready(function(){  //ketika halaman web sudah dimuat seutuhnya
			
			$("#btnDoSearch").click(function(){ //ketika tombol Cari Data ditekan
				
				query = $("#querySearch").val().toLowerCase(); //tampung kata yang dicari user
				
				if(query.trim() == ""){ //jika kata yg dicari user kosong
					//tampilkan pesan ke user
					alert("Mohon isi kata / penggalan kata");
					return;
				}
				
				//ubah lokasi halaman ke halaman hasil pencarian
				window.location = '<?php echo base_url(); ?>page/home/search/'+$("#objSearch").val()+'/'+$("#modeSearch").val()+'/'+encodeURIComponent(query);
			});
		});
	</script>