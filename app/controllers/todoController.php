<?php

// Controlador para manejar todas las operaciones del todo list
class todoController extends Controller
{

    // Título específico para este controlador
    protected $title = 'Lista de Tareas';

    /**
     * Página principal - mostrar todas las tareas
     */
    function index()
    {
        // Obtener todas las tareas con detalles
        $todos = todoModel::getAllWithDetails();

        // Datos para la vista
        $data = [
            'todos' => $todos,
            'page_title' => 'Mi Lista de Tareas'
        ];

        // Renderizar vista directamente sin pasar por to_Object
        View::render('todolist', $data);
    }

    /**
     * Mostrar formulario para agregar nueva tarea
     */
    function add()
    {
        $data = [
            'page_title' => 'Agregar Nueva Tarea'
        ];
        // Renderizar vista directamente sin pasar por to_Object
        View::render('addTodo', $data);
    }

    /**
     * Mostrar formulario para editar tarea existente
     */
    function edit()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectWithMessage('todo', 'ID de tarea inválido', 'danger');
            return;
        }

        $id = $_GET['id'];
        $todo = todoModel::find($id);

        if (!$todo) {
            $this->redirectWithMessage('todo', 'Tarea no encontrada', 'danger');
            return;
        }

        $data = [
            'page_title' => 'Editar Tarea',
            'todo' => $todo
        ];

        View::render('editTodo', $data);
    }

    /**
     * Procesar formulario de nueva tarea
     */
    function store()
    {
        // Validar datos requeridos
        if (!$this->validatePost(['task'])) {
            $this->redirectWithMessage('todo/add', 'Debe ingresar una tarea', 'warning');
            return;
        }

        // Preparar datos
        $todoData = [
            'task' => trim($_POST['task']),
            'description' => trim($_POST['description'] ?? ''),
            'priority' => $_POST['priority'] ?? 'medium',
            'completed' => 0
        ];

        // Crear tarea
        todoModel::create($todoData);

        // Redireccionar con mensaje de éxito
        $this->redirectWithMessage('todo', 'Tarea agregada exitosamente', 'success');
    }

    /**
     * Procesar formulario de edición de tarea
     */
    function update()
    {
        if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
            $this->redirectWithMessage('todo', 'ID de tarea inválido', 'danger');
            return;
        }

        if (!$this->validatePost(['task'])) {
            $this->redirectWithMessage('todo/edit?id=' . $_POST['id'], 'Debe ingresar una tarea', 'warning');
            return;
        }

        $id = $_POST['id'];

        // Verificar que la tarea existe
        $todo = todoModel::find($id);
        if (!$todo) {
            $this->redirectWithMessage('todo', 'Tarea no encontrada', 'danger');
            return;
        }

        // Preparar datos
        $todoData = [
            'task' => trim($_POST['task']),
            'description' => trim($_POST['description'] ?? ''),
            'priority' => $_POST['priority'] ?? 'medium'
        ];

        // Actualizar tarea
        todoModel::update($id, $todoData);

        // Redireccionar con mensaje de éxito
        $this->redirectWithMessage('todo', 'Tarea actualizada exitosamente', 'success');
    }

    /**
     * Cambiar estado de una tarea (completada/pendiente)
     */
    function toggle()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectWithMessage('todo', 'ID de tarea inválido', 'danger');
            return;
        }

        $id = $_GET['id'];

        // Verificar que la tarea existe
        $todo = todoModel::find($id);
        if (!$todo) {
            $this->redirectWithMessage('todo', 'Tarea no encontrada', 'danger');
            return;
        }

        // Cambiar estado
        Todo::toggleStatus($id);

        // Mensaje según el nuevo estado
        $newStatus = $todo['completed'] ? 'pendiente' : 'completada';
        $this->redirectWithMessage('todo', "Tarea marcada como {$newStatus}", 'info');
    }

    function toggleFavorite()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectWithMessage('todo', 'ID de tarea inválido', 'danger');
            return;
        }

        $id = $_GET['id'];

        // Verificar que la tarea existe
        $todo = todoModel::find($id);
        if (!$todo) {
            $this->redirectWithMessage('todo', 'Tarea no encontrada', 'danger');
            return;
        }

        // Cambiar estado
        Todo::toggleFavoriteStatus($id);

        // Mensaje según el nuevo estado
        $newStatus = $todo['favorite'] ? 'checked' : '';
        $this->redirectWithMessage('todo', "Tarea marcada como {$newStatus}", 'info');
    }


    /**
     * Eliminar una tarea
     */
    function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectWithMessage('todo', 'ID de tarea inválido', 'danger');
            return;
        }

        $id = $_GET['id'];

        // Verificar que la tarea existe
        $todo = todoModel::find($id);
        if (!$todo) {
            $this->redirectWithMessage('todo', 'Tarea no encontrada', 'danger');
            return;
        }

        // Eliminar tarea
        todoModel::delete($id);

        $this->redirectWithMessage('todo', 'Tarea eliminada exitosamente', 'info');
    }

    /**
     * Buscar tareas
     */
    function search()
    {
        $search = $_GET['q'] ?? '';

        if (empty($search)) {
            $this->redirectWithMessage('todo', 'Debe ingresar un término de búsqueda', 'warning');
            return;
        }

        $todos = todoModel::search($search);

        $data = [
            'todos' => $todos,
            'search_term' => $search,
            'page_title' => "Resultados para: {$search}"
        ];

        // Renderizar vista directamente sin pasar por to_Object
        View::render('todolist', $data);
    }
}
