# GEMINI.md
This file provides guidance to GEMINI when working with code in this repository.

## High-level code architecture and structure

This is a PHP-based Reversi game. The core logic is implemented on the server-side, which responds to moves made by the user on the front-end.

- **Backend**: The PHP backend handles the game logic. It receives the coordinates of a move, validates it, and returns the new state of the game board.
- **State Management**: The game's state is stored in the server-side session.
- **Frontend**: The user interface is a standard HTML, CSS, and JavaScript frontend. GUI settings are stored in the browser's Web Storage and sent to the server when a game begins.
- **API**: An API documentation is available at https://yuta-yoshinaga.github.io/reversiphp/

## Development

### Dependencies

Project dependencies are managed by Composer. To install them, run:

```sh
composer install
```

### Testing and Linting

There are no configured testing or linting tools in this project. The `bitbucket-pipelines.yml` file contains a commented-out command to run `phpunit`, which may indicate that tests were used in the past.

### Deployment

The application is set up for deployment on Heroku. The `bitbucket-pipelines.yml` file contains a script to automatically deploy the application to Heroku upon a push to the repository.
