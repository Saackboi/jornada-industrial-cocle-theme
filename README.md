# Jornada Industrial Coclé - IV Edición (Tema de WordPress)

Este repositorio contiene exclusivamente el código fuente del tema personalizado desarrollado para el sitio web oficial de la IV Edición de la Jornada Industrial de la UTP (Centro Regional de Coclé). El proyecto implementa una arquitectura modular de componentes desacoplados utilizando el motor de Lazy Blocks.

---

## Estructura del Tema

Este repositorio versiona únicamente los archivos planos de diseño y lógica. El núcleo de WordPress, la base de datos y la carpeta física de medios (wp-content/uploads) están excluidos.
````
jornada-industrial-theme/
├── blocks/                 # Componentes web modulares e independientes
│   ├── [nombre-del-bloque]/ 
│   │   ├── block.php       # Renderizado HTML y lógica de presentación en PHP
│   │   └── block.css       # Estilos CSS encapsulados del bloque
│   └── ...
├── style.css               # Metadatos de inicialización y registro del tema
└── index.php               # Archivo de respaldo estructural del Core de WordPress
````
---

## Requisitos e Instalación Local

Para levantar el entorno de desarrollo local:

1. Levanta un sitio limpio desde cero en LocalWP.
2. Dirígete a la ruta de temas del proyecto local: app/public/wp-content/themes/
3. Clona este repositorio dentro de esa carpeta:
   git clone <url-del-repositorio>
4. Accede al panel administrativo local (/wp-admin), ve a Plugins > Añadir nuevo e instala y activa el plugin Lazy Blocks.
5. Ve a Apariencia > Temas y activa el Tema de la Jornada Industrial Coclé.

---

## Configuración y Renderizado de Bloques

El código del tema se encarga de registrar y mapear los bloques automáticamente a partir de los directorios dentro de `/blocks/`. 

* **Mapeo Automático:** Cada subcarpeta representa un componente. El sistema asocia automáticamente el archivo `block.php` y su respectivo `block.css` según el slug del directorio. Asegúrate de que el tema personalizado esté seleccionado y activo en el panel de WordPress para que el motor reconozca correctamente las rutas de los componentes.
