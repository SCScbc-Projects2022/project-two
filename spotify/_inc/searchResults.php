<?php

// TO DO:
// key: translate API setup from postman into useable JavaScript
// assign and use variables for client id, client secret, user id, token id, playlist, id, track id, device id, and context uri
// figure out PUT request to play song


// Start new instance of Curl server
$cURL = new CurlServer();

// Set URL for request to create new playlist
$req_url = `https://api.spotify.com/v1/users/${user_id}/playlists`;

// Start POST request via cURL
$create_playlist = $cURL->post_request($req_url, $_SESSION['spotify_token']->access_token);

// Set URL for request to add track to playlist
$req_url = `https://api.spotify.com/v1/playlists/${playlist_id}/tracks?uris=${track_id}`;

// Start POST request via cURL
$add_track = $cURL->post_request($req_url, $_SESSION['spotify_token']->access_token);

// Set URL for request to search Spotify
$req_url = `https://api.spotify.com/v1/search?query=track:${trackTitle}&type=track&include_external=audio&offset=0&limit=5`;

// Start GET request via cURL
$search_track = $cURL->get_request($req_url, $_SESSION['spotify_token']->access_token);

// Set URL for request to retrieve user's device ID
$req_url = `https://api.spotify.com/v1/me/player/devices`

// Start GET request via cURL
$device_id = $cURL->get_request($req_url, $_SESSION['spotify_token']->access_token);


// Set URL for request to activate user's device for API playback
$req_url = `https://api.spotify.com/v1/me/player`

// Start PUT request via cURL
$activate_device = $cURL->put_request($req_url, $_SESSION['spotify_token']->access_token);

// Set URL for request to play song
$req_url = `https://api.spotify.com/v1/me/player/play`

// Start PUT request to play song 

// include page header
include '_inc/html/header.php';

?>
<header>
  <script src="https://sdk.scdn.co/spotify-player.js"></script>
  <script>
    const token = '<?php echo $_SESSION['spotify_token']->access_token; ?>';
  </script>
  <script src="scripts/web_playback.js"></script>
</header>

<body>
  <div class="grid-container" id="searchResults-container">
    <h2>Search results:</h2>
    <ol>
      <li>
        <!-- for each search result item create list item and populate track title -->
        <?php
        foreach ($search_track as $content_value) {
          if (is_array($content_value)) {
            // echo '<pre>';
            // echo print_r($content_value);
            // echo '</pre>;

            foreach ($content_value as $value) {
              echo "<div class='grid_item">;
              echo "Song: $value->name <br/>";
              echo "<input type='checkbox' class='song-checkbox' id='songCheckbox' label='confirm-song-checkbox'></input>";
              echo "<button type='submit' id='addSongButton' alt='add this song to your fermata and start writing' onclick=\"play_song('$value->uri')\">Compose</button>";
            }
          
          }
        }
        ?>
      </li>
    </ol>
    <p>Search for any song on Spotify!</p>
    <input class="search-input" type="text" id="searchResultsInput"></input>
    <button onclick="searchTrack();" alt="search spotify for track">Search Track</button>
  </div>
</body>
<?php

// page footer
include '_inc/html/footer.php';