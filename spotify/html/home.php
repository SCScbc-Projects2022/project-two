<?php
// Include page header
include '_inc/html/header.php';
?>
<div class="container" id="home_container">
  <p><img src="images/logo.png" alt="fermata logo"></p>
  <p><button onclick="userLoginRequest();">Login</button><p>
</div>

<script>
  // Login button handler
  const userLoginRequest = () => {
    let loginUri = 'https://accounts.spotify.com/authorize' +
      '?client_id=<?php echo $__app_client_id; ?>' +
      '&response_type=code' +
      '&redirect_uri=<?php echo $__app_client_id; ?>' +
      '&scope=streaming user-read-private';
      '&show_dialog=false';
    // debug
    // console.log(loginUri);

    //Open URL to request user login from Spotify
    window.open(loginUri, ' self')

  }
</script>