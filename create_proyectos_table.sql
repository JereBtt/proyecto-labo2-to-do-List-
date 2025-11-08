-- Tabla proyectos
CREATE TABLE `proyectos` (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    descripcion TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos de ejemplo
INSERT INTO `proyectos` (`nombre`, `descripcion`) VALUES
('Terminar la carrera', 'Aprobar Laboratorio II :)'),
('Conseguir trabajo', 'Aprobar Laboratorio II con buena nota :)'),
('Conseguir felicidad', 'Aprobar Laboratorio II con muuy buena nota :)');
