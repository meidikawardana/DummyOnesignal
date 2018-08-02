<!--
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dummy Onesignal</title>
	<style>
		body {
			 font-family: Arial;
		}
	</style>
</head>

<body>
[Dummy Onesignal]
</body>

</html>
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dummy Onesignal Backend</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <style>
	body{
		padding:16px;
	}
  </style>
</head>
<body>

<div class="container">
	<!--
	  <div class="row">
		<div class="col-sm-12">
		  <h3>Kirim notifikasi ke hape</h3>
		  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
		  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
		</div>
	  </div>
	-->
	
  <form id="form">
    <div class="form-group">
      <label for="email">Target User</label>
	  <select class="form-control" id="user_id">
		<option value="0"> -- Pilih User -- </option>
		<?php foreach($users as $a_user){ ?>
			<option value="<?php echo $a_user->id; ?>"><?php echo $a_user->name; ?></option>
		<?php } ?>
	  </select>
    </div>
	<div class="form-group">
      <label for="email">Notification title</label>
      <input type="text" class="form-control" id="title" placeholder="Enter notification title" name="title">
    </div>
	<div class="form-group">
      <label for="email">Notification message</label>
      <input type="text" class="form-control" id="message" placeholder="Enter notification message" name="message">
    </div>		
    <button type="button" class="btn btn-primary" id="btnSend">Submit</button>
  </form>	
</div>
	<script>
		$(document).ready(function(){
			$("#btnSend").click(function(){
				
				if($("#user_id").val() == 0){
					alert("Mohon pilih user untuk dikirimi notifikasi");
					return;
				}
				
				//simpan data ke server
				$.post( '<?php echo base_url(); ?>Api/send_notification'
					, {
						user_id: $("#user_id").val()
						, title: $("#title").val()
						, message: $("#message").val()
					}
					, function(data) {
						
						console.log(data);
						
						data_json = JSON.parse(data);
						
						if (typeof data_json.id !== 'undefined' && typeof data_json.errors === 'undefined') {
							alert("sukses mengirim notifikasi");
						}else{
							alert("gagal mengirim notifikasi");
						}
						
						// if(data.saved == 1){ //jika data berhasil disimpan
							// alert(data.msg); //tampilkan pesan ke user
							// location.reload(); //muat ulang halaman web
						// }else{ //jika data gagal disimpan
							// alert(data.msg);  //tampilkan pesan ke user
						// }
				   },
				   'json'
				);
			});
		});
	</script>
</body>
</html>
