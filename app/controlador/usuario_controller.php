<?php
header("Content-Type: text/html;charset=utf-8");
function login($nombre_user, $contrasena){
    include("app/modelo/conexion.php");
    $contrasena = $_POST['user_pass'];
    $passHash = password_hash($contrasena, PASSWORD_BCRYPT);
    $descifrar = password_verify($contrasena, $passHash);

    $sentencia = 'SELECT password FROM usuarios WHERE nombre=:nombre_user and password=:pass_user'; 
    $valorcito = array(
        ':nombre_user' => $nombre_user,
        'pass_user' => $contrasena
    );


if($valorcito){
    $usuario = seleccionar($sentencia, $valorcito);

    if(!empty($usuario)){ 
        session_start();
        $obj = json_decode(json_encode($usuario)); 
        $_SESSION['usuario']['id']= $obj['0']->id;
        $_SESSION['usuario']['nombre_user']= $obj['0']->nombre_user;
        $_SESSION['usuario']['nombre_comp']=$obj['0']->nombre_comp;
        $_SESSION['usuario']['contrasena']=$obj['0']->contrasena;
        $_SESSION['usuario']['telefono']=$obj['0']->telefono;
        $_SESSION['usuario']['correo']=$obj['0']->correo;
        $_SESSION['usuario']['codigo_acceso']= $obj['0']->codigo_acceso;
        print("changos");
        return true;

    }else{

        return false;
    }
}

}

function logout(){
    
    session_destroy();
}


function registrar($usuario){
    include("app/modelo/conexion.php");
    $nombre_user = ($_POST['nombre_user']);
    $contrasena = ($_POST['contrasena']);
    $correo = ($_POST['correo']);
    $codigo_acceso = ($_POST['codigo_acceso']);
    $contrasena = $_POST['contrasena'];
    $passHash = password_hash($contrasena, PASSWORD_BCRYPT);
    
        $query = 'INSERT INTO app_paciente VALUES(:id, :nombre_user, :nombre_comp, :contrasena, :telefono, :correo, :codigo_acceso)';

        $valores = array(
            ':id' => null,
            ':nombre_user' => $usuario['nombre_user'],
            ':nombre_comp' => $usuario['nombre_comp'],
            ':contrasena' => $passHash,
            ':telefono' =>$usuario['telefono'],
            ':correo' => $usuario['correo'],
            ':codigo_acceso' => $usuario['codigo_acceso']
            );
    
        $sentencia = 'SELECT * FROM app_paciente WHERE nombre_user=:nombre_user';
        $validar = array(
            ':nombre_user' => $nombre_user
        );

        $s = 'SELECT * FROM app_paciente WHERE correo=:correo';
        $v = array(
            ':correo' => $correo
        );

        $sql = 'SELECT * FROM app_psicologo WHERE codigo=:codigo_acceso';
        $val = array(
            ':codigo_acceso' => $codigo_acceso
        );


        if(seleccionar($sentencia, $validar)){
            echo "<script> alert('Este nombre de usuario ya se encuentra registrado, intente con uno nuevo.');</script>";
            
               

        }else if(seleccionar($s, $v)){
            echo "<script> alert('Este correo electrónico ya se encuentra registrado.');</script>";
     
        }else{
            if(seleccionar($sql, $val) ){
                $insertar = (insertar($query, $valores));

                $sentencia = 'SELECT contrasena FROM app_paciente WHERE nombre_user=:nombre_user'; 
                $valorcito = array(
                    ':nombre_user' => $nombre_user
                );
            
                $contraArreglo = seleccionar($sentencia, $valorcito);
                $contraReal = $contraArreglo[0]['contrasena'];

                if($contraArreglo){
                    $descifrar = password_verify($contrasena, $contraReal);
                    if($descifrar == 1){
            
                        $query = 'SELECT * FROM app_paciente WHERE nombre_user=:nombre_user'; 
            
                        $valor = array(
                            ':nombre_user' => $nombre_user
                        );
            
                        $usuario = seleccionar($query, $valor);
            
                        if(!empty($usuario)){ 
                            session_start();
                            $obj = json_decode(json_encode($usuario)); 
                            $_SESSION['usuario']['id']= $obj['0']->id;
                            $_SESSION['usuario']['nombre_user']= $obj['0']->nombre_user;
                            $_SESSION['usuario']['nombre_comp']=$obj['0']->nombre_comp;
                            $_SESSION['usuario']['contrasena']=$obj['0']->contrasena;
                            $_SESSION['usuario']['telefono']=$obj['0']->telefono;
                            $_SESSION['usuario']['correo']=$obj['0']->correo;
                            $_SESSION['usuario']['codigo_acceso']= $obj['0']->codigo_acceso;
                            header("location:index.php");
                        }else{
                            echo "<script> alert('Hubo un problema.');</script>";
                        }
                            
                    }
            
                }                        
                
               
        }else{
            echo "<script> alert('El código de acceso que ingresó es incorrecto.');</script>";
        }
    }

  
}

function editarDatos($id){
    include_once("app/modelo/conexion.php");
    $sentencia = 'UPDATE app_paciente SET contrasena=:contrasena, telefono=:telefono, correo=:correo WHERE id=:id';
    $validar = array(
        ':id' => null,
        ':contrasena' => $usuario['contrasena'],
        ':telefono' =>$usuario['telefono'],
        ':correo' => $usuario['correo']
        );

    actualizar($sentencia, $validar);
}
?>