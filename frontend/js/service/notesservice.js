class NotesService {
  constructor() {

  }

  findAllNotes() {
    return $.get(AppConfig.backendServer+'/rest/post');
  }

  findNote(id) {
    return $.get(AppConfig.backendServer+'/rest/post/' + id);
  }

  deleteNote(numero) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/post/' + numero,
      method: 'DELETE'
    });
  }

  saveNote(note) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/post/' + note.numero,
      method: 'PUT',
      data: JSON.stringify(note),
      contentType: 'application/json'
    });
  }

  addNote(note) {
    return $.ajax({
      url: AppConfig.backendServer+'/rest/post',
      method: 'POST',
      data: JSON.stringify(note),
      contentType: 'application/json'
    });
  }



}
