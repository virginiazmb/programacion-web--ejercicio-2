<?php

    include "students.php";
    session_start();

        if(!isset($_SESSION['promediostu'])){
            $_SESSION['promediostu']= [];
        }

        if(isset($_POST['btn'])){
            if(isset($_POST['cedula']) && !empty ($_POST['cedula']) && isset($_POST['name']) && !empty ($_POST['name']) && isset($_POST['mate']) && !empty ($_POST['mate']) && isset($_POST['fisi']) && !empty ($_POST['fisi']) && isset($_POST['program']) && !empty ($_POST['program'])){

                $studentreg = new estudiantesdatos();

                $studentreg->setCedula($_POST['cedula']);
                $studentreg->setNombre($_POST['name']);
                $studentreg->setNotasmat($_POST['mate']);
                $studentreg->setNotasfisic($_POST['fisi']);
                $studentreg->setNotasprogram($_POST['program']);

                array_push($_SESSION['promediostu'], $studentreg);
                //print_r($_SESSION['promediostu']);
                echo "<h2> PROMEDIOS:  </h2>";
                prom();

            } 

            else{
                echo "It didn't work, try again!"; }
        } 


    function prom(){

            // nota maxima de cada materia
            $maxmate=0;
            $maxfisic=0;
            $maxprog=0;

            // cantidad de alumnos aprobados 
            $mateaprob=0;
            $fisicaprob=0;
            $programaprob=0;

            //cantidad de alumnos reprobados

            $matereprob=0;
            $fisicreprob=0;
            $programrepro=0;

            // para sumar las notas en orden para obtener el promedio

            $sumamate=0;
            $sumafisi=0;
            $sumaprog=0;

             // promedio de materias

            $mateprom=0;
            $fisiprom=0;
            $programprom=0;

            //cantidad de alumnos que aprobaron, una, dos, tres materias
            
            $estudiante_uno=0;
            $estudiante_dos=0;
            $estudiante_tres=0;



        // se utiliza un contador para los alumnos y materias en el arreglo, en orden para determinar lo que se necesita.
        $counter= count($_SESSION['promediostu']);

        //nota maxima en cada materia

        for($i=0; $i<$counter; $i++){
            if($_SESSION['promediostu'][$i]->getNotasmat()>$maxmate){

                $maxmate= $_SESSION['promediostu'][$i]->getNotasmat();
            }
            
        }

        echo "<br>";
        echo "<h3>Nota maxima de matematicas: ".$maxmate . "</h3>";
    


        for($i=0; $i<$counter; $i++){
            if($_SESSION['promediostu'][$i]->getNotasfisic()>$maxfisic){
    
                $maxfisic= $_SESSION['promediostu'][$i]->getNotasfisic();
                }
            }

            echo "<h3>Nota maxima de fisica: ". $maxfisic . "</h3>";


        for($i=0; $i<$counter; $i++){
            if($_SESSION['promediostu'][$i]->getNotasprogram()>$maxprog){
            
                $maxprog= $_SESSION['promediostu'][$i]->getNotasprogram();
                
                }
            }
        
            echo "<h3>Nota maxima de programacion: ". $maxprog . "</h3><br>";


        // Alumnos aprobados y reprobados

        if(isset($_SESSION['promediostu'])){
            for($i=0; $i<$counter; $i++){

                if ( $_SESSION['promediostu'][$i]->getNotasmat() >= 10) {
                $mateaprob++;

                } else {
                $matereprob++;
                }
            }

            echo "<br>";

            echo "<h3>Total de alumnos aprobados en matematicas: ". $mateaprob . "</h3>";

            echo "<h3>Total de alumnos reprobados en matematicas: ". $matereprob . "</h3>";
        }


        if(isset($_SESSION['promediostu'])){
            for($i=0; $i<$counter; $i++){

                if ( $_SESSION['promediostu'][$i]->getNotasfisic() >= 10) {
                $fisicaprob++;

                } else {
                $fisicreprob++;
                }
            }

            echo "<br>";

            echo "<h3>Total de alumnos aprobados en fisica: ". $fisicaprob . "</h3>";

            echo "<h3>Total de alumnos reprobados en fisica: ". $fisicreprob . "</h3>";
        }


        if(isset($_SESSION['promediostu'])){
            for($i=0; $i<$counter; $i++){

                if ( $_SESSION['promediostu'][$i]->getNotasprogram() >= 10) {
                $programaprob++;

                } else {
                $programrepro++;
                }
            }

            echo "<br>";

            echo "<h3>Total de alumnos aprobados en programacion: ". $programaprob . "</h3>";

            echo "<h3>Total de alumnos reprobados en programacion: ". $programrepro . "</h3>";
        }


        // para obtener las notas de las materias

        for($i=0;$i<$counter;$i++){ 
            $sumamate += $_SESSION['promediostu'][$i]->getNotasmat();
        }
        
        for($i=0;$i<$counter;$i++){ 
            $sumafisi += $_SESSION['promediostu'][$i]->getNotasfisic();
        }

        for($i=0;$i<$counter;$i++){ 
            $sumaprog += $_SESSION['promediostu'][$i]->getNotasprogram();
        }


        // para obtener el promedio de las materias

        if($counter == 0 && $sumamate == 0){
            echo "<h4>No hay notas registradas, por favor ingrese una</h4><br>";

        }else {
            $mateprom=($sumamate/$counter);
            
            echo "<br>";
            echo "<h3>El promedio de matematicas de los alumnos es: " . $mateprom . "</h3>";
        }


        if($counter == 0 && $sumafisi == 0){
            echo "<h4>No hay notas registradas, por favor ingrese una</h4>";

        }else {
            $fisiprom=($sumafisi/$counter);
        
            echo "<h3>El promedio de fisica de los alumnos es: " . $fisiprom . "</h3>";
        }


        if($counter == 0 && $sumaprog == 0){
            echo "<h4>No hay notas registradas, por favor ingrese una</h4>";

        }else {
            $programprom=($sumaprog/$counter);
        
            echo "<h3>El promedio de programacion de los alumnos es: " . $programprom . "</h3><br>";
        }


        // alumno que aprobo una materia

        if(isset($_SESSION['promediostu'])) {
            
            for($i=0;$i<$counter;$i++){

                if($_SESSION['promediostu'][$i]->getNotasmat() >= 10 && $_SESSION['promediostu'][$i]->getNotasfisic() < 10 && $_SESSION['promediostu'][$i]->getNotasprogram() < 10 || $_SESSION['promediostu'][$i]->getNotasmat() < 10 && $_SESSION['promediostu'][$i]->getNotasprogram() >= 10 && $_SESSION['promediostu'][$i]->getNotasfisic() < 10 || $_SESSION['promediostu'][$i]->getNotasfisic() >= 10 && $_SESSION['promediostu'][$i]->getNotasprogram() < 10 && $_SESSION['promediostu'][$i]->getNotasmat() < 10) {
                    
                    $estudiante_uno++;
                }
        
            }
            echo "<br>";
            echo "<h3>Alumnos que aprobaron una materia: ". $estudiante_uno . "</h3>";
        }


        // alumno que aprobo dos materias

        if(isset($_SESSION['promediostu'])) {
            
            for($i=0;$i<$counter;$i++){

                if($_SESSION['promediostu'][$i]->getNotasmat() >= 10 && $_SESSION['promediostu'][$i]->getNotasfisic() >= 10 && $_SESSION['promediostu'][$i]->getNotasprogram() < 10 || $_SESSION['promediostu'][$i]->getNotasmat() >= 10 && $_SESSION['promediostu'][$i]->getNotasprogram() >= 10 && $_SESSION['promediostu'][$i]->getNotasfisic() < 10 || $_SESSION['promediostu'][$i]->getNotasfisic() >= 10 && $_SESSION['promediostu'][$i]->getNotasprogram() >= 10 && $_SESSION['promediostu'][$i]->getNotasmat() < 10) {
                    
                    $estudiante_dos++;
                    
                }
        
            }
            echo "<h3>Alumnos que aprobaron dos materias: ". $estudiante_dos . "</h3>";
        }


        // alumno que aprobo tres materias

        if(isset($_SESSION['promediostu'])) {

            for($i=0;$i<$counter;$i++) {
                if($_SESSION['promediostu'][$i]->getNotasmat() >= 10 && $_SESSION['promediostu'][$i]->getNotasfisic() >= 10 && $_SESSION['promediostu'][$i]->getNotasprogram()){
        
                    $estudiante_tres++;
                }
            }
            echo "<h3>Alumnos que aprobaron tres materias ". $estudiante_tres . "</h3>";
        }
    
    }

?>