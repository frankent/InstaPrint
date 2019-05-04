# Instagram Printer
Get all public Instagram feed by #Hashtag please keep in your mind 
```WTF
THIS PROJECT IS NOT MADE FOR COMMERCIAL...
```
If you want to use it as a commercial **please support me a beer or coffee (my wife drink a lot) :P**

**FYI.** This project has made and used in a few years ago to support my personal wedding. all code and some logic will look messy.

**FYI2**. I will happy if has anyone can improve this project and make a pull request

### Features
- Get all #Hastag Instagram public feed
- Create a new image map with template and Print it out

### Required
This Project's designed to run in `Raspberry Pi3 with Docker service` based on `laravel 5.3`
but you can use this project with `PC` or `WTF any platform` but you have to provide all package down here to my kid :)

#### PHP Package
- PHP SQLite
- PHP Imagick

#### Server Package
- CUPS ([control printer service](https://www.cups.org/))
- CronJOB

FYI. if I missing some stuff please update this note by open `Pull Request`

### Command
Get instagram feed by using this command
```bash
php artisan instagram:feed
```

Print Image, this method will return print command please pipe it to shell to allow server execute it
```bash
php artisan instagram:print | sh
```

Cron script example (Write it from my memory not sure is it work)
```bash
# for who use it in with out docker
* * * * * php artisan instagram:feed && php artisan instagram:print | sh

```

```bash
# for docker usage
* * * * * docker exec bash -c "cd {path} && php artisan instagram:feed && php artisan instagram:print" | sh
```


### If you like please support us :)

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F2M5VKQ8Y7236)
