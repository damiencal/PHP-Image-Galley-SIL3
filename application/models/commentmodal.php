<?php

class CommentModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

########################################

		/**
		 * Retourne les notes pour un idImg doné
		 * @param int $idImg
		 */
		function getNote($idImg){
			return $this->db->getNoteByIdImg("note",$idImg);
		}


		/**
		 * Met a jour la note d'une image
		 * @param String $val indique la note(Pos/Neg) a modifier
		 * @param int $idImg id de l'image
		 */
		function updateNote($val, $idImg){
			$note = $this->getNote($idImg);
			$this->db->updateNote("note",$val, $note);
		}




}
