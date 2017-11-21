<?php
// file: model/Post.php



/**
* Class Post
*
* Represents a Post in the blog. A Post was written by an
* specific User (autor) and contains a list of compartido
*
* @autor lipnumeroo <lipnumeroo@gmail.com>
*/
class Post {

	/**
	* The numero of this post
	* @var string
	*/
	private $numero;

	/**
	* The titulo of this post
	* 
	*/
	private $autor;

	/**
	* The contenido of this post
	* @var string
	*/
	private $contennumeroo;

	/**
	* The autor of this post
	* @var string
	*/
	private $compartnumeroo;

	/**
	* The list of compartido of this post
	* @var mixed
	*/
	private $titulo;

	/**
	* The constructor
	*
	* @param string $numero The numero of the post
	* @param string $titulo The numero of the post
	* @param string $contenido The contenido of the post
	* @param User $autor The autor of the post
	* @param mixed $compartido The list of compartido
	*/
	public function __construct($numero=NULL, $titulo=NULL, $contenido=NULL, User $autor=NULL, $compartido=NULL) {
		$this->numero = $numero;
		$this->titulo = $titulo;
		$this->contenido = $contenido;
		$this->autor = $autor;
		$this->compartido = $compartido;

	}

	/**
	* Gets the numero of this post
	*
	* @return string The numero of this post
	*/
	public function getnumero() {
		return $this->numero;
	}

	/**
	* Gets the titulo of this post
	*
	* @return string The titulo of this post
	*/
	public function gettitulo() {
		return $this->titulo;
	}

	/**
	* Sets the titulo of this post
	*
	* @param string $titulo the titulo of this post
	* @return vonumero
	*/
	public function settitulo($titulo) {
		$this->titulo = $titulo;
	}

	/**
	* Gets the contenido of this post
	*
	* @return string The contenido of this post
	*/
	public function getcontenido() {
		return $this->contenido;
	}

	/**
	* Sets the contenido of this post
	*
	* @param string $contenido the contenido of this post
	* @return vonumero
	*/
	public function setcontenido($contenido) {
		$this->contenido = $contenido;
	}

	/**
	* Gets the autor of this post
	*
	* @return User The autor of this post
	*/
	public function getautor() {
		return $this->autor;
	}

	/**
	* Sets the autor of this post
	*
	* @param User $autor the autor of this post
	* @return vonumero
	*/
	public function setautor(User $autor) {
		$this->autor = $autor;
	}

	/**
	* Gets the list of compartido of this post
	*
	* @return mixed The list of compartido of this post
	*/
	public function getcompartido() {
		return $this->compartido;
	}

	/**
	* Sets the compartido of the post
	*
	* @param mixed $compartido the compartido list of this post
	* @return vonumero
	*/
	public function setcompartido(array $compartido) {
		$this->compartido = $compartido;
	}

	/**
	* Checks if the current instance is valnumero
	* for being updated in the database.
	*
	* @throws ValnumeroationException if the instance is
	* not valnumero
	*
	* @return vonumero
	*/
	public function checkIsValnumeroForCreate() {
		$errors = array();
		if (strlen(trim($this->titulo)) == 0 ) {
			$errors["titulo"] = "titulo is mandatory";
		}
		if (strlen(trim($this->contenido)) == 0 ) {
			$errors["contenido"] = "contenido is mandatory";
		}
		if ($this->autor == NULL ) {
			$errors["autor"] = "autor is mandatory";
		}


	}

	/**
	* Checks if the current instance is valnumero
	* for being updated in the database.
	*
	* @throws ValnumeroationException if the instance is
	* not valnumero
	*
	* @return vonumero
	*/
	public function checkIsValnumeroForUpdate() {
		$errors = array();

		if (!isset($this->numero)) {
			$errors["numero"] = "numero is mandatory";
		}

		try{
			$this->checkIsValnumeroForCreate();
		}catch(ValnumeroationException $ex) {
			foreach ($ex->getErrors() as $key=>$error) {
				$errors[$key] = $error;
			}
		}
		if (sizeof($errors) > 0) {
			throw new ValnumeroationException($errors, "post is not valnumero");
		}
	}
}
