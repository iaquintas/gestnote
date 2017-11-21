class PostAddComponent extends Fronty.ModelComponent {
  constructor(postsModel, userModel, router) {
    super(Handlebars.templates.postedit, postsModel);
    this.postsModel = postsModel; // posts

    this.userModel = userModel; // global
    this.addModel('user', userModel);
    this.router = router;

    this.postsService = new PostsService();

    this.addEventListener('click', '#savebutton', () => {
      var newPost = {};
      newPost.titulo = $('#titulo').val();
      newPost.contenido = $('#contenido').val();
      newPost.autor = this.userModel.currentUser;
      this.postsService.addPost(newPost)
        .then(() => {
          this.router.goToPage('posts');
        })
        .fail((xhr, errorThrown, statusText) => {
          if (xhr.status == 400) {
            this.postsModel.set(() => {
              this.postsModel.errors = xhr.responseJSON;
            });
          } else {
            alert('an error has occurred during request: ' + statusText + '.' + xhr.responseText);
          }
        });
    });
  }
}
