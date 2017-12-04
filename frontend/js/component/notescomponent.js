class NotesComponent extends Fronty.ModelComponent {
  constructor(notesModel, userModel, router) {
    super(Handlebars.templates.notestable, notesModel, null, null);


    this.notesModel = notesModel;
    this.userModel = userModel;
    this.addModel('user', userModel);
    this.router = router;

    this.notesService = new NotesService();

    this.userModel.addObserver(()=> {
      if (this.userModel.isLogged) {
        this.updatenotes();
      }
    });
  }

  onStart() {
    if (this.userModel.isLogged) {
      this.updatenotes();
    }
  }

  updatenotes() {
    this.notesService.findAllNotes().then((data) => {

      this.notesModel.setNotes(
        // create a Fronty.Model for each item retrieved from the backend
        data.map(
          (item) => new NoteModel(item.numero, item.author_numero, item.titulo,item.contenido,item.compartido,)
      ));
    });
  }

  // Override
  createChildModelComponent(className, element, id, modelItem) {
    return new NoteComponent(modelItem, this.userModel, this.router, this);
  }
}



  class NoteComponent extends Fronty.ModelComponent {
    constructor(postModel, userModel, router, notesComponent) {
      super(Handlebars.templates.note, postModel, null, null);

      this.notesComponent = notesComponent;

      this.userModel = userModel;
      this.addModel('user', userModel); // a secondary model

      this.router = router;

      this.addEventListener('click', '#remove-button', (event) => {
        if (confirm(I18n.translate('Are you sure?'))) {
          var postId = event.target.getAttribute('item');
          this.notesComponent.notesService.deleteNote(postId)

            .always(() => {
              this.notesComponent.updatenotes();
            });
        }
      });

      this.addEventListener('click', '#edit-button', (event) => {
        var postId = event.target.getAttribute('item');
        this.router.goToPage('edit-post?id=' + postId);
      });

      this.addEventListener('click', '#share-button', (event) => {
        var postId = event.target.getAttribute('item');
        this.router.goToPage('share-post?id=' + postId);
      });
    }

}

class NoteShareComponent extends Fronty.ModelComponent {
  constructor(notesModel, userModel, router) {
    super(Handlebars.templates.noteshare, notesModel);
    this.notesModel = notesModel; // notes
    this.userModel = userModel; // global
    this.addModel('user', userModel);
    this.router = router;

    this.notesService = new NotesService();

    this.addEventListener('click', '#savebutton', () => {
      this.notesModel.selectedNote.titulo = $('#titulo').val();
      this.notesModel.selectedNote.contenido = $('#contenido').val();
      this.notesModel.selectedNote.compartido = $('#compartido').val();

      this.notesService.saveNote(this.notesModel.selectedNote)
        .then(() => {
          this.notesModel.set((model) => {
            model.errors = []
          });
          this.router.goToPage('notes');
        })
        .fail((xhr, errorThrown, statusText) => {
          if (xhr.status == 400) {
            this.notesModel.set((model) => {
              model.errors = xhr.responseJSON;
            });
          } else {
            alert('an error has occurred during request: ' + statusText + '.' + xhr.responseText);
          }
        });

    });
    this.addEventListener('click', '#backbutton', () => {

        this.router.goToPage('notes');
        fail((xhr, errorThrown, statusText) => {
          if (xhr.status == 400) {
            this.notesModel.set(() => {
              this.notesModel.errors = xhr.responseJSON;
            });
          } else {
            alert('an error has occurred during request: ' + statusText + '.' + xhr.responseText);
          }
        });
    });

  }

  onStart() {
    var selectedId = this.router.getRouteQueryParam('id');
    if (selectedId != null) {
      this.notesService.findNote(selectedId)
        .then((post) => {
          this.notesModel.setSelectedNote(post);
        });
    }
  }
}
