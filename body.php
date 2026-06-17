<main class="container">
  <div class="logo">
    <img src="<?php echo ftab("logo_web", "web_setting", "logo_web"); ?>" class="img-fluid" alt="logo rtp">
  </div>

  <!-- Slider main container -->
  <div class="slider-wrapper rounded-top shadow">
    <div class="running-text">
      <marquee scrollamount="3" direction="left">
        <?php echo ftab("pengumuman_web", "web_setting", "pengumuman_web"); ?></marquee>
    </div>
    <div class="swiper slider">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->

        <?php

        $sslide = "SELECT sliders FROM img_sliders";
        $qslide = mysqli_query($data, $sslide);
        $b = 0;
        if (mysqli_num_rows($qslide) > 0) {
          while ($fslide = mysqli_fetch_assoc($qslide)) {
            $slideimg = $fslide['sliders'];

            echo '<div class="swiper-slide">
                <img src="' . $slideimg . '" loading="lazy" class="slider-img rounded" alt="slider ' . $b++ . '">
                <div class="swiper-lazy-preloader"></div>
            </div>';
          }
        }

        ?>

      </div>

    </div>
  </div>

  <div class="row g-0">
    <div class="col d-grid">
      <button onclick='location.href="<?php echo ftab("link_daftarbo", "web_setting", "link_daftarbo"); ?>";'
        class="btn-credit">LOGIN</button>
    </div>

    <div class="col d-grid">
      <button onclick='location.href="<?php echo ftab("link_daftarbo", "web_setting", "link_daftarbo"); ?>";'
        class="btn-credit">DAFTAR</button>
    </div>

  </div>

  <div style="justify-content: flex-start;" id="icon-prov" class="icon-prov g-1">
    <div class="loader"></div>
  </div>

  <div class="bg-theme">

    <div class="d-flex justify-content-between">
      <div class="mt-3">
        <h6><i class="lni text-warning lni-timer"></i> Update RTP: <?php echo dayindo(); ?>,
          <?php echo date("d"); ?> <?php echo bulanindo(); ?> <?php echo date("Y"); ?></h6>
      </div>

      <div class="my-2">
        <button onclick="darkMode()" id="btn-colorscheme" class="btn btn-sm btn-light"><i id="icon-colorscheme"
            class="lni lni-sun"></i></button>
      </div>

    </div>

    <div class="row justify-content-center g-1">

      <?php

      // Game Selection
      $prov = '';
      if (isset($_GET['game'])) {
        $game = mysqli_real_escape_string($data, $_GET['game']);
        $prov = $game;
      } else {
        $prov = 'pp';
      }

      switch ($prov) {
        case 'jg':
          echo '
          <div class="col-12"><h4 class="title-game">JOKER GAMING SLOT LIVE RTP</h4>
          <h6><i class="lni lni-thumbs-up"></i> SUKA(5.0): <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i></h6>
        </div>';
          break;

        case 'pp':
          echo '
          <div class="col-12"><h4 class="title-game">PRAGMATIC PLAY SLOT LIVE RTP</h4>
              <h6><i class="lni lni-thumbs-up"></i> SUKA(5.9) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i></h6>
            </div>';
          break;

        case 'idn':
          echo '
            <div class="col-12"><h4 class="title-game">IDN Play SLOT LIVE RTP</h4>
                <h6><i class="lni lni-thumbs-up"></i> SUKA(5.0) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i></h6>
              </div>';
          break;

        case 'wmc':
          echo '<div class="col-12"><h4 class="title-game">WMC SLOT LIVE RTP</h4>
              <h6><i class="lni lni-thumbs-up"></i> SUKA(5.1) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>';
          break;

        case 'jili':
          echo '<div class="col-12"><h4 class="title-game">JILI SLOT LIVE RTP</h4>
              <h6><i class="lni lni-thumbs-up"></i> SUKA(4.7) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>';
          break;

        case 'pg':
          echo '<div class="col-12"><h4 class="title-game">POCKET GAMING SLOT LIVE RTP</h4>
              <h6><i class="lni lni-thumbs-up"></i> SUKA(5.8) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i></h6>
            </div>';
          break;

        case 'nolimit':
          echo '<div class="col-12"><h4 class="title-game">NOLIMIT SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(5.8) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i></h6>
            </div>';
          break;


        case 'gmw':
          echo '<div class="col-12"><h4 class="title-game">GMW SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(4.0) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>';
          break;

        case 'elottery':
          echo '<div class="col-12"><h4 class="title-game">E-LOTTERY GAMING SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.8) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>';
          break;

        case 'png':
          echo '<div class="col-12"><h4 class="title-game">PIONEER GAMING SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.8) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>';
          break;

        case 'tg':
          echo '<div class="col-12"><h4 class="title-game">TOP TREND GAMING SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.5) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'reevo':
          echo '<div class="col-12"><h4 class="title-game">REEVO SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.5) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'mg':
          echo '<div class="col-12"><h4 class="title-game">Micro Gaming SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(4) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'fastspin':
          echo '<div class="col-12"><h4 class="title-game">FAST SPIN SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(4) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'hb':
          echo '<div class="col-12"><h4 class="title-game">Habanero SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.5) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'playngo':
          echo '<div class="col-12"><h4 class="title-game">PLAYNGO SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(4.5) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'dragoon':
          echo '<div class="col-12"><h4 class="title-game">DRAGOON SOFT SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(4.5) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'ygg':
          echo '<div class="col-12"><h4 class="title-game">YGGDRASIL SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(2.9) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'playson':
          echo '<div class="col-12"><h4 class="title-game">PLAYSON SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(2.7) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'nagagames':
          echo '<div class="col-12"><h4 class="title-game">NAGA GAMES SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(2.7) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'boom':
          echo '<div class="col-12"><h4 class="title-game">BOOMING GAME SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.3) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'playtech':
          echo '<div class="col-12"><h4 class="title-game">PLAYTECH SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(4.2) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'kagaming':
          echo '<div class="col-12"><h4 class="title-game">KA GAMING SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(4.2) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'playstar':
          echo '<div class="col-12"><h4 class="title-game">PLAYSTAR SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.9) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'fat':
          echo '<div class="col-12"><h4 class="title-game">FATPANDA SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(2.3) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'booongo':
          echo '<div class="col-12"><h4 class="title-game">BOOONGO SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.0) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'sbo':
          echo '<div class="col-12"><h4 class="title-game">SBO SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.0) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'fs':
          echo '<div class="col-12"><h4 class="title-game">FAST SPIN SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.0) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'limag':
          echo '<div class="col-12"><h4 class="title-game">5G GAMING SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.3) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'sm':
          echo '<div class="col-12"><h4 class="title-game">SLOTMANIA LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.3) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'redtiger':
          echo '<div class="col-12"><h4 class="title-game">RED TIGER SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(4.3) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'netent':
          echo '<div class="col-12"><h4 class="title-game">NETENT SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(4.0) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'ais':
          echo '<div class="col-12"><h4 class="title-game">AIS SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.0) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;

        case 'gameplay':
          echo '<div class="col-12"><h4 class="title-game">GAMEPLAY SLOT LIVE RTP</h4>

              <h6><i class="lni lni-thumbs-up"></i> SUKA(3.7) : <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-warning"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i> <i class="lni lni-star-fill text-light"></i></h6>
            </div>
          ';
          break;
      }
      ?>

    </div>


    <div id="rtp-content" data-url="<?php echo ftab("link_daftarbo", "web_setting", "link_daftarbo"); ?>"
      class="row justify-content-center g-1">
      <div class="col-12 my-3">
        <div class="loader"></div>

        <div id="refreshPage" style="display: none;" class="text-center mx-auto">
          <p>Terlalu lama ? Tekan tombol Refresh dibawah ini:</p>
          <button onclick="location.reload()" class="btn btn-credit btn-sm">Refresh</button>
        </div>
      </div>

    </div>

  </div>

</main>

<footer class="container">
  <div class="mt-1 content-home">
    <?php echo ftab("slot_gacortexts", "change_text", "slot_gacortexts"); ?>
  </div>
</footer>

<button onclick="goUp()" id="btn-up" class="btn-up btn-sm btn btn-danger"><i
    class="lni lni-chevron-up-circle"></i></button>

<div class="nav-bottom">


  <div onclick="location.href='/'" class="col item-nav-bottom">
    <i class="lni lni-home"></i>
    <p>Home</p>
  </div>

  <div onclick='location.href="<?php echo ftab("link_promosi", "web_setting", "link_promosi") ?>";'
    class="col item-nav-bottom">
    <i class="lni lni-invest-monitor"></i>
    <p>Promosi</p>
  </div>

  <div onclick='location.href="<?php echo ftab("link_daftarbo", "web_setting", "link_daftarbo"); ?>";'
    class="col item-nav-bottom">
    <i class="lni lni-list"></i>
    <p>Daftar</p>
  </div>

  <div data-bs-toggle="modal" data-bs-target="#contact" class="col item-nav-bottom">
    <i class="lni lni-phone-set"></i>
    <p>Contact</p>
  </div>


</div>

<!-- Contact -->
<div class="modal fade" id="contact" tabindex="-1" aria-labelledby="contact" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-dark fs-5" id="contact">Hubungi Kami:</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-dark">
        <?php echo ftab("isi_kontak", "web_setting", "isi_kontak"); ?>
      </div>
    </div>
  </div>
</div>


<style>
  .loader {
    width: 32px;
    height: 32px;
    border: 4px solid rgba(255, 255, 255, 0.2);
    border-top-color: var(--g1);
    /* change color here */
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    /* optional centering */
    margin: 10px auto;
  }

  @keyframes spin {
    to {
      transform: rotate(360deg);
    }
  }
</style>

<script>
  setTimeout(() => {
    document.getElementById("refreshPage").style.display = "block";
  }, 10000);
</script>