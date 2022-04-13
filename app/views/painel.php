<?= $this->layout('_template') ?>

<?php if ($pairs) : ?>
  <!-- cards -->
  <div class="container">
    <div class="row">
      <div style="margin-bottom: 6em !important;">
        <?php if ($cards) : ?>
          <!-- cards -->
          <?php foreach ($cards as $item) : ?>
            <div class="col-12 mt-3">
              <div class="card shadow">
                <div class="card-body text-center">
                  <?php foreach ($users as $user) : ?>
                    <?php if ($user->name === $item->autor) : ?>
                      <img class="cover shadow mb-3" src="<?= IMAGES . '/' . $user->img ?>">
                    <?php endif ?>
                  <?php endforeach ?>

                  <p style="font-size: 12px;"><?= $item->autor ?> | <?= $item->created_at ?></p>
                  <h2><?= $item->title ?></h2>
                  <p><?= $item->description ?></p>
                  <p><b>Quando? <?= $item->date ?></b></p>

                  <?php if ($item->status === 0) : ?>
                    <a href="<?= URL . 'cards/' . $item->id ?>" class="btn shadow mt-2 bg-primary text-white">Check</a>
                  <?php else : ?>
                    <a href="<?= URL . 'cards/' . $item->id ?>" class="btn shadow mt-2 bg-dark text-white">Completo</a>
                  <?php endif ?>
                  <!-- card-oduy -->
                </div>
                <!-- card -->
              </div>
              <!-- col -->
            </div>
          <?php endforeach ?>
          <!-- end cards -->
        <?php else : ?>
          <div class="col-12 mt-3">
            <div class="card shadow">
              <div class="card-body">
                <h6><b>Ops!</b> ninguem cadastro nada..</h6>
                <p>Crie uma postagem no menu "+".</p>
                <!-- card-oduy -->
              </div>
              <!-- card -->
            </div>
            <!-- col -->
          </div>
        <?php endif ?>
      </div>
      <!-- row -->
    </div>
    <!-- container -->
  </div>
  <!-- end cards -->
<?php else : ?>
  <!-- invite -->
  <div class="container">
    <div class="row">
      <div class="col-12 mt-3">
        <div class="card shadow w-100">
          <div class="card-body">
            <?php if ($invitationsPrimary) : ?>
              <h5>Aguardando seu par aceitar o convite :)</h5>

            <?php elseif ($invitationsSecondary) : ?>

              <?php foreach ($invitationsSecondary as $item) : ?>

                <h5><b><?= $item->namePrimary ?></b> disse que namora você!</h5>
                <p>Deseja fazer par com essa pessoa?</p>
                <div class="d-flex">
                  <a href="<?= URL . 'accept/' . $item->id ?>" class="btn w-100 bg-primary text-white shadow rounded-pill">
                    Sim
                  </a>
                  <a href="<?= URL . 'recuse/' . $item->id ?>" class="ms-2 btn w-100 bg-danger text-white shadow rounded-pill">
                    Não
                  </a>
                </div>

              <?php endforeach ?>

            <?php else : ?>

              <h5>Convide seu par!</h5>
              <p>é necessário que seu par já tenha cadastro na plataforma.</p>

              <form action="<?= URL ?>invite" method="POST">
                <div class="input-group input-group-lg">
                  <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
                  <input type="hidden" name="name" value="<?= $_SESSION['name'] ?>">
                  <input type="email" name="email" class="form-control w-100 shadow rounded-pill" placeholder="Digite um e-mail.." required>
                </div>

                <button type="submit" class="btn bg-primary text-white w-100 btn-lg shadow mt-3 rounded-pill">Convidar</button>
              </form>

              <?php if (isset($_GET['invite-error'])) : ?>
                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                  <strong>OPS!</strong> Não encontrei esse e-mail :(
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif ?>

            <?php endif ?>
            <!-- card body -->
          </div>
          <!-- card -->
        </div>
        <!-- col -->
      </div>
      <!-- row -->
    </div>
    <!-- container -->
  </div>
  <!-- end invite -->
<?php endif ?>

<!-- botão de adicionar metas -->
<div class="fixed-bottom bg-primary">
  <div class="container">
    <div class="row">
      <div class="col-12 text-white text-center">
        <a href="<?= URL ?>exit" class="btn btn-lg text-white">Sair</a>
        <?php if ($pairs) : ?>
          <button class="btn btn-lg text-white" style="font-weight: bold; font-size: 2em" data-bs-toggle="modal" data-bs-target="#post">
            +
          </button>
        <?php endif ?>
        <a href="#" class="btn btn-lg text-white">Perfil</a>
      </div>
      <!-- row -->
    </div>
    <!-- container -->
  </div>
</div>

<!-- post modal -->
<div class="modal fade" id="post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">O que vamos fazer?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= URL ?>cards" method="POST">
          <div class="input-group input-group-lg flex-column">
            <input type="text" name="title" class="form-control shadow rounded-pill w-100" required placeholder="Título..">
            <input type="text" name="description" class="form-control shadow rounded-pill w-100 mt-3" required placeholder="Descrição..">
            <input type="text" name="date" class="form-control shadow rounded-pill w-100 mt-3" required placeholder="Quando vamos..?">
          </div>
          <button class="btn btn-lg bg-primary text-white shadow mt-3 w-100 rounded-pill">Adicionar</button>
        </form>
        <!-- modal-body -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>