# intra-doodle
PHP script with form allowing to retrieve a doodle.com link with all the slots of a given activity on Epitech's intra.

## Features
- Retrieves slots for a given Epitech's intra activity
- Build a doodle link with slots time
- Option management, with config file
- Sample HTML with an example on hot-to-use the script. 

## Installation
- Simply clone this depot anywhere on your server.
- Copy [config.json.exemple](https://github.com/BernardJeremy/intra-doodle/blob/master/config.json.exemple) file into a `config.json` file.
- Add your intranet login/password to the `config.json` file.
- Add a default name and a default location to the `config.json` file.
- Use the HTML sample ([index.php](https://github.com/BernardJeremy/intra-doodle/blob/master/index.php)) or create your own.

## Configuration
- `login` : Your intranet login.
- `password` : Your intranet password.
- `doodle_create_url` : Link to create a doodle poll.
- `display_name` :  Default name displayed on doodle.
- `display_location` :  Default location displayed on doodle.
