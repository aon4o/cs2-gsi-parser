# A parser for CS2 Game State Integration data.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/aon4o/cs2-gsi-parser.svg?style=flat-square)](https://packagist.org/packages/aon4o/cs2-gsi-parser)
[![Tests](https://img.shields.io/github/actions/workflow/status/aon4o/cs2-gsi-parser/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/aon4o/cs2-gsi-parser/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/aon4o/cs2-gsi-parser.svg?style=flat-square)](https://packagist.org/packages/aon4o/cs2-gsi-parser)

This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/cs2_gsi_parser.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/cs2_gsi_parser)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can
support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.
You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards
on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require aon4o/cs2-gsi-parser
```

## Usage

### Parser

The parser class accepts a JSON string, an associative array or an object.

The result you get back is a fully typed object representing the game state.

```php
use Aon4o\Cs2GsiParser\GSIParser;

/** @var string|array|object $data */
$game_state = GSIParser::parse($data);

echo $game_state->map->name; // de_dust2
```

### Config generator

You can also generate a config file for CS2 GSI.

```php
use Aon4o\Cs2GsiParser\GSIConfigWriter;

$config = GSIConfigWriter::new()
    ->setUrl('http://yourdomain.com/cs2-gsi-endpoint')
    ->setAuthToken('your_auth_key')
    ->setSettings(timeout: 5.0, buffer: 0.1, throttle: 0.1, heartbeat: 30.0)
    ->get();

echo $config;
// "cs2-gsi"
// {
//     "uri" "http://yourdomain.com/cs2-gsi-endpoint"
//     "timeout" "5"
//     "buffer"  "0.1"
//     "throttle" "0.1"
//     "heartbeat" "30"
//     "auth"
//     {
//         "token" "your_auth_key"
//     }
//     "data"
//     {
//         "map_round_wins" "1"
//         "map" "1"
//         "player_id" "1"
//         "player_match_stats" "1"
//         "player_state" "1"
//         "player_weapons" "1"
//         "provider" "1"
//         "round" "1"
//         "allgrenades" "1"
//         "allplayers_id" "1"
//         "allplayers_match_stats" "1"
//         "allplayers_position" "1"
//         "allplayers_state" "1"
//         "allplayers_weapons" "1"
//         "bomb" "1"
//         "phase_countdowns" "1"
//         "player_position" "1"
//     }
// }
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Alex Naida](https://github.com/aon4o)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
