-- ============================================
-- TABLA DE ASIGNATURAS (entidad #10)
-- ============================================
USE crud_usuarios;

CREATE TABLE IF NOT EXISTS asignaturas (
    id VARCHAR(36) NOT NULL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    nombre_completo VARCHAR(200) NOT NULL,
    descripcion TEXT NULL,
    area_conocimiento VARCHAR(120) NOT NULL,
    carrera VARCHAR(150) NOT NULL,
    numero_creditos TINYINT UNSIGNED NOT NULL,
    contenido_tematico TEXT NULL,
    semestre TINYINT UNSIGNED NOT NULL,
    profesor VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Consulta de verificación
SELECT * FROM asignaturas;
