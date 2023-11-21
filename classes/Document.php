<?php

class Document{
    private $_db; 


    public function __construct(){
        $this->_db = DB::getInstance();
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
        if (!$this->_db->insert('document', $fields)) {
            throw new Exception('Ocorreu um problema ao Adicionar o Documento!');
        }
    }
    public function deleteDocumentByID($id){
        $this->_db->delete("document",array("id"=>$id));
    }

    public function showAllDocumentsByType($type){
        $documents = $this->getDocumentByType($type);
        if ($documents->count() > 0) {
            echo "<tbody>";
            foreach ($documents->results() as $document) {
                
                echo "<tr>";
                echo "<td> <a href='$document->arquivo' download>".$document->titulo."</a></td>";
                echo "<td>".$document->autores."</td>";
                echo "<td>".$document->data_submissao."</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        } else {
            echo "<li>No documents found.</li>";
        }
    }
    
    public function showAllDocuments(){
        $documents = $this->getAllDocuments();
        if ($documents->count() > 0) {
         
            foreach ($documents->results() as $document) {
                
                echo "<tr>";
                echo "<td> <a href='$document->arquivo' download>".$document->titulo."</a></td>";
                
                echo "<td>".$document->autores."</td>";
                echo "<td>".$document->tipo_trabalho."</td>";
                echo "<td>".$document->data_submissao."</td>";
                echo "</tr>";
            }

           
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
                echo "<td><a href ='editdocument.php'><i class='fa-regular fa-pen-to-square fa-bounce'></i></a></td>";
                echo "<td><a href='delete.php?id=$document->id'><i class='bi bi-trash'></i></a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
        } else {
            echo "<li>No documents found.</li>";
        }


    }

    public function upload($file): string {
        
        $upload_dir = __DIR__ . "./../resources/pdf/";
    
        // Verificar se o arquivo foi enviado sem erros
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return "error";
        }
    
        // Verificar se o tipo de arquivo é permitido (ajuste conforme necessário)
        $allowed_types = ['pdf', 'doc', 'docx'];
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    
        if (!in_array(strtolower($file_extension), $allowed_types)) {
            return "error";
        }
    
        // Gerar um nome único para o arquivo
        $unique_filename = uniqid() . '_' . $file['name'];
        $target_path = $upload_dir . $unique_filename;
    
        // Mover o arquivo para o diretório de upload
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            $url = "http://localhost/repositorioFET/resources/pdf/" . $unique_filename;
            return $url;
        } else {
            return "error";
        }
    }

}