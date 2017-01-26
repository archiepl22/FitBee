var koa     = require('koa'),
    router  = require('koa-router')(),
    logger  = require('koa-logger'),
    serve   = require('koa-static'),
    hbs     = require("koa-handlebars");


var app = koa();

// Logger
app.use(logger());
app.use(serve(process.cwd() + '/dist'));

app.use(hbs({
  defaultLayout: 'main', 
  viewsDir: './views', 
  layoutsDir: './views/layouts', 
  partialsDir: './views/partials', 
  extension: 'hbs',
  cache: false
}));


router.get('/', function *() {
    yield this.render('home', {
      title: 'Fitbee Home'
    });
  });

router.get('/workouts', function *() {
    yield this.render('workouts', {
      layout: 'dash',
      title: 'My Workouts'
    });
  });
router.get('/login', function *() {
    yield this.render('login', {title: 'Login'});
  });

router.get('/signup', function *() {
    yield this.render('signup', {title: 'Sign up'});
  });

router.get('/browse-workouts', function *() {
    yield this.render('browse-workouts', {title: 'Browse Workouts'});
  });

router.get('/find-trainer', function *() {
    yield this.render('find-trainer', {title: 'Find a Trainer'});
  });

app.use(router.routes());


if (!module.parent) {
  app.listen(1337);
  console.log('listening on port 1337');
}