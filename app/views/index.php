<?= $this->layout('_template') ?>

<div class="fixed-bottom">
  <div class="container">
    <div class="row mb-3">
      <div class="col-12 text-center mb-5">
        <div class="logo text-white mb-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-postcard-heart" viewBox="0 0 16 16">
            <path d="M8 4.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7Zm3.5.878c1.482-1.42 4.795 1.392 0 4.622-4.795-3.23-1.482-6.043 0-4.622ZM2.5 5a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3Zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3Zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3Z" />
            <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H2Z" />
          </svg>
        </div>

        <h1 class="text-white">Metas de casal</h1>
        <h6 class="text-white">agende tarefas a fazer em casal</h6>

        <?php if (isset($_GET['login-error'])) : ?>
          <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
            <strong>OPS!</strong> E-mail ou senha incoprretos!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php elseif (isset($_GET['cadastro-error'])) : ?>
          <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
            <strong>OPS!</strong> Esse e-mail já está cadastrado!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php elseif (isset($_GET['success'])) : ?>
          <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
            <strong>Ebaa!</strong> Cadastro realizado!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif ?>

      </div>
      <div class="col-12">
        <button class="btn btn-lg w-100 shadow bg-primary text-white rounded-pill" data-bs-toggle="modal" data-bs-target="#login">Login</button>
        <button class="btn btn-lg w-100 shadow bg-white mt-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#cadastro">Cadastro</button>
        <!-- col -->
      </div>
      <!-- row  -->
    </div>
    <!-- container -->
  </div>
</div>

<!-- modal de login -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= URL ?>login" method="POST">
          <div class="input-group input-group-lg flex-column">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control shadow rounded-pill w-100" required placeholder="Insira seu e-mail">

            <label for="passwd" class="form-label mt-3">Senha</label>
            <input type="password" name="passwd" id="passwd" class="form-control shadow rounded-pill w-100" required placeholder="Insira sua senha">
          </div>
          <button class="btn btn-lg bg-primary text-white shadow mt-3 w-100 rounded-pill">Login</button>
        </form>
        <!-- modal-body -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- modal de cadastro -->
<div class="modal fade" id="cadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Criar conta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= URL ?>cadastro" method="POST">
          <div class="input-group input-group-lg flex-column">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control shadow rounded-pill w-100" required placeholder="Nome completo">

            <label for="email" class="form-label mt-3">E-mail</label>
            <input type="email" name="email" id="email" class="form-control shadow rounded-pill w-100" required placeholder="Insira seu e-mail">

            <label for="passwd" class="form-label mt-3">Senha</label>
            <input type="password" name="passwd" id="passwd" class="form-control shadow rounded-pill w-100" required placeholder="Insira sua senha">
          </div>
          <button class="btn btn-lg bg-primary text-white shadow mt-3 w-100 rounded-pill">Cadastrar</button>
        </form>
        <!-- modal-body -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
