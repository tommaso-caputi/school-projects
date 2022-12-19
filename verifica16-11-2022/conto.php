<html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    </head>

    <body>
        
    <?php
        if (!empty($_POST['nome']) && !empty($_POST['cognome'])){
            echo "<p class='text-3xl font-black text-gray-900 dark:text-white'>Ordine effettuato correttamente</p>";
            echo "<br><p class='text-lg font-medium text-gray-900 dark:text-white'>Nome: ".$_POST['nome']."</p>";
            echo "<br><p class='text-lg font-medium text-gray-900 dark:text-white'>Cognome: ".$_POST['cognome']."</p>";
            echo "<hr class='my-8 h-px bg-gray-200 border-0 dark:bg-gray-700'>
                    <div class='overflow-x-auto relative'>
                    <table class='w-full text-sm text-left text-gray-500 dark:text-gray-400'>
                    <thead class='text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>
                    <tr>
                        <th scope='col' class='py-3 px-6'>
                            Cibo
                        </th>
                        <th scope='col' class='py-3 px-6'>
                            Prezzo
                        </th>
                    </tr>
                </thead>";
            $prezzoConsegna = explode("-", $_POST['abitazione'], 2);
            $prezzoConsegna = $prezzoConsegna[1];
            $prezzo = $prezzoConsegna;
            foreach($_POST['cibo'] as $cibo){
                $nomePrezzo = explode("-", $cibo, 2);
                $prezzo = $prezzo + $nomePrezzo[1];
                echo "<tbody>
                        <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                            <td class='py-4 px-6'>".$nomePrezzo[0]."</td><td class='py-4 px-6'>".$nomePrezzo[1]."&#8364;</td>
                      </tbody>";
            }
            echo "</table>
                    <hr class='my-8 h-px bg-gray-200 border-0 dark:bg-gray-700'>
                    <p class='text-1xl font-black text-gray-900 dark:text-white'>Prezzo complessivo(+".$prezzoConsegna."&#8364; per la consegna): ".$prezzo."</p>";
        }else{
            echo "Inserire tutti i campi";
        }
    ?>
    </body>
</html>
