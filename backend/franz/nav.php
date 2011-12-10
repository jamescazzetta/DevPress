<!-- Primary navigation -->
<nav id="primary">
  <ul>
    <li <?php echo ($thetable == "kunden" ? 'class="current"': '' ); ?> >
      <a href="<?php echo $backendurl ?>/kunden.php">
        <span class="icon dashboard"></span>
        Kunden
      </a>
    </li>
    
    <li <?php echo ($thetable == "kunden_status" ? 'class="current"': '' ); ?> >
      <a href="<?php echo $backendurl ?>/kunden_status.php">
        <span class="icon pencil"></span>
       	Stati
      </a>
    </li>  

    <li <?php echo ($thetable == "rechnungen" ? 'class="current"': '' ); ?> >
      <a href="<?php echo $backendurl ?>/rechnungen.php">
        <span class="icon pencil"></span>
       	Rechnungen
      </a>
    </li>

	<li <?php echo ($thetable == "mediadb" ? 'class="current"': '' ); ?> >
      <a href="<?php echo $backendurl ?>/media.php">
        <span class="icon gallery"></span>
       	Media
      </a>
    </li>
	<li <?php echo ($thetable == "navigation" ? 'class="current"': '' ); ?> >
      <a href="navigation.php">
        <span class="icon chart"></span>
        <span class="badge">4</span>
        Navigation
      </a>
    </li>
  </ul>

  <input type="text" id="search" placeholder="Realtime search..." />
</nav>

<!-- Secondary navigation -->
<nav id="secondary">
  <ul>
    <li class="current"><a href="#">Main tab</a></li>
    <li><a href="#">Optional second tab</a></li>
    <li><a href="#">Optional third tab</a></li>
  </ul>
</nav>

<section id='content'>

