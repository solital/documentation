Sometimes when we create a project for a client or for our work, we want to protect our code so that other people can't use it.

Solital has a security method that verifies the domain of your project. If someone else copies your project to another domain, Solital sends you an email letting you know that your project is on a different domain.

To do this configuration, you need to edit the `bootstrap.yaml` file. In the `verify_domain -> enable_verification` key, change the value to `true`.

```yaml
verify_domain:
  enable_verification: false
  send_to: 
  recipient_name: 
```

In the `send_to` key, add the email that will be used for Solital to notify you about the copy of the project. In the `recipient_name` key, you will add your name or an alias.

When you do this and reload any page in your project, a variable called `APP_DOMAIN` will be created in the `.env` file. This variable will contain the domain where your project was made. Obviously, if you are on locahost, you need to change this variable later.

The line below is just an example.

```
APP_DOMAIN="http://localhost:8000"
```

This is one more method for the security of your code. Obviously, for greater security, you need to use a private repository on GitHub.