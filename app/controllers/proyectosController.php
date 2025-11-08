<?php

// Controlador para manejar todas las operaciones de proyectos
class proyectosController extends Controller
{

    // Título específico para este controlador todo
    protected $title = 'Lista de Proyectos';

    /**
     * Página principal - mostrar todos los Proyectos 
     */
    function index()
    {
        // Obtener todos los Proyectos con detalles
        $proyectos = proyectosModel::getAllWithDetails();

        // Datos para la vista
        $data = [
            'proyectos' => $proyectos,
            'page_title' => 'Mi Lista de Proyectos'
        ];

        // Renderizar vista directamente sin pasar por to_Object
        View::render('proyectoslist', $data);
    }

    /**
     * Mostrar formulario para agregar nuevo proyecto 
     */
    function add()
    {
        $data = [
            'page_title' => 'Agregar Nuevo Proyecto'
        ];
        // Renderizar vista directamente sin pasar por to_Object
        View::render('addProyectos', $data);
    }

    /**
     * Mostrar formulario para editar proyecto existente 
     */
    function edit()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectWithMessage('proyectos', 'ID de proyecto inválido', 'danger');
            return;
        }

        $id = $_GET['id'];
        $todo = proyectosModel::find($id);

        if (!$todo) {
            $this->redirectWithMessage('proyectos', 'Proyecto no encontrado', 'danger');
            return;
        }

        $data = [
            'page_title' => 'Editar Proyecto',
            'proyectos' => $todo
        ];

        View::render('editProyectos', $data);
    }

    /**
     * Procesar formulario de nuevo proyecto 
     */
    function store()
    {
        // Validar datos requeridos
        if (!$this->validatePost(['nombre'])) {
            $this->redirectWithMessage('proyectos/add', 'Debe ingresar un proyecto', 'warning');
            return;
        }

        // Preparar datos
        $todoData = [
            'nombre' => trim($_POST['nombre']),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
        ];

        // Crear proyecto
        proyectosModel::create($todoData);

        // Redireccionar con mensaje de éxito
        $this->redirectWithMessage('proyectos', 'Proyecto agregado exitosamente', 'success');
    }

    /**
     * Procesar formulario de edición de proyectos
     */
    function update()
    {
        if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
            $this->redirectWithMessage('proyectos', 'ID de proyecto inválido', 'danger');
            return;
        }

        if (!$this->validatePost(['nombre'])) {
            $this->redirectWithMessage('proyectos/edit?id=' . $_POST['id'], 'Debe ingresar un proyecto', 'warning');
            return;
        }

        $id = $_POST['id'];

        // Verificar que el proyecto existe
        $todo = proyectosModel::find($id);
        if (!$todo) {
            $this->redirectWithMessage('proyectos', 'Proyecto no encontrada', 'danger');
            return;
        }

        // Preparar datos
        $todoData = [
            'nombre' => trim($_POST['nombre']),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
        ];

        // Actualizar proyecto
        proyectosModel::update($id, $todoData);

        // Redireccionar con mensaje de éxito
        $this->redirectWithMessage('proyectos', 'Proyecto actualizada exitosamente', 'success');
    }


    /**
     * Eliminar un proyecto
     */
    function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectWithMessage('proyectos', 'ID de proyecto inválido', 'danger');
            return;
        }

        $id = $_GET['id'];

        // Verificar que el proyecto existe
        $todo = proyectosModel::find($id);
        if (!$todo) {
            $this->redirectWithMessage('proyectos', 'Proyecto no encontrada', 'danger');
            return;
        }

        // Eliminar proyecto
        proyectosModel::delete($id);

        $this->redirectWithMessage('proyectos', 'Proyecto eliminada exitosamente', 'info');
    }

    /**
     * Buscar tareas task todo
     */
    function search()
    {
        $search = $_GET['q'] ?? '';

        if (empty($search)) {
            $this->redirectWithMessage('proyectos', 'Debe ingresar un término de búsqueda', 'warning');
            return;
        }

        $todos = proyectosModel::search($search);

        $data = [
            'proyectos' => $todos,
            'search_term' => $search,
            'page_title' => "Resultados para: {$search}"
        ];

        // Renderizar vista directamente sin pasar por to_Object
        View::render('proyectoslist', $data);
    }
}
