<?php

class Document{
    private $_db; 


    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function cleanForm(){
        
    }

    public function getAllDocuments(){
            return $this->_db->get("document",array());
    }

    public function getDocumentByType($name){
            $name = ucfirst(strtolower($name));
            
            return $this->_db->get("document",array("tipo_trabalho", '=', $name));
    }
    public function getDocumentByUserID($id){

        return $this->_db->get("document",array("id_user", '=', $id));

    }
    public function deleteDocument($name){
            return $this->_db->delete("document",array("titulo"=>$name));
    }

    public function updateDocument($name,$fields){
            return $this->_db->update("document",array("titulo"=>$name),$fields);
    }

    public function createDocument($fields){
            return $this->_db->insert("document",$fields);
    }

    public function showAllDocumentsByType($type){
        $documents = $this->getDocumentByType($type);
        if ($documents->count() > 0) {
            echo "<tbody>";
            foreach ($documents->results() as $document) {
                
                echo "<tr>";
                echo "<td>".$document->titulo."</td>";
                echo "<td>".$document->autores."</td>";
                echo "<td>".$document->data_submissao."</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        } else {
            echo "<li>No documents found.</li>";
        }
    }

    public function showAllDocumentsByUserID($id){

        $documents = $this->getDocumentByUserID($id);
        if ($documents->count() > 0) {
            echo "<tbody>";
            foreach ($documents->results() as $document) {
                
                echo "<tr>";
                echo "<td>".$document->titulo."</td>";
                echo "<td>".$document->tipo_trabalho."</td>";
                echo "<td>".$document->data_submissao."</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        } else {
            echo "<li>No documents found.</li>";
        }


    }

}