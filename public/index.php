<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimarket Inventario</title>
    <link href="../public/css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Minimarket Inventario</h1>
        <form id="productForm" class="space-y-4" method="POST">
            <div>
                <label for="productName" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
                <input type="text" id="productName" name="productName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label for="unitPrice" class="block text-sm font-medium text-gray-700">Precio por Unidad</label>
                <input type="number" id="unitPrice" name="unitPrice" step="0.01" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Cantidad de Inventario</label>
                <input type="number" id="quantity" name="quantity" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md">Agregar Producto</button>
        </form>

        <?php
            // Función para agregar productos al array asociativo
            function agregarProducto(&$productos, $nombre, $precio, $cantidad) {
                $productos[] = [
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'cantidad' => $cantidad,
                    'valor_total' => $precio * $cantidad,
                    'estado' => $cantidad > 0 ? 'En Stock' : 'Agotado'
                ];
            }

            // Inicializar el array de productos
            $productos = [];

            // Procesar el formulario
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = $_POST['productName'];
                $precio = floatval($_POST['unitPrice']);
                $cantidad = intval($_POST['quantity']);

                // Validar los datos ingresados
                if (!empty($nombre) && $precio > 0 && $cantidad >= 0) {
                    agregarProducto($productos, $nombre, $precio, $cantidad);
                } else {
                    echo "<p class='text-red-500'>Error: Datos inválidos.</p>";
                }
            }

            // Función para mostrar la tabla de productos
            function mostrarTabla($productos) {
                echo "<div class='overflow-x-auto'>";
                echo "<table class='w-full divide-y divide-gray-200'>";
                echo "<thead class='bg-gray-50'>";
                echo "<tr>";
                echo "<th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Nombre del Producto</th>";
                echo "<th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Precio por Unidad</th>";
                echo "<th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Cantidad de Inventario</th>";
                echo "<th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Valor Total</th>";
                echo "<th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Estado</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody class='divide-y divide-gray-200'>";
                foreach ($productos as $producto) {
                    echo "<tr>";
                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'>{$producto['nombre']}</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$producto['precio']}</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$producto['cantidad']}</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$producto['valor_total']}</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$producto['estado']}</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
            
                echo "</tbody>";
                echo "</table>";
            

            // Mostrar la tabla si hay productos
            if (!empty($productos)) {
                mostrarTabla($productos);
            }
        ?>
    </div>
</body>
</html>
