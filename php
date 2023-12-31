Symfony 5.4.23 (env: dev, debug: true) #StandWithUkraine https://sf.to/ukraine

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -e, --env=ENV         The Environment name. [default: "dev"]
      --no-debug        Switch off debug mode.
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  about                       Display information about the current project
  completion                  Dump the shell completion script
  help                        Display help for a command
  list                        List commands
 assets
  assets:install              Install bundle's web assets under a public directory
 cache
  cache:clear                 Clear the cache
  cache:pool:clear            Clear cache pools
  cache:pool:delete           Delete an item from a cache pool
  cache:pool:list             List available cache pools
  cache:pool:prune            Prune cache pools
  cache:warmup                Warm up an empty cache
 config
  config:dump-reference       Dump the default configuration for an extension
 debug
  debug:autowiring            List classes/interfaces you can use for autowiring
  debug:config                Dump the current configuration for an extension
  debug:container             Display current services for an application
  debug:dotenv                Lists all dotenv files with variables and values
  debug:event-dispatcher      Display configured listeners for an application
  debug:router                Display current routes for an application
 lint
  lint:container              Ensure that arguments injected into services match type declarations
  lint:yaml                   Lint a YAML file and outputs encountered errors
 router
  router:match                Help debug routes by simulating a path info match
 secrets
  secrets:decrypt-to-local    Decrypt all secrets and stores them in the local vault
  secrets:encrypt-from-local  Encrypt all local secrets to the vault
  secrets:generate-keys       Generate new encryption keys
  secrets:list                List all secrets
  secrets:remove              Remove a secret from the vault
  secrets:set                 Set a secret in the vault
 security
  security:check              Checks security issues in your project dependencies
