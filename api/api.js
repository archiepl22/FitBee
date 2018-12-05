const express = require("express");

const router = express.Router();

var users = [{
  id: 1,
  name: "Andrew Violino",
  bio: "Do greatest at in learning steepest. Breakfast extremity suffering one who all otherwise suspected. He at no nothing forbade up moments. Wholly uneasy at missed be of pretty whence. John way sir high than law who week. Surrounded prosperous introduced it if is up dispatched. Improved so strictly produced answered elegance is.",
  followed_by: [],
  following: [],
  image_url: "/static/images/profile1.jpeg",
  location: "Los Angeles",
  username: "andrew",
  workouts_purchased: []
}, {
  id: 2,
  name: "Archie Landreman",
  bio: "Lorem ipsum dolor amet literally disrupt pinterest keffiyeh, hot chicken deep v put a bird on it four dollar toast ennui taiyaki mixtape ramps pug tousled. YOLO kale chips readymade, cloud bread tote bag helvetica activated charcoal.",
  followed_by: [],
  following: [],
  image_url: "/static/images/profile2.jpeg",
  location: "Las Vegas",
  username: "archie",
  workouts_purchased: []
}, {
  id: 3,
  name: "Eric Gandhi",
  bio: "Hoodie woke jean shorts selvage, flannel vegan direct trade pok pok mustache beard 3 wolf moon scenester taxidermy authentic. Disrupt quinoa succulents cold-pressed synth.",
  followed_by: [],
  following: [],
  image_url: "/static/images/profile3.jpeg",
  location: "Los Angeles",
  username: "eric",
  workouts_purchased: []
}];

var exercises = [{
  id: 1,
  description: "The term \"biceps curl\" may refer to any of a number of weight training exercises that target the biceps brachii muscle.",
  image_url: "/static/images/exercise1.jpeg",
  name: "Bicep Curls",
  unit: "lbs"
}, {
  id: 2,
  description: "The bench press is an upper body strength training exercise that consists of pressing a weight upwards from a supine position. The exercise works the pectoralis major as well as supporting chest, arm, and shoulder muscles such as the anterior deltoids, serratus anterior, coracobrachialis, scapulae fixers, trapezii, and the triceps.",
  image_url: "/static/images/exercise2.jpeg",
  name: "Bench Press",
  unit: "lbs"
}, {
  id: 3,
  description: "Running is a method of terrestrial locomotion allowing humans and other animals to move rapidly on foot.",
  image_url: "/static/images/exercise3.jpeg",
  name: "Run",
  unit: "miles"
}, {
  id: 4,
  description: "The plank (also called a front hold, hover, or abdominal bridge) is an isometric core strength exercise that involves maintaining a position similar to a push-up for the maximum possible time.",
  image_url: "/static/images/exercise4.jpg",
  name: "Plank",
  unit: "sec"
}, {
  id: 5,
  description: "A lunge can refer to any position of the human body where one leg is positioned forward with knee bent and foot flat on the ground while the other leg is positioned behind.",
  video_url: "/static/videos/lunge.mp4",
  name: "Lunge",
  unit: ""
}, {
  id: 6,
  description: "A multi-joint exercise that strengthens the legs",
  name: "Front Squat",
  unit: "lbs"
}, {
  id: 7,
  description: "",
  name: "Barbell Calf Raise",
  unit: "lbs"
}, {
  id: 8,
  description: "",
  name: "Barbell Lunge",
  unit: "lbs"
}, {
  id: 9,
  description: "",
  name: "Kettlebell Crunch",
  unit: "kg"
}, {
  id: 10,
  description: "",
  name: "Pistol Squat",
  unit: ""
}, {
  id: 11,
  description: "",
  name: "Box Jump",
  unit: ""
}, {
  id: 12,
  description: "",
  name: "Quad Curls",
  unit: "lbs"
}, {
  id: 13,
  description: "",
  name: "Band Hip Slide",
  unit: ""
}, {
  id: 14,
  description: "",
  name: "Leg Press",
  unit: "lbs"
}, {
  id: 15,
  description: "",
  name: "Seated Calf Raise",
  unit: "lbs"
}, {
  id: 16,
  description: "",
  name: "Treadmill Sprint",
  unit: "sec"
}, {
  id: 17,
  description: "",
  name: "Power Clean",
  unit: "lbs"
}, {
  id: 18,
  description: "",
  name: "Wide Pull-Ups",
  unit: ""
}, {
  id: 19,
  description: "",
  name: "Band Curls",
  unit: ""
}, {
  id: 20,
  description: "",
  name: "Barbell Overhead Press",
  unit: "lbs"
}, {
  id: 21,
  description: "",
  name: "Barbell Curls",
  unit: "lbs"
}, {
  id: 22,
  description: "",
  name: "Incline Row",
  unit: "lbs"
}, {
  id: 23,
  description: "",
  name: "21's",
  unit: "lbs"
}, {
  id: 24,
  description: "",
  name: "Lat Pulldowns",
  unit: "lbs"
}, {
  id: 25,
  description: "",
  name: "Seated Close-grip Row",
  unit: "lbs"
}, {
  id: 26,
  description: "",
  name: "Half-kneeling Shoulder Press",
  unit: "lbs"
}, {
  id: 27,
  description: "",
  name: "Squat Overhead Ball Throws",
  unit: "lbs"
}, {
  id: 28,
  description: "",
  name: "Dynamic warmup and stretching",
  unit: ""
}];

var feed = {
  leaderboard: {
    field: "workouts completed",
    users: [{
      id: 2,
      name: "archie",
      value: 17,
      username: "archie"
    }, {
      id: 1,
      name: "andrew",
      value: 8,
      username: "andrew"
    }, {
      id: 3,
      name: "eric",
      value: 7,
      username: "eric"
    }]
  }
};

var results = [{
  id: 1,
  workout_id: 1,
  created_at: new Date("2018-03-01"),
  created_by: 1, 
  completed: true,
  modified_at: new Date("2018-03-15"),
  type: "results",
  results: [{
    exercise_id: 1,
    sets: [{
      reps: 10,
      quantity: 30,
      unit: "lbs"
    }, {
      reps: 5,
      quantity: 40,
      unit: "lbs"
    }]
  }, {
    exercise_id: 2,
    sets: [{
      reps: 7,
      quantity: 140,
      unit: "lbs"
    }, {
      reps: 5,
      quantity: 160,
      unit: "lbs"
    }]
  }, {
    exercise_id: 3
  }]
}, {
  id: 2,
  workout_id: 1,
  created_at: new Date("2018-03-01"),
  created_by: 1, 
  completed: false,
  modified_at: new Date("2018-04-1"),
  type: "results",
  results: [{
    exercise_id: 1,
    sets: [{
      reps: 10,
      quantity: 30,
      unit: "lbs"
    }, {
      reps: 5,
      quantity: 40,
      unit: "lbs"
    }]
  }, {
    exercise_id: 2
  }, {
    exercise_id: 3
  }]
}];

var workouts = [{
  id: 1,
  created_at: new Date("2018-02-14"),
  created_by: {
    id: 1,
    name: "Andrew",
    username: "andrew"
  },
  description: "This is a description of a FitBee workout! Should be about 150 characters long and describe the workout.",
  image_url: "/static/images/workout1.jpeg",
  name: "Andrew's Workout",
  exercises: [{
    id: 1,
    note: "pick up the weight"
  }, {
    id: 2,
    note: "use a spotter"
  }, {
    id: 3,
    note: ""
  }],
  template: [{
    exercise_id: 1,
    sets: [{
      reps: 7,
      quantity: 20
    }, {
      reps: 5,
      quantity: 30
    }, {
      reps: 3,
      quantity: 40
    }]
  }, {
    exercise_id: 2,
    sets: [{
      reps: 10,
      quantity: 100
    }, {
      reps: 5,
      quantity: 150
    }]
  }, {
    excercise_id: 3,
    sets: [{
      reps: 1,
      quantity: 10
    }]
  }]
}, {
  id: 2,
  created_at: new Date("2018-6-1"),
  created_by: {
    id: 2,
    name: "Archie",
    username: "archie"
  },
  description: "Leg day description.",
  exercises: [{
    id: 28
  }, {
    id: 6,
    circuit: 1
  }, {
    id: 7,
    circuit: 1
  }, {
    id: 4,
    circuit: 1
  }, {
    id: 8,
    circuit: 2
  }, {
    id: 9,
    circuit: 2
  }, {
    id: 10,
    circuit: 3
  }, {
    id: 11,
    circuit: 3
  }, {
    id: 12,
    circuit: 4
  }, {
    id: 13,
    circuit: 4
  }, {
    id: 14,
    circuit: 5
  }, {
    id: 15,
    circuit: 5
  }, {
    id: 16
  }],
  image_url: "/static/images/workout2.jpeg",
  name: "Leg Day",
  template: [{
    exercise_id: 28,
    sets: []
  }, {
    exercise_id: 6,
    sets: [{
      reps: 6,
      quantity: 135
    }, {
      reps: 6,
      quantity: 155
    }, {
      reps: 6,
      quantity: 175
    }, {
      reps: 6,
      quantity: 135
    }]
  }, {
    exercise_id: 7,
    sets: [{
      reps: 12,
      quantity: 135
    }, {
      reps: 10,
      quantity: 155
    }, {
      reps: 8,
      quantity: 175
    }, {
      reps: 12,
      quantity: 135
    }]
  }, {
    excercise_id: 4,
    sets: [{
      quantity: 30
    }, {
      quantity: 30
    }, {
      quantity: 30
    }, {
      quantity: 30
    }]
  }, {
    exercise_id: 8,
    sets: [{
      reps: 6,
      quantity: 115
    }, {
      reps: 6,
      quantity: 115
    }, {
      reps: 6,
      quantity: 115
    }]
  }, {
    exercise_id: 9,
    sets: [{
      reps: 6,
      quantity: 20
    }, {
      reps: 6,
      quantity: 20
    }, {
      reps: 6,
      quantity: 20
    }]
  }, {
    exercise_id: 10,
    sets: [{
      reps: 6
    }, {
      reps: 6
    }, {
      reps: 6
    }]
  }, {
    exercise_id: 11,
    sets: [{
      reps: 10
    }, {
      reps: 10
    }, {
      reps: 10
    }]
  }, {
    exercise_id: 12,
    sets: [{
      reps: 12,
      quantity: 50
    }, {
      reps: 12,
      quantity: 50
    }, {
      reps: 12,
      quantity: 50
    }, {
      reps: 12,
      quantity: 50
    }]
  }, {
    exercise_id: 13,
    sets: [{
      reps: 10
    }, {
      reps: 10
    }, {
      reps: 10
    }, {
      reps: 10
    }]
  }, {
    exercise_id: 14,
    sets: [{
      reps: 8,
      quantity: 180
    }, {
      reps: 8,
      quantity: 180
    }, {
      reps: 8,
      quantity: 180
    }]
  }, {
    exercise_id: 15,
    sets: [{
      reps: 12,
      quantity: 90
    }, {
      reps: 12,
      quantity: 90
    }, {
      reps: 12,
      quantity: 90
    }]
  }, {
    exercise_id: 16,
    sets: [{
      quantity: 30
    }, {
      quantity: 15
    }, {
      quantity: 15
    }, {
      quantity: 180
    }]
  }]
}, {
  id: 3,
  created_at: new Date("2018-06-09"),
  created_by: {
    id: 2,
    name: "Archie",
    username: "archie"
  },
  description: "Back and bicep workout",
  exercises: [{
    id: 17,
    circuit: 1
  }, {
    id: 18,
    circuit: 1
  }, {
    id: 19,
    circuit: 1
  }, {
    id: 20,
    circuit: 2
  }, {
    id: 21,
    circuit: 2
  }, {
    id: 22,
    circuit: 3
  }, {
    id: 23,
    circuit: 3
  }, {
    id: 24
  }, {
    id: 25
  }, {
    id: 26,
    circuit: 4
  }, {
    id: 27,
    circuit: 4
  }],
  image_url: "/static/images/workout3.jpeg",
  name: "Back and Bicep",
  template: [{
    exercise_id: 17,
    sets: [{
      reps: 6,
      quantity: 115
    }, {
      reps: 4,
      quantity: 135
    }, {
      reps: 4,
      quantity: 135
    }, {
      reps: 6,
      quantity: 115
    }]
  }, {
    exercise_id: 18,
    sets: [{
      reps: 6
    }, {
      reps: 6
    }, {
      reps: 6
    }, {
      reps: 6
    }]
  }, {
    excercise_id: 19,
    sets: [{
      reps: 12
    }, {
      reps: 12
    }, {
      reps: 12
    }, {
      reps: 12
    }]
  }, {
    exercise_id: 20,
    sets: [{
      reps: 6,
      quantity: 95
    }, {
      reps: 4,
      quantity: 115
    }, {
      reps: 4,
      quantity: 115
    }, {
      reps: 4,
      quantity: 95
    }]
  }, {
    exercise_id: 21,
    sets: [{
      reps: 6,
      quantity: 65
    }, {
      reps: 6,
      quantity: 65
    }, {
      reps: 8,
      quantity: 65
    }, {
      reps: 8,
      quantity: 65
    }]
  }, {
    exercise_id: 22,
    sets: [{
      reps: 6,
      quantity: 115
    }, {
      reps: 6,
      quantity: 115
    }, {
      reps: 6,
      quantity: 95
    }]
  }, {
    exercise_id: 23,
    sets: [{
      reps: 18,
      quantity: 55
    }, {
      reps: 18,
      quantity: 55
    }, {
      reps: 18,
      quantity: 55
    }]
  }, {
    exercise_id: 24,
    sets: [{
      reps: 6,
      quantity: 120
    }, {
      reps: 6,
      quantity: 120
    }, {
      reps: 6,
      quantity: 120
    }, {
      reps: 6,
      quantity: 120
    }]
  }, {
    exercise_id: 25,
    sets: [{
      reps: 6,
      quantity: 150
    }, {
      reps: 6,
      quantity: 150
    }, {
      reps: 6,
      quantity: 150
    }]
  }, {
    exercise_id: 26,
    sets: [{
      reps: 6,
      quantity: 45
    }, {
      reps: 6,
      quantity: 45
    }, {
      reps: 6,
      quantity: 45
    }]
  }, {
    exercise_id: 27,
    sets: [{
      reps: 12,
      quantity: 20
    }, {
      reps: 12,
      quantity: 20
    }, {
      reps: 12,
      quantity: 20
    }]
  }]
}];

var feed = [{
  content: "Test Feed Post",
  id: 1,
  posted_at: new Date("2018-06-20"),
  posted_by: {
    id: 1,
    name: "Andrew Violino",
    username: "andrew"
  }
}];

var messages = [];

/********* AUTH *********/

/*
  POST /auth/login

  User logging in

  receives
    username [String]
    password [String]

  returns
    user [Object]
*/
router.post("/auth/login", function(req, res) {
  var username = req.body.username;
  var user = users.find(u => u.username == username);
  if(user) {
    req.session.user = user;
    res.send(req.session.user);
  } else {
    res.status(500).send({message: "Invalid username or password"});
  }
});

/*
  POST /auth/logout

  User logging out

  receives
    (none)

  returns
    (none)
*/
router.post("/auth/logout", function(req, res) {
  req.session.destroy(function(err) {
    res.send("ok");  
  });
});

/*
  POST /auth/signup

  User signing up

  receives
    name [String]
    username [String]
    password [String]
    [...]

  returns
    user [Object]
*/
router.post("/auth/signup", function(req, res) {
  var username = req.body.username;
  if(users.find(user => user.username == username)) {
    return res.status(500).json({message: "That username is already taken."});
  }
  var model = Object.assign({}, req.body, {
    id: users.length + 1,
    created_at: new Date(),
    followed_by: [],
    following: [],
    workouts_purchased: []
  });
  users.push(model);
  req.session.user = model;
  res.send(req.session.user);
});

/********** EXERCISE **********/

/*
  GET /api/exercises

  Gets a list of exercises, by default all built-in exercises and all exercises created by current user

  receives
    (none)

  returns
    exercises [Array]
*/
router.get("/exercises", function(req, res) {
  res.send(exercises);
});

/*
  POST /api/exercises

  Creates a new exercise

  receives
    name
    description
    image_url
    video_url

  returns
    exercise [Object]
*/
router.post("/exercises", function(req, res) {
  var id = exercises.length + 1;
  var exercise = Object.assign({}, req.body, {
    id: id,
    created_at: new Date(),
    created_by: {
      id: req.session.user.id,
      name: req.session.user.name
    }
  });
  exercises.push(exercise);
  res.send(exercise);
});

/*
  PUT /api/exercises/:id

  Edits the exercise with the specified ID

  receives
    name
    description
    image_url
    video_url

  returns
    exercise [Object]
*/
router.put("/exercises/:id", function(req, res) {
  var index = exercises.findIndex(e => e.id == req.params.id);
  exercises[index] = req.body;
  res.send(exercises[index]);
});

/********** FEED **********/

function getUserFeed(user_id) {
  var user_feed = feed.filter(function(item) {
    return item.posted_by.id == user_id;
  });
  user_feed = user_feed.sort(function(a, b) {
    return b.posted_at - a.posted_at;
  });
  return user_feed;
}

/*
  GET /api/feed

  Gets a specific user's feed

  receives
    user_id [Integer] / (optional - use current user id if not provided)

  returns
    posts [Array]
*/
router.get("/feed", function(req, res) {
  var user_id = req.query.user_id || req.session.user.id;
  var user_feed = getUserFeed(user_id);
  res.send(user_feed);
});

/*
  POST /api/feed

  Adds a post to the current user's feed

  receives
    content [String]

  returns
    posts [Array]
*/
router.post("/feed", function(req, res) {
  var post = {
    content: req.body.content,
    id: feed.length + 1,
    posted_at: new Date(),
    posted_by: {
      id: req.session.user.id,
      name: req.session.user.name
    }
  };
  feed.push(post);
  var user_id = req.session.user.id;
  var user_feed = getUserFeed(user_id);
  res.send(user_feed);
});


/*********** NOTIFICATIONS **********/

function addNotification(content, targetId, sender) {
  messages.push({
    id: messages.length + 1,
    sent_by: {
      id: sender.id,
      name: sender.name
    },
    sent_to: targetId,
    content: content
  });
}

/*
  GET /api/notifications

  Gets the current user's notifications

  receives
    (none)

  returns
    notifications [Array]
*/
router.get("/notifications", function(req, res) {
  var user_id = req.session.user.id;
  var user_messages = messages.filter(function(message) {
    return message.sent_to == user_id;
  });
  res.send(user_messages);
});

/*
  POST /api/notifications/:id/read

  Marks the notification with the specified ID as read

  receives
    (none)

  returns
    notifications [Array]
*/
router.post("/notifications/:id/read", function(req, res) {
  var user_id = req.session.user.id;
  var message = messages.find(m => m.id == req.params.id);
  if(message.sent_to == user_id) {
    message.read_at = new Date();  
  }
  var user_messages = messages.filter(function(message) {
    return message.sent_to == user_id;
  });
  res.send(user_messages);
});

/********** RESULTS **********/

/*
  GET /api/results

  Gets the current user's workout results

  receives
    (none)

  returns
    results [Array]
*/
router.get("/results", function(req, res) {
  res.send(results);
});

/*
  POST /api/results

  Creates a record of workout results for the current user

  receives
    [result object]

  returns
    result [Object]
*/
router.post("/results", function(req, res) {
  var id = results.length + 1;
  var now = new Date();
  var model = Object.assign({}, req.body, {
    id: id,
    created_at: now,
    created_by: {
      id: req.session.user.id,
      name: req.session.user.name
    },
    modified_at: now
  });
  results.push(model);
  res.send(model);
});

/********** USERS **********/

/*
  GET /api/users

  Gets a list of users

  receives
    (none)

  returns
    users [Array]
*/
router.get("/users", function(req, res) {
  res.send(users);
});

/*
  GET /api/users/search

  Gets a user by name

  receives
    query [String] - search term

  returns
    users [Array]
*/
router.get("/users/search", function(req, res) {
  const query = req.query.query;
  const user = users.find(u => u.username == query) || {};
  res.send(user);
});

/*
  POST /api/users/purchase/:workout_id

  User purchases the specified workout

  receives
    (none)

  returns
    user [Object]
*/
router.post("/users/purchase/:workout_id", function(req, res) {
  var user = users.find(u => u.id == req.session.user.id);
  var id = parseInt(req.params.workout_id);
  if(!user.workouts_purchased.includes(id)) {
    user.workouts_purchased.push(id);
  }
  res.send(user);
});

/*
  GET /api/users/:username

  Gets the specified user

  receives
    (none)

  returns
    user [Object]
*/
router.get("/users/:username", function(req, res) {
  const user = users.find(u => u.username == req.params.username);
  res.send(user);
});

/*
  PUT /api/users/:id

  Edits the specified user (must be current user)

  receives
    [user model]

  returns
    user [Object]
*/
router.put("/users/:id", function(req, res) {
  if(req.params.id != req.session.user.id) {
    return res.status(500).json({error: "invalid request"});
  }
  var index = users.findIndex(u => u.id == req.params.id);
  users[index] = req.body;
  res.send(users[index]);
});

/*
  POST /api/users/:id/follow

  Current user follows specified user

  receives
    (none)

  returns
    users [Array]
*/
router.post("/users/:id/follow", function(req, res) {
  const followed = users.find(u => u.id == req.params.id);
  if(followed) {
    const follower = users.find(u => u.id == req.session.user.id);
    follower.following.push(followed.id);
    followed.followed_by.push(follower.id);
    addNotification({type: "follow"}, followed.id, req.session.user);
    return res.send([followed, follower]);
  }
  res.status(500).json({error: "invalid request"});
});

/*
  POST /api/users/:id/unfollow

  Current user unfollows specified user

  receives
    (none)

  returns
    users [Array]
*/
router.post("/users/:id/unfollow", function(req, res) {
  const followed = users.find(u => u.id == req.params.id);
  if(followed) {
    const follower = users.find(u => u.id == req.session.user.id);
    const following_index = follower.following.findIndex(id => id == followed.id);
    follower.following.splice(following_index, 1);
    const follower_index = followed.followed_by.findIndex(id => id == follower.id);
    followed.followed_by.splice(follower_index, 1);
    return res.send([followed, follower]);
  }
  res.status(500).json({error: "invalid request"});
});

/********** WORKOUTS **********/

/*
  GET /api/workouts

  Gets a list of workouts

  receives
    owned [boolean] - if set, only return current user's workouts
    purchased [boolean] - if set, only return workouts purchased by current user

  returns
    workouts [Array]
*/
router.get("/workouts", function(req, res) {
  var filtered = workouts;
  if(req.query.owned) {
    filtered = workouts.filter(workout => workout.created_by.id == req.session.user.id);
  } else if(req.query.purchased) {
    var user = users.find(u => u.id == req.session.user.id);
    filtered = workouts.filter(workout => user.workouts_purchased.includes(workout.id));
  }
  res.send(filtered);
});

/*
  GET /api/workouts/:id

  Gets a specific workout

  receives
    (none)

  returns
    workout [Object]
*/
router.get("/workouts/:id", function(req, res) {
  var workout = {};
  for(var i = 0; i < workouts.length; i++) {
    if(workouts[i].id == req.params.id) {
      workout = workouts[i];
    }
  }
  res.send(workout);
});

/*
  PUT /api/workouts/:id

  Updates the specified workout

  receives
    [workout model]

  returns
    workout [Object]
*/
router.put("/workouts/:id", function(req, res) {
  var index = workouts.findIndex(workout => workout.id == req.params.id);
  workouts[index] = req.body;
  res.send(workouts[index]);
});

/*
  POST /api/workouts

  Creates a new workout

  receives
    [workout model]

  returns
    workout [Object]
*/
router.post("/workouts", function(req, res) {
  var id = workouts.length + 1;
  var workout = Object.assign({}, req.body, {
    id: id,
    created_at: new Date(),
    created_by: {
      id: req.session.user.id,
      name: req.session.user.name
    }
  });
  workouts.push(workout);
  res.send(workout);
});


/*
  POST /api/workouts/:id/send

  Sends a workout to the specified users, creates notifications for each of them

  receives
    users [Array - user ids]

  returns
    (none)
*/
router.post("/workouts/:id/send", function(req, res) {
  var body = req.body;
  var content = {
    id: req.params.id,
    type: "send_workout"
  };
  body.users.forEach(function(user) {
    addNotification(content, user, req.session.user);
  });
  res.send({});
});

module.exports = router;