Anax WEATHER mod (v1)
==================================




Install as Anax module
------------------------------------

This is how you install the module into an existing Anax installation.

Install using composer.

```
composer require aiur18/vaderanax "dev-master"
```

Copy the needed files, configuration and setup the weathermod

```
rsync -av vendor/aiur18/vaderanax/.anax/ .anax/
rsync -av vendor/aiur18/vaderanax/config/ config/
rsync -av vendor/aiur18/vaderanax/src/ src/
rsync -av vendor/aiur18/vaderanax/test/ test/
rsync -av vendor/aiur18/vaderanax/view/ view/
rsync -av vendor/aiur18/vaderanax/.phpcs.xml ./
rsync -av vendor/aiur18/vaderanax/.phpdoc.xml ./
rsync -av vendor/aiur18/vaderanax/.phpmd.xml ./
rsync -av vendor/aiur18/vaderanax/.phpunit.xml ./
rsync -av vendor/aiur18/vaderanax/LICENSE.txt ./
rsync -av vendor/aiur18/vaderanax/README.md ./
rsync -av vendor/aiur18/vaderanax/REVISION.md ./

```


Dependency
------------------

This is a Anax modulen and primarly intended to be used together with the Anax framework.
Run the following script.
```
./.anax/scaffold/postprocess.bash
```


License
------------------

This software carries a MIT license. See LICENSE.txt for details.



```
 .  
..:  Copyright (c) 2017 - 2019 knasenn (knasenn@dbwebb.se)
```
