# Craft 3 on Heroku

Craft 3 is a PHP application based on Yii2, and is installed via Composer.

This means that it’s well-suited for deployment to cloud-based platforms like Heroku. In this case, we’e put together a barebones starter-kit for running a Craft application on Heroku.

There are a couple of limitations, here, that are important to note if it’s your first time using Heroku:

1. **The filesystem is ephemeral.** This means that anything you store on your running Dynos is considered disposable—so, if you want to persist data (like user uploads), you’ll have to use a 
2. **Assume the app will scale.** Design your formation and configuration assuming that you’ll (eventually) be running more than a single process. Your database, sessions, and shared caches should all be kept in a common location—but Heroku will help with this through “Addons,” configured with this `app.json`.
3. **Logs are streams.** Any logging that ends up in a file is as good as gone. There might be some clever workarounds here, but since the purpose of this repo is to demonstrate compatability with first-party Heroku tools, Craft is configured to log to `php://stdout` and `php://stderr`, so the logs can be “[Drained](https://devcenter.heroku.com/articles/log-drains)” anywhere you like.

It’s also worth mentioning: The traditional “queue” is handled here by a `worker` Dyno. In order to run the app locally, you’re apt to need to spin up a listener to ensure your jobs are taken care of:

```
$ ./craft queue/listen --verbose
```

:point_up: This is the same worker command you see in the `Procfile` in the project's root!

## Setup

Just click this button to set up your first app!

[![Deploy to Heroku](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/oof-bar/craft-heroku)

:deciduous_tree:
