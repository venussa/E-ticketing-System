 <nav class="navbar navbar-expand-md navbar-dark bg-light fixed-top" style="z-index: 998">

  <button onClick="show_navbar()" style="border:1px #f5f5f5 solid;color:#f5f5f5" class="navbar-toggler" type="button" >
    <span class="navbar-toggler-icon" style="color:#f5f5f5"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbar">

    <ul class="navbar-nav mx-auto">

      <li class="nav-item home active">
        <a class="nav-link" href="#home" active="home" onClick="return GoTo(this)">HOME<span class="sr-only">(current)</span></a>
      </li>

    <!--   <li class="nav-item">
        <a class="nav-link" href="#portofolio" onClick="return GoTo(this)">PORTOFOLIO</a>
      </li> -->

      <li class="nav-item about">
        <a class="nav-link" href="#about" active="about" onClick="return GoTo(this)">ABOUT</a>
      </li>

      <li class="nav-item event">
        <a  class="nav-link" href="#tickets" active="event" onClick="return GoTo(this)">UPCOMING EVENT</a>
      </li>
      
      <li class="nav-item contact">
        <a class="nav-link" href="#contact" active="contact" onClick="return GoTo(this)">CONTACT</a>
      </li>

    </ul>

  </div>

</nav>
