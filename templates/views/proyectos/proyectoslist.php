<?php require_once INCLUDES . 'inc_header.php'; ?>

<!-- Mostrar notificaciones toast -->
<?= Toast::flash() ?>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><?= $data['page_title'] ?? 'Mi Lista de Proyectos' ?></h1>
            <a href="<?= URL ?>proyectos/add" class="btn btn-primary">Nuevo Proyecto</a>
        </div>


        <!-- Barra de búsqueda -->
        <div class="mb-4">
            <form method="GET" action="<?= URL ?>proyectos/search" class="d-flex">
                <input type="text" class="form-control me-2" name="q"
                    placeholder="Buscar Proyectos..." value="<?= $data['search_term'] ?? '' ?>">
                <button type="submit" class="btn btn-outline-secondary">Buscar</button>
            </form>
        </div>

        <!-- Lista de Proyectos -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Proyectos</h5>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($data['proyectos'])): ?>
                    <?php foreach ($data['proyectos'] as $todo): ?>
                        <div class="todo-item p-3 border-bottom">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <h6 class="mb-0 me-2 ">
                                            <?= htmlspecialchars($todo['nombre']) ?>
                                        </h6>
                                    </div>

                                    <?php if ($todo['descripcion']): ?>
                                        <p class="text-muted mb-2 small">
                                            <?= htmlspecialchars($todo['descripcion']) ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="<?= URL ?>proyectos/edit?id=<?= $todo['id'] ?>"
                                        class="btn btn-sm btn-outline-primary">
                                        Editar
                                    </a>
                                    <a href="#"
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteProjectModal"
                                        data-href="<?= URL ?>/proyectos/delete?id=<?= $todo['id'] ?>">
                                        Eliminar
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                        <h5>No hay proyectos</h5>
                        <p>
                            <?php if (isset($data['search_term'])): ?>
                                No se encontraron proyectos para "<?= htmlspecialchars($data['search_term']) ?>"
                            <?php else: ?>
                                ¡Agrega tu primer proyecto!
                            <?php endif; ?>
                        </p>
                        <a href="<?= URL ?>proyectos/add" class="btn btn-primary">
                            Nuevo Proyecto
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>


</div>

<?php require_once INCLUDES . 'inc_footer.php'; ?>


<!-- Modal de confirmación -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Eliminar Proyecto?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Esta acción no se puede deshacer. ¿Estás seguro de eliminar este proyecto?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmDelete" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>


<script>
    const deleteProjectModal = document.getElementById('deleteProjectModal');

    deleteProjectModal.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget; // botón que abrió el modal
        const href = button.getAttribute('data-href'); // URL final que ya viene correcta
        const confirmLink = deleteProjectModal.querySelector('#confirmDelete');
        confirmLink.href = href;
    });
</script>