<?php
    function comprueba_valido($valor,$tipo,$valor_confirmacion="") {
       
        switch ($tipo) {
            case "texto";
                $valido = trim(html_entity_decode($valor));
                if ($valido == "") {
                    $valido = false;
                }
            break;
            case "pass";
                $valido = $valor;
                if ($valor<>$valor_confirmacion) {
                    $valido = false;
                }

            break;
            case "email";
                $valido = filter_var($valor, FILTER_VALIDATE_EMAIL);
                if (!$valido) {
                    $valido = false; 
                }
            break;
            case "codigopostal";
                $valido = preg_match('/^[0-9]{5,5}$/', $valor);
                if ($valido) {
                    $valido = $valor;
                }
            break;
            case "numero";
                
                if (!is_numeric($valor)) {
                    $valido = false; 
                }
                else {
                    $valido = $valor;
                }
            break;
            case "select";
                if (!isset($valor)) {
                    $valido = false; 
                }
                else {
                    $valido = $valor;
                }
            break;
        }
        return $valido;

    }
    function genera_enviado_acciones(&$enviado, &$acciones, $codPed,$fecha,$codRes=0,$administrador=0) {
    
        if ($enviado == 0) {
            $enviado = '<span class="no_enviado">NO ENVIADO</span>';
            $acciones = '<a href="consultar_pedido.php?codPed='. $codPed . '&codRes=' . $codRes . '" class="button icon small solid fa-search">Ver pedido</a>';
            $acciones .= '<a href="modificar_pedido.php?codPed='. $codPed . '&codRes=' . $codRes . '" class="button icon small solid fa-bars separado">Modificar pedido</a>';
            if ($administrador== 1) {
                $acciones .= '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" class="inline" >
                <input type="submit" value="Enviar pedido" class="icon small solid fa-paper-plane ">
                <input type="hidden" name="codPed" value="' . $codPed . '">
                <input type="hidden" name="codRes" value="' . $codRes . '">
            </form>'; 
            }
            $acciones .= '<form action="generar_pedido.php" method="post" class="inline" >
                                <input type="submit" value="Eliminar pedido" class="icon small solid fa-trash primary">
                                <input type="hidden" name="accion" value="eliminar_ped" class="icon small solid fa-trash primary">
                                <input type="submit" name="pdf" value="generar pdf">
                                <input type="hidden" name="codPed" value="' . $codPed . '">
                                <input type="hidden" name="codRes" value="' . $codRes . '">  
                                <input type="hidden" name="fecha" value="' .  $fecha . '">                     
                            </form>';
            
        }
        else {
            $enviado = '<span class="enviado">ENVIADO</span>';
            $acciones = '<a href="consultar_pedido.php?codPed='. $codPed . '&codRes=' . $codRes . '" class="button icon small solid fa-search">Ver pedido</a>';
        
        }


    }

    // CATEGORÍAS
    function sql_listar_categorias ($pdo, &$stmt,&$hay_categorias) {
        try {
		
            $sql = 'select * from categorias';
            $stmt = $pdo->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $hay_categorias = $stmt->rowCount();
            
        }
        catch (PDOException $err) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL.";
        }

    }
    function select_categorias ($pdo, &$hay_categorias, &$select_categorias, $valor_seleccionado=0) {
        
        sql_listar_categorias ($pdo, $stmt, $hay_categorias);
     
        $select_categorias = '<select name="CodCat" id="CodCat">';
            while ($row_categorias = $stmt->fetch())   {
                if ($row_categorias["CodCat"] == $valor_seleccionado) {
                    $select_categorias .= '<option value="'. $row_categorias["CodCat"] . '" selected="selected">'. $row_categorias["Nombre"] . '</option>';
                }
                else {
                    $select_categorias .= '<option value="'. $row_categorias["CodCat"] . '">'. $row_categorias["Nombre"] . '</option>';
                }    
            }     
        $select_categorias .= '</select>';
        $stmt = null;

    }
    function listar_categorias($pdo,$perfil, &$tabla, &$hay_categorias) {
        
        sql_listar_categorias ($pdo, $stmt, $hay_categorias);
      
        $tabla = '<table class="alt">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
						<tbody>';
							while ($row = $stmt->fetch()) {
                                $tabla .= '<tr>
                                <td>' . $row["Nombre"] . '</td>
                                <td>' . $row["Descripcion"] . '</td>
                                <td>
                                    <a href="ver_productos_categoria.php?CodCat=' . $row["CodCat"] . '" class="button small icon solid fa-search">Ver productos</a>';
                                if ($perfil == "Administrador") {
                                    $tabla .= ' <a href="modificar_categoria.php?CodCat=' . $row["CodCat"] . '" class="button icon small solid fa-bars">Modificar</a>
                                                <a href="eliminar_categoria.php?CodCat=' . $row["CodCat"] . '" class="button icon small solid fa-trash primary">Eliminar</a>';
                                }

                                $tabla .='</td></tr>';
                            }
						$tabla .= '</tbody></table>';
        
    }

    // PRODUCTOS

    function sql_listar_productos($pdo, &$stmt, &$hay_productos, $categoria=0) {
        try {
		
            $sql = 'SELECT p.CodProd, p.Nombre, p.Descripcion, p.Peso, p.Stock, c.Nombre as nombreCat, c.CodCat
                    FROM productos p, categorias c 
                    WHERE p.Categoria=c.CodCat';
            if ($categoria <>0) {
                $sql .= " and p.Categoria = $categoria";
            }
            $stmt = $pdo->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $hay_productos = $stmt->rowCount();
         
            
        }
        catch (PDOException $err) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL.";
        }
    }
    function listar_productos($stmt,$perfil) {
        $tabla ='<table class="alt">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Peso</th>
                            <th>Stock</th>
                            <th>Categoría</th>';
                        if ($perfil=='Administrador') {
                            $tabla .= '<th>Acciones</th>';
                        }
                    $tabla .='        
                        </tr>
                    </thead>
                    <tbody>';
                    while ($row = $stmt->fetch()) {
                        $tabla .= '<tr>
                                <td>' . $row["Nombre"] . '</td>
                                <td>' . $row["Descripcion"] . '</td>
                                <td>' . $row["Peso"] . '</td>
                                <td>' . $row["Stock"] . '</td>
                                <td><a href="ver_productos_categoria.php?CodCat=' . $row["CodCat"] . '" class="button small icon solid fa-search">' . $row["nombreCat"] . '</a></td>';
                                if ($perfil == "Administrador") {
                                    $tabla .= '<td> <a href="modificar_producto.php?CodProd=' . $row["CodProd"] . '" class="button icon small solid fa-bars">Modificar</a>
                                                <a href="eliminar_producto.php?CodProd=' . $row["CodProd"] . '" class="button icon small solid fa-trash primary">Eliminar</a></td>';
                                }

                                $tabla .='</tr>';
                            }
						$tabla .= '</tbody></table>';
        return $tabla;
    }

    //RESTAURANTES

    function sql_listar_restaurantes($pdo, &$stmt, &$hay_restaurantes) {
        try {
		
            $sql = 'SELECT *
                    FROM restaurantes';
           
            $stmt = $pdo->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $hay_restaurantes = $stmt->rowCount();
         
            
        }
        catch (PDOException $err) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL.";
        }
    }
    function listar_restaurantes($stmt) {
        $tabla ='<table class="alt">
                    <thead>
                        <tr>
                            <th>Correo</th>
                            <th>Dirección</th>
                            <th>Ciudad</th>
                            <th>Código Postal</th>
                            <th>Pais</th>
                            <th>Acciones</th>';
                    $tabla .='        
                        </tr>
                    </thead>
                    <tbody>';
                    while ($row = $stmt->fetch()) {
                        $tabla .= '<tr>
                                <td>' . $row["Correo"] . '</td>
                                <td>' . $row["Direccion"] . '</td>
                                <td>' . $row["Ciudad"] . '</td>
                                <td>' . $row["CP"] . '</td>
                                <td>' . $row["Pais"] . '</td>
                                <td> <a href="modifica_restaurante.php?CodRes=' . $row["CodRes"] . '" class="button icon small solid fa-bars">Modificar</a>
                                     <a href="listar_pedidos_restaurante.php?CodRes=' . $row["CodRes"] . '" class="button icon small solid fa-search primary">Listar Pedidos</a>
                                     <a href="eliminar_restaurante.php?CodRes=' . $row["CodRes"] . '" class="button icon small solid fa-trash primary">Eliminar</a></td>';
                                $tabla .='</tr>';
                            }
						$tabla .= '</tbody></table>';
        return $tabla;

    }

    function sql_datos_restaurante($pdo, $CodRes) {
        try {
            $sql = 'select * from restaurantes where CodRes = :CodRes';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':CodRes',$CodRes);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
        }
        catch (PDOException $err) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL.";
        }
        return $row;
    }
?>