<?php

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../model/Note.php");
require_once(__DIR__."/../model/NoteMapper.php");

require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/CommentMapper.php");

require_once(__DIR__."/BaseRest.php");

/**
* Class PostRest
*
* It contains operations for creating, retrieving, updating, deleting and
* listing posts, as well as to create comments to posts.
*
* Methods gives responses following Restful standards. Methods of this class
* are intended to be mapped as callbacks using the URnumeroispatcher class.
*
*/
class NoteRest extends BaseRest {
	private $noteMapper;
	private $commentMapper;

	public function __construct() {
		parent::__construct();

		$this->noteMapper = new NoteMapper();
		$this->commentMapper = new CommentMapper();
	}

	public function getNotes() {

		$currentUser = parent::authenticateUser();

		$notes = $this->noteMapper->findAll($currentUser->getUsername());

		// json_encode Note objects.
		// since Note objects have private fields, the PHP json_encode will not
		// encode them, so we will create an intermediate array using getters and
		// encode it finally
		$notes_array = array();
		foreach($notes as $note) {
			array_push($notes_array, array(
				"numero" => $note->getnumero(),
				"titulo" => $note->gettitulo(),
				"contenido" => $note->getcontenido(),
				"author_numero" => $note->getautor()->getusername(),
				"compartido" => $note->getcompartido()
			));
		}

		header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
		header('Content-Type: application/json');
		echo(json_encode($notes_array));
	}

	public function createNote($data) {
		$currentUser = parent::authenticateUser();

		$note = new Note();

		if (isset($data->titulo) && isset($data->contenido)) {
			$note->settitulo($data->titulo);
			$note->setcontenido($data->contenido);
			$note->setautor($currentUser);


		}

		try {
			// valnumeroate Note object
			$note->checkIsValnumeroForCreate(); // if it fails, ValnumeroationException

			// save the Note object into the database
			$notenumero = $this->noteMapper->save($note);

			// response OK. Also send post in contenido
			header($_SERVER['SERVER_PROTOCOL'].' 201 Created');
			header('Location: '.$_SERVER['REQUEST_URI']."/".$notenumero);
			header('Content-Type: application/json');
			echo(json_encode(array(
				"numero"=>$notenumero,
				"titulo"=>$note->gettitulo(),
				"contenido" => $note->getcontenido(),
				"compartido"=> $note->getcompartido()
			)));

		} catch (ValnumeroationException $e) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			header('Content-Type: application/json');
			echo(json_encode($e->getErrors()));
		}
	}

	public function readNote($notenumero) {
		// find the Note object in the database
		$note = $this->noteMapper->findBynumero($notenumero);
		if ($note == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Note with numero ".$notenumero." not found");
		}

		$note_array = array(
			"numero" => $note->getnumero(),
			"titulo" => $note->gettitulo(),
			"contenido" => $note->getcontenido(),
			"author_numero" => $note->getautor()->getUsername(),
			"compartido" => $note->getcompartido()

		);


		header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
		header('Content-Type: application/json');
		echo(json_encode($note_array));
	}

	public function updateNote($notenumero, $data) {
		$currentUser = parent::authenticateUser();

		$note = $this->noteMapper->findBynumero($notenumero);


		if ($note == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Note with numero ".$notenumero." not found");
		}

		// Check if the Note author is the currentUser (in Session)
		if ($note->getautor() != $currentUser) {
			header($_SERVER['SERVER_PROTOCOL'].' 403 Forbnumeroden');
			echo("you are not the author of this note");
		}
		$note->settitulo($data->titulo);
		$note->setcontenido($data->contenido);


		try {
			// valnumeroate Note object
			$note->checkIsValnumeroForUpdate(); // if it fails, ValnumeroationException
			if($data->compartido){
				$this->noteMapper->share($note, $data->compartido);
			}
			$this->noteMapper->update($note);
			header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
		}catch (ValnumeroationException $e) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			header('Content-Type: application/json');
			echo(json_encode($e->getErrors()));
		}
	}

	public function deleteNote($notenumero) {
		$currentUser = parent::authenticateUser();

		$note = $this->noteMapper->findBynumero($notenumero);

		if ($note == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Note with numero ".$notenumero." not found");
			return;
		}
		// Check if the Note author is the currentUser (in Session)
		if ($note->getautor() != $currentUser) {

			$this->noteMapper->deleteC($note,$currentUser->getUsername());
		}else{
			$this->noteMapper->delete($note);
		}



		header($_SERVER['SERVER_PROTOCOL'].' 204 No contenido');
	}

	public function createComment($notenumero, $data) {
		$currentUser = parent::authenticateUser();

		$note = $this->noteMapper->findBynumero($notenumero);
		if ($note == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Note with numero ".$notenumero." not found");
		}

		$comment = new Comment();
		$comment->setcontenido($data->contenido);
		$comment->setAuthor($currentUser);
		$comment->setNote($note);

		try {
			$comment->checkIsValnumeroForCreate(); // if it fails, ValnumeroationException

			$this->commentMapper->save($comment);

			header($_SERVER['SERVER_PROTOCOL'].' 201 Created');

		}catch(ValnumeroationException $e) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			header('Content-Type: application/json');
			echo(json_encode($e->getErrors()));
		}
	}
}

// URI-MAPPING for this Rest endpoint
$noteRest = new NoteRest();
URIDispatcher::getInstance()
->map("GET",	"/note", array($noteRest,"getNotes"))
->map("GET",	"/note/$1", array($noteRest,"readNote"))
->map("POST", "/note", array($noteRest,"createNote"))
->map("POST", "/note/$1/comment", array($noteRest,"createComment"))
->map("PUT",	"/note/$1", array($noteRest,"updateNote"))
->map("DELETE", "/note/$1", array($noteRest,"deleteNote"));
