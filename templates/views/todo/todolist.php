<?php require_once INCLUDES . 'inc_header.php'; ?>

<!-- Mostrar notificaciones toast -->
<?= Toast::flash() ?>

<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4">
            <?= $data['page_title'] ?? 'Mi Lista de Tareas' ?>
        </h1>
        
        <!-- Barra de búsqueda -->
        <div class="mb-4">
            <form method="GET" action="<?= URL ?>todo/search" class="d-flex">
                <input type="text" class="form-control me-2" name="q" 
                       placeholder="Buscar tareas..." value="<?= $data['search_term'] ?? '' ?>">
                <button type="submit" class="btn btn-outline-secondary">Buscar</button>
            </form>
        </div>
        
        <!-- Lista de tareas -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tareas</h5>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($data['todos'])): ?>
                    <?php foreach ($data['todos'] as $todo): ?>
                        <div class="todo-item p-3 border-bottom <?= $todo['completed'] ? 'completed-task' : '' ?>">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <h6 class="mb-0 me-2 <?= $todo['completed'] ? 'text-decoration-line-through text-muted' : '' ?>">
                                            <?= htmlspecialchars($todo['task']) ?>
                                        </h6>
                                        <span class="badge priority-badge bg-<?= $todo['priority_color'] ?>">
                                            <?= $todo['priority_text'] ?>
                                        </span>
                                    </div>
                                    
                                    <?php if ($todo['description']): ?>
                                        <p class="text-muted mb-2 small">
                                            <?= htmlspecialchars($todo['description']) ?>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <small class="text-muted">
                                        <?= $todo['formatted_date'] ?>
                                    </small>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="<?= URL ?>todo/edit?id=<?= $todo['id'] ?>" 
                                       class="btn btn-sm btn-outline-primary">
                                        Editar
                                    </a>
                                    <a href="<?= URL ?>todo/delete?id=<?= $todo['id'] ?>" 
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('¿Eliminar esta tarea?')">
                                        Eliminar
                                    </a>
                                    <a href="<?= URL ?>todo/toggle?id=<?= $todo['id'] ?>" 
                                       class="btn btn-sm <?= $todo['completed'] ? 'btn-outline-success' : 'btn-success' ?>">
                                        <?= $todo['completed'] ? 'Pendiente' : 'Completar' ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                        <h5>No hay tareas</h5>
                        <p>
                            <?php if (isset($data['search_term'])): ?>
                                No se encontraron tareas para "<?= htmlspecialchars($data['search_term']) ?>"
                            <?php else: ?>
                                ¡Agrega tu primera tarea!
                            <?php endif; ?>
                        </p>
                        <a href="<?= URL ?>todo/add" class="btn btn-primary">
                            Nueva Tarea
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Panel lateral -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Sistema de Tareas</h5>
                <p class="text-muted mb-4">
                    Organiza tus actividades diarias de forma simple.
                </p>
                <a href="<?= URL ?>todo/add" class="btn btn-primary w-100">
                    Nueva Tarea
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once INCLUDES . 'inc_footer.php'; ?>
