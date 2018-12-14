# Craft 3 on Heroku

Craft 3 is a PHP application based on Yii2, and is installed via Composer.

This means that it's well-suited for deployment to cloud-based platforms like Heroku. In this case, we've put together a barebones starter-kit for running a Craft application on Heroku.

There are a couple of limitations, here, that are important to note if it's your first time using Heroku:

1. **The filesystem is ephemeral.** This means that anything you store on your running Dynos is considered disposable—so, if you want to persist data (like user uploads), you'll have to use a 
2. **Assume the app will scale.** Design your infrastructure and configuration assuming that you'll be running more than a single process. Your database, sessions, and shared caches should all be kept in a common location—but Heroku will help with this through “Addons,” configured with this `app.json`.

## Setup

Just click this button to set up your first app!

[![Deploy to Heroku](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/oof-bar/craft-heroku)

:deciduous_tree:
