local:  composer-local  vendor project generate-files

composer-local:
	ln -s -f composer.json.local composer.json

composer-github:
	ln -s -f composer.json.github composer.json

vendor:
	composer install

project: vendor
	vendor/bin/ethnam-generator add-project -b . My

generate-files: project
	vendor/bin/ethnam-generator add-action hello
	vendor/bin/ethnam-generator add-view -t hello
	vendor/bin/ethnam-generator add-template hello2
	vendor/bin/ethnam-generator add-entry-point -g cli mycli
	vendor/bin/ethnam-generator add-entry-point -g www mywww
	vendor/bin/ethnam-generator clear-cache
	vendor/bin/ethnam-generator i18n
	vendor/bin/ethnam-generator help
	vendor/bin/ethnam-generator

test: generate-files
	test -d app
	test -d www
	test -e .ethna
	test -f app/action/Hello.php
	test -f app/view/Hello.php
	test -f template/ja_JP/hello.tpl
	test -f template/ja_JP/hello2.tpl
	grep '入力してください' locale/ja_JP/LC_MESSAGES/ethna_sysmsg.ini >/dev/null

clean:
	rm .ethna app bin etc lib locale log schema skel template tmp www -rf

destroy: clean
	rm .ethna composer.lock vendor -rf

