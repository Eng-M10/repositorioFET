<?php

class Document{
    private $_db; 
    private $_doctitle;
    private $_docID;
    private $_docautor;
    private $_docresumo;
    private $_doctipo;
    private $_docarquivo;

    public function getTitle(){
        return $this->_doctitle;
    }
    public function getAutor(){
        return $this->_docautor;
    }
    public function getResumo(){
        return $this->_docresumo;
    }

    public function getTipo(){
        return $this->_doctipo;
    }

    public function getArquivo(){
        return $this->_docarquivo;
    }

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
    public function getDocumentByID($id){

            return $this->_db->get("document",array("id_doc", '=', $id));
    }

    public function documentData($id){
        $document = $this->getDocumentByID($id);

        if ($document->count() > 0) {
         
            foreach ($document->results() as $document) {
                $this->_docID = $document->id_doc;
                $this->_doctitle = $document->titulo;
                $this->_docautor = $document->autores;
                $this->_docresumo = $document->resumo;
                $this->_doctipo = $document->tipo_trabalho;
                $this->_docarquivo = $document->arquivo;
            }
        }
    }

    public function getDocumentByUserID($id){

        return $this->_db->get("document",array("id_user", '=', $id));

    }
    public function createDocument($fields){
        if (!$this->_db->insert('document', $fields)) {
            throw new Exception('Ocorreu um problema ao Adicionar o Documento!');
        }
    }
    public function deleteDocumentByID($id){
        return $this->_db->delete('document', array("id_doc","=",$id));
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

                echo "<td><span><a href ='editdocument.php?id={$document->id_doc}'><i class='bi bi-pencil-square'></i></a></span> | <span><a href='delete.php?id={$document->id_doc}'><i class='bi bi-trash'></i></a></span>
                </td>";
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