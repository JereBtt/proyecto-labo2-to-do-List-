<?php

// Modelo para manejar las operaciones de la tabla proyectos
class proyectosModel extends Model
{

    // Nombre de la tabla en la base de datos
    protected $table = 'proyectos';

    // Campos que se pueden llenar masivamente
    protected $fillable = ['nombre', 'descripcion'];

    /**
     * Obtener todas las tareas con información adicional
     * @return array Array de tareas con datos procesados
     */
    public static function getAllWithDetails()
    {
        $todos = self::all();

        // Procesar cada tarea para agregar información adicional 
        foreach ($todos as &$todo) {
            $todo['formatted_date'] = date('d/m/Y H:i', strtotime($todo['created_at']));
        }

        return $todos;
    }

    /**
     * Buscar tareas por texto
     * @param string $search Texto a buscar
     * @return array Array de tareas encontradas
     */
    public static function search($search)
    {
        $result = Db::query("
            SELECT * FROM proyectos 
            WHERE nombre LIKE ? OR descripcion LIKE ? 
            ORDER BY created_at DESC
        ", ["%{$search}%", "%{$search}%"]);
        return $result->fetchAll();
    }
}
