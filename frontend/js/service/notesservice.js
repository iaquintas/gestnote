class NotesService {
  constructor() {

  }

  findAllNotes() {
    return $.get(AppConfig.backendServer+'/rest/note');
  }

  findNote(id) {
    return $.get(AppConfig.backendServer+'/rest/note/' + id);
  }

  deleteNote(numero) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/note/' + numero,
      method: 'DELETE'
    });
  }

  saveNote(note) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/note/' + note.numero,
      method: 'PUT',
      data: JSON.stringify(note),
      contentType: 'application/json'
    });
  }

  addNote(note) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/note',
      method: 'POST',
      data: JSON.stringify(note),
      contentType: 'application/json'
    });
  }



}
