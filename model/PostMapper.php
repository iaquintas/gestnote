<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../model/Comment.php");

/**
* Class PostMapper
*
* Database interface for Post entities
*
* @author lipNumeroo <lipNumeroo@gmail.com>
*/
class PostMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Retrieves all posts
	*
	* Note: Comments are not added to the Post instances
	*
	* @throws PDOException if a database error occurs
	* @return mixed Array of Post instances (without comments)
	*/
	public function findAll($currentUser) {

		//$stmt = $this->db->query("SELECT * FROM notas, usuarios,comparte WHERE usuarios.login = notas.AUTOR OR (usuarios.login=comparte.login and comparte.numero=notas.numero)");
		$stmt = $this->db->query("SELECT notas.Numero,notas.AUTOR,notas.TITULO,notas.CONTENIDO,notas.COMPARTIDO FROM notas,comparte WHERE(notas.Numero=comparte.Numero AND comparte.login='$currentUser' AND comparte.BORRADO='NO')");
		$posts_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$posts = array();

		foreach ($posts_db as $post) {
			$author = new User($post["AUTOR"]);
			array_push($posts, new Post($post["Numero"], $post["TITULO"],  $post["CONTENIDO"], $author, $post["COMPARTIDO"]));
		}

		$stmt = $this->db->query("SELECT * FROM notas WHERE AUTOR='$currentUser'");
		$postsC_db = $stmt->fetchAll(PDO::FETCH_ASSOC);



		foreach ($postsC_db as $post) {
			$author = new User($post["AUTOR"]);
			array_push($posts, new Post($post["Numero"], $post["TITULO"],  $post["CONTENIDO"], $author, $post["COMPARTIDO"]));
		}





		return $posts;
	}

	/**
	* Loads a Post from the database given its Numero
	*
	* Note: Comments are not added to the Post
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Post is not found
	*/
	public function findByNumero($postNumero){
		$stmt = $this->db->prepare("SELECT * FROM notas WHERE Numero=?");
		$stmt->execute(array($postNumero));
		$post = $stmt->fetch(PDO::FETCH_ASSOC);

		if($post != null) {
			return new Post(
			$post["Numero"],
			$post["TITULO"],
			$post["CONTENIDO"],
			new User($post["AUTOR"]),
			$post["COMPARTIDO"]
			);
		} else {
			return NULL;
		}
	}

	/**
	* Loads a Post from the database given its Numero
	*
	* It includes all the comments
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Post is not found
	*/
	/*
	public function findByNumeroWithComments($postNumero){
		$stmt = $this->db->prepare("SELECT
			P.Numero as 'post.Numero',
			P.titulo as 'post.titulo',
			P.CONTENIDO as 'post.CONTENIDO',
			P.author as 'post.author',
			C.Numero as 'comment.Numero',
			C.CONTENIDO as 'comment.CONTENIDO',
			C.post as 'comment.post',
			C.author as 'comment.author'

			FROM posts P LEFT OUTER JOIN comments C
			ON P.Numero = C.post
			WHERE
			P.Numero=? ");

			$stmt->execute(array($postNumero));
			$post_wt_comments= $stmt->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($post_wt_comments) > 0) {
				$post = new Post($post_wt_comments[0]["post.Numero"],
				$post_wt_comments[0]["post.titulo"],
				$post_wt_comments[0]["post.CONTENIDO"],
				new User($post_wt_comments[0]["post.author"]));
				$comments_array = array();
				if ($post_wt_comments[0]["comment.Numero"]!=null) {
					foreach ($post_wt_comments as $comment){
						$comment = new Comment( $comment["comment.Numero"],
						$comment["comment.CONTENIDO"],
						new User($comment["comment.author"]),
						$post);
						array_push($comments_array, $comment);
					}
				}
				$post->setComments($comments_array);

				return $post;
			}else {
				return NULL;
			}
		}
*/
		/**
		* Saves a Post into the database
		*
		* @param Post $post The post to be saved
		* @throws PDOException if a database error occurs
		* @return int The mew post Numero
		*/
		public function save(Post $post) {
			$stmt = $this->db->prepare("INSERT INTO notas(AUTOR,TITULO,CONTENIDO,COMPARTIDO) values (?,?,?,?)");
			$stmt->execute(array($post->getautor()->getUsername(),$post->gettitulo(), $post->getcontenido(), $post->getcompartido()));
			return $this->db->lastInsertId();
		}

		public function share(Post $post) {

			$stmt = $this->db->prepare("INSERT INTO comparte(Numero,login,borrado) values (?,?,?)");
			$stmt->execute(array($post->getnumero(),$post->getcompartido(), "NO"));
			return $this->db->lastInsertId();
		}

		/**
		* Updates a Post in the database
		*
		* @param Post $post The post to be updated
		* @throws PDOException if a database error occurs
		* @return voNumero
		*/
		public function update(Post $post) {
			$stmt = $this->db->prepare("UPDATE notas set titulo=?, contenido=?,compartido=? where Numero=?");
			$stmt->execute(array($post->gettitulo(), $post->getcontenido(),$post->getcompartido(), $post->getnumero()));
		}

		/**
		* Deletes a Post into the database
		*
		* @param Post $post The post to be deleted
		* @throws PDOException if a database error occurs
		* @return voNumero
		*/
		public function delete(Post $post) {
			$stmt = $this->db->prepare("DELETE from notas WHERE Numero=?");
			$stmt->execute(array($post->getnumero()));
		}

		public function deleteC(Post $post,$currentUser) {
			$stmt = $this->db->prepare("UPDATE comparte SET borrado='SI' WHERE Numero=? AND login='$currentUser'");
			$stmt->execute(array( $post->getnumero()));
		}



}
