class MainComponent extends Fronty.RouterComponent {
  constructor() {
    super('frontyapp', Handlebars.templates.main, 'maincontent');

    // models instantiation
    // we can instantiate models at any place
    var userModel = new UserModel();
    var postsModel = new PostsModel();
    this.addModel('user', userModel);



    super.setRouterConfig({
      posts: {
        component: new PostsComponent(postsModel, userModel, this),
        title: 'Notes'
      },
      'view-post': {
        component: new PostViewComponent(postsModel, userModel, this),
        title: 'Note'
      },
      'edit-post': {
        component: new PostEditComponent(postsModel, userModel, this),
        title: 'Edit Note'
      },
      'add-post': {
        component: new PostAddComponent(postsModel, userModel, this),
        title: 'Add Note'
      },

      'share-post': {
        component: new PostShareComponent(postsModel, userModel, this),
        title: 'Share Note'
      },


      login: {
        component: new LoginComponent(userModel, this),
        title: 'Login'
      },
      defaultRoute: 'posts'
    });

    Handlebars.registerHelper('currentPage', () => {
          return super.getCurrentPage();
    });



    var userService = new UserService();
    this.addChildComponent(this._createUserBarComponent(userModel, userService));
    this.addChildComponent(this._createLanguageComponent());

  }

  _createUserBarComponent(userModel, userService) {
    var userbar = new Fronty.ModelComponent(Handlebars.templates.user, userModel, 'userbar');

    userbar.addEventListener('click', '#logoutbutton', () => {
      userModel.logout();
      userService.logout();
    });

    // do relogin
    userService.loginWithSessionData()
      .then(function(logged) {
        if (logged != null) {
          userModel.setLoggeduser(logged);
        }
      });

    return userbar;
  }



  _createLanguageComponent() {
    var languageComponent = new Fronty.ModelComponent(Handlebars.templates.language, this.routerModel, 'languagecontrol');
    // language change links
    languageComponent.addEventListener('click', '#englishlink', () => {
      I18n.changeLanguage('default');
      document.location.reload();
    });

    languageComponent.addEventListener('click', '#spanishlink', () => {
      I18n.changeLanguage('es');
      document.location.reload();
    });

    return languageComponent;
  }
}
