<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li @if($current=="home") class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/">Home </a>
      </li>

      <li @if($current=="polices") class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/polices">Apolices </a>
      </li>

      <li @if($current=="clients") class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/clients">Clientes </a>
      </li>

    </ul>

  </div>
</nav>
