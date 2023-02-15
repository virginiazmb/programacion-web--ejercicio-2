<?php

    class estudiantesdatos{

        private $name= "";
        private $cedula= "";
        private $mate;
        private $fisi=0;
        private $program=0;

        public function getNombre(){
            return $this->name;
        }

        public function setNombre($name){
            $this->name=$name;
        }

        public function getCedula(){
            return $this->cedula;
        }

        public function setCedula($cedula){
            $this->cedula=$cedula;
        }

        public function getNotasmat(){
            return $this->mate;
        }

        public function setNotasmat($mate){
            $this->mate=$mate;
        }

        public function getNotasfisic(){
            return $this->fisi;
        }

        public function setNotasfisic($fisi){
            $this->fisi=$fisi;
        }

        public function getNotasprogram(){
            return $this->program;
        }

        public function setNotasprogram($program){
            $this->program=$program;
        }
    }

?>