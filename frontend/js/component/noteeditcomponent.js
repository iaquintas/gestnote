class NoteEditComponent extends Fronty.ModelComponent {
  constructor(notesModel, userModel, router) {
    super(Handlebars.templates.noteedit, notesModel);
    this.notesModel = notesModel; // notes
    this.userModel = userModel; // global
    this.addModel('user', userModel);
    this.router = router;

    this.notesService = new NotesService();

    this.addEventListener('click', '#savebutton', () => {
      this.notesModel.selectedNote.titulo = $('#titulo').val();
      this.notesModel.selectedNote.contenido = $('#contenido').val();

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
        .then((note) => {
          this.notesModel.setSelectedNote(note);
        });
    }
  }
}
