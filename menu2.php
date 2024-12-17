<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $option = $_POST['option'];

    switch ($option) {
        case '1': // Opción Fibonacci
            $n = intval($_POST['fibonacci_n']);
            if ($n < 1 || $n > 50) {
                $error = "El número debe estar en el rango de 1 a 50.";
            } else {
                // Calcular los N primeros números de Fibonacci
                $f1 = 1;
                $f2 = 1;
                $fibonacci = [$f1, $f2];

                for ($i = 3; $i <= $n; $i++) {
                    $fibonacci[] = $fibonacci[$i - 3] + $fibonacci[$i - 2];
                }

                $result = "Los primeros $n números de Fibonacci son: " . implode(", ", $fibonacci);
            }
            break;

        case '2': // Opción Cubo
            define("MAX", 1000000);
            $resultados = [];

            for ($i = 1; $i <= MAX; $i++) {
                $suma = 0;
                $numero = $i;
                while ($numero > 0) {
                    $digito = $numero % 10;
                    $suma += pow($digito, 3);
                    $numero = intval($numero / 10);
                }

                if ($suma === $i) {
                    $resultados[] = $i;
                }
            }

            $result = "Los números entre 1 y " . MAX . " que cumplen la condición son: " . implode(", ", $resultados);
            break;

        case '3': // Opción Fraccionarios
            // Leer fraccionarios
            $num_a = intval($_POST['num_a']);
            $den_a = intval($_POST['den_a']);
            $num_b = intval($_POST['num_b']);
            $den_b = intval($_POST['den_b']);
            $num_c = intval($_POST['num_c']);
            $den_c = intval($_POST['den_c']);
            $num_d = intval($_POST['num_d']);
            $den_d = intval($_POST['den_d']);

            if ($den_a <= 0 || $den_b <= 0 || $den_c <= 0 || $den_d <= 0) {
                $error = "Los denominadores deben ser mayores que 0.";
            } else {
                // Calcular la expresión A + B * C - D
                $a = $num_a / $den_a;
                $b = $num_b / $den_b;
                $c = $num_c / $den_c;
                $d = $num_d / $den_d;

                $resultado = $a + ($b * $c) - $d;
                $result = "El resultado de la operación es: $resultado";
            }
            break;

        case 'S': // Salir
            $result = "Gracias por usar el programa.";
            header("Location: index.html");
            exit;

        default:
            $error = "Opción inválida.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú PHP</title>
    <style>
        body {
            background-image: url('Imagenes/fondo.jpg');
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
        }

        h1 {
            text-align: center;
            color: #ffcc00;
            font-size: 2em;
            margin-bottom: 20px;
        }

        hr {
            border: 1px solid #ffcc00;
            margin: 20px 0;
        }

        .menu-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            text-align: center;
        }

        .menu-item {
            background: rgba(0, 0, 0, 0.7);
            padding: 15px;
            border-radius: 10px;
            transition: transform 0.2s, box-shadow 0.3s;
            cursor: pointer;
        }

        .menu-item:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 20px rgba(255, 204, 0, 0.8);
        }

        .menu-item i {
            font-size: 2em;
            margin-bottom: 10px;
            display: block;
            color: #ffcc00;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 1.1em;
        }

        select, input, button {
            padding: 12px;
            font-size: 1em;
            border: none;
            border-radius: 8px;
            outline: none;
        }

        select, input {
            background: #333;
            color: #f0f0f0;
        }

        select:focus, input:focus {
            border: 2px solid #ffcc00;
            background: #444;
        }

        button {
            background: #ff9800;
            color: #1a1a1a;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s, background 0.3s;
        }

        button:hover {
            background: #ffa726;
            transform: scale(1.05);
        }

        .result {
            background: rgba(0, 0, 0, 0.85);
            padding: 20px;
            border-radius: 10px;
            font-size: 1.1em;
            color: #a0f1a0;
            margin-top: 15px;
        }

        .error {
            color: #ff7373;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>MENÚ PRINCIPAL</h1>
        <hr>
        <div class="menu-options">
            <div class="menu-item">
                <i>📜</i>
                <p>1. Fibonacci</p>
            </div>
            <div class="menu-item">
                <i>🔢</i>
                <p>2. Cubo</p>
            </div>
            <div class="menu-item">
                <i>➗</i>
                <p>3. Fraccionarios</p>
            </div>
            <div class="menu-item">
                <i>🚪</i>
                <p>S. Salir</p>
            </div>
        </div>
        <hr>
        <form method="post">
            <label for="option">Seleccione una opción:</label>
            <select id="option" name="option" required onchange="updateInputs()">
                <option value="">Seleccione...</option>
                <option value="1" <?= isset($option) && $option == '1' ? 'selected' : '' ?>>1 - Fibonacci</option>
                <option value="2" <?= isset($option) && $option == '2' ? 'selected' : '' ?>>2 - Cubo</option>
                <option value="3" <?= isset($option) && $option == '3' ? 'selected' : '' ?>>3 - Fraccionarios</option>
                <option value="S" <?= isset($option) && $option == 'S' ? 'selected' : '' ?>>S - Salir</option>
            </select>

            <div id="inputs">
                <?php if (isset($option) && $option == '1'): ?>
                    <label for="fibonacci_n">Ingrese un número entero (1 ≤ N ≤ 50):</label>
                    <input type="number" id="fibonacci_n" name="fibonacci_n" min="1" max="50" value="<?= isset($n) ? $n : '' ?>" required>
                <?php elseif (isset($option) && $option == '3'): ?>
                    <label>Ingrese 4 fraccionarios:</label><br>
                    A: <input type="number" name="num_a" required> / <input type="number" name="den_a" required><br>
                    B: <input type="number" name="num_b" required> / <input type="number" name="den_b" required><br>
                    C: <input type="number" name="num_c" required> / <input type="number" name="den_c" required><br>
                    D: <input type="number" name="num_d" required> / <input type="number" name="den_d" required><br>
                <?php endif; ?>
            </div>

            <button type="submit">Enviar</button>
        </form>
        <hr>
        <?php if (isset($result)): ?>
            <div class="result">
                <h2>Resultado:</h2>
                <p><?= $result ?></p>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="result error">
                <h2>Error:</h2>
                <p><?= $error ?></p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function updateInputs() {
            const option = document.getElementById('option').value;
            const inputs = document.getElementById('inputs');
            inputs.innerHTML = ''; // Limpiar campos previos

            if (option === "1") {
                inputs.innerHTML = `
                    <label for="fibonacci_n">Ingrese un número entero (1 ≤ N ≤ 50):</label>
                    <input type="number" id="fibonacci_n" name="fibonacci_n" min="1" max="50" required>
                `;
            } else if (option === "3") {
                inputs.innerHTML = `
                    <label>Ingrese 4 fraccionarios:</label><br>
                    A: <input type="number" name="num_a" required> / <input type="number" name="den_a" required><br>
                    B: <input type="number" name="num_b" required> / <input type="number" name="den_b" required><br>
                    C: <input type="number" name="num_c" required> / <input type="number" name="den_c" required><br>
                    D: <input type="number" name="num_d" required> / <input type="number" name="den_d" required><br>
                `;
            }
        }
    </script>
</body>
</html>
