## Submission API

Service for handling customers submission.

Powered by [Laravel](https://laravel.com/docs). 

## Local deployment
- Clone repository `git clone https://github.com/DyachenkoInna/submission-api.git`
- Go to project directory `cd submission-api`
- Start local development server in background - vendor/bin/sail
- Fill environments for database connection
- Run migrations `vendor/bin/sail migrate`

## Useful commands
- `vendor/bin/sail composer run lint` - check code styles correspond to PSR12
- `vendor/bin/sail run test` - run tests

## API documentation
Open API documentation is available at `/api-doc/v1.html` route.
