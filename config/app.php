<?php
return [
    /**
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),

    /**
     * Configure basic information about the application.
     *
     * - namespace - The namespace to find app classes under.
     * - defaultLocale - The default locale for translation, formatting currencies and numbers, date and time.
     * - encoding - The encoding used for HTML + database connections.
     * - base - The base directory the app resides in. If false this
     *   will be auto detected.
     * - dir - Name of app directory.
     * - webroot - The webroot directory.
     * - wwwRoot - The file path to webroot.
     * - baseUrl - To configure CakePHP to *not* use mod_rewrite and to
     *   use CakePHP pretty URLs, remove these .htaccess
     *   files:
     *      /.htaccess
     *      /webroot/.htaccess
     *   And uncomment the baseUrl key below.
     * - fullBaseUrl - A base URL to use for absolute links. When set to false (default)
     *   CakePHP generates required value based on `HTTP_HOST` environment variable.
     *   However, you can define it manually to optimize performance or if you
     *   are concerned about people manipulating the `Host` header.
     * - imageBaseUrl - Web path to the public images directory under webroot.
     * - cssBaseUrl - Web path to the public css directory under webroot.
     * - jsBaseUrl - Web path to the public js directory under webroot.
     * - paths - Configure paths for non class based resources. Supports the
     *   `plugins`, `templates`, `locales` subkeys, which allow the definition of
     *   paths for plugins, view templates and locale files respectively.
     */
    'App' => [
        'namespace' => 'App',
        'encoding' => env('APP_ENCODING', 'UTF-8'),
        'defaultLocale' => env('APP_DEFAULT_LOCALE', 'es_CL'),
        'defaultTimezone' => env('APP_DEFAULT_TIMEZONE', 'UTC'),
        'base' => false,
        'dir' => 'src',
        'webroot' => 'webroot',
        'wwwRoot' => WWW_ROOT,
        //'baseUrl' => env('SCRIPT_NAME'),
        'fullBaseUrl' => false,
        'imageBaseUrl' => 'img/',
        'cssBaseUrl' => 'css/',
        'jsBaseUrl' => 'js/',
        'paths' => [
            'plugins' => [ROOT . DS . 'plugins' . DS],
            'templates' => [APP . 'Template' . DS],
            'locales' => [APP . 'Locale' . DS],
        ],
    ],

    /**
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => env('SECURITY_SALT', '5584033205b3eb7d2dbe33f1fe32a7b32285d771b5932a3fdc491cdec090dd86'),
    ],

    /**
     * Apply timestamps with the last modified time to static assets (js, css, images).
     * Will append a querystring parameter containing the time the file was modified.
     * This is useful for busting browser caches.
     *
     * Set to true to apply timestamps when debug is true. Set to 'force' to always
     * enable timestamping regardless of debug value.
     */
    'Asset' => [
        //'timestamp' => true,
        // 'cacheTime' => '+1 year'
    ],

    /**
     * Configure the cache adapters.
     */
    'Cache' => [
        'default' => [
            'className' => 'Cake\Cache\Engine\FileEngine',
            'path' => CACHE,
            'url' => env('CACHE_DEFAULT_URL', null),
        ],

        /**
         * Configure the cache used for general framework caching.
         * Translation cache files are stored with this configuration.
         * Duration will be set to '+2 minutes' in bootstrap.php when debug = true
         * If you set 'className' => 'Null' core cache will be disabled.
         */
        '_cake_core_' => [
            'className' => 'Cake\Cache\Engine\FileEngine',
            'prefix' => 'myapp_cake_core_',
            'path' => CACHE . 'persistent/',
            'serialize' => true,
            'duration' => '+1 years',
            'url' => env('CACHE_CAKECORE_URL', null),
        ],

        /**
         * Configure the cache for model and datasource caches. This cache
         * configuration is used to store schema descriptions, and table listings
         * in connections.
         * Duration will be set to '+2 minutes' in bootstrap.php when debug = true
         */
        '_cake_model_' => [
            'className' => 'Cake\Cache\Engine\FileEngine',
            'prefix' => 'myapp_cake_model_',
            'path' => CACHE . 'models/',
            'serialize' => true,
            'duration' => '+1 years',
            'url' => env('CACHE_CAKEMODEL_URL', null),
        ],

        /**
         * Configure the cache for routes. The cached routes collection is built the
         * first time the routes are processed via `config/routes.php`.
         * Duration will be set to '+2 seconds' in bootstrap.php when debug = true
         */
        '_cake_routes_' => [
            'className' => 'Cake\Cache\Engine\FileEngine',
            'prefix' => 'myapp_cake_routes_',
            'path' => CACHE,
            'serialize' => true,
            'duration' => '+1 years',
            'url' => env('CACHE_CAKEROUTES_URL', null),
        ],

        'config_cache_menu_cell' => [
            'className' => 'File',
            'prefix' => 'cell_',
            'path' => CACHE . 'cells/',
            'serialize' => true,
            'duration' => '+1 years',
        ],
        'config_cache_query' => [
            'className' => 'File',
            'prefix' => 'query_',
            'path' => CACHE . 'queries/',
            'serialize' => true,
            'duration' => '+1 years',
        ],
        'config_cache_query_short' => [
            'className' => 'File',
            'prefix' => 'query_',
            'path' => CACHE . 'queries/',
            'serialize' => true,
            'duration' => '+1 day',
        ],
    ],

    /**
     * Configure the Error and Exception handlers used by your application.
     *
     * By default errors are displayed using Debugger, when debug is true and logged
     * by Cake\Log\Log when debug is false.
     *
     * In CLI environments exceptions will be printed to stderr with a backtrace.
     * In web environments an HTML page will be displayed for the exception.
     * With debug true, framework errors like Missing Controller will be displayed.
     * When debug is false, framework errors will be coerced into generic HTTP errors.
     *
     * Options:
     *
     * - `errorLevel` - int - The level of errors you are interested in capturing.
     * - `trace` - boolean - Whether or not backtraces should be included in
     *   logged errors/exceptions.
     * - `log` - boolean - Whether or not you want exceptions logged.
     * - `exceptionRenderer` - string - The class responsible for rendering
     *   uncaught exceptions. If you choose a custom class you should place
     *   the file for that class in src/Error. This class needs to implement a
     *   render method.
     * - `skipLog` - array - List of exceptions to skip for logging. Exceptions that
     *   extend one of the listed exceptions will also be skipped for logging.
     *   E.g.:
     *   `'skipLog' => ['Cake\Http\Exception\NotFoundException', 'Cake\Http\Exception\UnauthorizedException']`
     * - `extraFatalErrorMemory` - int - The number of megabytes to increase
     *   the memory limit by when a fatal error is encountered. This allows
     *   breathing room to complete logging or error handling.
     */
    'Error' => [
        'errorLevel' => E_ALL & ~E_USER_DEPRECATED ^ E_NOTICE,
        'exceptionRenderer' => 'Cake\Error\ExceptionRenderer',
        'skipLog' => [],
        'log' => true,
        'trace' => true,
    ],

    /**
     * Email configuration.
     *
     * By defining transports separately from delivery profiles you can easily
     * re-use transport configuration across multiple profiles.
     *
     * You can specify multiple configurations for production, development and
     * testing.
     *
     * Each transport needs a `className`. Valid options are as follows:
     *
     *  Mail   - Send using PHP mail function
     *  Smtp   - Send using SMTP
     *  Debug  - Do not send the email, just return the result
     *
     * You can add custom transports (or override existing transports) by adding the
     * appropriate file to src/Mailer/Transport. Transports should be named
     * 'YourTransport.php', where 'Your' is the name of the transport.
     */
    'EmailTransport' => [
        'default' => [
            'className' => 'Cake\Mailer\Transport\MailTransport',
            /*
             * The following keys are used in SMTP transports:
             */
            'host' => 'localhost',
            'port' => 25,
            'timeout' => 30,
            'username' => null,
            'password' => null,
            'client' => null,
            'tls' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],

    /**
     * Email delivery profiles
     *
     * Delivery profiles allow you to predefine various properties about email
     * messages from your application and give the settings a name. This saves
     * duplication across your application and makes maintenance and development
     * easier. Each profile accepts a number of keys. See `Cake\Mailer\Email`
     * for more information.
     */
    'Email' => [
        'default' => [
            'transport' => 'default',
            'from' => 'you@localhost',
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
        ],
    ],

    /**
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * ### Notes
     * - Drivers include Mysql Postgres Sqlite Sqlserver
     *   See vendor\cakephp\cakephp\src\Database\Driver for complete list
     * - Do not use periods in database name - it may lead to error.
     *   See https://github.com/cakephp/cakephp/issues/6471 for details.
     * - 'encoding' is recommended to be set to full UTF-8 4-Byte support.
     *   E.g set it to 'utf8mb4' in MariaDB and MySQL and 'utf8' for any
     *   other RDBMS.
     */
    'Datasources' => [
        /*'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            /*
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly

            //'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'my_app',
            /*
             * You do not need to set this flag to use full utf-8 encoding (internal default since CakePHP 3.6).

            //'encoding' => 'utf8mb4',
            'timezone' => 'UTC',
            'flags' => [],
            'cacheMetadata' => true,
            'log' => false,

            /**
             * Set identifier quoting to true if you are using reserved words or
             * special characters in your table or column names. Enabling this
             * setting will result in queries built using the Query Builder having
             * identifiers quoted when creating SQL. It should be noted that this
             * decreases performance because each query needs to be traversed and
             * manipulated before being executed.

            'quoteIdentifiers' => false,

            /**
             * During development, if using MySQL < 5.6, uncommenting the
             * following line could boost the speed at which schema metadata is
             * fetched from the database. It can also be set directly with the
             * mysql configuration directive 'innodb_stats_on_metadata = 0'
             * which is the recommended value in production environments

            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],

            'url' => env('DATABASE_URL', null),
        ],*/
        //Desarrollo        PORWEB#032019
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'sistdesa.bdd.pjud',
            'username' => 'PORWEB',
            'password' => 'PORWEB#032019',
            'database' => '(DESCRIPTION=(ADDRESS= (PROTOCOL=tcp) (HOST=sistdesa.bdd.pjud) (PORT=1518))(CONNECT_DATA= (SID=SISTDESA)))',
            'schema' => 'PORWEB',
        ],
        /*
        //Produccion
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            //'host' => 'sistprod.bdd.pjud',
            'username' => 'USER_PORWEB',
            'password' => 'U_PorWeb#062019',
            'database' => '(DESCRIPTION=(FAILOVER=on)(LOAD_BALANCE=off)(ADDRESS=(PROTOCOL=TCP)(HOST=sistprod.bdd.pjud)(PORT=1520))(ADDRESS=(PROTOCOL=TCP)(HOST=sistprod.bdd.pjud)(PORT=1520))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=SISTPROD)))',
            'schema' => 'PORWEB',
        ],*/
        'sigpprod' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'sigpprodsb.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'Portal_PJ',
            'password' => 'PJ#1705',
            'database' => '(DESCRIPTION=(ADDRESS= (PROTOCOL=tcp) (HOST=sigpprodsb.bdd.pjud) (PORT=1579))(CONNECT_DATA= (SID=SIGPPROD)))',
            'schema' => 'Portal_PJ', //The schema that owns the tables, not necessarily your login schema
        ],
        'portal' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'portprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'PORTAL',
            'password' => 'portal',
            'database' => '(DESCRIPTION=(ADDRESS= (PROTOCOL=tcp) (HOST=portprod.bdd.pjud) (PORT=3456))(CONNECT_DATA= (SID=PORTPROD)))',
            'schema' => 'PORTAL', //The schema that owns the tables, not necessarily your login schema
        ],
        'portprod_consulta_ciudadana' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'portprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'usupres',
            'password' => 'utf0808',
            'database' => '(DESCRIPTION=(ADDRESS= (PROTOCOL=tcp) (HOST=portprod.bdd.pjud) (PORT=3456))(CONNECT_DATA= (SID=PORTPROD)))',
            'schema' => 'PORTPROD', //The schema that owns the tables, not necessarily your login schema
        ],
        'portdesa_consulta_ciudadana_corpres' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'portprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'CORPRES',
            'password' => 'CR#2019',
            'database' => '(DESCRIPTION=(ADDRESS= (PROTOCOL=tcp) (HOST=portdesa.bdd.pjud) (PORT=1526))(CONNECT_DATA= (SID=PORTDESA)))',
            'schema' => 'PORTDESA', //The schema that owns the tables, not necessarily your login schema
        ],

        'portdesa_consulta_ciudadana_ppres' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'portprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'PPRES',
            'password' => 'utf0808',
            'database' => '(DESCRIPTION=(ADDRESS= (PROTOCOL=tcp) (HOST=portdesa.bdd.pjud) (PORT=1526))(CONNECT_DATA= (SID=PORTDESA)))',
            'schema' => 'PORTDESA', //The schema that owns the tables, not necessarily your login schema
        ],

        'cortprod' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'cortprodsb.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'USER_OJV',
            'password' => 'OJV#1522',
            'database' => '(DESCRIPTION=(ADDRESS= (PROTOCOL=tcp) (HOST=portprod.bdd.pjud) (PORT=1713))(CONNECT_DATA= (SID=CORTPROD)))',
            'schema' => 'CORTPROD', //The schema that owns the tables, not necessarily your login schema
        ],
        'cortprod_abogados' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'cortprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'SOFPAR',
            'password' => 'garry',
            'database' => '(DESCRIPTION=(ADDRESS= (PROTOCOL=tcp) (HOST=cortprod.bdd.pjud) (PORT=1713))(CONNECT_DATA= (SID=CORTPROD)))',
            'schema' => 'CORTPROD', //The schema that owns the tables, not necessarily your login schema
        ],

        /*'CONCIVI_PORTALPJUD' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'cortprodsb.bdd.pjud', //Usually unused for Oracle connections
            'username' => 'USER_OJV',
            'password' => 'OJV#1522',
            'database' => '(DESCRIPTION=(FAILOVER=on)(LOAD_BALANCE=off)(ADDRESS=(PROTOCOL=TCP)(HOST=cortprodsb.bdd.pjud)(PORT=1713))(ADDRESS=(PROTOCOL=TCP)(HOST=cortprodsb.bdd.pjud)(PORT=1713))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=CORTPROD)))',
            'schema' => 'USER_OJV', //The schema that owns the tables, not necessarily your login schema
        ],*/
        //Estado diario civil
        'CIVIPROD_OJV' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'civiprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'USER_OJV',
            'password' => 'OJV#1522',
            'database' => '(DESCRIPTION=(FAILOVER=on)(LOAD_BALANCE=off)(ADDRESS=(PROTOCOL=TCP)(HOST=civiprod.bdd.pjud)(PORT=3455))(ADDRESS=(PROTOCOL=TCP)(HOST=civiprod.bdd.pjud)(PORT=3455))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=CIVIPROD)))',
            'schema' => 'USER_OJV', //The schema that owns the tables, not necessarily your login schema
        ],
        //Estado diario cobranza
        'CBZAPROD_USER_ESTDIARIO' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'cbzaprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'USER_ESTDIARIO',
            'password' => 'utf0808',
            'database' => '(DESCRIPTION=(FAILOVER=on)(LOAD_BALANCE=off)(ADDRESS=(PROTOCOL=TCP)(HOST=cbzaprod.bdd.pjud)(PORT=3458))(ADDRESS=(PROTOCOL=TCP)(HOST=cbzaprod.bdd.pjud)(PORT=3458))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=CBZAPROD)))',
            'schema' => 'USER_ESTDIARIO', //The schema that owns the tables, not necessarily your login schema
        ],
        //Estado diario familia
        'FAMIPROD_USER_ESTDIARIO' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'famiprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'USER_ESTDIARIO',
            'password' => 'utf0808',
            'database' => '(DESCRIPTION=(FAILOVER=on)(LOAD_BALANCE=off)(ADDRESS=(PROTOCOL=TCP)(HOST=famiprod.bdd.pjud)(PORT=1571))(ADDRESS=(PROTOCOL=TCP)(HOST=famiprod.bdd.pjud)(PORT=1571))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=FAMIPROD)))',
            'schema' => 'USER_ESTDIARIO', //The schema that owns the tables, not necessarily your login schema
        ],
        //Estado diario laboral
        'LABOPROD_USER_ESTDIARIO' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'laboprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'USER_ESTDIARIO',
            'password' => 'utf0808',
            'database' => '(DESCRIPTION=(FAILOVER=on)(LOAD_BALANCE=off)(ADDRESS=(PROTOCOL=TCP)(HOST=laboprod.bdd.pjud)(PORT=1561))(ADDRESS=(PROTOCOL=TCP)(HOST=laboprod.bdd.pjud)(PORT=1561))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=LABOPROD)))',
            'schema' => 'USER_ESTDIARIO', //The schema that owns the tables, not necessarily your login schema
        ],
        //Estado diario penal
        'RPENPROD_USER_ESTDIARIO' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'laboprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'USER_ESTDIARIO',
            'password' => 'utf0808',
            'database' => '(DESCRIPTION=(FAILOVER=on)(LOAD_BALANCE=off)(ADDRESS=(PROTOCOL=TCP)(HOST=rpenprod.bdd.pjud)(PORT=1524))(ADDRESS=(PROTOCOL=TCP)(HOST=rpenprod.bdd.pjud)(PORT=1524))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=RPENPROD)))',
            'schema' => 'USER_ESTDIARIO', //The schema that owns the tables, not necessarily your login schema
        ],
        // Estado diario corte suprema y apelaciones
        'CORTPROD_EST_DIARIO' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'cortprodsb.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'USER_ESTDIARIO',
            'password' => 'utf0808',
            'database' => '(DESCRIPTION=(ADDRESS= (PROTOCOL=tcp) (HOST=portprod.bdd.pjud) (PORT=1713))(CONNECT_DATA= (SID=CORTPROD)))',
            'schema' => 'USER_ESTDIARIO', //The schema that owns the tables, not necessarily your login schema
        ],
        'sxmlprod_cendoc' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'sxmlprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'cendoc',
            'password' => 'CenDoc#072018',
            'database' => '(DESCRIPTION=(ADDRESS= (PROTOCOL=tcp) (HOST=sxmlprod.bdd.pjud) (PORT=1559))(CONNECT_DATA= (SID=SXMLPROD)))',
            'schema' => 'cendoc', //The schema that owns the tables, not necessarily your login schema
        ],

        'FAMIPROD_OJV' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'famiprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'USER_OJV',
            'password' => 'OJV#1522',
            'database' => '(DESCRIPTION=(FAILOVER=on)(LOAD_BALANCE=off)(ADDRESS=(PROTOCOL=TCP)(HOST=famiprod.bdd.pjud)(PORT=1571))(ADDRESS=(PROTOCOL=TCP)(HOST=famiprod.bdd.pjud)(PORT=1571))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=FAMIPROD)))',
            'schema' => 'USER_OJV', //The schema that owns the tables, not necessarily your login schema
        ],

        'CBZAPROD_OJV' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'cbzaprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'PORTAL_SITCOB',
            'password' => 'Portal2014',
            'database' => '(DESCRIPTION=(FAILOVER=on)(LOAD_BALANCE=off)(ADDRESS=(PROTOCOL=TCP)(HOST=cbzaprod.bdd.pjud)(PORT=3458))(ADDRESS=(PROTOCOL=TCP)(HOST=cbzaprod.bdd.pjud)(PORT=3458))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=CBZAPROD)))',
            'schema' => 'PORTAL_SITCOB', //The schema that owns the tables, not necessarily your login schema
        ],

        'RPENPROD_OJV' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'rpenprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'USER_OJV',
            'password' => 'OJV#1522',
            'database' => '(DESCRIPTION=(FAILOVER=on)(LOAD_BALANCE=off)(ADDRESS=(PROTOCOL=TCP)(HOST=rpenprod.bdd.pjud)(PORT=1524))(ADDRESS=(PROTOCOL=TCP)(HOST=rpenprod.bdd.pjud)(PORT=1524))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=RPENPROD)))',
            'schema' => 'USER_OJV', //The schema that owns the tables, not necessarily your login schema
        ],

        'LABOPROD_OJV' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Oracle\Driver\Oracle',
            'host' => 'laboprod.bdd.pjud', //Usually unused for Oracle connections */
            'username' => 'CONS_PORTAL',
            'password' => 'salmo23',
            'database' => '(DESCRIPTION=(FAILOVER=on)(LOAD_BALANCE=off)(ADDRESS=(PROTOCOL=TCP)(HOST=laboprod.bdd.pjud)(PORT=1561))(ADDRESS=(PROTOCOL=TCP)(HOST=laboprod.bdd.pjud)(PORT=1561))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=LABOPROD)))',
            'schema' => 'CONS_PORTAL', //The schema that owns the tables, not necessarily your login schema
        ],

        /**
         * The test connection is used during the test suite.
         */
        'test' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            //'encoding' => 'utf8mb4',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
            'log' => false,
            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
            'url' => env('DATABASE_TEST_URL', null),
        ],
    ],

    /**
     * Configures logging options
     */
    'Log' => [
        'debug' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'debug',
            'url' => env('LOG_DEBUG_URL', null),
            'scopes' => false,
            'levels' => ['notice', 'info', 'debug'],
        ],
        'error' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'error',
            'url' => env('LOG_ERROR_URL', null),
            'scopes' => false,
            'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
        ],
        // To enable this dedicated query log, you need set your datasource's log flag to true
        'queries' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'queries',
            'url' => env('LOG_QUERIES_URL', null),
            'scopes' => ['queriesLog'],
        ],
    ],

    /**
     * Session configuration.
     *
     * Contains an array of settings to use for session configuration. The
     * `defaults` key is used to define a default preset to use for sessions, any
     * settings declared here will override the settings of the default config.
     *
     * ## Options
     *
     * - `cookie` - The name of the cookie to use. Defaults to 'CAKEPHP'. Avoid using `.` in cookie names,
     *   as PHP will drop sessions from cookies with `.` in the name.
     * - `cookiePath` - The url path for which session cookie is set. Maps to the
     *   `session.cookie_path` php.ini config. Defaults to base path of app.
     * - `timeout` - The time in minutes the session should be valid for.
     *    Pass 0 to disable checking timeout.
     *    Please note that php.ini's session.gc_maxlifetime must be equal to or greater
     *    than the largest Session['timeout'] in all served websites for it to have the
     *    desired effect.
     * - `defaults` - The default configuration set to use as a basis for your session.
     *    There are four built-in options: php, cake, cache, database.
     * - `handler` - Can be used to enable a custom session handler. Expects an
     *    array with at least the `engine` key, being the name of the Session engine
     *    class to use for managing the session. CakePHP bundles the `CacheSession`
     *    and `DatabaseSession` engines.
     * - `ini` - An associative array of additional ini values to set.
     *
     * The built-in `defaults` options are:
     *
     * - 'php' - Uses settings defined in your php.ini.
     * - 'cake' - Saves session files in CakePHP's /tmp directory.
     * - 'database' - Uses CakePHP's database sessions.
     * - 'cache' - Use the Cache class to save sessions.
     *
     * To define a custom session handler, save it at src/Network/Session/<name>.php.
     * Make sure the class implements PHP's `SessionHandlerInterface` and set
     * Session.handler to <name>
     *
     * To use database sessions, load the SQL file located at config/schema/sessions.sql
     */
    'Session' => [
        'defaults' => 'php',
        'timeout'=> 24*60
    ],
];
