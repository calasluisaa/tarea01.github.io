<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $option = $_POST['option'];
    $number = isset($_POST['number']) ? intval($_POST['number']) : null;

    // Validar el número ingresado
    if ($number !== null && ($number < 0 || $number > 10)) {
        $error = "El número debe estar en el rango de 0 a 10.";
    } else {
        switch ($option) {
            case '1': // Factorial
                if ($number !== null) {
                    $factorial = 1;
                    for ($i = 1; $i <= $number; $i++) {
                        $factorial *= $i;
                    }
                    $result = "El factorial de $number es: $factorial";
                } else {
                    $error = "Debe ingresar un número para calcular el factorial.";
                }
                break;

            case '2': // Primo
                if ($number !== null) {
                    if ($number < 2) {
                        $isPrime = false;
                    } else {
                        $isPrime = true;
                        for ($i = 2; $i <= sqrt($number); $i++) {
                            if ($number % $i === 0) {
                                $isPrime = false;
                                break;
                            }
                        }
                    }
                    $result = $isPrime ? "$number es un número primo." : "$number no es un número primo.";
                } else {
                    $error = "Debe ingresar un número para verificar si es primo.";
                }
                break;

            case '3': // Serie Matemática
                if ($number !== null) {
                    $serie = 0;
                    $sign = 1;
                    $serieTerms = [];
                    for ($i = 1; $i <= $number; $i++) {
                        $term = $sign * (pow($i, 2) / factorial($i));
                        $serie += $term;
                        $serieTerms[] = $sign > 0 ? "+ " . (pow($i, 2) . "/" . factorial($i)) : "- " . (pow($i, 2) . "/" . factorial($i));
                        $sign *= -1;
                    }
                    $result = "La serie matemática es: " . implode(" ", $serieTerms) . "<br>El resultado es: $serie";
                } else {
                    $error = "Debe ingresar un número para calcular la serie matemática.";
                }
                break;

            case 'S': // Salir
                $result = "Gracias por usar el programa. ¡Hasta luego!";
                header("Location: index.html");
                break;

            default:
                $error = "Opción inválida.";
        }
    }
}

// Función para calcular factorial
function factorial($n)
{
    $factorial = 1;
    for ($i = 1; $i <= $n; $i++) {
        $factorial *= $i;
    }
    return $factorial;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú PHP</title>
    <!-- Bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('Imagenes/fondo.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-blend-mode: overlay;
            background-color: rgba(0, 0, 0, 0.6);
            color: #000;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            background: rgba(25, 25, 25, 0.95);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.6);
        }

        h1 {
            text-align: center;
            font-weight: bold;
            color: #0bce63;
            margin-bottom: 30px;
        }

        .menu-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
            color: #0bce63;
        }

        .menu-option {
            background: rgba(35, 35, 35, 0.9);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border: 2px solid #0bce63;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .menu-option:hover {
            transform: scale(1.05);
            background: #0bce63;
            color: #0000;
            cursor: pointer;
        }

        .form-section {
            margin-top: 20px;
            background: rgba(45, 45, 45, 0.95);
            padding: 20px;
            border-radius: 10px;
        }

        .form-group label {
            font-weight: bold;
            color: #0bce63;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }

        button {
            background: #0bce63;
            color: #000;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: #0aae52;
            transform: scale(1.05);
        }

        .result, .error {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            font-weight: bold;
        }

        .result {
            background: #eafaf1;
            border: 1px solid #c8e6d8;
            color: #0b3d25;
        }

        .error {
            background: #ffdada;
            border: 1px solid #ff9999;
            color: #b71c1c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Menú de Opciones</h1>
        <!-- Opciones de menú -->
        <div class="menu-options">
            <div class="menu-option">1. Factorial</div>
            <div class="menu-option">2. Primo</div>
            <div class="menu-option">3. Serie Matemática</div>
            <div class="menu-option">S. Salir</div>
        </div>
        <!-- Formulario -->
        <div class="form-section">
            <form method="post">
                <div class="form-group">
                    <label for="option">Escoja una opción:</label>
                    <select id="option" name="option" required>
                        <option value="">Seleccione...</option>
                        <option value="1" <?= isset($option) && $option == '1' ? 'selected' : '' ?>>1 - Factorial</option>
                        <option value="2" <?= isset($option) && $option == '2' ? 'selected' : '' ?>>2 - Primo</option>
                        <option value="3" <?= isset($option) && $option == '3' ? 'selected' : '' ?>>3 - Serie Matemática</option>
                        <option value="S" <?= isset($option) && $option == 'S' ? 'selected' : '' ?>>S - Salir</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="number">Ingrese un número (0 ≤ num ≤ 10):</label>
                    <input type="number" id="number" name="number" min="0" max="10" value="<?= isset($number) ? $number : '' ?>">
                </div>
                <button type="submit">Enviar</button>
            </form>
        </div>
        <!-- Resultados -->
        <?php if (isset($result)): ?>
            <div class="result">
                <h3>Resultado:</h3>
                <p><?= $result ?></p>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="error">
                <h3>Error:</h3>
                <p><?= $error ?></p>
            </div>
        <?php endif; ?>
    </div>
    <!-- Bootstrap 3 JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
