<?php
// file: model/NoteMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Note.php");
require_once(__DIR__."/../model/Comment.php");

/**
* Class NoteMapper
*
* Database interface for Note entities
*
* @author lipNumeroo <lipNumeroo@gmail.com>
*/
class NoteMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Retrieves all notes
	*
	* Note: Comments are not added to the Note instances
	*
	* @throws PDOException if a database error occurs
	* @return mixed Array of Note instances (without comments)
	*/
	public function findAll($currentUser) {

		//$stmt = $this->db->query("SELECT * FROM notas, usuarios,comparte WHERE usuarios.login = notas.AUTOR OR (usuarios.login=comparte.login and comparte.numero=notas.numero)");
		$stmt = $this->db->query("SELECT notas.Numero,notas.AUTOR,notas.TITULO,notas.CONTENIDO,notas.COMPARTIDO FROM notas,comparte WHERE(notas.Numero=comparte.Numero AND comparte.login='$currentUser' AND comparte.BORRADO='NO')");
		$notes_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$notes = array();

		foreach ($notes_db as $note) {
			$author = new User($note["AUTOR"]);
			array_push($notes, new Note($note["Numero"], $note["TITULO"],  $note["CONTENIDO"], $author, $note["COMPARTIDO"]));
		}

		$stmt = $this->db->query("SELECT * FROM notas WHERE AUTOR='$currentUser'");
		$notesC_db = $stmt->fetchAll(PDO::FETCH_ASSOC);



		foreach ($notesC_db as $note) {
			$author = new User($note["AUTOR"]);
			array_push($notes, new Note($note["Numero"], $note["TITULO"],  $note["CONTENIDO"], $author, $note["COMPARTIDO"]));
		}





		return $notes;
	}

	/**
	* Loads a Note from the database given its Numero
	*
	* Note: Comments are not added to the Note
	*
	* @throws PDOException if a database error occurs
	* @return Note The Note instances (without comments). NULL
	* if the Note is not found
	*/
	public function findByNumero($noteNumero){
		$stmt = $this->db->prepare("SELECT * FROM notas WHERE Numero=?");
		$stmt->execute(array($noteNumero));
		$note = $stmt->fetch(PDO::FETCH_ASSOC);

		if($note != null) {
			return new Note(
			$note["Numero"],
			$note["TITULO"],
			$note["CONTENIDO"],
			new User($note["AUTOR"]),
			$note["COMPARTIDO"]
			);
		} else {
			return NULL;
		}
	}

	/**
	* Loads a Note from the database given its Numero
	*
	* It includes all the comments
	*
	* @throws PDOException if a database error occurs
	* @return Note The Note instances (without comments). NULL
	* if the Note is not found
	*/
	/*
	public function findByNumeroWithComments($noteNumero){
		$stmt = $this->db->prepare("SELECT
			P.Numero as 'note.Numero',
			P.titulo as 'note.titulo',
			P.CONTENIDO as 'note.CONTENIDO',
			P.author as 'note.author',
			C.Numero as 'comment.Numero',
			C.CONTENIDO as 'comment.CONTENIDO',
			C.note as 'comment.note',
			C.author as 'comment.author'

			FROM notes P LEFT OUTER JOIN comments C
			ON P.Numero = C.note
			WHERE
			P.Numero=? ");

			$stmt->execute(array($noteNumero));
			$note_wt_comments= $stmt->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($note_wt_comments) > 0) {
				$note = new Note($note_wt_comments[0]["note.Numero"],
				$note_wt_comments[0]["note.titulo"],
				$note_wt_comments[0]["note.CONTENIDO"],
				new User($note_wt_comments[0]["note.author"]));
				$comments_array = array();
				if ($note_wt_comments[0]["comment.Numero"]!=null) {
					foreach ($note_wt_comments as $comment){
						$comment = new Comment( $comment["comment.Numero"],
						$comment["comment.CONTENIDO"],
						new User($comment["comment.author"]),
						$note);
						array_push($comments_array, $comment);
					}
				}
				$note->setComments($comments_array);

				return $note;
			}else {
				return NULL;
			}
		}
*/
		/**
		* Saves a Note into the database
		*
		* @param Note $note The note to be saved
		* @throws PDOException if a database error occurs
		* @return int The mew note Numero
		*/
		public function save(Note $note) {
			$stmt = $this->db->prepare("INSERT INTO notas(AUTOR,TITULO,CONTENIDO,COMPARTIDO) values (?,?,?,?)");
			$stmt->execute(array($note->getautor()->getUsername(),$note->gettitulo(), $note->getcontenido(), $note->getcompartido()));
			return $this->db->lastInsertId();
		}

		public function share(Note $note, $username) {

			$stmt = $this->db->prepare("INSERT INTO comparte(Numero,login,borrado) values (?,?,?)");
			$stmt->execute(array($note->getnumero(),$username, "NO"));
			return $this->db->lastInsertId();
		}

		/**
		* Updates a Note in the database
		*
		* @param Note $note The note to be updated
		* @throws PDOException if a database error occurs
		* @return voNumero
		*/
		public function update(Note $note) {
			$stmt = $this->db->prepare("UPDATE notas set titulo=?, contenido=?,compartido=? where Numero=?");
			$stmt->execute(array($note->gettitulo(), $note->getcontenido(),$note->getcompartido(), $note->getnumero()));
		}

		/**
		* Deletes a Note into the database
		*
		* @param Note $note The note to be deleted
		* @throws PDOException if a database error occurs
		* @return voNumero
		*/
		public function delete(Note $note) {
			$stmt = $this->db->prepare("DELETE from notas WHERE Numero=?");
			$stmt->execute(array($note->getnumero()));
		}

		public function deleteC(Note $note,$currentUser) {
			$stmt = $this->db->prepare("UPDATE comparte SET borrado='SI' WHERE Numero=? AND login='$currentUser'");
			$stmt->execute(array( $note->getnumero()));
		}



}
