# Piglet

## Helping families meet their goals

### Contributing

Piglet is happy to receive contributions any way they come. Bug reports, feature requests, and code contributions are all welcome and appreciated.

*Please note that **all** code contributions to the project will be accepted under the project license. If you would like to submit your contribution under a different license, it will not be accepted.*

### Dependencies

Piglet is a pretty standard [Laravel](https://laravel.com/) application. In order to build and run, you will need:

- [git](https://git-scm.com/)
- [PHP 7.2+](http://php.net/)
- [composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) ([Maria DB](https://mariadb.org/) should work just as well, if preferred)
- [SQLite](https://www.sqlite.org/index.html)
- [node 8+](https://nodejs.org/en/)
- [npm 3.5+](https://www.npmjs.com/)

*Note that Piglet has only ever officially been tested to develop and run on Linux. If you're having trouble installing the dependencies, [Laravel Homestead](https://laravel.com/docs/5.7/homestead) should provide a viable development environment.*

### Installation

Clone the repository and install the project dependencies:

```bash
git clone git@github.com:noahheck/piglet piglet

cd piglet

composer install

npm install
```

Copy the `.env.example` file to `.env`, then generate a Laravel application key:

```bash
cp .env.example .env

./artisan key:generate
```


Use your text editor to change the relevant values to suit your environment, including:

- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

*You might also wish to configure your environment with appropriate `MAIL` parameters if you want to send emails. See the [Laravel documentation](https://laravel.com/docs/5.7/mail).*

### Running the Application

Start the Artisan development server:

```bash
./artisan serve
```

Open another terminal in the project root and ask node to compile the javascript resources and watch for changes:

```bash
npm run watch
```

Open your web browser and navigate to: http://localhost:8000 (probably, your port may be different).


