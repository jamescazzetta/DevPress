<!-- Primary navigation -->
<nav id="primary">
  <ul>
    <li <?php echo ($thetable == "antennen" ? 'class="current"': '' ); ?> >
      <a href="antennen.php">
        <span class="icon dashboard"></span>
        Antennen
      </a>
    </li>
    
    <li <?php echo ($thetable == "antennen_arte" ? 'class="current"': '' ); ?> >
      <a href="antennen_arte.php">
        <span class="icon pencil"></span>
        Antennen Arten
      </a>
    </li>
    
    <li <?php echo ($thetable == "antennen_bauformen" ? 'class="current"': '' ); ?> >
      <a href="antennen_bauformen.php">
        <span class="icon tables"></span>
        Antennen Bauformen
      </a>
    </li>

    <li <?php echo ($thetable == "navigation" ? 'class="current"': '' ); ?> >
      <a href="navigation.php">
        <span class="icon chart"></span>
        <span class="badge">4</span>
        Navigation
      </a>
    </li>
<!--
    <li>
      <a href="/notifications">
        <span class="icon modal"></span>
        Notifcations
      </a>
    </li>
    
    <li>
      <a href="/gallery">
        <span class="icon gallery"></span>
        Gallery
      </a>
    </li>

    <li>
      <a href="/buttons">
        <span class="icon anchor"></span>
        Icons/buttons
      </a>
    </li>    -->           
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

