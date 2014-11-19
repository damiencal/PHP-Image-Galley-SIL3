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

	/**
     * Return an image votes
     * @param string $id Image ID
     */
    public function getVotes($id){
        $id = strip_tags($id;)

        $sql = "SELECT * FROM votes WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetchAll();
    }

	/**
     * Update an image votes
     * @param string $id Image ID
     */
    public function getVotes($id){
        $id = strip_tags($id;)

        $vote = $this->getVotes($id);

		if($vote=='like'){
			$likes = $vote->likes + 1;

            $sql = "UPDATE note set positive='$positive',negative='$note->negative',idImg='$note->idImg' WHERE id='$note->id'";
            $query = $this->db->prepare($sql);
            $parameters = array(':id' => $id);

            $query->execute($parameters);

            return $query->fetchAll();
        }

        else{
            $likes = $vote->likes - 1;
            $sql = "UPDATE note set positive='$note->positive',negative='$negative',idImg='$note->idImg' WHERE id='$note->id'";
            $query = $this->db->prepare($sql);
            $parameters = array(':id' => $id);

            $query->execute($parameters);

            return $query->fetchAll();

        }

    }

}
