<?= $this->layout('_template'); ?>

<div class="container">
  <div class="row">

    <?php foreach ($user as $item) : ?>
      <div class="col-12 mt-3 text-center mb-5">
        <div class="card shadow">
          <div class="card-body">
            <form action="<?= URL ?>perfil" method="POST" enctype="multipart/form-data">
              <h5>Alterar imagem de perfil</h5>
              <img src="<?= IMAGES . $item->img ?>" class="shadow mb-3 mt-2" width="200" height="auto">
              <p><?= $item->name ?></p>

              <input type="file" name="image" class="form-control shadow rounded-pill mt-3" required>
              <button class="btn btn-dark shadow mt-3 w-100 rounded-pill">Salvar</button>
            </form>

            <a href="<?= URL ?>painel" class="btn shadow w-100 bg-primary text-white mt-3 rounded-pill">Voltar</a>
            <!-- card-body -->
          </div>
          <!-- card -->
        </div>
        <!-- col -->
      </div>
    <?php endforeach ?>

    <!-- row -->
  </div>
  <!-- container -->
</div>