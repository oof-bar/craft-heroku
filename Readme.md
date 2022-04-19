# Craft 3 on Heroku

Craft 3 is a PHP application based on Yii2, and is installed via Composer.

This means that it’s well-suited for deployment to cloud-based platforms like Heroku. In this case, we’ve put together a barebones starter-kit for running a Craft application on Heroku.

There are a couple of limitations, here, that are important to note if it’s your first time using Heroku:

1. **The filesystem is ephemeral.** This means that anything you store on your running Dynos is considered disposable—so, if you want to persist data (like user uploads), you’ll have to use a cloud-based storage service like Amazon S3 or Google Cloud Storage.
2. **Assume the app will scale.** Design your formation and configuration assuming that you’ll (eventually) be running more than a single process. Your database, sessions, and shared caches should all be kept in a common location—but Heroku will help with this through “Addons,” configured with this `app.json`.
3. **Logs are streams.** Any logging that ends up in a file is as good as gone. There might be some clever workarounds here, but since the purpose of this repo is to demonstrate compatibility with first-party Heroku tools, Craft is configured to log to `php://stdout` and `php://stderr`, so the logs can be “[Drained](https://devcenter.heroku.com/articles/log-drains)” anywhere you like.

Read more about [12-factor](https://12factor.net) app architecture—the underlying principles of the Heroku platform.

It’s also worth mentioning: The traditional “queue” is handled here by a `worker` Dyno. In order to run the app locally, you’ll need to spin up a queue daemon to ensure your jobs are taken care of:

```
$ ./craft queue/listen --verbose
```

:point_up: This is the same worker command you see in the `Procfile` in the project's root! It’ll get booted alongside your `web` Dyno.

## Setup

Just click this button to set up your first app!

[![Deploy to Heroku](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/oof-bar/craft-heroku)

This script does a few things:

1. Creates a new “app” in your Heroku account;
2. Provisions [addons](https://devcenter.heroku.com/categories/add-ons) (Redis and Postgres);
3. Helps set up required [Config Vars](https://devcenter.heroku.com/articles/config-vars);
4. Performs an initial build, including the installation of Composer dependencies;
5. Configures Dyno formation (with two `web` processes and one `worker`);
6. Redirects you to the Craft 3 installation screen.

> You might encounter some visual issues with the installation process—this is because the `cpresources` that this process moves into the public web root happens on a Dyno-by-Dyno basis, and the initial request for the installation page is not apt to have been hit on both servers—but susequent requests for those assets could still be served by another dyno. Refresh the page a few times, and both dynos will begin to warm their `cpresources`.

## Local Development

But what about the road to production? This repo is designed to work seamlessly with Craft's first-party development environment, [Nitro](https://getnitro.sh).

Install Nitro, clone the project,  and run `$ nitro add craft-heroku`. For more information, please refer to the Nitro [documentation](https://craftcms.com/docs/nitro).

:deciduous_tree:
