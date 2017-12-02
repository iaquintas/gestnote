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
          
            .always(() => {
              this.postsComponent.updatePosts();
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

class PostShareComponent extends Fronty.ModelComponent {
  constructor(postsModel, userModel, router) {
    super(Handlebars.templates.postshare, postsModel);
    this.postsModel = postsModel; // posts
    this.userModel = userModel; // global
    this.addModel('user', userModel);
    this.router = router;

    this.postsService = new PostsService();

    this.addEventListener('click', '#savebutton', () => {
      this.postsModel.selectedPost.titulo = $('#titulo').val();
      this.postsModel.selectedPost.contenido = $('#contenido').val();
      this.postsModel.selectedPost.compartido = $('#compartido').val();

      this.postsService.savePost(this.postsModel.selectedPost)
        .then(() => {
          this.postsModel.set((model) => {
            model.errors = []
          });
          this.router.goToPage('posts');
        })
        .fail((xhr, errorThrown, statusText) => {
          if (xhr.status == 400) {
            this.postsModel.set((model) => {
              model.errors = xhr.responseJSON;
            });
          } else {
            alert('an error has occurred during request: ' + statusText + '.' + xhr.responseText);
          }
        });

    });
    this.addEventListener('click', '#backbutton', () => {

        this.router.goToPage('posts');
        fail((xhr, errorThrown, statusText) => {
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

  onStart() {
    var selectedId = this.router.getRouteQueryParam('id');
    if (selectedId != null) {
      this.postsService.findPost(selectedId)
        .then((post) => {
          this.postsModel.setSelectedPost(post);
        });
    }
  }
}
