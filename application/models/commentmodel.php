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
    public function updateVotes($id, $vote){
        $id = strip_tags($id);
        $vote = $this->getVotes($id);

		if($vote == 'like') {
			$likes = $vote->likes + 1;
            return $likes;
        }

        elseif($vote == 'dislike') {
            $likes = $vote->likes - 1;
            return $likes;
        }

        $sql = "UPDATE votes SET likes= :likes  WHERE id= :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':likes' => $likes);

        $query->execute($parameters);

        return $query->fetchAll();
        }

}
