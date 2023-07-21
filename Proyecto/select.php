<?php
include 'conexion.php';
$conexion = Conexion::conectar();

$consulta1 = "SELECT * FROM Tipo_de_Prenda";
$consulta2 = "SELECT * FROM Tipo_de_Servicio";
$consulta3 = "SELECT * FROM Cliente";

$resultado1 = $conexion->query($consulta1);
$resultado2 = $conexion->query($consulta2);
$resultado3 = $conexion->query($consulta3);

$prendaOptions = "";
$servicioOptions = "";
$clienteOptions = "";

while ($fila = $resultado1->fetch(PDO::FETCH_ASSOC)) {
    $prendaOptions .= "<option value='".$fila['id_Prenda']."'>".$fila['nombreTipoPrenda']."</option>";
}

while ($fila = $resultado2->fetch(PDO::FETCH_ASSOC)) {
    $servicioOptions .= "<option value='".$fila['id_TipoServicio']."'>".$fila['nombreServicio']."</option>";
}

while ($fila = $resultado3->fetch(PDO::FETCH_ASSOC)) {
    $clienteOptions .= "<option value='".$fila['id_Cliente']."'>".$fila['nombreClie']." ".$fila['apellido']."</option>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tipoServicio']) && isset($_POST['tipoPrenda']) && isset($_POST['fechaRecogida']) && isset($_POST['cantidad']) && isset($_POST['cliente'])) {
        $tipoServicioId = $_POST['tipoServicio'];
        $tipoPrendaId = $_POST['tipoPrenda'];
        $fechaRecogida = $_POST['fechaRecogida'];
        $cantidad = $_POST['cantidad'];
        $clienteId = $_POST['cliente'];

        // Insertar el servicio en la base de datos
        $insertarServicio = "INSERT INTO Servicio (fecha_recogida, cantidad, estado, id_TipoServicio, id_Prenda, id_Cliente)
                             VALUES (:fechaRecogida, :cantidad, 'pendiente', :tipoServicioId, :tipoPrendaId, :clienteId)";

        $stmt = $conexion->prepare($insertarServicio);
        $stmt->bindParam(':fechaRecogida', $fechaRecogida);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':tipoServicioId', $tipoServicioId);
        $stmt->bindParam(':tipoPrendaId', $tipoPrendaId);
        $stmt->bindParam(':clienteId', $clienteId);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <div>
            <label>Tipo de servicio:</label>
            <select name="tipoServicio" required>
                <?php echo $servicioOptions; ?>
            </select>
        </div>
        <div>
            <label>Tipo de prenda:</label>
            <select name="tipoPrenda" required>
                <?php echo $prendaOptions; ?>
            </select>
        </div>
        <div>
            <label>Fecha de recogida:</label>
            <input type="date" name="fechaRecogida" required>
        </div>
        <div>
            <label>Cantidad:</label>
            <input type="number" name="cantidad" required>
        </div>
        <div>
            <label>Cliente:</label>
            <select name="cliente" required>
                <?php echo $clienteOptions; ?>
            </select>
        </div>
        <button type="submit" name="guardar">Guardar</button>
    </form>
</body>
</html>
