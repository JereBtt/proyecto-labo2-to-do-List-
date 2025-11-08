-- ===============================================
-- Tabla para el sistema de tareas (TODO LIST)
-- Cada tarea puede estar asociada a un proyecto
-- ===============================================

CREATE TABLE `todos` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `task` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `completed` TINYINT(1) DEFAULT 0,
  `priority` ENUM('low', 'medium', 'high') DEFAULT 'medium',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `favorite` TINYINT(1) DEFAULT 0,
  
  -- Nuevo campo: relación con proyectos
  `project_id` INT NULL,

  -- Índice para mejorar la velocidad de búsqueda por proyecto
  INDEX `idx_todos_project_id` (`project_id`),

  -- Clave foránea: conecta cada tarea con un proyecto existente
  CONSTRAINT `fk_todos_project`
    FOREIGN KEY (`project_id`) REFERENCES `proyectos`(`id`)
    ON UPDATE CASCADE
    ON DELETE SET NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===============================================
-- Insertar datos de ejemplo
-- ===============================================

INSERT INTO `todos` (`task`, `description`, `priority`, `created_at`, `project_id`) VALUES
('Aprender el framework', 'Estudiar la estructura MVC del proyecto', 'high', NOW(), NULL),
('Crear todo list', 'Implementar funcionalidad completa', 'medium', NOW(), NULL),
('Documentar código', 'Completar el README y explicar la lógica del sistema', 'low', NOW(), NULL);
