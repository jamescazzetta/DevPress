<!-- Primary navigation -->
<nav id="primary">
  <ul>
    <li <?php echo ($thetable == "kunden" ? 'class="current"': '' ); ?> >
      <a href="<?php echo $themeurl ?>/kunden.php">
        <span class="icon dashboard"></span>
        Kunden
      </a>
    </li>
    
    <li <?php echo ($thetable == "kunden_status" ? 'class="current"': '' ); ?> >
      <a href="<?php echo $themeurl ?>/kunden_status.php">
        <span class="icon pencil"></span>
       	Stati
      </a>
    </li>  

    <li <?php echo ($thetable == "rechnungen" ? 'class="current"': '' ); ?> >
      <a href="<?php echo $themeurl ?>/rechnungen.php">
        <span class="icon pencil"></span>
       	Rechnungen
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

