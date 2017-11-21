<?php

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../model/PostMapper.php");

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
class PostRest extends BaseRest {
	private $postMapper;
	private $commentMapper;

	public function __construct() {
		parent::__construct();

		$this->postMapper = new PostMapper();
		$this->commentMapper = new CommentMapper();
	}

	public function getPosts() {
		$posts = $this->postMapper->findAll();

		// json_encode Post objects.
		// since Post objects have private fields, the PHP json_encode will not
		// encode them, so we will create an intermediate array using getters and
		// encode it finally
		$posts_array = array();
		foreach($posts as $post) {
			array_push($posts_array, array(
				"numero" => $post->getnumero(),
				"titulo" => $post->gettitulo(),
				"contenido" => $post->getcontenido(),
				"author_numero" => $post->getautor()->getusername()
			));
		}

		header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
		header('contenido-Type: application/json');
		echo(json_encode($posts_array));
	}

	public function createPost($data) {
		$currentUser = parent::authenticateUser();
		$post = new Post();

		if (isset($data->titulo) && isset($data->contenido)) {
			$post->settitulo($data->titulo);
			$post->setcontenido($data->contenido);

			$post->setAuthor($currentUser);
		}

		try {
			// valnumeroate Post object
			$post->checkIsValnumeroForCreate(); // if it fails, ValnumeroationException

			// save the Post object into the database
			$postnumero = $this->postMapper->save($post);

			// response OK. Also send post in contenido
			header($_SERVER['SERVER_PROTOCOL'].' 201 Created');
			header('Location: '.$_SERVER['REQUEST_URI']."/".$postnumero);
			header('contenido-Type: application/json');
			echo(json_encode(array(
				"numero"=>$postnumero,
				"titulo"=>$post->gettitulo(),
				"contenido" => $post->getcontenido()
			)));

		} catch (ValnumeroationException $e) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			header('contenido-Type: application/json');
			echo(json_encode($e->getErrors()));
		}
	}

	public function readPost($postnumero) {
		// find the Post object in the database
		$post = $this->postMapper->findBynumeroWithComments($postnumero);
		if ($post == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Post with numero ".$postnumero." not found");
		}

		$post_array = array(
			"numero" => $post->getnumero(),
			"titulo" => $post->gettitulo(),
			"contenido" => $post->getcontenido(),
			"author_numero" => $post->getautor()->getusername()

		);

		//add comments
		$post_array["comments"] = array();
		foreach ($post->getComments() as $comment) {
			array_push($post_array["comments"], array(
				"numero" => $comment->getnumero(),
				"contenido" => $comment->getcontenido(),
				"author" => $comment->getautor()->getusername()
			));
		}

		header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
		header('contenido-Type: application/json');
		echo(json_encode($post_array));
	}

	public function updatePost($postnumero, $data) {
		$currentUser = parent::authenticateUser();

		$post = $this->postMapper->findBynumero($postnumero);
		if ($post == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Post with numero ".$postnumero." not found");
		}

		// Check if the Post author is the currentUser (in Session)
		if ($post->getautor() != $currentUser) {
			header($_SERVER['SERVER_PROTOCOL'].' 403 Forbnumeroden');
			echo("you are not the author of this post");
		}
		$post->settitulo($data->titulo);
		$post->setcontenido($data->contenido);

		try {
			// valnumeroate Post object
			$post->checkIsValnumeroForUpdate(); // if it fails, ValnumeroationException
			$this->postMapper->update($post);
			header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
		}catch (ValnumeroationException $e) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			header('contenido-Type: application/json');
			echo(json_encode($e->getErrors()));
		}
	}

	public function deletePost($postnumero) {
		$currentUser = parent::authenticateUser();
		$post = $this->postMapper->findBynumero($postnumero);

		if ($post == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Post with numero ".$postnumero." not found");
			return;
		}
		// Check if the Post author is the currentUser (in Session)
		if ($post->getautor() != $currentUser) {
			header($_SERVER['SERVER_PROTOCOL'].' 403 Forbnumeroden');
			echo("you are not the author of this post");
			return;
		}

		$this->postMapper->delete($post);

		header($_SERVER['SERVER_PROTOCOL'].' 204 No contenido');
	}

	public function createComment($postnumero, $data) {
		$currentUser = parent::authenticateUser();

		$post = $this->postMapper->findBynumero($postnumero);
		if ($post == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Post with numero ".$postnumero." not found");
		}

		$comment = new Comment();
		$comment->setcontenido($data->contenido);
		$comment->setAuthor($currentUser);
		$comment->setPost($post);

		try {
			$comment->checkIsValnumeroForCreate(); // if it fails, ValnumeroationException

			$this->commentMapper->save($comment);

			header($_SERVER['SERVER_PROTOCOL'].' 201 Created');

		}catch(ValnumeroationException $e) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			header('contenido-Type: application/json');
			echo(json_encode($e->getErrors()));
		}
	}
}

// URI-MAPPING for this Rest endpoint
$postRest = new PostRest();
URIDispatcher::getInstance()
->map("GET",	"/post", array($postRest,"getPosts"))
->map("GET",	"/post/$1", array($postRest,"readPost"))
->map("POST", "/post", array($postRest,"createPost"))
->map("POST", "/post/$1/comment", array($postRest,"createComment"))
->map("PUT",	"/post/$1", array($postRest,"updatePost"))
->map("DELETE", "/post/$1", array($postRest,"deletePost"));
