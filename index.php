<?php
include("conexion.php");

// Manejo del buscador opcional
$busqueda = "";
if (isset($_GET['buscar'])) {
    $busqueda = $conexion->real_escape_string($_GET['buscar']);
    $resultado = $conexion->query("SELECT * FROM productos WHERE nombre LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%'");
} else {
    $resultado = $conexion->query("SELECT * FROM productos");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Abarrotes Don Ponce - Inicio</title>
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>

    <!-- ENCABEZADO / NAVBAR -->
    <div class="header">
        <div class="navbar">
            <div class="brand">
                <h1 class="titulo-tienda">Abarrotes Don Ponce</h1>
            </div>
            <div class="nav-links">
                <a href="index.php">Inicio</a>
                <a href="menudeo.php">Pedidos A Domicilio</a>
                <a href="mayoreo.php">Pedidos Mayoreo</a>
                <a href="login.php" class="btn-admin">Administrador</a>
            </div>
        </div>
    </div>

    <!-- CONTENEDOR PRINCIPAL (Más ancho para acomodar ambas columnas) -->
    <div class="main-container" style="max-width: 1200px; margin: 30px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0px 0px 5px rgba(0,0,0,0.1);">
        
        <!-- BIENVENIDA ARRIBA -->
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="color: #0066c0; margin-top: 0;">¡Bienvenidos a Abarrotes Don Ponce!</h2>
            <p>Tradición y calidad al servicio de la comunidad desde nuestra fundación. Encuentra todo lo necesario para tu hogar al mejor precio.</p>
        </div>

        <!-- CONTENEDOR DE DOS COLUMNAS: IMÁGENES A UN LADO Y TABLA AL OTRO -->
        <div style="display: flex; gap: 30px; flex-wrap: wrap; align-items: flex-start;">
            
            <!-- COLUMNA IZQUIERDA: Imágenes Locales -->
            <div style="flex: 2; min-width: 280px;">
                <h3 style="color: #0066c0; margin-top: 0;">Conoce la Tienda</h3>
                <div style="margin-bottom: 15px;">
                    <img src="img/donponch.png" alt="Don Ponch" style="width: 100%; border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                </div>
                <div style="display: flex; gap: 10px;">
                                    </div>
                                    <h2 style="color: #0066c0; margin-top: 0;">Conoce la Tienda</h2>
                                   <p>Fundada en 1985 por Don Ponce y su familia, nuestra tienda comenzó como un pequeño local de barrio comprometido con ofrecer productos frescos y de calidad a precios accesibles.</p>
                <p>A lo largo de los años, nos hemos expandido a más de 12 sucursales en toda la región, convirtiéndonos en el aliado principal de miles de familias e ingeniosos comerciantes.</p>
                <p>Ahora damos el salto digital para facilitarte la vida: realiza tus pedidos al mayoreo para tu negocio o solicita tu súper a domicilio sin salir de casa.</p>
               
            </div>

            <!-- COLUMNA DERECHA: Buscador y Tabla de Inventario -->
            <div style="flex: 1; min-width: 450px;">
                <h3 style="color: #0066c0; margin-top: 0;">📦 Catálogo de Productos y Existencias</h3>
                <p>Consulta la disponibilidad en tiempo real:</p>

                <!-- Buscador -->
                <form method="GET" action="index.php" style="margin: 15px 0; display: flex; gap: 10px;">
                    <input type="text" name="buscar" value="<?php echo htmlspecialchars($busqueda); ?>" placeholder="Buscar producto o categoría..." style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <button type="submit" style="padding: 8px 15px; background: #0066c0; color: white; border: none; border-radius: 4px; cursor: pointer;">Buscar</button>
                    <?php if(!empty($busqueda)) { ?>
                        <a href="index.php" style="padding: 8px 12px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; display: inline-flex; align-items: center;">Ver Todo</a>
                    <?php } ?>
                </form>

                <!-- Tabla de Inventario -->
                <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <tr style="background: #f8f9fa;">
                        <th style="padding: 8px; border: 1px solid #ddd;">ID</th>
                        <th style="padding: 8px; border: 1px solid #ddd;">Nombre</th>
                        <th style="padding: 8px; border: 1px solid #ddd;">Categoría</th>
                        <th style="padding: 8px; border: 1px solid #ddd;">Precio</th>
                        <th style="padding: 8px; border: 1px solid #ddd;">Stock</th>
                    </tr>
                    <?php 
                    if ($resultado && $resultado->num_rows > 0) {
                        while($row = $resultado->fetch_assoc()) { 
                    ?>
                    <tr>
                        <td style="padding: 6px; border: 1px solid #ddd; text-align: center;"><?php echo $row['id']; ?></td>
                        <td style="padding: 6px; border: 1px solid #ddd;"><strong><?php echo $row['nombre']; ?></strong></td>
                        <td style="padding: 6px; border: 1px solid #ddd;"><?php echo $row['categoria']; ?></td>
                        <td style="padding: 6px; border: 1px solid #ddd; text-align: right;">$<?php echo number_format($row['precio'], 2); ?></td>
                        <td style="padding: 6px; border: 1px solid #ddd; text-align: center;"><?php echo $row['stock']; ?> un.</td>
                    </tr>
                    <?php 
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="5" style="padding: 15px; text-align: center; color: #666;">No se encontraron productos registrados.</td>
                    </tr>
                    <?php } ?>
                </table>
            </div>

        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> Abarrotes Don Ponce S.A. de C.V. - Todos los derechos reservados.</p>
    </div>

</body>
</html>