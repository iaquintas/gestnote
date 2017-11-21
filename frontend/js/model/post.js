class PostModel extends Fronty.Model {

  constructor(numero,autor_id,titulo,contenido,compartido) {
    super('PostModel'); //call super

    if (numero) {
      this.numero = numero;
    }
    if (autor_id) {
      this.autor_id = autor_id;
    }

    if (titulo) {
      this.titulo = titulo;
    }

    if (contenido) {
      this.contenido = contenido;
    }
    if (compartido) {
      this.titulo = compartido;
    }


  }

  setitulo(titulo) {
    this.set((self) => {
      self.titulo = titulo;
    });
  }

  setautor_id(autor_id) {
    this.set((self) => {
      self.autor_id = autor_id;
    });
  }
  setcontenido(contenido) {
    this.set((self) => {
      self.contenido = contenido;
    });
  }
  setcompartido(compartido) {
    this.set((self) => {
      self.compartido = compartido;
    });
  }
}
