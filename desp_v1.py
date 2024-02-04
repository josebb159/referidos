import os


# Solicitar al usuario que ingrese el nombre del modelo y del controlador
modelo = input("Ingrese el nombre del modelo: ")
controlador = modelo
name_app="prueba_app"
# Solicitar al usuario que ingrese los atributos y métodos de la clase
modelo_atributos = input("Ingrese los atributos de la clase modelo (separados por comas): ").split(',')
modelo_metodos = input("Ingrese los métodos de la clase modelo (separados por comas): ").split(',')

# Crear las carpetas si no existen
if not os.path.exists('model'):
    os.makedirs('model')
if not os.path.exists('controller'):
    os.makedirs('controller')

# Crear el archivo del modelo si no existe
if not os.path.exists(f"model/{modelo}.php"):
    with open(f"model/{modelo}.php", 'w') as f:
        f.write("<?php\n")
        f.write(f"class {modelo} {{\n")
        f.write(f"\tpublic $conexion;\n")
        for atributo in modelo_atributos:
            f.write(f"\tprivate ${atributo};\n")
        f.write("\n")
        
        f.write(f"\tpublic function registrar_{modelo}($id")
        for atributo in modelo_atributos:
            f.write(f",${atributo}")
        f.write(",$estado){\n")
        f.write(f'\t$estado_defaul = 1;\n')
        f.write(f'\t$sql = "INSERT INTO `rol`(`estado`')
        for atributo in modelo_atributos:
            f.write(f",`{atributo}`")
        f.write(f') VALUES (:estado')
        for atributo in modelo_atributos:
            f.write(f",:{atributo}")
        f.write(f')";\n')
        f.write(f'\t$reg = $this->conexion->prepare($sql);\n')
        f.write(f"\t$reg->execute(array(':estado' => $estado_defaul")
        for atributo in modelo_atributos:
            f.write(f",':{atributo}' => ${atributo}")
        f.write(f'));\n')
        f.write(f'\treturn 1;\n')
        f.write('\t}\n')

        f.write(f"\tpublic function buscar_{modelo}(){{")
        f.write(f'$sql = "SELECT  * FROM {modelo} ";\n')
        f.write('\t$reg = $this->conexion->prepare($sql);\n')
        f.write('\t$reg->execute();\n')
        f.write('\t$consulta =$reg->fetchAll();\n')
        f.write('\tif ($consulta) {\n')
        f.write('\t\treturn $consulta;\n')
        f.write('\t}else{\n')
        f.write('\t\treturn 0;\n')
        f.write('\t} }\n')

        f.write(f"\tpublic function cambiar_estado_{modelo}($id, $estado){{")
        f.write(f'$sql = "UPDATE `{modelo}` SET `estado`=:estado WHERE id=:id";\n')
        f.write('\t$reg = $this->conexion->prepare($sql);\n')
        f.write("\t$reg->execute(array(':id' => $id, ':estado' => $estado));\n")
        f.write('\t}\n')

        f.write(f"\tpublic function eliminar_{modelo}($id, $estado){{")
        f.write(f'$sql = "DELETE FROM `{modelo}`  WHERE id=:id";\n')
        f.write('\t$reg = $this->conexion->prepare($sql);\n')
        f.write("\t$reg->execute(array(':id' => $id));\n")
        f.write('\t}\n')

        f.write(f"\tpublic function modificar_{modelo}($id, $estado")
        for atributo in modelo_atributos:
            f.write(f",${atributo}")
        f.write("){\n")
        f.write(f'\t$sql = "UPDATE `{modelo}` SET `estado`=:estado ')
        for atributo in modelo_atributos:
            f.write(f",`{atributo}`=:{atributo}")
        f.write(f' WHERE id=:id";\n')
        f.write('\t$reg = $this->conexion->prepare($sql);\n')
        f.write("\t$reg->execute(array(':id' => $id, ':estado' => $estado")
        for atributo in modelo_atributos:
            f.write(f",':{atributo}' => ${atributo}")
        f.write(f'));\n')
        f.write('\t}\n')

        f.write(f"\tpublic function buscar_json_{modelo}($id){{")
        f.write(f'$sql = "SELECT  * FROM rol where id=".$id."";\n')
        f.write('\t$reg = $this->conexion->prepare($sql);\n')
        f.write("\t$reg->execute();\n")
        f.write("\t$results = $reg->fetchAll(PDO::FETCH_ASSOC);\n")
        f.write("\treturn json_encode($results);\n")
        f.write('\t}\n')


        for metodo in modelo_metodos:
            f.write(f"\tpublic function {metodo}() {{\n")
            f.write("\t\t// Código del método aquí\n")
            f.write("\t}\n\n")
        f.write("}\n?>")
        print(f"Archivo {modelo}.php creado en la carpeta model")
else:
    print(f"El archivo {modelo}.php ya existe en la carpeta model")

# Crear el archivo del controlador si no existe
if not os.path.exists(f"controller/{controlador}Controller.php"):
    with open(f"controller/{controlador}Controller.php", 'w') as f:
        f.write("<?php\n")
        f.write(f"include '../model/{controlador}.php';\n")
        f.write("\n")
        f.write(f"if(isset($_POST['id'])){{\n")
        f.write(f"\t$id =  $_POST['id'];\n")
        f.write("}\n")
        f.write("\n")
        for atributo in modelo_atributos:
            f.write(f"if(isset($_POST['${atributo}'])){{\n")
            f.write(f"\t${atributo} =  $_POST['{atributo}'];\n")
            f.write(f"\tif (!preg_match('/^[a-zA-Z0-9\s]{{0,100}}$/', ${atributo})) {{ die('error {atributo}');}}\n")
            f.write("}\n")
            f.write("\n")
        f.write("\n")
        f.write(f"if(isset($_POST['estado'])){{\n")
        f.write(f"\t$estado =  $_POST['estado'];\n")
        f.write("}\n")
        f.write("\n")
        f.write(f"if(isset($_POST['op'])){{\n")
        f.write(f"\t$op =  $_POST['op'];\n")
        f.write("}\n")
        f.write("\n")
        f.write("switch ($op) {\n")

        f.write("\tcase 'registrar':\n")
        f.write(f"\t\t$n_{controlador}  = new {controlador}();\n")
        f.write(f"\t\t$resultado = $n_{controlador}  -> registrar_{controlador}($id")
        for atributo in modelo_atributos:
            f.write(f",${atributo}")
        f.write(");\n")
        f.write("\t\techo $resultado;\n")
        f.write("\tbreak;\n")

        f.write("\tcase 'buscar':\n")
        f.write(f"\t\t$n_{controlador}  = new {controlador}();\n")
        f.write(f"\t\t$resultado = $n_{controlador}  -> buscar_{controlador}();\n")
        f.write("\t\tif($resultado==0){\n")
        f.write("\t\t\texit();\n")
        f.write("\t\t}\n")
        f.write("\t\tforeach ($resultado as $key) {\n")
        f.write("\t\t\tif($key['estado']=='1'){\n")
        f.write("\t\t\t\t$st = 'checked';\n")
        f.write("\t\t\t}else{\n")
        f.write("\t\t\t\t$st = '';\n")
        f.write("\t\t\t}\n")
        f.write("\t\t?>\n")
        f.write("\t\t<tr>\n")
        f.write("\t\t\t<td><?= $key['id']; ?></td>\n")
        for atributo in modelo_atributos:
            f.write(f"\t\t\t<td><?= $key['{atributo}']; ?></td>\n")
        f.write("\t\t\t<td><?= $key['estado']; ?></td>\n")
        f.write("\t\t\t<td>\n")
        f.write('\t\t\t\t<div class="dropdown">\n')
        f.write('\t\t\t\t\t<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n')
        f.write("\t\t\t\t\t\tAcciones\n")
        f.write('\t\t\t\t\t\t<i class="mdi mdi-chevron-down"></i>\n')
        f.write('\t\t\t\t\t\t</button>\n')
        f.write('\t\t\t\t\t\t<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">\n')
        f.write('\t\t\t\t\t\t\t<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal2" onclick="modificar(<?php echo "')
        f.write("'\".$key['id'].\"'")
        for atributo in modelo_atributos:
            f.write(f",'\".$key['{atributo}'].\"'")
        f.write(",'\".$key['estado'].\"'")
        f.write('"; ?>)">Aprobar</a>\n')
        f.write('\t\t\t\t\t\t\t<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key[\'id\']; ?>)">Eliminar</a>\n')
        f.write('\t\t\t\t\t\t</div>\n')
        f.write('\t\t\t\t\t</div>\n')
        f.write('\t\t\t</td>\n')
        f.write('\t\t</tr>\n')
        f.write('\t\t<?php\n')
        f.write('\t\t}\n')
        f.write("\tbreak;\n")

        f.write("\tcase 'cambiar_estado':\n")
        f.write(f"\t\t$n_{controlador}  = new {controlador}();\n")
        f.write(f"\t\t$resultado = $n_{controlador}  -> cambiar_estado($id, $estado);\n")
        f.write('\t\techo 1;\n')
        f.write("\tbreak;\n")

        f.write("\tcase 'eliminar':\n")
        f.write(f"\t\t$n_{controlador}  = new {controlador}();\n")
        f.write(f"\t\t$resultado = $n_{controlador}  -> eliminar($id);\n")
        f.write('\t\techo 1;\n')
        f.write("\tbreak;\n")

        f.write("\tcase 'buscar_select':\n")
        f.write(f"\t\t$n_{controlador}  = new {controlador}();\n")
        f.write(f"\t\t$resultado = $n_{controlador}  -> buscar_select();\n")
        f.write("\t\tforeach ($resultado as $key) {\n")
        f.write("\t\t?>\n")
        f.write("\t\t\t<option value=\"<?php echo $key['id']; ?>\"><?php echo $key['descripcion']; ?></option>;\n")
        f.write("\t\t<?php\n")
        f.write("\t\t}\n")
        f.write("\tbreak;\n")

        f.write("\tcase 'buscar_json':\n")
        f.write(f"\t\t$n_{controlador}  = new {controlador}();\n")
        f.write(f"\t\t$resultado = $n_{controlador}  -> buscar_json($id);\n")
        f.write('\t\techo $resultado;\n')
        f.write("\tbreak;\n")



        f.write("\tcase 'modificar':\n")
        f.write(f"\t\t$n_{controlador}  = new {controlador}();\n")
        f.write(f"\t\t$resultado = $n_{controlador}  -> modificar($id")
        for atributo in modelo_atributos:
            f.write(f",${atributo}")
        f.write(",$estado);\n")
        f.write('\t\techo 1;\n')
        f.write("\tbreak;\n")

        for metodo in modelo_metodos:
            f.write(f"\tcase '{metodo}':\n")
            f.write(f"\t\t$n_{controlador}  = new {controlador}();\n")
            f.write(f"\t\t$resultado = $n_{controlador}  -> {metodo}($id")
            for atributo in modelo_atributos:
                f.write(f",${atributo}")
            f.write(",$estado);\n")
            f.write("\tbreak;\n")

        f.write("\tdefault:\n")
        f.write("\tbreak;\n")

        f.write("}\n")
        
        print(f"Archivo {controlador}Controller.php creado en la carpeta controller")
else:
    print(f"El archivo {controlador}Controller.php ya existe en la carpeta controller")





# Crear el archivo del controlador si no existe
if not os.path.exists(f"assets/js/functions/administrador/{controlador}.js"):
    with open(f"assets/js/functions/administrador/{controlador}.js", 'w') as f:
        
        f.write("$(document).ready(function(){\n")
        f.write("\tver_registros();\n")
        f.write("});\n\n")

        f.write("function registrar(){\n")
        f.write("\tvar result = function_ajax({\n")
        f.write("\t\t'op':'registrar',\n")
        for atributo in modelo_atributos:
            f.write(f"\t\t'{atributo}': $(\"#{atributo}\").val(),\n")
        f.write("\t\t'estado':'1'\n}")
        f.write(f"\t,'../controller/{controlador}Controller.php');\n")
        f.write("\tif(result==\"1\"){\n")
        f.write("\t\talert_success();\n")
        for atributo in modelo_atributos:
            f.write(f'\t\t$("#{atributo}").val("");\n')
        f.write("\t}\n")
        f.write("}\n\n")


        f.write("function ver_registros(){\n")
        f.write("\tvar table = $('#datatable-buttons').DataTable();\n")
        f.write("\ttable.destroy();\n")
        f.write("\tvar result = function_ajax({\n")
        f.write("\t\t'op':'buscar'\n}")
        f.write(f"\t,'../controller/{controlador}Controller.php');\n")
        f.write("\t$(\"#datos\").html(result);\n")
        f.write("\t$('#datatable-buttons').DataTable( {\n")
        f.write("\t\tdom: 'Bfrtip',\n")
        f.write("\t\tbuttons: [\n")
        f.write("\t\t\t'copy', 'csv', 'excel', 'pdf', 'print'\n")
        f.write("\t\t]\n")
        f.write("\t});\n")
        f.write("}\n\n")

        f.write("function cambiar_estado(id, estado){\n")
        f.write("\tif(estado==1){\n")
        f.write("\t\testado=0\n")
        f.write("\t}else{\n")
        f.write("\t\testado=1\n")
        f.write("\t}\n")
        f.write("\tvar result = function_ajax({\n")
        f.write("\t\t'op':'cambiar_estado',\n")
        f.write("\t\t'id': id,\n")
        f.write("\t\t'estado':estado\n}")
        f.write(f"\t,'../controller/{controlador}Controller.php');\n")
        f.write("\tif(result==\"1\"){\n")
        f.write("\t\talert_success();\n")
        f.write("\t}\n")
        f.write("}\n\n")


        f.write("function eliminar( id ){\n")
        f.write("\tSwal.fire({\n")
        f.write("\t\ttitle: \"Estas seguro de eliminar este registro?\",\n")
        f.write("\t\ttext: \"seleccione las siguentes opciones para continuar!\",\n")
        f.write("\t\ticon: \"warning\",\n")
        f.write("\t\tshowCancelButton: true,\n")
        f.write("\t\tconfirmButtonColor: \"#1cbb8c\",\n")
        f.write("\t\tcancelButtonColor: \"#ff3d60\",\n")
        f.write("\t\tconfirmButtonText: \"Si, deseo eliminar\",\n")
        f.write("\t\tcancelButtonText: \"Cancelar\"\n")
        f.write("\t}).then(function (result) {\n")
        f.write("\t\tif (result.value) {\n")
        f.write("\t\t\tvar result = function_ajax({\n")
        f.write("\t\t\t\t'op':'cambiar_estado',\n")
        f.write("\t\t\t\t'id': id\n}")
        f.write(f"\t\t\t,'../controller/{controlador}Controller.php');\n")
        f.write("\t\t\tif(result==\"1\"){\n")
        f.write("\t\t\t\tver_registros();\n")
        f.write("\t\t\t\tSwal.fire(\"Eliminado!\", \"La registro fue eliminado.\", \"success\");\n")
        f.write("\t\t\t}\n")
        f.write("\t\t}\n")
        f.write("\t});\n")
        f.write("}\n\n")

        f.write("function cargar_datos(id")
        for atributo in modelo_atributos:
            f.write(f",{atributo}")
        f.write(",estado){\n")
        f.write("\t$(\"#id\").val(id);\n")
        for atributo in modelo_atributos:
            f.write(f"\t$(\"#{atributo}\").val({atributo});\n")
        f.write("\t$(\"#estado\").val(estado);\n")
        f.write("}\n\n")


        f.write("function modificar(){\n")
        f.write("\tvar id =  $(\"#id\").val();\n")
        for atributo in modelo_atributos:
            f.write(f"\tvar {atributo} =  $(\"#{atributo}\").val();\n")
        f.write("\tSwal.fire({\n")
        f.write("\t\ttitle: \"Estas seguro de modificar este registro?\",\n")
        f.write("\t\ttext: \"seleccione las siguentes opciones para continuar!\",\n")
        f.write("\t\ticon: \"warning\",\n")
        f.write("\t\tshowCancelButton: true,\n")
        f.write("\t\tconfirmButtonColor: \"#1cbb8c\",\n")
        f.write("\t\tcancelButtonColor: \"#ff3d60\",\n")
        f.write("\t\tconfirmButtonText: \"Si, deseo modificar\",\n")
        f.write("\t\tcancelButtonText: \"Cancelar\"\n")
        f.write("\t}).then(function (result) {\n")
        f.write("\t\tif (result.value) {\n")
        f.write("\t\t\tvar result = function_ajax({\n")
        f.write("\t\t\t\t'op':'modificar',\n")
        f.write("\t\t\t\t'id': id,\n")
        for atributo in modelo_atributos:
            f.write(f"\t\t\t\t'{atributo}': {atributo},\n")
        f.write("\t\t\t}")
        f.write(f",'../controller/{controlador}Controller.php');\n")
        f.write("\t\t\tif(result==\"1\"){\n")
        f.write("\t\t\t\tver_registros();\n")
        f.write("\t\t\t\tSwal.fire(\"Modificado!\", \"El registro fue modificado.\", \"success\");\n")
        f.write("\t\t\t\t$('#myModal').modal('hide');\n")
        f.write("\t\t\t}\n")
        f.write("\t\t}\n")
        f.write("\t});\n")
        f.write("}\n\n")



        f.write("function alert_success(){\n")
        f.write("\tSwal.fire({\n")
        f.write("\t\ttitle: 'Listo, has agregado un registro!',\n")
        f.write("\t\ttext: 'Preciona el boton para aceptar!',\n")
        f.write("\t\ticon: 'success',\n")
        f.write("\t\tconfirmButtonColor: '#5664d2'\n")
        f.write("\t});\n")
        f.write("}\n\n")

        f.write("function alert_warning(){\n")
        f.write("\tSwal.fire({\n")
        f.write("\t\ttitle: 'Error al registrar la categoria!',',\n")
        f.write("\t\ttext: 'Preciona el boton para aceptar!',\n")
        f.write("\t\ticon: 'warning',\n")
        f.write("\t\tconfirmButtonColor: '#5664d2'\n")
        f.write("\t});\n")
        f.write("}\n\n")

        f.write("$('#sa-warning').click(function () {\n")
        f.write("});\n\n")


        f.write("$(\"#form_1\").on('submit', function(evt){\n")
        f.write("\tevt.preventDefault();  \n")
        f.write("\tmodificar();\n")
        f.write("});\n\n")

        f.write("$(\"#form_2\").on('submit', function(evt){\n")
        f.write("\tevt.preventDefault();  \n")
        f.write("\tmodificar();\n")
        f.write("});\n\n")

        f.write("function function_ajax(data,url){\n")
        f.write("\t$.post({\n")
        f.write("\t\ttype: 'POST',\n")
        f.write("\t\turl: url,\n")
        f.write("\t\tdata: data,\n")
        f.write("\t\tsuccess: function(response){\n")
        f.write("\t\t\treturn response;\n")
        f.write("\t\t}\n")
        f.write("\t});\n")
        f.write("}\n")


        
        print(f"Archivo {controlador}.js creado en la carpeta /assets/js/functions/administrador")
else:
    print(f"El archivo {controlador}.js ya existe en la carpeta /assets/js/functions/administrador")




# Crear el archivo del vista si no existe
if not os.path.exists(f"view/dinamic/administrador/{controlador}.php"):
    with open(f"view/dinamic/administrador/{controlador}.php", 'w') as f:
        f.write("<!-- DataTables -->\n")
        f.write('<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />\n')
        f.write('<link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />\n')
        f.write('<link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />\n')
        f.write('<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />\n\n')
        f.write('<div class="page-content">\n')
        f.write('\t<div class="container-fluid">\n')
        f.write('\t\t<div class="row">\n')
        f.write('\t\t\t<div class="col-12">\n')
        f.write('\t\t\t\t<div class="page-title-box d-sm-flex align-items-center justify-content-between">\n')
        f.write(f'\t\t\t\t\t<h4 class="mb-sm-0">Lista de {controlador}</h4>\n')
        f.write('\t\t\t\t\t<div class="page-title-right">\n')
        f.write('\t\t\t\t\t\t<ol class="breadcrumb m-0">\n')
        f.write(f'\t\t\t\t\t\t\t<li class="breadcrumb-item"><a href="javascript: void(0);">{name_app}</a></li>\n')
        f.write(f'\t\t\t\t\t\t\t<li class="breadcrumb-item active">Listado de {controlador}</li>\n')
        f.write('\t\t\t\t\t\t</ol>\n')
        f.write('\t\t\t\t\t</div>\n')
        f.write('\t\t\t\t</div>\n')
        f.write('\t\t\t</div>\n')
        f.write('\t\t</div>\n')
        f.write('\t\t<div class="row">\n')
        f.write('\t\t\t<div class="col-12">\n')
        f.write('\t\t\t\t<div class="card">\n')
        f.write('\t\t\t\t\t<div class="card-body">\n')
        f.write(f'\t\t\t\t\t\t<h4 class="card-title">{controlador}</h4>\n')
        f.write('\t\t\t\t\t\t<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">\n')
        f.write('\t\t\t\t\t\t\t<thead>\n')
        f.write('\t\t\t\t\t\t\t\t<th>ID</th>\n')
        for atributo in modelo_atributos:
            f.write(f'\t\t\t\t\t\t\t\t<th>{atributo}</th>\n')
        f.write('\t\t\t\t\t\t\t\t<th>Opciones</th>\n')
        f.write('\t\t\t\t\t\t\t<thead>\n')
        f.write('\t\t\t\t\t\t\t<tbody id="datos">\n')
        f.write('\t\t\t\t\t\t\t</tbody>\n')
        f.write('\t\t\t\t\t\t</table>\n')
        f.write('\t\t\t\t\t\t<button type="button"  class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_agregar">Agregar usuario</button>\n')
        f.write('\t\t\t\t\t</div>\n')
        f.write('\t\t\t\t</div>\n')
        f.write('\t\t\t</div>\n')
        f.write('\t\t</div>\n')
        f.write('\t</div>\n')
        f.write('</div>\n\n\n')
     
        f.write('<?php \n')
        f.write('$aditionals_js=\'\n')
        f.write('<!-- Required datatable js -->\n')
        f.write('<script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>\n')
        f.write('<script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>\n')
        f.write("<!-- Buttons examples -->\n")
        f.write('<script src="../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>\n')
        f.write('<script src="../assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>\n')
        f.write('<script src="../assets/libs/jszip/jszip.min.js"></script>\n')
        f.write('<script src="../assets/libs/pdfmake/build/pdfmake.min.js"></script>\n')
        f.write('<script src="../assets/libs/pdfmake/build/vfs_fonts.js"></script>\n')
        f.write('<script src="../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>\n')
        f.write('<script src="../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>\n')
        f.write('<script src="../assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>\n')
        f.write('<script src="../assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>\n')
        f.write('<script src="../assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>\n')
        f.write('<!-- Responsive examples -->\n')
        f.write('<script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>\n')
        f.write('<script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>\n')
        f.write('<!-- Datatable init js -->\n')
        f.write('<script src="../assets/js/pages/datatables.init.js"></script>\n')
        f.write('\';\n')
        f.write('?>\n')
        
        
        print(f"Archivo {controlador}.php creado en la carpeta view/dinamic/administrador/")
else:
    print(f"El archivo {controlador}.php ya existe en la carpeta view/dinamic/administrador/")



# Verificar si existe la carpeta sql
if not os.path.exists('sql'):
    os.makedirs('sql')

if not os.path.exists(f"sql/{modelo}sql.php"):
    with open(f"sql/{modelo}.sql", 'w') as f:
        
        f.write(f"Create table {modelo}(\n") 
        f.write(f"\tid_{modelo} int AUTO_INCREMENT,  \n") 
        for atributo in modelo_atributos:
            f.write(f"\t{atributo} varchar(100),\n")
        f.write(f"\tfecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),\n") 
        f.write(f"\tfecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),\n") 
        f.write(f"\tprimary key(id_{modelo})\n") 
        f.write(")\n")
        print(f"Archivo {controlador}.sql creado en la carpeta sql")
else:
    print(f"El archivo {controlador}Controller.php ya existe en la carpeta controller")



path = "model"
extension = ".php"
array_name = "php_files"

files = [f for f in os.listdir(path) if os.path.isfile(os.path.join(path, f)) and f.endswith(extension)]

with open("archivo_php.py", "w") as f:
    f.write(f"{array_name} = {str(files)}\n")

try:
    from archivo_php import php_files
except ImportError:
    print("El archivo generado no se pudo importar correctamente")
else:
    
    for file in php_files:
        if file not in files:
            print(f"El archivo falta en la carpeta")
            print(f"El archivo {file} falta en la carpeta")
            php_files.remove(file)
            with open("archivo_php.py", "w") as f:
                f.write(f"{array_name} = {str(php_files)}\n")




linea_general = 0
direccion = 'view/view_controller_admin.php'
with open(direccion) as archivo:
    linea = 1
    for contenido in archivo:
        if '/*construir*/' in contenido:
            linea_general=linea
            print(f"La cadena se encuentra en la línea {linea}")
            break
        linea += 1

linea_general = linea_general - 1

# Leemos todas las líneas del archivo en una lista
with open(direccion, "r") as archivo:
    lineas = archivo.readlines()

# Borramos la línea 3 (índice 2 porque los índices de la lista empiezan en 0)
del lineas[linea_general]

# Sobreescribimos el archivo con las nuevas líneas
with open(direccion, "w") as archivo:
    archivo.writelines(lineas)





with open(direccion, "r") as archivo:
    lineas = archivo.readlines()

# Agregamos la cadena en la línea 3 (índice 2 porque los índices de la lista empiezan en 0)
lineas.insert(linea_general,"\t" +'elseif($_GET[\'view\']=="'+controlador+'"){' + "\n")
lineas.insert(linea_general+1, "\t\t"+ "include 'dinamic/administrador/"+controlador+".php';" + "\n")
lineas.insert(linea_general+2, "\t" '}' + "\n")
lineas.insert(linea_general+3, '/*construir*/'+ "\n")


# Sobreescribimos el archivo con las nuevas líneas
with open(direccion, "w") as archivo:
    archivo.writelines(lineas)



linea_general = 0
direccion = 'view/static/menu.php'
with open(direccion) as archivo:
    linea = 1
    for contenido in archivo:
        if '<!--construir-->' in contenido:
            linea_general=linea
            print(f"La cadena se encuentra en la línea {linea}")
            break
        linea += 1

linea_general = linea_general - 1

# Leemos todas las líneas del archivo en una lista
with open(direccion, "r") as archivo:
    lineas = archivo.readlines()

# Borramos la línea 3 (índice 2 porque los índices de la lista empiezan en 0)
del lineas[linea_general]

# Sobreescribimos el archivo con las nuevas líneas
with open(direccion, "w") as archivo:
    archivo.writelines(lineas)





with open(direccion, "r") as archivo:
    lineas = archivo.readlines()

# Agregamos la cadena en la línea 3 (índice 2 porque los índices de la lista empiezan en 0)
lineas.insert(linea_general,"\t" +'<li>' + "\n")
lineas.insert(linea_general+1, "\t\t"+ ' <a href="home.php?view='+controlador+'" class=" waves-effect <?php if($valor=="'+controlador+'"){ echo "active mm-active"; } ?>">' + "\n")
lineas.insert(linea_general+2, "\t\t\t" '<i class="fas fa-fw fa-wrench"></i>' + "\n")
lineas.insert(linea_general+3, "\t\t\t" '<span>'+controlador+'</span>' + "\n")
lineas.insert(linea_general+4, "\t\t" '</a>' + "\n")
lineas.insert(linea_general+5, "\t" '</li>' + "\n")
lineas.insert(linea_general+6  , '<!--construir-->'+ "\n")


# Sobreescribimos el archivo con las nuevas líneas
with open(direccion, "w") as archivo:
    archivo.writelines(lineas)








linea_general = 0
direccion = 'view/static/dependencias_js_admin.php'
with open(direccion) as archivo:
    linea = 1
    for contenido in archivo:
        if '/*construir*/' in contenido:
            linea_general=linea
            print(f"La cadena se encuentra en la línea {linea}")
            break
        linea += 1

linea_general = linea_general - 1

# Leemos todas las líneas del archivo en una lista
with open(direccion, "r") as archivo:
    lineas = archivo.readlines()

# Borramos la línea 3 (índice 2 porque los índices de la lista empiezan en 0)
del lineas[linea_general]

# Sobreescribimos el archivo con las nuevas líneas
with open(direccion, "w") as archivo:
    archivo.writelines(lineas)





with open(direccion, "r") as archivo:
    lineas = archivo.readlines()

# Agregamos la cadena en la línea 3 (índice 2 porque los índices de la lista empiezan en 0)
lineas.insert(linea_general,"\t" +'if($_GET[\'view\']=="'+controlador+'"){' + "\n")
lineas.insert(linea_general+1, "\t\t"+ 'echo "<script src=\'../assets/js/functions/administrador/'+controlador+'.js\'></script>";' + "\n")
lineas.insert(linea_general+2, "\t" '}' + "\n")
lineas.insert(linea_general+3  , '/*construir*/'+ "\n")


# Sobreescribimos el archivo con las nuevas líneas
with open(direccion, "w") as archivo:
    archivo.writelines(lineas)