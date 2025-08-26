<?php
    if (!isset($_GET['display']) || isset($_GET['limpar'])) {
        $display = '';
        $primeiro_numero = '';
        $operacao = '';
        $segundo_numero = '';
    } else {
    
        $display = $_GET['display'];
        $primeiro_numero = $_GET['primeiro_numero'];
        $operacao = $_GET['operacao'];
        $segundo_numero = $_GET['segundo_numero'];

    
        if (isset($_GET['numero'])) {
            $numero = $_GET['numero'];
            if ($operacao == '') {
                $display .= $numero;
                $primeiro_numero = $display;
            } else {
                if ($segundo_numero == '') {
                    $display = $numero;
                } else {
                    $display .= $numero;
                }
                $segundo_numero = $display;
            }
        }

    
        if (isset($_GET['op'])) {
            $operacao = $_GET['op'];
            $primeiro_numero = $display;
            $segundo_numero = '';
            $display = '';
        }
        

        if (isset($_GET['igual'])) {

            $resultado = 0;

            switch ($operacao) {
                case 'soma':
                    $resultado = $primeiro_numero + $segundo_numero;
                    break;
                case 'subtracao':
                    $resultado = $primeiro_numero - $segundo_numero;
                    break;
                case 'multiplicacao':
                    $resultado = $primeiro_numero * $segundo_numero;
                    break;
                case 'divisao':
                    if ($segundo_numero != 0) {
                        $resultado = $primeiro_numero / $segundo_numero;
                    } 
                    break;
            }
            $display = $resultado;
            $primeiro_numero = $display;
            $operacao = '';
            $segundo_numero = '';
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calculadora</title>
</head>

<body>
    <div class="container">
        <div class="calculadora">
            <form action="calculadora.php" method="get">
                <table>
                    <tr>
                        <td colspan="4" id="display">
                            <?php echo $display; ?>
                        </td>
                    </tr>
                    <tr>
                        <input type="hidden" name="primeiro_numero" value="<?php echo $primeiro_numero; ?>">
                        <input type="hidden" name="operacao" value="<?php echo $operacao; ?>">
                        <input type="hidden" name="segundo_numero" value="<?php echo $segundo_numero; ?>">
                        <input type="hidden" name="display" value="<?php echo $display; ?>">

                        <td><button type="submit" name="limpar" value="C" class="botoesCalc" id="limparVisor">C</button></td>
                        <td><button type="button" class="botoesCalc" disabled>CE</button></td>
                        <td><button type="submit" name="op" value="divisao" class="botoesCalc">&divide;</button></td>
                        <td><button type="submit" name="op" value="multiplicacao" class="botoesCalc">&times;</button></td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="numero" value="7" class="botoesCalc">7</button></td>
                        <td><button type="submit" name="numero" value="8" class="botoesCalc">8</button></td>
                        <td><button type="submit" name="numero" value="9" class="botoesCalc">9</button></td>
                        <td><button type="submit" name="op" value="subtracao" class="botoesCalc">-</button></td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="numero" value="4" class="botoesCalc">4</button></td>
                        <td><button type="submit" name="numero" value="5" class="botoesCalc">5</button></td>
                        <td><button type="submit" name="numero" value="6" class="botoesCalc">6</button></td>
                        <td><button type="submit" name="op" value="soma" class="botoesCalc">+</button></td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="numero" value="1" class="botoesCalc">1</button></td>
                        <td><button type="submit" name="numero" value="2" class="botoesCalc">2</button></td>
                        <td><button type="submit" name="numero" value="3" class="botoesCalc">3</button></td>
                        <td rowspan="2"><button type="submit" name="igual" value="=" class="botoesCalc" id="resultado">=</button></td>
                    </tr>
                    <tr>
                        <td></td><!--só para centralizar o numero 0-->
                        <td colspan="1"><button type="submit" name="numero" value="0" class="botoesCalc">0</button></td>
                        <td><button type="submit" name="numero" value="." class="botoesCalc">.</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>