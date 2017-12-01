class PostsComponent extends Fronty.ModelComponent {
  constructor(postsModel, userModel, router) {
    super(Handlebars.templates.poststable, postsModel, null, null);


    this.postsModel = postsModel;
    this.userModel = userModel;
    this.addModel('user', userModel);
    this.router = router;

    this.postsService = new PostsService();

  }

  onStart() {
    this.updatePosts();
  }

  updatePosts() {
    this.postsService.findAllPosts().then((data) => {

      this.postsModel.setPosts(
        // create a Fronty.Model for each item retrieved from the backend
        data.map(
          (item) => new PostModel(item.numero, item.author_numero, item.titulo,item.contenido,item.compartido,)
      ));
    });
  }

  // Override
  createChildModelComponent(className, element, id, modelItem) {
    return new PostComponent(modelItem, this.userModel, this.router, this);
  }
}



  class PostComponent extends Fronty.ModelComponent {
    constructor(postModel, userModel, router, postsComponent) {
      super(Handlebars.templates.post, postModel, null, null);

      this.postsComponent = postsComponent;

      this.userModel = userModel;
      this.addModel('user', userModel); // a secondary model

      this.router = router;

      this.addEventListener('click', '#remove-button', (event) => {
        if (confirm(I18n.translate('Are you sure?'))) {
          var postId = event.target.getAttribute('item');
          this.postsComponent.postsService.deletePost(postId)
            .fail(() => {
              alert('post cannot be deleted')
            })
            .always(() => {
              this.postsComponent.updatePosts();
            });
        }
      });

      this.addEventListener('click', '#edit-button', (event) => {
        var postId = event.target.getAttribute('item');
        this.router.goToPage('edit-post?id=' + postId);
      });
    }

}
