# Craft 4 on Heroku

Craft 4 is a PHP application based on Yii2, and is installed via Composer.

This means that it’s well-suited for deployment to cloud-based platforms like Heroku. In this case, we’ve put together a barebones starter-kit for running a Craft application on Heroku.

## 12-Factor Apps

There are a couple of limitations, here, that are important to note if it’s your first time using Heroku:

1. **The filesystem is ephemeral.** This means that anything you store on your running dynos is considered disposable—so, if you want to persist data (like user uploads), you’ll have to use a cloud-based storage service like Amazon S3 or Google Cloud Storage. This also applies to Craft-specific features like [Project Config](https://craftcms.com/docs/4.x/project-config.html), which relies on YAML files written to disk.
2. **Assume the app will scale.** Design your formation and configuration assuming that you’ll (eventually) be running more than a single process. Your database, sessions, and shared caches should all be kept in a common location—but Heroku will help with this through “Addons,” configured with this `app.json`.
3. **Logs are streams.** Any logging that ends up in a file is as good as gone. There might be some clever workarounds here, but since the purpose of this repo is to demonstrate compatibility with first-party Heroku tools, Craft is configured to log to `php://stdout` and `php://stderr`, so the logs can be “[Drained](https://devcenter.heroku.com/articles/log-drains)” anywhere you like.

Read more about [12-factor](https://12factor.net) app architecture, the underlying principles of the Heroku platform.

## Queue

It’s also worth mentioning: The traditional “queue” is handled here by a `worker` dyno. In order to run the app [locally](#local-development), you’ll need to spin up a queue daemon to ensure your jobs are taken care of:

```bash
php craft queue/listen --verbose
```

:point_up: This is the same worker command you see in the `Procfile` in the project's root! It’ll get booted alongside your `web` dyno.

## Setup

Just click this button to set up your first app!

[![Deploy to Heroku](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/oof-bar/craft-heroku)

This script does a few things:

1. Creates a new “app” in your Heroku account;
2. Provisions [addons](https://devcenter.heroku.com/categories/add-ons) (Redis and Postgres);
3. Helps set up required [Config Vars](https://devcenter.heroku.com/articles/config-vars);
4. Performs an initial build, including the installation of Composer dependencies;
5. Configures “dyno” formation (with two `web` processes and one `worker`);
6. Redirects you to the Craft 4 installation screen. :confetti_ball:

> You might encounter some visual issues with the installation process—this is because the `cpresources` are published into the public web root on a dyno-by-dyno basis, and the initial request for the installation page is not apt to have been hit on both servers.
> Subsequent requests for those assets could still be served by another dyno. Refresh the page a few times, and both dynos will begin to warm their `cpresources`.

## Local Development

But what about the road to production? This repo is designed to work seamlessly with Craft’s recommended development environment, [DDEV](https://ddev.readthedocs.io/en/stable/).

Install DDEV, clone the project, and run `$ ddev start`. For more information, please refer to the official Craft [installation instructions](https://craftcms.com/docs/4.x/installation.html).

:deciduous_tree:
