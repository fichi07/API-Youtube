<?php
function get_CURL($url){
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($curl);
  curl_close($curl);
  
  return json_decode($result, true);
}

$result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UC0S6CWcmD7NYObWuU2BunVw&key=AIzaSyCOELkcl3R2Iv-6ORl69ZoHuVKZxxJxaSM');

$youtubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result['items'][0]['snippet']['title'];
$subscriber = $result['items'][0]['statistics']['hiddenSubscriberCount'];

//latest video
$urlLatesVideo ='https://www.googleapis.com/youtube/v3/search?key=AIzaSyCOELkcl3R2Iv-6ORl69ZoHuVKZxxJxaSM&channelId=UC0S6CWcmD7NYObWuU2BunVw&maxResults=3&order=date&part=snippet';
$result = get_CURL($urlLatesVideo);
$latestVideoId = $result['items'][0]['id']['videoId'];

$videos = [];
foreach($result['items'] as $video ){
  $videos[] = $video['id']['videoId'];
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
    integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

  <!-- My CSS -->
  <link rel="stylesheet" href="css/style.css">

  <title>19650039 Moch Wahyu Fitra Choiri</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">19650039 Moch Wahyu Fitra Choiri</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Youtube</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="instagram.php">Instagram</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Yt -->
  <section class="social bg-light" id="social">
    <div class="container">
      <div class="row pt-4 mb-4">
        <div class="col text-center">
          <h2>Youtube</h2>
        </div>
      </div>

      <hr>
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4">
              <img src="<?= $youtubeProfilePic; ?>" widht="200" class="rounded-circle img-thumbnail">

            </div>
            <div class="col-md-8">
              <h5>
                <?= $channelName; ?>
              </h5>
              <p>
                <?= $subscriber; ?> Subscriber
              </p>
              <div class="g-ytsubscribe" data-channelid="UC0S6CWcmD7NYObWuU2BunVw" data-layout="default"
                data-count="default">
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr><br>
      <div class="row mt-3 pb-3">
        <?php foreach($videos as $video) : ?>
        <div class="col">
          <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/<?= $video; ?>?rel=0" allowfullscreen></iframe>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
    crossorigin="anonymous"></script>
  <script src="https://apis.google.com/js/platform.js"></script>
</body>

</html>