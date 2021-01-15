# OpenFakeGenerator

A simple project to display fake datas. All datas are generated by `fakerphp/faker`, this project only show this datas 
in a webpage :)

## Installation

```bash
git clone https://github.com/leblanc-simon/open-fake-generator.git
cd open-fake-generator
composer install
```

## Page and options

### Options available

All options are available for API and webpage. You can add option in the URL (GET argument)

* locale : generate fake datas in a specifical locale (by default : your preferred language of your browser)
* gender : select a *male* or *female* (by default : random gender)
* type: select a specifical type of data
    * *person* (by default) : all datas
    * *contact*
    * *address*
    * *bank*
    * *company*

### API

Generate a JSON with fake datas : http://fake.leblanc.io/api/

### Webpage

Generate a webpage with fake datas : http://fake.leblanc.io/

One click in the value generated, copy the data in your clipboard.

## Thanks to

* https://fakerphp.github.io/
* https://symfony.com/components
* https://twig.symfony.com/
* https://www.iconfinder.com/becris (for logo)

## License

* [WTFPL](http://www.wtfpl.net/txt/copying/)


