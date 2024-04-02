<button class="btn position-fixed top-0 start-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
  <img src="{{ asset('assets/sidebar-icons/toggle.svg') }}" alt="fechar">
</button>

<nav class="sidebar offcanvas offcanvas-start show" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel" style="width: 300px">
  <div class="offcanvas-header justify-content-between p-4">
    <h3 class="mb-0">Logo</h3>
    <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close"><img src="{{ asset('assets/sidebar-icons/toggle.svg') }}" alt="fechar"></button>
  </div>

  <div class="d-flex flex-column offcanvas-body p-4 pb-3 border-bottom border-top">
    <ul class="list-unstyled ps-0 m-0 d-flex flex-column">
      <li class="mb-1">
        <img src="{{ asset('assets/sidebar-icons/patrimonio.svg') }}" alt="patrimonio-icon">

        <button class="btn d-inline-flex align-items-center rounded border-0">
          Patrimônio
        </button>
      </li>

      <li class="my-1">
        <img src="{{ asset('assets/sidebar-icons/cadastro.svg') }}" alt="cadastro-icon">

        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#cadastros-collapse" aria-expanded="false">
          Cadastros
        </button>

        <div class="collapse" id="cadastros-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Patrimônio</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Classificação Contábil</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Prédios</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Cargos</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Setores</a></li>
          </ul>
        </div>
      </li>

      <li class="my-1">
        <img src="{{ asset('assets/sidebar-icons/movimentacao.svg') }}" alt="cadastro-icon">

        <button class="btn d-inline-flex align-items-center rounded border-0">
          Movimentações
        </button>
      </li>

      <li class="mt-1">
        <img src="{{ asset('assets/sidebar-icons/relatorio.svg') }}" alt="cadastro-icon">

        <button class="btn d-inline-flex align-items-center rounded border-0">
          Relatórios
        </button>
      </li>
    </ul>

    <div class="mt-auto border-top pt-3">
      <ul class="list-unstyled m-0 d-flex flex-column">
        <li class="mb-1">
        <img src="{{ asset('assets/sidebar-icons/configuracoes.svg') }}" alt="cadastro-icon">

          <button class="btn d-inline-flex align-items-center rounded border-0">
            Configurações
          </button>
        </li>

        <li class="mt-1">
        <img src="{{ asset('assets/sidebar-icons/sair.svg') }}" alt="cadastro-icon">

          <button class="btn d-inline-flex align-items-center rounded border-0">
            Sair
          </button>
        </li>
      </ul>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-center p-4 py-2">
    <a href="#" class="d-flex align-items-center justify-content-center link-body-emphasis text-decoration-none">
      <img src="https://github.com/mdo.png" alt="mdo" width="50" height="50" class="rounded-circle">
    </a>
    <div class="d-flex flex-column w-100 ps-3">
      <span>{{ auth()->user()->name }}</span>
      <span>{{ auth()->user()->email }}</span>
    </div>
  </div>
</nav>

