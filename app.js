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

router.get('/landing', function *() {
  yield this.render('landing', {
    title: 'Fitbee'
  });
});

router.get('/create-workout', function *() {
  yield this.render('createworkout', {
    title: 'Create a new workout'
  });
});

router.get('/workouts', function *() {
  yield this.render('workouts', {
    layout: 'dash',
    title: 'My Workouts'
  });
});

router.get('/messages', function *() {
  yield this.render('messages', {
    layout: 'dash',
    title: 'Messages'
  });
});

router.get('/calendar', function *() {
  yield this.render('calendar', {
    layout: 'dash',
    title: 'Calendar'});
});

router.get('/new-event', function *() {
  yield this.render('newevent', {
    layout: 'dash',
    title: 'New Event'});
});

router.get('/groups', function *() {
  yield this.render('groups', {
    layout: 'dash',
    title: 'Groups'});
});

router.get('/group1', function *() {
  yield this.render('group1', {
    layout: 'dash',
    title: 'Group 1'});
});

router.get('/group-new', function *() {
  yield this.render('newgroup', {
    layout: 'dash',
    title: 'New Group'});
});

router.get('/group-settings', function *() {
  yield this.render('groupsettings', {
    layout: 'dash',
    title: 'Group Settings'});
});

router.get('/connect', function *() {
  yield this.render('connect', { title: 'Connect'});
});

router.get('/notifications', function *() {
  yield this.render('notifications', { title: 'Notifications'});
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

router.get('/profile', function *() {
  yield this.render('profile', {title: 'Profile'});
});

router.get('/settings', function *() {
  yield this.render('settings', {title: 'Settings'});
});

router.get('/editprofile', function *() {
  yield this.render('editprofile', {title: 'Edit your profile'});
});




app.use(router.routes());


if (!module.parent) {
  app.listen(1337);
  console.log('listening on port 1337');
}