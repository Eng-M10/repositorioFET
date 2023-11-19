<?php
require_once 'core/init.php';

if (Input::exists()) {

            $doc = new Document();
            $user = new User();
            $data = $user->data();

            $upload_result = $doc->upload($_FILES['ficheiro']);

            try {
                $doc->createDocument(
                    array(
                        'titulo' => Input::get('titulotrabalho'),
                        'resumo' => Input::get('resumotrabalho'),
                        'autores' => Input::get('autortrabalho'),
                        'tipo_trabalho' => Input::get('tipotrabalho'),
                        'id_user' => $data->id,
                        'estado' => 'Verificado',
                        'arquivo' => $upload_result
                    )
                );
                Redirect::to('userpainel.php');
                Session::flash('file', 'Foi Registado com sucesso, agora pode verificar o documento!');

            } catch (Exception $e) {
                echo "<p class='alert alert-danger text-center'>" . $e->getMessage() . "</p>";
            }
   
        }

