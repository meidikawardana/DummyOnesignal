<script src="https://www.gstatic.com/firebasejs/5.3.0/firebase.js"></script>
<script>
  //menginisialisasi firebase
  var config = {
    apiKey: "AIzaSyBJSb-gqcsePjMWWPXwjmJCXMvSNoBuj0k",
    authDomain: "pendaftaran-happyrobo.firebaseapp.com",
    databaseURL: "https://pendaftaran-happyrobo.firebaseio.com",
    projectId: "pendaftaran-happyrobo",
    storageBucket: "pendaftaran-happyrobo.appspot.com",
    messagingSenderId: "767311479049"
  };
  firebase.initializeApp(config);
  
	//mendapatkan obyek database firebase
  	var database = firebase.database();	  
</script>