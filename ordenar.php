<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "marciburgueritos");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $pedido = $_POST['pedido'];
    $refresco = $_POST['refresco'];
    $salsas = $_POST['salsas'];
    $pago = $_POST['pago'];

    // Insertar en la base de datos
    $sql = "INSERT INTO pedidos (nombre, pedido, refresco, salsas, pago)
            VALUES ('$nombre', '$pedido', '$refresco', '$salsas', $pago)";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "¡Pedido guardado con éxito!";
    } else {
        $mensaje = "Error: " . $conexion->error;
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ordena tu pedido</title>
  <style>
    body {
      background-color: #FFC0CB;
      font-family: Arial, sans-serif;
      color: #333;
      padding: 20px;
    }

    form {
      background-color: white;
      padding: 20px;
      border-radius: 15px;
      max-width: 500px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    h2 {
      text-align: center;
      color: #FF1493;
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    input, textarea, select {
      width: 100%;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-top: 5px;
    }

    button {
      margin-top: 20px;
      width: 100%;
      background-color: #FF1493;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #e31383;
    }

    .mensaje {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
      color: green;
    }
  </style>
</head>
<body>

  <?php if (!empty($mensaje)) echo "<div class='mensaje'>$mensaje</div>"; ?>

  <form method="POST">
    <h2>Formulario de Pedido</h2>

    <label for="nombre">Nombre del cliente:</label>
    <input type="text" name="nombre" required>

    <label for="pedido">¿Qué vas a ordenar?</label>
    <textarea name="pedido" rows="3" required></textarea>

    <label for="refresco">Refresco:</label>
    <select name="refresco">
      <option value="">-- Elige uno --</option>
      <option value="Coca Cola">Coca Cola</option>
      <option value="Fanta">Fanta</option>
      <option value="Sprite">Sprite</option>
      <option value="Agua Mineral">Agua Mineral</option>
      <option value="Ninguno">Ninguno</option>
    </select>

    <label for="salsas">Salsas (opcional):</label>
    <textarea name="salsas" rows="2"></textarea>

    <label for="pago">Total a pagar ($):</label>
    <input type="number" name="pago" step="0.01" required>

    <button type="submit">Enviar Pedido</button>
  </form>

</body>
</html>